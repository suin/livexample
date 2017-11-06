<?php

namespace Livexample\PHPParser;

use Livexample\PHPLexer\Lexer;

final class Parser
{
    /**
     * @param string $code
     * @return string
     */
    public static function getOutput($code)
    {
        $state = new State();
        $tokens = Lexer::tokenize($code);
        $output = new Output();

        foreach ($tokens as $token) {
            if ($token->isComment() && $token->isOutput()) {
                $output = new Output();
                $output->addLine($token->commentBody());
                $state->insideOfOutput();
            } elseif ($token->isComment() && $state->isInsideOfOutput()) {
                $output->addLine($token->commentBody());
            } else {
                $state->outsideOfOutput();
            }
        }

        return (string)$output;
    }
}
