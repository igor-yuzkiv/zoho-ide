<?php

namespace App\Containers\IDE\Contracts;

interface SuggestionsProvider
{
    public function provide(): array;
}
