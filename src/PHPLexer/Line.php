<?php

namespace Livexample\PHPLexer;

class Line
{
    /**
     * @var int
     */
    private $number;
    /**
     * @var Token[]
     */
    private $tokens;

    /**
     * @param int     $number
     * @param Token[] $tokens
     */
    public function __construct($number, array $tokens)
    {
        $this->number = $number;
        $this->tokens = $tokens;
    }

    /**
     * @return int
     */
    public function number()
    {
        return $this->number;
    }

    /**
     * @return Token[]
     */
    public function tokens()
    {
        return $this->tokens;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return count($this->tokens) === 0;
    }
}
