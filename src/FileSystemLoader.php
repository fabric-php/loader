<?php

namespace Fabric\Loader;

use Fabric\Loader\Exception\TemplateNotFound;

final class FileSystemLoader implements TemplateLoaderInterface
{
    private string $extension;
    private array $directories;

    public function __construct(string $extension, array $directories)
    {
        $this->extension = $extension;
        $this->directories = $directories;
    }

    /**
     * Find a template and return its content
     *
     * @param string $templateName The name of the template. Usually something like: product/view.tpl
     * @return string              The body of the template
     * @throws TemplateNotFound
     */
    public function load(string $templateName): string
    {
        foreach ($this->directories as $dir) {
            $path = $dir.DIRECTORY_SEPARATOR.$templateName.$this->extension;
            if (!file_exists($path)) {
                continue;
            }
            if (!is_readable($path)) {
                continue;
            }

            return file_get_contents($path);
        }

        throw TemplateNotFound::withName($templateName);
    }
}
