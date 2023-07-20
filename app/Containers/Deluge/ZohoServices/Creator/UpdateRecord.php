<?php

namespace App\Containers\Deluge\ZohoServices\Creator;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Contracts\DelugeVariable;
use App\Containers\Deluge\Deluge;
use App\Containers\Deluge\ZohoServices\DelugePrettier;
use App\Containers\DelugeSyntax;

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
