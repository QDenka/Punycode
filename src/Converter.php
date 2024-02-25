<?php

namespace Qdenka\Punycode;

use Qdenka\Punycode\Contracts\ConverterContract;
use Qdenka\Punycode\Services\PunycodeConverter;
use Qdenka\Punycode\ValueObjects\Uri;

class Converter implements ConverterContract
{
    static PunycodeConverter $converter;

    /**
     * Encode the URL to Punycode.
     *
     * @param string $url
     * @return string
     * @throws \Throwable
     */
    public static function encode(string $url): string
    {
        $url = new Uri($url);

        return self::getConverter()->encode($url);
    }

    /**
     * Decode the Punycode URL back to its original form.
     *
     * @param string $url
     * @return string
     * @throws \Throwable
     */
    public static function decode(string $url): string
    {
        $url = new Uri($url);
        
        return self::getConverter()->decode($url);
    }

    /**
     * @param array $urls
     * @return array
     * @throws \Throwable
     */
    public static function decodeFromArray(array $urls): array
    {
        $decodedUrls = [];
        foreach ($urls as $url) {
            $decodedUrls[] = self::decode($url);
        }
        return $decodedUrls;
    }

    /**
     * @param array $urls
     * @return array
     * @throws \Throwable
     */
    public static function encodeFromArray(array $urls): array
    {
        $encodedUrls = [];
        foreach ($urls as $url) {
            $encodedUrls[] = self::encode($url);
        }
        return $encodedUrls;
    }

    /**
     * Get an instance of the PunycodeConverter.
     *
     * @return PunycodeConverter
     */
    private static function getConverter(): PunycodeConverter
    {
        if (!isset(self::$converter)) {
            self::$converter = new PunycodeConverter();
        }

        return self::$converter;
    }
}
