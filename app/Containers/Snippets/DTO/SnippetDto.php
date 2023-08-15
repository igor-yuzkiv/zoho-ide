<?php

namespace App\Containers\Snippets\DTO;

use App\Abstractions\DataTransferObject;

class SnippetDto extends DataTransferObject
{
    public string $name;
    public string $component_name;
    public ?string $content = null;
    public ?string $description = null;
    public ?string $type = null;
    public array $arguments = [];
}
