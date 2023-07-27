<?php
namespace Deluge\Creator\Views;

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
