<?php

namespace App\Containers\Deluge;

/**
 *
 */
class DelugePrettier
{
    /**
     * @param CodeSnippet|string $code
     * @return string
     */
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