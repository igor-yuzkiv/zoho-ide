<?php

namespace App\Containers\Deluge\Actions;


use App\Abstractions\Contracts\ActionInterface;
use App\Containers\Deluge\Models\Snippet\Snippet;

/**
 *
 */
class UpdateSnippetProcedure implements ActionInterface
{
    /**
     * @param Snippet $snippet
     * @param array $data
     */
    public function __construct(
        protected readonly Snippet $snippet,
        protected readonly array   $data
    )
    {

    }


    /**
     * @return Snippet
     */
    public function handle(): Snippet
    {
        $this->snippet->update($this->data);

        $arguments = \Arr::get($this->data, 'arguments', []);
        if (!empty($arguments)) {
            (new SaveArgumentsAction($this->snippet, $arguments))->handle();
        }

        return $this->snippet;
    }
}
