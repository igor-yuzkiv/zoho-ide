<?php

namespace App\Containers\Deluge\Base\Variables;

use App\Containers\Deluge\Base\DelugeSyntax;

interface DelugeVariable
{
    public function getName(): string;
    public function define(mixed $value = null, string $close = DelugeSyntax::CLOSE): string;
}
