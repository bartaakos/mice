<?php

namespace MouseManager;

class EmptySpot implements ISpot
{
    private $position;

    public function __construct($position)
    {
        $this->position = $position;
    }

    public function __toString()
    {
        return '_';
    }

    public function getDirection()
    {
        return 0;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function shouldStepTo($index)
    {
        $this->position = $index;
    }
}