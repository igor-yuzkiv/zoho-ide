<?php
return [
    'suggestions_providers' => [
        \App\Containers\CodeEditor\SuggestionProviders\BladeSuggestionProvider::class,
        \App\Containers\Snippets\SuggestionProviders\TemplatesSuggestionProvider::class,
    ],
];
