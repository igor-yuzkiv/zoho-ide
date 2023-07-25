<?php

namespace App\Containers\Deluge\Statements;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\DelugeSyntax;

/**
 *
 */
class EndIfStatement extends CodeSnippet
{

    public const DEFAULT = DelugeSyntax::TAB . "}" . DelugeSyntax::NEW_LINE;

    /**
     *
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function build(): string
    {
        $this->addLine( self::DEFAULT);
        return $this->code;
    }
}
