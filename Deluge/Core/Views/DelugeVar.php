<?php

namespace Deluge\Core\Views;

use App\Abstractions\DelugeComponent;
use Illuminate\Support\HtmlString;


/**
 * Slots
 *   - default
 *   - else
 *   - elseif
 * Attributes
 *  - condition - for each slot and this component
 */

class DelugeVar extends DelugeComponent
{
    public function handle(): string
    {
        return  $this->attributes->get('name') . " = " . $this->attributes->get('value') . ";\n";
    }

}
