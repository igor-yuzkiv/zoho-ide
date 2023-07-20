<?php

namespace App\Containers\Deluge\ZohoServices\Creator;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Deluge;

class InsertRecord extends CodeSnippet
{
    public function __construct(
        protected string $formName,
        protected array $fields
    )
    {

    }

    public function build(): string{
        $code = "r_$this->formName = insert into $this->formName\n\t[";
        foreach ($this->fields as $field => $value) {
            $code .= "\n\t\t$field = $value";
        }
        $code .= "\n\t]" . Deluge::SEMICOLON_NEW_LINE_TAB;
        return $code;
    }
}
