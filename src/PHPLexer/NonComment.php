<?php

namespace Livexample\PHPLexer;

final class NonComment extends Token
{
    /**
     * @param array $token
     * @return NonComment
     */
    public static function create(array $token)
    {
        return new self($token);
    }
}
