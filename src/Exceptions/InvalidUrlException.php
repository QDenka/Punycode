<?php

namespace Qdenka\Punycode\Exceptions;

use Throwable;

class InvalidUrlException extends \Exception
{
    public function __construct($message = "Please provide a valid URL.")
    {
        parent::__construct($message);
    }
}