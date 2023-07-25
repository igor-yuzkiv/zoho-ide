<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SyncCrmWithCreator extends Component
{
    public function __construct(
        protected array $map,
        protected string $module,
        protected string $formName,
    )
    {

    }

    public function render(): View
    {
        return view('components.sync_crm_with_creator', [
            'map' => $this->map,
            'module' => $this->module,
            'formName' => $this->formName,
        ]);
    }
}
