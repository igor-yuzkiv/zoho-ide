<?php

namespace App\Containers\Deluge;

/**
 *
 */
abstract class CodeSnippet
{
    /**
     * @var string
     */
    protected string $code = "";

    /**
     * @return string
     */
    abstract public function build(): string;

    /**
     * @param CodeSnippet|string $line
     * @return $this
     */
    protected function addLine(CodeSnippet|string $line) : self {
        if ($line instanceof CodeSnippet) {
            $line = $line->build();
        }
        $this->code .= $line;
        return  $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->build();
    }
}
