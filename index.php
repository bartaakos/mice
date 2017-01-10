<?php

use MouseManager\EmptySpot;
use MouseManager\LeftMouse;
use MouseManager\MouseManager;
use MouseManager\RightMouse;

require __DIR__ . '/vendor/autoload.php';


$mm3 = new MouseManager([new RightMouse(0), new EmptySpot(1), new LeftMouse(2)], true);
$mm3->run();

$mm5 = new MouseManager([new RightMouse(0), new RightMouse(1), new EmptySpot(2), new LeftMouse(3), new LeftMouse(4)]);
$mm5->run();

$mm = new MouseManager([new RightMouse(0), new RightMouse(1), new RightMouse(2), new EmptySpot(3), new LeftMouse(4), new LeftMouse(5), new LeftMouse(6)]);
$mm->run();
