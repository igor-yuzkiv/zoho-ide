<?php

namespace App\Ship\Console\Commands;

use App\Containers\Snippets\Actions\RenderSnippetAction;
use App\Containers\Snippets\Enums\ArgumentType;
use App\Containers\Snippets\Models\Snippet;
use App\Containers\Snippets\Models\SnippetArgument;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';

    public function handle(): void
    {
        $snippet = Snippet::find(1);

        $result = (new RenderSnippetAction(
            $snippet, [
                'formName' => 'Accounts',
                'insertMapping' => [
                    [
                        'name' => "test",
                        'value' => 'test'
                    ],
                ],
                'responseField' => "test",
            ]
        ))->handle();

        dd($result);

    }
}
