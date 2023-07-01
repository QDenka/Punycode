<?php

namespace Qdenka\Punycode\Exceptions;

class ModuleNotFoundException extends \Exception
{
    public function __construct($message = "Module not found.")
    {
        parent::__construct($message);
    }
}