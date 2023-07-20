<?php

namespace App\Containers\Deluge\ZohoServices\Creator;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Deluge;
use App\Containers\DelugeSyntax;

class FetchRecord extends CodeSnippet
{
    public function __construct(
        protected string $formName,
        protected string $criteria = "ID != 0",
        protected string $variableName = "record"
    )
    {

    }

    public function build(): string {
        return "$this->variableName = $this->formName[$this->criteria]" . DelugeSyntax::SEMICOLON_NEW_LINE_TAB;
    }
}