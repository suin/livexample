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
        $blocks = new OutputBlocks();
        $state = new State();
        $tokens = Lexer::tokenize($code);

        foreach ($tokens as $token) {
            if ($token->isComment() && $token->isOutput()) {
                $blocks->addLineToNewBlock($token->commentBody());
                $state->insideOfOutput();
            } elseif ($token->isComment() && $state->isInsideOfOutput()) {
                $blocks->addLineToPreviousBlock($token->commentBody());
            } else {
                $state->outsideOfOutput();
            }
        }

        return implode("\n", $blocks->toArray());
    }
}
