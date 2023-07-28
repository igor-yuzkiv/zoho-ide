<?php
return [
    "name"      => "deluge-core",
    "prefix"     => "dl",
    "namespace"  => "Deluge\Core\Views",
    "components" => [
        [
            "name"      => "deluge-if",
            "insertText" => "<deluge-if>\n\t<x-slot name='condition'></x-slot>\n\t<x-slot></x-slot>\n</deluge-if>",
            "attributes" => [],
            "slots" => [],
        ],
    ],
];
