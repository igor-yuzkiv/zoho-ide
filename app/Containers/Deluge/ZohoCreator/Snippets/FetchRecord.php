<?php

namespace App\Containers\Deluge\ZohoCreator\Snippets;

use App\Containers\Deluge\Base\DelugeSyntax;

class FetchRecord
{
    public function __construct(
        protected string $formName,
        protected string $criteria = "ID != 0",
        protected string $variableName = "record"
    )
    {

    }

    public function build(string $close = DelugeSyntax::CLOSE): string {
        return "$this->variableName = $this->formName[$this->criteria]$close";
    }
}
