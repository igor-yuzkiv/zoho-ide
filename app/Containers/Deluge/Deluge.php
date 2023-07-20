<?php

namespace App\Containers\Deluge;

use App\Containers\Deluge\ZohoServices\DelugePrettier;

final class Deluge
{
    const NEW_LINE_TAB = "\n\t";

    const NEW_LINE = "\n";

    const TAB = "\t";

    const SEMICOLON = ";";
    const SEMICOLON_NEW_LINE = ";\n";

    const SEMICOLON_NEW_LINE_TAB = ";\n\t";

    /**
     * @param string $condition
     * @param string|CodeSnippet|null $body
     * @param bool $endIf
     * @return string
     */
    public static function if(string $condition, string|CodeSnippet|null $body = null, bool $endIf = false): string
    {
        $result = "if ($condition) {" . Deluge::NEW_LINE_TAB;
        if ($body) {
            $result .= DelugePrettier::tabulate($body);
        }

        if ($endIf) {
            $result .= Deluge::endIf();
        }

        return $result;
    }

    /**
     * @param string|CodeSnippet|null $body
     * @param bool $endIf
     * @return string
     */
    public static function else(string|CodeSnippet|null $body = null, bool $endIf = false): string
    {
        $result = "} else {" . Deluge::NEW_LINE;
        if ($body) {
            $result .= DelugePrettier::tabulate($body);
        }

        if ($endIf) {
            $result .= Deluge::endIf();
        }

        return $result;
    }

    /**
     * @param string $condition
     * @param string|CodeSnippet|null $body
     * @param bool $endIf
     * @return string
     */
    public static function elseIf(string $condition, string|CodeSnippet|null $body = null, bool $endIf = false): string
    {
        $result = "} else if ($condition) {" . Deluge::NEW_LINE_TAB;
        if ($body) {
            $result .= DelugePrettier::tabulate($body);
        }

        if ($endIf) {
            $result .= Deluge::endIf();
        }

        return $result;
    }

    /**
     * @return string
     */
    public static function endIf(): string
    {
        return Deluge::TAB . "}" . Deluge::NEW_LINE;
    }
}
