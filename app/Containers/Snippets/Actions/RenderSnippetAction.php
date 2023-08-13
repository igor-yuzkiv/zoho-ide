<?php

namespace App\Containers\Snippets\Actions;

use App\Abstractions\Contracts\Action\ActionInterface;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

/**
 *
 */
class RenderSnippetAction implements ActionInterface
{
    /**
     * @param Snippet $snippet
     * @param array $arguments
     */
    public function __construct(
        private readonly Snippet $snippet,
        private readonly array   $arguments = []
    )
    {

    }

    /**
     * @return string
     */
    public function handle(): string
    {
        $content = $this->snippet->getContent();
        if ($this->snippet->type === SnippetType::SAMPLE) {
            return $content;
        }

        return \Blade::render($this->snippet->getContent(), $this->getData());
    }

    /**
     * @return array
     */
    private function getData(): array
    {
        $data = [];
        $rules = [];

        foreach ($this->snippet->arguments as $argument) {
            $data[$argument->name] = \Arr::get($this->arguments, $argument->name, $argument->default_value);
            $rules[$argument->name] = $argument->required ? 'required' : 'nullable';
        }

        return \Validator::validate($data, $rules);
    }
}
