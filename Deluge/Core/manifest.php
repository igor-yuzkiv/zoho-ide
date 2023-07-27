<?php
return [
    "label"      => "Deluge Core",
    "prefix"     => "",
    "namespace"  => "Deluge\\Core\\Views",
    "components" => [
        [
            "label"      => "if",
            "insertText" => "<x-dl::if-statement condition\"\"></x-dl::if-statement>",
            "slots"      => [],
            "attributes" => [
                "condition" => [
                    "type"     => "string",
                    "default"  => "",
                    "required" => true,
                ],
            ],
        ],
    ],
];
