<?php

namespace App\Containers\IDE\Presenters;

use App\Abstractions\Contracts\Presenter\IterablePresenter;
use App\Containers\IDE\Contracts\SuggestionsProvider;

class SuggestionPresenter implements IterablePresenter
{

    /**
     * @return SuggestionsProvider[]
     */
    private function getProvider(): array
    {
        $result = [];

        foreach (config('project.ide.suggestions_providers') as $providerClass) {
            $provider = app($providerClass);

            if ($provider instanceof SuggestionsProvider) {
                $result[] = $provider;
            } else {
                throw new \InvalidArgumentException('Invalid provider class, should implement SuggestionsProvider interface');
            }
        }

        return $result;
    }

    public function present(): iterable
    {
        $suggestions = [];
        foreach ($this->getProvider() as $provider) {
            $suggestions = array_merge($suggestions, $provider->provide());
        }

        return $suggestions;
    }
}
