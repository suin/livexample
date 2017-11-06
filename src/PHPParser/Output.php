<?php

namespace Livexample\PHPParser;

final class Output
{
    private $output = '';

    /**
     * @internal \Livexample\PHPParser
     * @param string $line
     */
    public function addLine($line)
    {
        // To normalize line break and remove whitespaces around text.
        $this->output = trim($this->output . "\n" . $line);
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getOutput();
    }
}
