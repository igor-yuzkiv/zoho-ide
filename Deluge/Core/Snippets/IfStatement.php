<?php

namespace Deluge\Core\Snippets;

use Illuminate\View\Component;

class IfStatement extends Component
{
    public function render(): string
    {
        dd($this->resolveView());
        dd($this->data());
        return <<<'blade'
                <div>
                    if
                </div>
        blade;
    }
}
