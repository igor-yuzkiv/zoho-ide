<?php

namespace Deluge\Creator\Views;

use App\Abstractions\DelugeComponent;

class FetchRecord extends DelugeComponent
{
    public function handle(): string
    {

        return  $this->attributes->get('varName') . " = " . $this->attributes->get('form') . "[".$this->attributes->get('criteria')."];\n";
    }
}
