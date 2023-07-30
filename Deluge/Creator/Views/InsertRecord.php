<?php

namespace Deluge\Creator\Views;

use App\Abstractions\DelugeComponent;

class InsertRecord extends DelugeComponent
{
    public function handle(): string
    {
        return  '\\\\ insert record';
    }
}
