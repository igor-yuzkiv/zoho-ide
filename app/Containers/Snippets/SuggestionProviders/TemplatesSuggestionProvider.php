<?php

namespace App\Containers\Snippets\SuggestionProviders;

use App\Containers\CodeEditor\Contracts\SuggestionsProvider;
use App\Containers\CodeEditor\Enums\MonacoCompletionItemKind;
use App\Containers\Snippets\Enums\ArgumentType;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Models\Snippet;

/**
 * Monaco Editor Suggestions Provider for Templates
 */
class TemplatesSuggestionProvider implements SuggestionsProvider
{
    /**
     * @return array
     */
    public function provide(): array
    {
        $snippets = Snippet::query()
            ->where("type", SnippetType::TEMPLATE)
            ->whereNotNull('component_name')
            ->get();

        $result = [];
        foreach ($snippets as $snippet) {
            $result[] = $this->prepareItem($snippet);
        }

        return $result;
    }


    /**
     * @param Snippet $snippet
     * @return array
     */
    private function prepareItem(Snippet $snippet): array
    {
        $insertText = "<x-" . $snippet->component_name;
        $props = "";
        $slots = "";
        foreach ($snippet->arguments as $argument) {
            if ($argument->is_slot) {
                $slots .= "\n<x-slot:" . $argument->name . "> </x-slot>";
            } else {
                $props .= " " . $argument->name . "=\"\"";
            }
        }
        $insertText .= "$props>$slots\n</x-" . $snippet->component_name . ">";

        return [
            "label"         => $snippet->title,
            "kind"          => MonacoCompletionItemKind::Snippet->value,
            "insertText"    => $insertText,
            "documentation" => $snippet->description ?? "",
        ];
    }
}
