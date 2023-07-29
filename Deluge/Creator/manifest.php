<?php
return [
    "name"       => "zoho-creator",
    "prefix"     => "zoho.creator",
    "namespace"  => "Deluge\Creator\Views",
    "components" => [
        [
            "name"       => "creator.fetch-record",
            "insertText" => "<x-zoho.creator::fetch-record form='formName' varName='varName' criteria='ID != 0'/>",
            "attributes" => [],
            "slots"      => [],
        ],
        [
            "name"       => "creator.insert-record",
            "insertText" => "<x-zoho.creator::insert-record form='formName' varName='varName'/>",
            "attributes" => [],
            "slots"      => [],
        ],
        [
            "name"       => "creator.update-record",
            "insertText" => "<x-zoho.creator::update-record varName='varName'/>",
            "attributes" => [],
            "slots"      => [],
        ],
    ],
];
