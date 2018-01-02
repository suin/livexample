<?php

namespace Livexample\PHPLexer;

final class CommentWithOutput extends Token
{
    const LONG_OUTPUT_TOKEN_PATTERN = '|^//(?<indent> *)Output:|';
    const SHORT_OUTPUT_TOKEN_PATTERN = '|^//(?<indent> *)=>|';

    /**
     * @param array $token
     * @return CommentWithOutput|null
     */
    public static function create(array $token)
    {
        return (
            $token[0] === T_COMMENT
            && self::containsOutputToken($token[1])
        ) ? new self($token) : null;
    }

    /**
     * @param string $code
     * @return bool
     */
    private static function containsOutputToken($code)
    {
        return self::containsLongOutputToken($code)
            || self::containsShortOutputToken($code);
    }

    /**
     * @param string $code
     * @return bool
     */
    private static function containsLongOutputToken($code)
    {
        return preg_match(self::LONG_OUTPUT_TOKEN_PATTERN, $code) === 1;
    }

    /**
     * @param string $code
     * @return bool
     */
    private static function containsShortOutputToken($code)
    {
        return preg_match(self::SHORT_OUTPUT_TOKEN_PATTERN, $code) === 1;
    }

    /**
     * @return string
     */
    public function commentBody()
    {
        $t = $this->token();
        if (self::containsLongOutputToken($t)) {
            return preg_replace(self::LONG_OUTPUT_TOKEN_PATTERN, '', $t);
        } elseif (self::containsShortOutputToken($t)) {
            return preg_replace(self::SHORT_OUTPUT_TOKEN_PATTERN, '', $t);
        } else {
            throw new \LogicException("Invalid output format: $t");
        }
    }

    /**
     * @return int
     */
    public function indent()
    {
        $t = $this->token();
        if (self::containsLongOutputToken($t)) {
            preg_match(self::LONG_OUTPUT_TOKEN_PATTERN, $t, $matches);
            return strlen($matches['indent']);
        } elseif (self::containsShortOutputToken($t)) {
            preg_match(self::SHORT_OUTPUT_TOKEN_PATTERN, $t, $matches);
            return strlen($matches['indent']);
        } else {
            throw new \LogicException("Invalid output format: $t");
        }
    }
}
