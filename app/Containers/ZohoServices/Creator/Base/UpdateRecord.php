<?php

namespace App\Containers\ZohoServices\Creator\Base;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\DelugeSyntax;

class UpdateRecord extends CodeSnippet
{
    public function __construct(
        protected string $collectionName,
        protected array $fields
    )
    {

    }

    public function build(): string
    {
        foreach ($this->fields as $key => $value) {
            $this->addLine(DelugeSyntax::TAB . $this->collectionName.".$key = " . $value. DelugeSyntax::NEW_LINE);
        }

        return $this->code;
    }
}