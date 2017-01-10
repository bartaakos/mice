<?php

namespace MouseManager;

use MouseManager\Exceptions\UnableToMoveException;

abstract class Mouse implements ISpot
{
    protected $direction;
    protected $position;

    /**
     * Mouse constructor.
     * @param int $position
     * @param int $direction
     */
    public function __construct($position, $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function step()
    {
        $this->position += $this->direction;
    }

    /**
     * @return int
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    public function shouldStepTo($index)
    {
        $this->step();

        if ($this->position != $index) {
            throw new UnableToMoveException();
        }
    }
}