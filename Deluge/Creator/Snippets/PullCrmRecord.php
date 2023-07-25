<?php
namespace Deluge\Creator\Snippets;

use Illuminate\View\Component;

class PullCrmRecord extends Component
{
    public function render(): string
    {
        return <<<'blade'
                <div>
                    creator.pullCrmRecord
                </div>
        blade;
    }
}
