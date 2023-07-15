<?php

namespace App\Containers\Deluge\Base;

/**
 *
 */
final class IfStatements
{
    /**
     * @param string $condition
     * @return string
     */
    public static function if(string $condition): string
    {
        //TODO: add body, and add tabulation each line
        return "if ($condition) {" . DelugeSyntax::NEW_LINE;
    }

    /**
     * @return string
     */
    public static function else(): string
    {
        //TODO: add body, and add tabulation each line
        return "else {" . DelugeSyntax::NEW_LINE;
    }

    /**
     * @param string $condition
     * @return string
     */
    public static function elseIf(string $condition): string
    {
        //TODO: add body, and add tabulation each line
        return "else if ($condition) {" . DelugeSyntax::NEW_LINE;
    }

    /**
     * @return string
     */
    public static function endIf(): string
    {
        return "}" . DelugeSyntax::NEW_LINE;
    }
}
