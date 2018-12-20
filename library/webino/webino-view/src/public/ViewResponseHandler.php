<?php

namespace Webino;

/**
 * Class ViewResponseHandler
 * @package webino-view
 */
class ViewResponseHandler extends AbstractEventHandler
{
    /**
     * @return void
     */
    protected function initEvents(): void
    {
        $this->on(HttpResponseEvent::class, 'viewResponse', HttpResponseEvent::AFTER);
    }

    /**
     * @param HttpResponseEvent $event
     * @return HtmlResponse|null
     */
    function viewResponse(HttpResponseEvent $event): ?HtmlResponse
    {
        if ($event->getResponse()) {
            return null;
        }

        $app = $event->getApp();

        if (empty($app[LayoutView::FILE])) {
            return null;
        }

        $layoutPath = $app[LayoutView::FILE];
        $layoutFile = $app->getFile($layoutPath);
        $html = $layoutFile->getContents();

        // add general view handlers
        $app->on(ViewFormHandler::class);
        $app->on(ViewHandler::class);

        // create HTML document
        $dom = $app->create(HtmlDocument::class, $html);

        // layout phase
        $layoutEvent = new ViewLayoutEvent($event);
        $layoutEvent->setDom($dom);
        // layout loop
        for ($i=0; $i < 999; $i++) {
            $break = true;

            $app->emit($layoutEvent, function ($response) use (&$break) {
                // break loop on false response
                null !== $response or $break = true;
            });

            if ($break) {
                break;
            }
        }

        // dispatch phase
        $dispatch = true;
        $dispatchEvent = new ViewDispatchEvent($layoutEvent);
        $app->emit($dispatchEvent, function ($response) use ($event, &$dispatch) {
            // response by view
            if ($response) {
                $dispatch = false;
                $event->setResponse($response);
                return true;
            }
            return false;
        });

        // view phase
        $viewEvent = new ViewResponseEvent($layoutEvent);
        $viewEvent->setDom($dispatchEvent->getDom());
        $app->emit($viewEvent);

        // return view or HTML document response
        return $dispatch ? new HtmlResponse((string) $viewEvent->getDom()) : null;
    }
}
