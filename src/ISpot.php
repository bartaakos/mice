<?php

namespace MouseManager;

interface ISpot
{
    public function getDirection();

    public function getPosition();

    public function shouldStepTo($index);

    public function __toString();
}