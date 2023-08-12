<?php

namespace App\Containers\Snippets\Presenters;

use App\Abstractions\Contracts\PresenterInterface;
use App\Containers\Snippets\Enums\MonacoCompletionItemKind;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

class IdeSuggestionsPresenter implements PresenterInterface
{
    public function present(): iterable
    {
        return array_merge(
            $this->bladeSuggestions(),
            $this->snippetsSuggestions()
        );
    }

    public function bladeSuggestions(): array
    {
        return [
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
