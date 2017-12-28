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
}
