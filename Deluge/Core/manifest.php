<?php
return [
    "name"      => "deluge-core",
    "prefix"     => "dl",
    "namespace"  => "Deluge\Core\Views",
    "components" => [
        [
            "name"      => "var",
            "insertText" => "<x-dl::deluge-var name='name' type='string' value='null'/>",
            "attributes" => [],
            "slots" => [],
        ],
        [
            "name"      => "if",
            "insertText" => "<x-dl::deluge-if else_if>\n\t<x-slot name='condition'></x-slot>\n\t<x-slot name='then'></x-slot>\n\t<x-slot name='else'></x-slot>\n</x-dl::deluge-if>",
            "attributes" => [],
            "slots" => [],
        ],
    ],
];
