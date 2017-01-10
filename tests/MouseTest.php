<?php
namespace MouseManagerTests;

use MouseManager\LeftMouse;
use MouseManager\RightMouse;

class MouseTest extends \PHPUnit_Framework_TestCase
{
    public function testLeftMouse_Step()
    {
        $index = 2;
        $mouse = new LeftMouse($index);

        $this->assertEquals($index, $mouse->getPosition());
        $this->assertEquals(-1, $mouse->getDirection());

        $mouse->step();

        $this->assertEquals($index-1, $mouse->getPosition());
    }

    public function testLeftMouse_ShouldStepTo()
    {
        $index = 2;
        $mouse = new LeftMouse($index);

        $mouse->shouldStepTo(1);

        $this->assertEquals($index-1, $mouse->getPosition());
    }

    public function testRightMouse_Step()
    {
        $index = 2;
        $mouse = new RightMouse($index);

        $this->assertEquals($index, $mouse->getPosition());
        $this->assertEquals(1, $mouse->getDirection());

        $mouse->step();

        $this->assertEquals($index+1, $mouse->getPosition());
    }
}
