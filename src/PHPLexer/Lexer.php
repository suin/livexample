<?php

namespace Livexample\PHPLexer;

final class Lexer
{
    /**
     * @param string $phpCode
     * @return Line[]
     */
    public static function tokenize($phpCode)
    {
        $tokens = token_get_all($phpCode);
        $tokens = self::removeSingleCharacters($tokens);
        $lines = self::groupByLine($tokens);
        $lines = self::removeIndentFromEachLines($lines);
        $lines = self::createLineObjects($lines);
        return $lines;
    }

    /**
     * @param array $tokens
     * @return array
     */
    private static function removeSingleCharacters(array $tokens)
    {
        return array_filter($tokens, 'is_array');
    }

    /**
     * @param array $tokens
     * @return array
     */
    private static function groupByLine(array $tokens)
    {
        return array_values(array_reduce($tokens, function (array $lines, array $token) {
            $lines[$token[2]]['number'] = $token[2];
            $lines[$token[2]]['tokens'][] = array(
                $token[0],
                $token[1],
            );
            return $lines;
        }, array()));
    }

    /**
     * @param array $lines
     * @return array
     */
    private static function removeIndentFromEachLines(array $lines)
    {
        foreach ($lines as $k => $line) {
            $lines[$k]['tokens'] = Lexer::removeIndentFromLine($line['tokens']);
        }
        return $lines;
    }

    /**
     * @param array $line
     * @return array
     */
    private static function removeIndentFromLine(array $line)
    {
        $keep = false;
        return array_filter($line, function (array $token) use (&$keep) {
            if ($token[0] !== T_WHITESPACE) {
                $keep = true;
            }
            return $keep;
        });
    }

    /**
     * @param array $lines
     * @return Line[]
     */
    private static function createLineObjects(array $lines)
    {
        return array_map(function (array $line) {
            return new Line(
                $line['number'],
                array_map(function (array $token) {
                    return CommentWithOutput::create($token)
                        ?: Comment::create($token)
                            ?: NonComment::create($token);
                }, $line['tokens'])
            );
        }, $lines);
    }
}
