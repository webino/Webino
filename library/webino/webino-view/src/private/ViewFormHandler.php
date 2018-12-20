<?php

namespace Webino;

/**
 * Class ViewFormHandler
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
        $class = (new Filter\DashCaseToCamelCase)->filter(substr($nodeName, 0, strlen($nodeName) - 5));
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
                    $form = $viewForm->createForm();
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
