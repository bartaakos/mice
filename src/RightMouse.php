<?php

namespace MouseManager;

class RightMouse extends Mouse
{
    public function __construct($position)
    {
        parent::__construct($position, 1);
    }

    public function __toString()
    {
        return '>';
    }
}