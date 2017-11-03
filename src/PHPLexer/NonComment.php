<?php

namespace Livexample\PHPLexer;

final class NonComment extends Token
{
    /**
     * @param string|array $token
     * @return NonComment
     */
    public static function create($token)
    {
        return new self($token);
    }

    /**
     * @return bool
     */
    public function isComment()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isOutput()
    {
        return false;
    }

    /**
     * @return string
     */
    public function commentBody()
    {
        throw new \LogicException('Non-comment token has not comment body');
    }
}
