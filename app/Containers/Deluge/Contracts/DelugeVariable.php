<?php

namespace App\Containers\Deluge\Contracts;

use App\Containers\Deluge\Deluge;

interface DelugeVariable
{
    public function getName(): string;
    public function define(mixed $value = null, string $close = Deluge::SEMICOLON_NEW_LINE_TAB): string;
}
