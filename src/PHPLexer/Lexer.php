<?php

namespace Livexample\PHPLexer;

final class Lexer
{
    /**
     * @param string $phpCode
     * @return Token[]
     */
    public static function tokenize($phpCode)
    {
        return array_map(
            function ($token) {
                /** @var string|array $token */
                return CommentWithOutput::create($token)
                    ?: Comment::create($token)
                        ?: NonComment::create($token);
            },
            token_get_all($phpCode)
        );
    }
}
