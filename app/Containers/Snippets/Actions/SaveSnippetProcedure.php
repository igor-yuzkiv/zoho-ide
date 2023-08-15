<?php

namespace App\Containers\Snippets\Actions;

use App\Abstractions\Contracts\Action\ActionInterface;
use App\Containers\Snippets\DTO\SnippetDto;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

/**
 *
 */
class SaveSnippetProcedure implements ActionInterface
{
    /**
     * @param SnippetDto $snippetDto
     * @param Snippet|null $snippet
     */
    public function __construct(
        protected SnippetDto $snippetDto,
        protected ?Snippet   $snippet = null
    )
    {

    }

    /**
     * @return Snippet
     */
    public function handle(): Snippet
    {
        if (!$this->snippet) {
            $this->snippet = new Snippet();
        }

        $this->snippet->fill($this->snippetDto->toArray());

        $this->saveTemplateComponent();

        $this->snippet->save();

        $this->saveArguments();

        return $this->snippet;
    }

    /**
     * @return void
     */
    private function saveArguments(): void
    {
        if (empty($this->snippetDto->arguments)) {
            return;
        }

        (new SaveSnippetArgumentsAction($this->snippet, $this->snippetDto->arguments))->handle();
    }


    /**
     * @return bool
     */
    protected function saveTemplateComponent(): void
    {
        if (!$this->snippetDto->content) {
            return;
        }

        (new SaveSnippetContentAction(
            snippet: $this->snippet,
            content: $this->snippetDto->content,
            prevComponentName: $this->snippet->getOriginal('component_name')
        ))->handle();
    }
}
