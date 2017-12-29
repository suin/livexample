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
        $output = null;
        $outputs = array();
        $tokens = Lexer::tokenize($code);
        foreach ($tokens as $token) {
            if ($token instanceof CommentWithOutput) {
                $output = new Output($token->indent(), $token->commentBody());
                $outputs[] = $output;
                $insideOfOutput = true;
            } elseif ($token instanceof Comment && $insideOfOutput) {
                $output->addLine($token->commentBody());
            } else {
                $insideOfOutput = false;
            }
        }
        return implode("\n", $outputs);
    }
}
