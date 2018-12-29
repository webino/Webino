<?php

namespace Webino;

/**
 * Class ViewFormHandler
 * @TODO redesign
 * @package webino-view
 */
class ViewFormHandler extends AbstractViewHandler
{
    /**
     * Returns form views query XPath
     *
     * @return string
     */
    protected function getQueryXpath(): string
    {
        return '//*[substring(name(), string-length(name()) - string-length(\'-form\') +1) = \'-form\']';
    }

    /**
     * Setup form view for each node
     *
     * @param HtmlNode $node
     * @param InstanceContainerInterface $container
     */
    protected function eachNode(HtmlNode $node, InstanceContainerInterface $container): void
    {
        $nodeName = $node->getName();
        $class = (new FilterDashCaseToCamelCase)->filter(substr($nodeName, 0, strlen($nodeName) - 5));
        $view = $container->get("\Webino\\{$class}Form");
        $this->addViewItem($class, new ViewFormHandlerItem($view, $node));
    }

    /**
     * Dispatch form
     *
     * @param ViewDispatchEvent $event
     * @return mixed|null
     */
    protected function dispatch(ViewDispatchEvent $event)
    {
        $app = $event->getApp();

        foreach ($this->views as $class => $subForms) {
            /** @var ViewFormHandlerItem $item */
            foreach ($subForms as $item) {
                $viewForm = $item->getView();

                if (method_exists($viewForm, 'createForm')) {
                    if (isset($this->dispatched[$class])) {
                        /** @var ViewFormHandlerItem $lastItem */
                        $lastItem = $this->dispatched[$class];
                        $item->setForm($lastItem->getForm());
                        continue;
                    }
                    $this->dispatched[$class] = $item;

                    /** @var Form $form */
                    $formSpec = iterator_to_array($viewForm->createForm($event->getApp()));

                    $cacheId = md5(serialize($formSpec));
                    $cacheFile = $app->getFile("cache://forms/{$cacheId}.php");

                    if ($cacheFile->exists()) {
                        // load cached form
                        $form = call_user_func(function () use ($cacheFile, $app) {
                            $c = $app;
                            return require $cacheFile->getRealPath();
                        });

                    } else {
                        // TODO
                        $cache = ['$i = [];'];
                        $inputCache = [];
                        $formInputs = [];
                        $inputOptions = [];
                        $formObjects = [];

                        foreach ($formSpec as $formClass => $formOptions) {
                            foreach ($formOptions as $formOptionKey => $formOptionValue) {
                                if (is_numeric($formOptionKey)) {
                                    $formOptionKey = $formOptionValue;
                                    $formOptionValue = null;
                                }

                                if (class_exists($formOptionKey)) {
                                    $formObjects[] = $app->get($formOptionKey);
                                    // TODO cache
                                    $cache[] = sprintf('$i[] = $c->get(\'%s\', %s);', $formOptionKey, var_export($formOptionValue, true));
                                    continue;
                                }

                                $inputCache[$formOptionKey] = ['$o = [];'];

                                foreach ($formOptionValue as $formOptionItemKey => $formOptionItemValue) {
                                    if (is_numeric($formOptionItemKey)) {
                                        $formOptionItemKey = $formOptionItemValue;
                                        $formOptionItemValue = null;
                                    }

                                    if (class_exists($formOptionItemKey)) {
                                        $implements = class_implements($formOptionItemKey);
                                        if (isset($implements[FormFieldInterface::class])) {
                                            // fileds
                                            $formInputs[$formOptionKey] = $formOptionItemKey;

                                        } elseif (isset($implements[FormButtonInterface::class])) {
                                            // buttons
                                            $inputObject = $app->create($formOptionItemKey, $formOptionKey, $formOptionItemValue);
                                            $inputOptions[$formOptionKey][] = $inputObject;
                                            $formInputs[$formOptionKey] = $inputObject;

                                            // TODO cache
                                            $inputCache[$formOptionKey][] = sprintf('$i[] = $c->create(\'%s\', \'%s\', %s);', $formOptionItemKey, $formOptionKey, var_export($formOptionItemValue, true));

                                        } else {
                                            // other
                                            $inputObject = $app->create($formOptionItemKey, $formOptionItemValue);
                                            $inputOptions[$formOptionKey][] = $inputObject;

                                            // TODO cache
                                            $inputCache[$formOptionKey][] = sprintf('$o[] = $c->create(\'%s\', %s);', $formOptionItemKey, var_export($formOptionItemValue, true));
                                        }
                                    }
                                }
                            }
                            break;
                        }

                        foreach ($formInputs as $inputName => &$input) {

                            // TODO cache
                            $inputClass = is_object($input) ? get_class($input) : $input;
                            $cache[] = join("\n", $inputCache[$inputName] ?? []);

                            if (is_object($input)) {
                                continue;
                            }

                            // TODO cache
                            $cache[] = sprintf('$i[] = $c->create(\'%s\', \'%s\', $o);', $inputClass, $inputName);

                            // create input
                            $input = $app->create($input, $inputName, $inputOptions[$inputName] ?? []);
                        }

                        $form = $app->create($formClass, $formObjects + $formInputs);

                        // TODO cache
                        $cache[] = sprintf('return $c->create(\'%s\', $i);', $formClass);
                        $cacheFile->setContents("<?php \n" . join($cache, "\n"));
                    }

                    // TODO
                    $item->setForm($form);

                    if (method_exists($viewForm, 'dispatch')) {
                        $dispatchEvent = new FormDispatchEvent($event);
                        $dispatchEvent->setForm($form);
                        $item->setDispatchEvent($dispatchEvent);

                        $response = $viewForm->dispatch($dispatchEvent);
                        $dispatchEvent->getForm() or $item->setForm(null);

                        if ($response) {
                            return $response;
                        }
                    }

                    if ($form->submit($event->getRequest())) {
                        if (method_exists($viewForm, 'submit')) {
                            $submitEvent = new FormSubmitEvent($event);
                            $submitEvent->setForm($form);
                            $item->setDispatchEvent($submitEvent);

                            $response = $viewForm->submit($submitEvent);
                            $submitEvent->getForm() or $item->setForm(null);

                            if ($response) {
                                return $response;
                            }
                        }
                    }
                }
                break;
            }
        }

        return null;
    }

    /**
     * View form
     *
     * @param ViewResponseEvent $event
     */
    protected function view(ViewResponseEvent $event): void
    {
        foreach ($this->views as $subForms) {
            /** @var ViewFormHandlerItem $item */
            foreach ($subForms as $item) {
                $viewForm = $item->getView();
                $node = $item->getNode();

                $response = true;
                if (method_exists($viewForm, 'view')) {
                    // custom view
                    $viewEvent = new ViewFormEvent($item->getDispatchEvent());
                    $viewEvent->setNode($node);
                    $response = $viewForm->view($viewEvent);
                }

                if (false !== $response) {
                    // default view
                    $form = $item->getForm();
                    if ($form) {
                        $node->replaceWithPart($form);
                    } else {
                        $node->remove();
                    }
                }
            }
        }
    }
}
