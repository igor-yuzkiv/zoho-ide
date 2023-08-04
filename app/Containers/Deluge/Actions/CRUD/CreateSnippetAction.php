<?php

namespace App\Containers\Deluge\Actions\CRUD;

use App\Abstractions\Contracts\ActionInterface;

class CreateSnippetAction implements ActionInterface
{
    public function __construct(
        protected readonly array $data
    )
    {

    }

    public function handle()
    {
        // TODO: Implement handle() method.
    }
}
