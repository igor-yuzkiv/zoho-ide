<?php

namespace App\Containers\Deluge;

abstract class CodeSnippet
{

    public function __toString(): string
    {
       return $this->build();
    }

    protected string $code = "";

    abstract public function build(): string;

    protected function addLine(CodeSnippet|string $line) : self {
        if ($line instanceof CodeSnippet) {
            $line = $line->build();
        }
        $this->code .= $line;
        return  $this;
    }
}
