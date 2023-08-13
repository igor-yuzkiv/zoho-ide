<?php

namespace App\Containers\Snippets\Presenters;

use App\Abstractions\Contracts\Presenter\IterablePresenter;
use App\Containers\IDE\Enums\MonacoCompletionItemKind;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

/**
 *
 */
class IdeSuggestionsPresenter implements IterablePresenter
{
    /**
     * @return iterable
     */
    public function present(): iterable
    {
        return array_merge(
            $this->bladeSuggestions(),
            $this->snippetsSuggestions()
        );
    }

    /**
     * @return array[]
     */
    public function bladeSuggestions(): array
    {
        return [
            [
                "label"      => "blade-if",
                "kind"       => MonacoCompletionItemKind::Snippet->value,
                "insertText" => "@if()\n@endif",
            ],
            [
                "label"      => "blade-foreach",
                "kind"       => MonacoCompletionItemKind::Snippet->value,
                "insertText" => "@foreach(\$items as \$key => \$value)\n@endforeach",
            ],
            [
                "label"      => "<x-slot",
                "kind"       => MonacoCompletionItemKind::Snippet->value,
                "insertText" => "<x-slot:></x-slot>",
            ],
            [
                "label"      => '$slot',
                "kind"       => MonacoCompletionItemKind::Snippet->value,
                "insertText" => '{!! $slot !!}',
            ]
        ];
    }

    /**
     * @return array
     */
    public function snippetsSuggestions(): array
    {
        $snippets = Snippet::query()
            ->where("type", SnippetType::TEMPLATE)
            ->whereNotNull('component_name')
            ->get();


        $result = [];

        foreach ($snippets as $snippet) {
            $result[] = [
                "label"      => $snippet->name,
                "kind"       => MonacoCompletionItemKind::Snippet->value,
                "insertText" => $snippet->component_insert_text,
            ];
        }

        return $result;
    }
}
