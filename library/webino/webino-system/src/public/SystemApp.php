<?php

namespace Webino;

/**
 * Class SystemApp
 * @package webino-system
 */
final class SystemApp extends App
{
    /**
     * {@inheritdoc}
     * @TODO system app make
     */
    static function make(): AppInterface
    {
        AppDebugger::enable();

        // TODO
        \Locale::setDefault('sk_SK');

        $app = parent::make();

        // view response
        $app->on(ViewResponseHandler::class);
        // router handler
        $app->on(RouterHandler::class);

        // TODO
        // Modules
        $app->on(TranslationModule::class);
        $app->on(SystemModule::class);
        $app->on(DefaultModule::class);

        // console dispatch
        // TODO handler class
        $app->on(ConsoleResponseEvent::class, function () {

            return 'Hello Console!';

        });

        // require user-land bootstrap config
        require $app->getFile('system://config/bootstrap.php')->getRealPath();

        return $app;
    }

}
