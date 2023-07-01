<?php

namespace Qdenka\Punycode;

use Qdenka\Punycode\Contracts\IdentifierContract;

class Identifier implements IdentifierContract
{
    /**
     * Check if a string is in Punycode format.
     *
     * @param string $string
     * @return bool
     */
    public static function isPunycode(string $string): bool
    {
        return (strpos($string, 'xn--') === 0);
    }

    /**
     * Check if a string contains Unicode characters.
     *
     * @param string $string
     * @return bool
     */
    public static function isUnicode(string $string): bool
    {
        return mb_check_encoding($string, 'UTF-8');
    }
}