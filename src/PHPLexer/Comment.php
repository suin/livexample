<?php

namespace Livexample\PHPLexer;

final class Comment extends Token
{
    /**
     * @param string|array $token
     * @return Comment|null
     */
    public static function create($token)
    {
        return (
            is_array($token)
            && $token[0] === T_COMMENT
        ) ? new self($token) : null;
    }

    /**
     * @return bool
     */
    public function isComment()
    {
        return true;
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
        return preg_replace('|^//\s*|', '', $this->token());
    }
}
