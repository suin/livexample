<?php

namespace Livexample\PHPLexer;

abstract class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * @param array $token
     */
    final protected function __construct(array $token)
    {
        $this->token = $token[1];
    }

    /**
     * @return string
     */
    final public function token()
    {
        return $this->token;
    }
}
