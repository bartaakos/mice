<?php

namespace MouseManager;

class StepState
{
    /** @var StepState */
    private $parent;
    /** @var StepState */
    private $next;
    private $mouseToMovePosition;
    private $currentSpots;
    private $depth;

    /**
     * StepState constructor.
     * @param StepState $parent
     * @param $miceToMovePosition
     * @param array $currentSpots
     * @param int $depth
     */
    public function __construct(StepState $parent = null, $miceToMovePosition, array $currentSpots, $depth = 0)
    {
        $this->parent = $parent;
        $this->mouseToMovePosition = $miceToMovePosition;
        $this->currentSpots = $currentSpots;
        $this->depth = $depth;
    }

    public function getSequence()
    {
        $sequence = $this->getNext() ? $this->getNext()->getSequence() : [];

        array_unshift($sequence, $this->getMouseToMovePosition());

        return $sequence;
    }

    public function getParentSequence()
    {
        $sequence = $this->getParent() ? $this->getParent()->getParentSequence() : [];

        array_push($sequence, $this->getMouseToMovePosition());

        return $sequence;
    }

    /**
     * @return StepState
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return mixed
     */
    public function getMouseToMovePosition()
    {
        return $this->mouseToMovePosition;
    }

    /**
     * @return mixed
     */
    public function getCurrentSpots()
    {
        return $this->currentSpots;
    }

    /**
     * @param mixed $currentSpots
     */
    public function setCurrentSpots($currentSpots)
    {
        $this->currentSpots = $currentSpots;
    }

    /**
     * @return StepState
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @param StepState $next
     */
    public function setNext($next)
    {
        $this->next = $next;
    }

    /**
     * @return int
     */
    public function getDepth()
    {
        return $this->depth;
    }
}