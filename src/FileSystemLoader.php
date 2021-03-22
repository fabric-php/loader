<?php

namespace Fabric\Loader;

use Interop\Template\Exception\TemplateNotFound;

final class FileSystemLoader implements TemplateLoaderInterface
{
    private array $directories;
    private string $extension;

    public function __construct(array $directories, string $extension = '.php')
    {
        $this->directories = $directories;
        $this->extension = $extension;
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

        throw TemplateNotFound::fromName($templateName);
    }
}
