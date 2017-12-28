<?php

namespace Livexample\PHPParser;

use Livexample\PHPLexer\Comment;
use Livexample\PHPLexer\CommentWithOutput;
use Livexample\PHPLexer\Lexer;

final class Parser
{
    /**
     * @param string $code
     * @return string
     */
    public static function getOutput($code)
    {
        $insideOfOutput = false;
        $tokens = Lexer::tokenize($code);
        $output = '';

        foreach ($tokens as $token) {
            if ($token instanceof CommentWithOutput) {
                $output = new Output($token->indent(),  $token->commentBody());
                $insideOfOutput = true;
            } elseif ($token instanceof Comment && $insideOfOutput) {
                $output->addLine($token->commentBody());
            } else {
                $insideOfOutput = false;
            }
        }

        return (string)$output;
    }
}
