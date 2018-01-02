<?php

namespace Livexample\PHPLexer;

final class Comment extends Token
{
    /**
     * @param array $token
     * @return Comment|null
     */
    public static function create(array $token)
    {
        return $token[0] === T_COMMENT ? new self($token) : null;
    }

    /**
     * @return string
     */
    public function commentBody()
    {
        return preg_replace('|^//|', '', $this->token());
    }
}
