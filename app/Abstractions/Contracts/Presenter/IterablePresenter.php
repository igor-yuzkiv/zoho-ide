<?php

namespace App\Abstractions\Contracts\Presenter;

interface IterablePresenter extends PresenterInterface
{
    public function present(): iterable;
}
