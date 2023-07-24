<?php

namespace App\Containers\Deluge;

use App\Containers\Deluge\Prettier\DelugePrettier;

final class Deluge
{
    /**
     * @param string $condition
     * @param string|CodeSnippet|null $body
     * @param bool $endIf
     * @return string
     */
    public static function if(string $condition, string|CodeSnippet|null $body = null, bool $endIf = false): string
    {
        $result = "if ($condition) {" . DelugeSyntax::NEW_LINE_TAB;
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
        $result = "} else {" . DelugeSyntax::NEW_LINE;
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
        $result = "} else if ($condition) {" . DelugeSyntax::NEW_LINE_TAB;
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
        return DelugeSyntax::TAB . "}" . DelugeSyntax::NEW_LINE;
    }

    public function for(string $loopVariable, string $in, string|CodeSnippet|null $body = null, bool $endFor = false): string
    {
        $result = "for ($loopVariable in $in) {" . DelugeSyntax::NEW_LINE_TAB;

        if ($body) {
            $result .= DelugePrettier::tabulate($body);
        }

        if ($endFor) {
            $result .= Deluge::endFor();
        }

        return $result;
    }
}
