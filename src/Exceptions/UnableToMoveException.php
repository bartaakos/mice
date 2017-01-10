<?php

namespace MouseManager\Exceptions;

class UnableToMoveException extends \Exception
{
    public function __construct($message = 'Unable to move.')
    {
        parent::__construct($message, 1, null);
    }
}