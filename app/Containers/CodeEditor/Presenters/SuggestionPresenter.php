<?php

namespace App\Containers\CodeEditor\Presenters;

use App\Abstractions\Contracts\Presenter\IterablePresenter;
use App\Containers\CodeEditor\Contracts\SuggestionsProvider;

/**
 *
 */
class SuggestionPresenter implements IterablePresenter
{
    /**
     * @return iterable
     */
    public function present(): iterable
    {
        $suggestions = [];
        foreach ($this->getProviders() as $provider) {
            $suggestions = array_merge($suggestions, $provider->provide());
        }

        return $suggestions;
    }


    /**
     * @return SuggestionsProvider[]
     */
    private function getProviders(): array
    {
        $result = [];

        foreach (config('project.code_editor.suggestions_providers') as $providerClass) {
            $provider = app($providerClass);

            if ($provider instanceof SuggestionsProvider) {
                $result[] = $provider;
            } else {
                throw new \InvalidArgumentException('Invalid provider class, should implement SuggestionsProvider interface');
            }
        }

        return $result;
    }
}
