<?php

namespace App\Containers\IDE\SuggestionProviders;

use App\Containers\IDE\Contracts\SuggestionsProvider;
use App\Containers\IDE\Enums\MonacoCompletionItemKind;

/**
 *
 */
class BladeSuggestionProvider implements SuggestionsProvider
{
    /**
     * @return array[]
     */
    public function provide(): array
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
}
