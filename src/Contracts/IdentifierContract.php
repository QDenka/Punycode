<?php

namespace Qdenka\Punycode\Contracts;

interface IdentifierContract
{
    /**
     * Check if a string is in Punycode format.
     *
     * @param string $string
     * @return bool
     */
    public static function isPunycode(string $string): bool;

    /**
     * Check if a string contains Unicode characters.
     *
     * @param string $string
     * @return bool
     */
    public static function isUnicode(string $string): bool;
}