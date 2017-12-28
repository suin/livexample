<?php

namespace Livexample\PHPLexer;

abstract class Token
{
    /**
     * @var string
     */
    private $token;

    /**
     * @param string|array $token
     */
    final protected function __construct($token)
    {
        if (is_array($token)) {
            $this->token = $token[1];
        } else {
            $this->token = $token;
        }
    }

    /**
     * @return string
     */
    final public function token()
    {
        return $this->token;
    }
}
