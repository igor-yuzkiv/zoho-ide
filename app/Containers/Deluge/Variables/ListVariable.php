<?php

namespace App\Containers\Deluge\Variables;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Contracts\DelugeVariable;
use App\Containers\Deluge\DelugeSyntax;

/**
 *
 */
class ListVariable implements DelugeVariable
{
    /**
     * @param string $variableName
     */
    public function __construct(protected string $variableName)
    {

    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return $this->variableName;
    }

    /**
     * @param mixed|null $value
     * @param string $close
     * @return string
     */
    public function define(mixed $value = null, string $close = DelugeSyntax::SEMICOLON_NEW_LINE_TAB): string
    {
        //TODO: define with value
        return "$this->variableName = List();" . $close;
    }

    /**
     * @param string|CodeSnippet $value
     * @param string $close
     * @return string
     */
    public function add(string|CodeSnippet $value, string $close = DelugeSyntax::SEMICOLON_NEW_LINE_TAB): string
    {
        return $this->variableName . ".add($value)" . $close;
    }

    /**
     * @param int $index
     * @param string $close
     * @return string
     */
    public function get(int $index, string $close = DelugeSyntax::SEMICOLON_NEW_LINE_TAB): string
    {
        return $this->variableName . ".get($index)$close";
    }

    //TODO: delete and other methods
}
