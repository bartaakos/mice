<?php

namespace MouseManager;

use MouseManager\Exceptions\NonExistingSpotException;
use MouseManager\Exceptions\NotAMouseException;
use MouseManager\Exceptions\UnableToMoveException;

class MouseManager
{
    /** @var ISpot[] */
    private $spots = [];
    /** @var ISpot[] */
    private $originalSpots = [];
    /** @var int */
    private $spotCount = 0;
    /** @var int */
    private $miceCount = 0;
    /** @var bool */
    private $verbose;

    /**
     * MouseManager constructor.
     * @param ISPot[] $mice
     * @param bool|true $verbose
     */
    public function __construct(array $mice, $verbose = true)
    {
        $this->spots = $mice;
        $this->originalSpots = $this->cloneSpots($mice);
        $this->spotCount = count($this->spots);
        $this->miceCount = $this->spotCount - 1;
        $this->verbose = $verbose;

        $this->log("\nMouseManager [" . count($this->spots) . "]:\n");
        $this->printState();
    }

    /**
     * @param ISpot[] $mice
     * @return ISpot[]
     */
    public function cloneSpots(array $mice)
    {
        return array_map(function ($object) {
            return clone $object;
        }, $mice);
    }

    public function printState()
    {
        $this->log('[');
        foreach ($this->spots as $mouse) {
            $this->log(" $mouse ");
        }
        $this->log("] \n");
    }

    /**
     * @return ISpot[]
     */
    public function getSpots()
    {
        return $this->spots;
    }

    /**
     * @param ISpot[] $spots
     */
    public function setSpots($spots)
    {
        $this->spots = $this->cloneSpots($spots);
    }

    /**
     * @return Solution
     */
    public function solve()
    {
        $startIndex = (int)(floor($this->spotCount / 2) - 1);

        $firstStep = new StepState(null, $startIndex, $this->cloneSpots($this->spots));

        $backTracker = new BackTracker($this);
        $backTracker->solve($firstStep);

        return new Solution($backTracker->isReady(), $firstStep);
    }

    public function run()
    {
        $verbose = $this->verbose;
        $this->verbose = false;

        $solution = $this->solve();

        $this->verbose = $verbose;

        if ($solution->isSolved()) {
            $this->log("Solved!\n");
            $this->log('Steps: ' . join(', ', $solution->getFirstStep()->getSequence()) . "\n");

            $stepState = $solution->getFirstStep();
            $index = $stepState->getMouseToMovePosition();
            $this->reset();

            $this->handleStep($index);

            while ($nextState = $stepState->getNext()) {
                $this->handleStep($nextState->getMouseToMovePosition());
                $stepState = $nextState;
            }

            $this->printState();
        } else {
            $this->log('Unable to solve.');
        }
    }

    /**
     * @param int $index Position of mouse to move
     * @return int Number of steps done
     *
     * @throws NonExistingSpotException
     * @throws NotAMouseException
     * @throws UnableToMoveException
     */
    public function handleStep($index)
    {
        $this->log("HandleStep $index @ ");
        $this->printState();

        /** @var Mouse $movingMouse */
        $movingMouse = $this->spots[$index];

        if (!$movingMouse || !($movingMouse instanceof Mouse)) {
            throw new NotAMouseException();
        }

        $movingMouse->step();
        $newPosition = $movingMouse->getPosition();

        if ($this->isFreeSpot($newPosition)) {
            // all good
            $this->swap($index, $newPosition);
            $this->spots[$index]->shouldStepTo($index);

            return $movingMouse->getDirection();
        } else {
            // let's jump then (double step)
            $movingMouse->step();
            $newPosition = $movingMouse->getPosition();

            if ($this->isFreeSpot($newPosition)) {
                // all good
                $this->swap($index, $newPosition);
                $this->spots[$index]->shouldStepTo($index);

                return 2 * $movingMouse->getDirection();
            } else {
                throw new UnableToMoveException();
            }
        }
    }

    private function reset()
    {
        $this->setSpots($this->originalSpots);
    }

    /**
     * @param $index
     * @return bool
     * @throws NonExistingSpotException
     */
    private function isFreeSpot($index)
    {
        if (!array_key_exists($index, $this->spots)) {
            throw new NonExistingSpotException($index);
        }

        return $this->spots[$index] instanceof EmptySpot;
    }

    /**
     * @param int $i
     * @param int $j
     */
    private function swap($i, $j)
    {
        $tmp = $this->spots[$i];
        $this->spots[$i] = $this->spots[$j];
        $this->spots[$j] = $tmp;
    }

    /**
     * @param string $msg
     */
    private function log($msg)
    {
        if ($this->verbose) {
            echo $msg;
        }
    }
}