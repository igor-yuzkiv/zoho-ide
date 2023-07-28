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
    public function render(): \Closure
    {
        return function (array $data) {
            /** @var ?HtmlString $slot */
            $slot = \Arr::get($data, 'slot');
            $attributes = \Arr::get($data, 'attributes');

            $result = "if () {\n";
            if ($slot) {
                $result .= $slot->toHtml();
            }

            return $result . "\n}";
        };
    }
}
