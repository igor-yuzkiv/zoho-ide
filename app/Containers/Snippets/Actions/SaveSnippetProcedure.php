<?php

namespace App\Containers\Snippets\Actions;

use App\Abstractions\Contracts\ActionInterface;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

/**
 *
 */
class SaveSnippetProcedure implements ActionInterface
{
    /**
     * @param array $data
     * @param Snippet|null $snippet
     */
    public function __construct(
        protected array    $data,
        protected ?Snippet $snippet = null
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

        $this->snippet->fill($this->data);

        if ($this->snippet->type === SnippetType::TEMPLATE) {
            $this->saveTemplateComponent();
            $this->snippet->content = null;
        }

        $this->snippet->save();

        if (!empty(\Arr::get($this->data, 'arguments'))) {
            (new SaveArgumentsAction($this->snippet, $this->data['arguments']))->handle();
        }

        return $this->snippet;
    }

    /**
     * @return bool
     */
    protected function saveTemplateComponent(): bool
    {
        $filePath = base_path(config('project.snippets.components_folder')) . '/' . $this->snippet->component_name . '.blade.php';
        return (bool)file_put_contents($filePath, $this->data['content']);
    }
}
