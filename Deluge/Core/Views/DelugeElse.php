<?php

namespace Deluge\Core\Views;

use Illuminate\Support\HtmlString;
use Illuminate\View\Component;
class DelugeElse extends Component
{
    public function render(): \Closure
    {
        return function (array $data) {
            return "else";
        };
    }
}
