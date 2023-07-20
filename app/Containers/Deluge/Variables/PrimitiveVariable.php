<?php

namespace App\Containers\Deluge\Variables;

use App\Containers\Deluge\Contracts\DelugeVariable;
use App\Containers\Deluge\Deluge;
use App\Containers\DelugeSyntax;

class PrimitiveVariable implements DelugeVariable
{
    public function __construct(protected string $variableName)
    {

    }

    public function define(mixed $value = null, string $close = DelugeSyntax::SEMICOLON_NEW_LINE_TAB): string
    {
        $valueType = gettype($value);
        switch ($valueType) {
            case "string":
                $value = "\"$value\"";
                break;
            case "integer":
            case "double":
                break;
            case "boolean":
                $value = $value ? "true" : "false";
                break;
            case "NULL":
                $value = "null";
                break;
        }

        return "$this->variableName = " . $value . $close;
    }

    public function getName(): string
    {
        return $this->variableName;
    }
}
