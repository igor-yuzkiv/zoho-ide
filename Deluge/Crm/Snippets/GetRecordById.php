<?php

namespace Deluge\Crm\Snippets;

use Illuminate\View\Component;

class GetRecordById  extends Component
{
    public function render(): string
    {
        return <<<'blade'
                <div>
                    crm.getRecordById
                </div>
        blade;
    }
}
