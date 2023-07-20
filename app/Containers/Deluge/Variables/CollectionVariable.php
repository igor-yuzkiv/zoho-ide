<?php

namespace App\Containers\Deluge\Variables;

use App\Containers\Deluge\Contracts\DelugeVariable;
use App\Containers\Deluge\DelugeSyntax;

/**
 *
 */
class CollectionVariable implements DelugeVariable
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
        // TODO: Implement define() method.
    }
}
