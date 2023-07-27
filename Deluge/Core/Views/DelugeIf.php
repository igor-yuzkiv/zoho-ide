<?php

namespace Deluge\Core\Views;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;


/**
 * Slots
 *   - default
 *   - else
 *   - elseif
 * Attributes
 *  - condition - for each slot and this component
 */

class DelugeIf extends Component
{
    public function render(): \Closure
    {
        return function (array $data) {

            /**
             * @var ?HtmlString $slot
             */
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
