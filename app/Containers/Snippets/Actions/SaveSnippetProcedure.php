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

        if ($this->snippet->type === SnippetType::TEMPLATE) {
            $this->saveTemplateComponent();
            $this->snippet->content = null;
        }

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

        (new SaveArgumentsAction($this->snippet, $this->snippetDto->arguments))->handle();
    }


    /**
     * @return bool
     */
    protected function saveTemplateComponent(): bool
    {
        $basePath = base_path(config('project.snippets.components_folder')) . '/';

        if ($this->snippet->isDirty('component_name')) {
            $oldFilePath = $basePath . $this->snippet->getOriginal('component_name') . '.blade.php';
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        }

        return (bool)file_put_contents(
            $basePath . $this->snippet->component_name . '.blade.php',
            $this->snippet->content
        );
    }
}
