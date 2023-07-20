<?php

namespace App\Containers\Deluge;

use App\Containers\DelugeSyntax;

/**
 *
 */
final class IfStatements
{
    /**
     * @param string $condition
     * @return string
     */
    public static function if(string $condition, string|CodeSnippet|null $body = null): string
    {
        //TODO: add body, and add tabulation each line
        $result =  "if ($condition) {" . DelugeSyntax::NEW_LINE_TAB;

        if ($body) {
            if ($body instanceof CodeSnippet) {
                dd($body);
            }
        }

        return $result;
    }

    /**
     * @return string
     */
    public static function else(): string
    {
        //TODO: add body, and add tabulation each line
        return "} else {" . DelugeSyntax::NEW_LINE_TAB;
    }

    /**
     * @param string $condition
     * @return string
     */
    public static function elseIf(string $condition): string
    {
        //TODO: add body, and add tabulation each line
        return "} else if ($condition) {" . DelugeSyntax::NEW_LINE_TAB;
    }

    /**
     * @return string
     */
    public static function endIf(): string
    {
        return "}" . DelugeSyntax::NEW_LINE_TAB;
    }
}
