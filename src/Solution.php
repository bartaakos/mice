<?php

namespace MouseManager;

class Solution
{
    /** @var bool */
    private $isSolved;
    /** @var StepState */
    private $firstStep;

    /**
     * Solution constructor.
     * @param $isSolved
     * @param StepState $firstStep
     */
    public function __construct($isSolved, StepState $firstStep)
    {
        $this->isSolved = $isSolved;
        $this->firstStep = $firstStep;
    }

    /**
     * @return bool
     */
    public function isSolved()
    {
        return $this->isSolved;
    }

    /**
     * @return StepState
     */
    public function getFirstStep()
    {
        return $this->firstStep;
    }

}