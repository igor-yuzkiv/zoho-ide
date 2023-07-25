<?php

namespace App\Containers\Deluge\Statements;

use App\Containers\Deluge\CodeSnippet;
use App\Containers\Deluge\DelugeSyntax;
use App\Containers\Deluge\Prettier\DelugePrettier;

/**
 *
 */
class IfStatement extends CodeSnippet
{
    /**
     * @var bool
     */
    protected bool $endIf = false;

    /**
     * @param string $condition
     * @param string|CodeSnippet|null $body
     */
    public function __construct(
        protected string                  $condition,
        protected null|string|CodeSnippet $body = null
    )
    {

    }

    /**
     * @return string
     */
    public function build(): string
    {
        $this->addLine("if ($this->condition) {" . DelugeSyntax::NEW_LINE_TAB);

        if ($this->body) {
            $this->addLine(DelugePrettier::tabulate($this->body));
        }

        if ($this->endIf) {
            $this->addLine(EndIfStatement::DEFAULT);
        }

        return  $this->code;
    }

    /**
     * @param bool $endIf
     */
    public function setEndIf(bool $endIf): void
    {
        $this->endIf = $endIf;
    }
}
