<?php

namespace App\Containers\Snippets\Actions;

use App\Abstractions\Contracts\Action\ActionInterface;
use App\Containers\Snippets\Models\Snippet;

/**
 *
 */
class SaveSnippetArgumentsAction implements ActionInterface
{
    /**
     * @param Snippet $snippet
     * @param array $arguments
     */
    public function __construct(
        protected readonly Snippet $snippet,
        protected readonly array   $arguments
    )
    {

    }

    /**
     * @return void
     */
    public function handle(): void
    {
        $this->deleteItems();
        $this->upsertArgument();
    }

    /**
     * @return void
     */
    protected function deleteItems(): void
    {
        $items = array_filter($this->arguments, function ($argument) {
            return \Arr::get($argument, '_delete') && \Arr::get($argument, 'id');
        });

        $this->snippet->arguments()->whereIn('id', array_column($items, 'id'))->delete();
    }

    /**
     * @return void
     */
    protected function upsertArgument(): void
    {
        $items = array_filter($this->arguments, function ($argument) {
            return !\Arr::get($argument, '_delete');
        });

        foreach ($items as $item) {
            if (\Arr::get($item, "id")) {
                $this->snippet->arguments()->find($item['id'])->update($item);
            } else {
                $this->snippet->arguments()->create($item);
            }
        }
    }
}
