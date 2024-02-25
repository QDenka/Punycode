<?php

namespace Qdenka\Punycode\ValueObjects;

use Qdenka\Punycode\Contracts\ValidatorContract;

class UriValidator implements ValidatorContract
{
    /**
     * @param array $uri
     * @return bool
     */
    public static function validate(array $uri): bool
    {
        return isset($uri['host']);
    }
}
