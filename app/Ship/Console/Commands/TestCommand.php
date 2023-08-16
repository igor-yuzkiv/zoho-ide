<?php

namespace App\Ship\Console\Commands;

use App\Containers\Snippets\Actions\RenderSnippetAction;
use App\Containers\Snippets\Enums\ArgumentType;
use App\Containers\Snippets\Enums\SnippetType;
use App\Containers\Snippets\Filters\SnippetTypeFilter;
use App\Containers\Snippets\Models\Snippet;
use App\Containers\Snippets\Models\SnippetArgument;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';

    public function handle(): void
    {
        $typeFilter = new SnippetTypeFilter(SnippetType::TEMPLATE->value);

        $snippet = Snippet::query()
            ->filter([
                0 => "type:template"
            ])
            ->get();


        dd($snippet->toArray());
    }
}
