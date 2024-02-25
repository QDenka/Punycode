<?php

namespace Qdenka\Punycode\Contracts;

interface ValidatorContract
{
    public static function validate(array $uri): bool;
}
