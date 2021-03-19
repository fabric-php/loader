<?php

namespace Fabric\Loader\Exception;

use RuntimeException;

final class TemplateNotFound extends RuntimeException implements FabricLoaderExceptionInterface
{
    public static function withName(string $templateName): self
    {
        return new self("Template '$templateName' not found.'");
    }
}
