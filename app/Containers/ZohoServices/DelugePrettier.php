<?php

namespace App\Containers\ZohoServices;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\DelugeSyntax;

class DelugePrettier
{
    public static function tabulate(CodeSnippet|string $code): string
    {
        $rows = explode("\n", $code);
        $result = "";
        foreach ($rows as $key => $row) {
            if ($key <= count($rows)-2) {
                $result .=DelugeSyntax::TAB . $row . DelugeSyntax::NEW_LINE;
            }else {
                $result .= $row;
            }
        }
        return $result;
    }
}
