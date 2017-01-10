<?php

namespace MouseManager\Exceptions;

class NonExistingSpotException extends \Exception
{
    public function __construct($index = null, $message = 'Non existing spot.')
    {
        if ($index !== null) {
            $message .= ' Index: ' . $index;
        }

        parent::__construct($message, 1, null);
    }
}