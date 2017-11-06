<?php

namespace Livexample\PHPParser;

final class OutputBlocks
{
    /**
     * @var Output[]
     */
    private $outputBlocks = array();

    /**
     * @return Output
     */
    private function newBlock()
    {
        $newBlock = new Output();
        $this->outputBlocks[] = $newBlock;
        return $newBlock;
    }

    /**
     * @internal \Livexample\PHPParser
     * @param Output $output
     */
    public function addBlock(Output $output)
    {
        $this->outputBlocks[] = $output;
    }

    /**
     * @internal \Livexample\PHPParser
     * @param string $line
     */
    public function addLineToNewBlock($line)
    {
        $this->newBlock()->addLine($line);
    }

    /**
     * @return Output
     */
    private function previousBlock()
    {
        $last = array_slice($this->outputBlocks, -1);
        if (empty($last)) {
            throw new \LogicException("Output list is empty");
        } else {
            return $last[0];
        }
    }

    /**
     * @internal \Livexample\PHPParser
     * @param string $line
     */
    public function addLineToPreviousBlock($line)
    {
        $this->previousBlock()->addLine($line);
    }

    /**
     * @return string[]
     */
    private function toArray()
    {
        return array_map('strval', $this->outputBlocks);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return implode("\n", $this->toArray());
    }
}
