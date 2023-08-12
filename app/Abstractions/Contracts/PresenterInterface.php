<?php

namespace App\Abstractions\Contracts;

interface PresenterInterface
{
    public function present() : iterable;
}
