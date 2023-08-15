<?php

namespace App\Containers\Snippets\DTO;

use App\Abstractions\DataTransferObject;

class SnippetDto extends DataTransferObject
{
    public string $title;
    public ?string $description = null;
    public string $component_name;
    public ?string $type = null;
    public ?string $language = null;
    public ?string $content = null;
    public array $arguments = [];
}
