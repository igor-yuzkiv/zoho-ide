<?php

namespace App\Containers\Deluge\ZohoServices;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\Deluge;

class DelugePrettier
{
    public static function tabulate(CodeSnippet|string $code): string
    {
        $rows = explode("\n", $code);
        $result = "";
        foreach ($rows as $key => $row) {
            if ($key <= count($rows)-2) {
                $result .=Deluge::TAB . $row . Deluge::NEW_LINE;
            }else {
                $result .= $row;
            }
        }
        return $result;
    }
}
