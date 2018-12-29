<?php

namespace Webino;

/**
 * Class TranslationConfig
 * @package webino-translation
 */
class TranslationConfig
{
    /**
     * @var InstanceContainerInterface
     */
    private $container;

    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * @var iterable
     */
    private $translations = [];

    /**
     * @param CreateServiceEvent $event
     * @return TranslationConfig
     */
    static function create(CreateServiceEvent $event): TranslationConfig
    {
        $app = $event->getApp();
        return new static($app, $app);
    }

    /**
     * @param InstanceContainerInterface $container
     * @param FilesystemInterface $filesystem
     */
    function __construct(InstanceContainerInterface $container, FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
        $this->container = $container;
    }

    /**
     * Register translation
     *
     * @param string $dirPath Translation directory path
     */
    function configTranslation(string $dirPath): void
    {
        foreach ($this->filesystem->getFileList($dirPath)->withExtension('php') as $item) {
            $this->translations[$item->getName()][] = $item->getRealPath();
        }
    }

    /**
     * Configure router
     *
     * @param Translator $translator
     */
    function configTranslator(Translator $translator): void
    {
        foreach ($this->translations as $locale => $paths) {
            foreach ($paths as $path) {
                $translator->addLazyTranslation($locale, function () use ($path) {
                    return $this->container->create(Translation::class, require $path);
                });
            }
        }
    }
}
