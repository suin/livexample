<?php

namespace Livexample\PHPLexer;

abstract class Token
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $token;

    /**
     * @var int
     */
    private $line;

    /**
     * @param string|array $token
     */
    final protected function __construct($token)
    {
        if (is_array($token)) {
            $this->id = $token[0];
            $this->token = $token[1];
            $this->line = $token[2];
        } else {
            $this->token = $token;
        }
    }

    /**
     * @return bool
     */
    abstract public function isComment();

    /**
     * @return bool
     */
    abstract public function isOutput();

    /**
     * @return string
     */
    abstract public function commentBody();

    /**
     * @return int|null
     */
    final public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    final public function token()
    {
        return $this->token;
    }

    /**
     * @return int|null
     */
    final public function line()
    {
        return $this->line;
    }
}
