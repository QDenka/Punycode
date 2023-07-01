<?php

namespace Qdenka\Punycode\Contracts;

interface ConverterContract
{
    /**
     * Encode the URL to Punycode.
     *
     * @param string $url
     * @return string
     */
    public static function encode(string $url): string;

    /**
     * Decode the Punycode URL back to its original form.
     *
     * @param string $url
     * @return string
     */
    public static function decode(string $url): string;

    /**
     * @param array $urls
     * @return array
     */
    public static function decodeFromArray(array $urls): array;

    /**
     * @param array $urls
     * @return array
     */
    public static function encodeFromArray(array $urls): array;
}