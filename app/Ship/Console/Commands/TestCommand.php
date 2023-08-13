<?php

namespace App\Ship\Console\Commands;

use App\Containers\IDE\Presenters\SuggestionPresenter;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    protected $signature = 'igor:test';

    protected $description = 'Command description';

    public function handle(): void
    {
        $suggestions = (new SuggestionPresenter())->present();


        dd($suggestions);
    }
}
