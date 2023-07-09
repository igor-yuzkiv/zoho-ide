<?php

namespace App\Containers\Deluge\Variable;

abstract class DelugeVariable
{
    public function __construct(
        protected string $name
    )
    {

    }

    public function __toString(): string
    {
        return $this->compile();
    }

    abstract protected function declare(): string;

    abstract public function compile(): string;
}
