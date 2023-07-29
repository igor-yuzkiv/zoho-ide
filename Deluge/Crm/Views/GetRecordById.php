<?php

namespace Deluge\Crm\Views;

use App\Abstractions\DelugeComponent;
use Illuminate\View\Component;

class GetRecordById  extends DelugeComponent
{
    public function handle(): string
    {
        $varName = $this->attributes->get('varName');
        $moduleName = $this->attributes->get('module');
        $recordId = $this->attributes->get('id');

        return "$varName = zoho.crm.getRecordById(\"$moduleName\",$recordId);\n";
    }
}
