<?php

namespace App\Containers\Deluge\Variables;

use App\Containers\Deluge\Contracts\DelugeVariable;
use App\Containers\Deluge\Deluge;
use App\Containers\DelugeSyntax;

/**
 *
 */
class MapVariable implements DelugeVariable
{
    /**
     * @param string $variableName
     */
    public function __construct(protected string $variableName)
    {

    }

    /**
     * @param mixed|null $value
     * @param string $close
     * @return string
     */
    public function define(mixed $value = null, string $close = DelugeSyntax::SEMICOLON_NEW_LINE_TAB): string
    {
        //TODO: define with value
        return "$this->variableName = Map();" . $close;
    }

    /**
     * @param $key
     * @param string $close
     * @return string
     */
    public function get($key, string $close = ";\n\t"): string
    {
        return $this->variableName . ".get(\"$key\")" . $close;
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $close
     * @return string
     * TODO: value types
     */
    public function put(string $key, mixed $value, string $close = ";\n\t"): string
    {
        return $this->variableName . ".put(\"$key\", $value)" . $close;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->variableName;
    }
}
