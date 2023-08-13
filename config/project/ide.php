<?php
return [
    'suggestions_providers' => [
        \App\Containers\IDE\SuggestionProviders\BladeSuggestionProvider::class,
        \App\Containers\Snippets\SuggestionProviders\TemplatesSuggestionProvider::class,
    ],
];
