<?php

namespace Qdenka\Punycode;

use Qdenka\Punycode\Contracts\IdentifierContract;

class Identifier implements IdentifierContract
{
    /**
     * Check if a string (URL or domain) contains Punycode-encoded segments.
     *
     * @param string $string
     * @return bool
     */
    public static function isPunycode(string $string): bool
    {
        return strpos($string, 'xn--') !== false;
    }

    /**
     * Check if a string contains non-ASCII (Unicode) characters.
     *
     * @param string $string
     * @return bool
     */
    public static function isUnicode(string $string): bool
    {
        return preg_match('/[^\x00-\x7F]/', $string) === 1;
    }
}
