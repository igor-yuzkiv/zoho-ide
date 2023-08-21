<?php

namespace App\Containers\CodeEditor\Contracts;

interface SuggestionsProvider
{
    public function provide(): array;
}
