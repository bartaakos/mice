<?php

namespace MouseManager;

use MouseManager\Exceptions\UnableToMoveException;

class BackTracker
{
    /**
     * @var MouseManager
     */
    private $mouseManager;

    /**
     * BackTracker constructor.
     * @param MouseManager $mouseManager
     */
    public function __construct(MouseManager $mouseManager)
    {
        $this->mouseManager = $mouseManager;
    }

    /**
     * @param StepState $stepState
     * @return bool
     */
    public function solve(StepState &$stepState)
    {
        $index = $stepState->getMouseToMovePosition();
        $this->mouseManager->setSpots($stepState->getCurrentSpots());

        $isStepSucceeded = $this->step($index);

        if ($isStepSucceeded) {
            if ($this->isReady()) {
                return true;
            }

            $currentMiceAfterStep = $this->mouseManager->cloneSpots($this->mouseManager->getSpots());
            $nextMoves = $this->findSpotsToMove($index);

            foreach ($nextMoves as $nextMove) {
                $state = new StepState($stepState, $nextMove, $currentMiceAfterStep, $stepState->getDepth() + 1);
                $stepState->setNext($state);

                $solved = $this->solve($state);

                if ($solved) {
                    return true;
                }
            }

            $stepState->setNext(null);

            return false;
        } else {
            return false;
        }
    }

    /**
     * @param int $index
     * @return bool
     * @throws Exceptions\NotAMouseException
     */
    private function step($index)
    {
        try {
            $this->mouseManager->handleStep($index);

            return true;
        } catch (UnableToMoveException $ex) {
            return false;
        }
    }

    /**
     * @param int $freeSpotIndex
     * @return int[]
     */
    private function findSpotsToMove($freeSpotIndex)
    {
        /** @var int[] $positions */
        $positions = [];

        $minIndex = max(0, $freeSpotIndex - 2);
        $maxIndex = min(count($this->mouseManager->getSpots()) - 1, $freeSpotIndex + 2);

        for ($i = $minIndex; $i <= $maxIndex; $i++) {
            $mouse = $this->mouseManager->getSpots()[$i];

            if (
                ($i < $freeSpotIndex && $mouse instanceof RightMouse) ||
                ($i > $freeSpotIndex && $mouse instanceof LeftMouse)
            ) {
                $positions[] = $i;
            }
        }

        return $positions;
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        $spots = $this->mouseManager->getSpots();

        $middleSpot = (int)floor(count($spots) / 2);

        if (!($spots[$middleSpot] instanceof EmptySpot)) {
            return false;
        }

        for ($i = 0; $i < $middleSpot; $i++) {
            if (!($spots[$i] instanceof LeftMouse)) {
                return false;
            }
        }

        return true;
    }
}