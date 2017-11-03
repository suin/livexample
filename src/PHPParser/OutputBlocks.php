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
     * @param string $line
     */
    public function addLineToPreviousBlock($line)
    {
        $this->previousBlock()->addLine($line);
    }

    /**
     * @return string[]
     */
    public function toArray()
    {
        return array_map('strval', $this->outputBlocks);
    }
}
