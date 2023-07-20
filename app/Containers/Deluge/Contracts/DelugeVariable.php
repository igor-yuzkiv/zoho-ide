<?php

namespace App\Containers\Deluge\Contracts;

use App\Containers\Deluge\Deluge;
use App\Containers\DelugeSyntax;

interface DelugeVariable
{
    public function getName(): string;
    public function define(mixed $value = null, string $close = DelugeSyntax::SEMICOLON_NEW_LINE_TAB): string;
}
