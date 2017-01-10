<?php

namespace MouseManager\Exceptions;

class NotAMouseException extends \Exception
{
    public function __construct($message = 'Not a mouse.')
    {
        parent::__construct($message, 1, null);
    }
}