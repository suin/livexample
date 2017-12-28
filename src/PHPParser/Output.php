<?php

namespace Livexample\PHPParser;

final class Output
{
    /**
     * @var string[]
     */
    private $lines = array();

    /**
     * @var int
     */
    private $indent;

    /**
     * @param int $indent
     * @param string $output
     */
    public function __construct($indent, $output)
    {
        $this->indent = $indent;
        $output = trim($output);
        if (strlen($output) > 0) {
            $this->lines[] = $output;
        }
    }

    /**
     * @internal \Livexample\PHPParser
     * @param string $line
     */
    public function addLine($line)
    {
        // Remove indent space.
        $line = preg_replace('/^ {' . $this->indent . '}/', '', $line);

        // To normalize line break.
        $this->lines[] = rtrim($line, "\r\n");
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return implode("\n", $this->lines);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getOutput();
    }
}
