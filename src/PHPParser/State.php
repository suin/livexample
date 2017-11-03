<?php

namespace Livexample\PHPParser;

final class State
{
    /**
     * @var bool
     */
    private $insideOfOutput = false;

    public function insideOfOutput()
    {
        $this->insideOfOutput = true;
    }

    public function outsideOfOutput()
    {
        $this->insideOfOutput = false;
    }

    /**
     * @return bool
     */
    public function isInsideOfOutput()
    {
        return $this->insideOfOutput;
    }
}
