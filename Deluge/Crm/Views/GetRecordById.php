<?php

namespace Deluge\Crm\Views;

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
