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
class DelugeIf extends DelugeComponent
{
    public function handle(): string
    {
        $statement = $this->attributes->get('else_if') ? 'else if' : 'if';

        $condition = $this->getSlot('condition');
        if (!$condition) {
            throw new \InvalidArgumentException("condition is required");
        }

        $result = "$statement (" . $condition->toHtml() . ") {\n";
        $result .= $this->getSlot('then')->toHtml() . "\n}";

        $elseSlot = $this->getSlot('else');
        if ($elseSlot) {
            $result .= "else {\n" . $elseSlot->toHtml() . "\n}";
        }
        return $result;
    }
}
