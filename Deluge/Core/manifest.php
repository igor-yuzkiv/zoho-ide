<?php
return [
    "name"      => "deluge-core",
    "prefix"     => "dl",
    "namespace"  => "Deluge\Core\Views",
    "components" => [
        [
            "name"      => "if",
            "insertText" => "<x-dl::deluge-if>\n\t<x-slot name='condition'></x-slot>\n</x-dl::deluge-if>",
            "attributes" => [],
            "slots" => [],
        ],
    ],
];
