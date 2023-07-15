<?php

namespace App\Containers\Deluge\Base\Variables;

use App\Containers\Deluge\Base\DelugeSyntax;

class PrimitiveVariable implements DelugeVariable
{
    public function __construct(protected string $variableName)
    {

    }

    public function define(mixed $value = null, string $close = DelugeSyntax::CLOSE): string
    {
        $valueType = gettype($value);
        switch ($valueType) {
            case "string":
                $value = "\"$value\"";
                break;
            case "integer":
            case "double":
                $value = "$value";
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
