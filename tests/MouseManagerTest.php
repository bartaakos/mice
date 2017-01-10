<?php

namespace MouseManagerTests;

use MouseManager\EmptySpot;
use MouseManager\LeftMouse;
use MouseManager\MouseManager;
use MouseManager\RightMouse;

class MouseManagerTest extends \PHPUnit_Framework_TestCase
{
    public function testSolve_3()
    {
        $mm = new MouseManager([new RightMouse(0), new EmptySpot(1), new LeftMouse(2)], false);

        $solution = $mm->solve();

        $this->assertTrue($solution->isSolved());
        $this->assertEquals([new LeftMouse(0), new EmptySpot(1), new RightMouse(2)], $mm->getSpots());
    }

    public function testSolve_5()
    {
        $mm = new MouseManager([new RightMouse(0), new RightMouse(1), new EmptySpot(2), new LeftMouse(3), new LeftMouse(4)], false);

        $solution = $mm->solve();

        $this->assertTrue($solution->isSolved());
        $this->assertEquals([new LeftMouse(0), new LeftMouse(1), new EmptySpot(2), new RightMouse(3), new RightMouse(4)], $mm->getSpots());
    }

    public function testSolve_7()
    {
        $mm = new MouseManager([new RightMouse(0), new RightMouse(1), new RightMouse(2), new EmptySpot(3), new LeftMouse(4), new LeftMouse(5), new LeftMouse(6)], false);

        $solution = $mm->solve();

        $this->assertTrue($solution->isSolved());
        $this->assertEquals([new LeftMouse(0), new LeftMouse(1), new LeftMouse(2), new EmptySpot(3), new RightMouse(4), new RightMouse(5), new RightMouse(6)], $mm->getSpots());
    }

}