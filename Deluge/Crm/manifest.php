<?php
return [
    "name"      => "zoho-crm",
    "prefix"     => "zoho.crm",
    "namespace"  => "Deluge\Crm\Views",
    "components" => [
        [
            "name"       => "crm.getRecordById",
            "insertText" => "<x-zoho.crm::get-record-by-id module='moduleName' varName='varName' id=''/>",
            "attributes" => [],
            "slots"      => [],
        ],
    ],
];
