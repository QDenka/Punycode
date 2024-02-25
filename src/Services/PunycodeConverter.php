<?php

namespace Qdenka\Punycode\Services;

use Exception;
use Qdenka\Punycode\Contracts\PunycodeDecoderContract;
use Qdenka\Punycode\Contracts\PunycodeEncoderContract;
use Qdenka\Punycode\Exceptions\ModuleNotFoundException;
use Qdenka\Punycode\ValueObjects\Uri;

/**
 * Class UrlPunycodeConverter
 *
 * This class is responsible for encoding and decoding URLs to and from Punycode.
 */
final class PunycodeConverter implements PunycodeEncoderContract, PunycodeDecoderContract
{
    /**
     * UrlPunycodeConverter constructor.
     *
     * @throws Exception
     */
    public function __construct()
    {
        if (!extension_loaded('intl')) {
            throw new ModuleNotFoundException('The intl extension is not loaded. Please ensure it is installed and enabled.');
        }
    }

    /**
     * Encode the URL into Punycode.
     *
     * @param Uri $uri
     * @return string
     */
    public function encode(Uri $uri): string
    {
        $uri = $this->encodeParsedUri($uri);

        return $uri->getUri();
    }

    /**
     * Decode the Punycode URL back to its original form.
     *
     * @param Uri $uri
     * @return string
     */
    public function decode(Uri $uri): string
    {
        $uri = $this->decodeParsedUri($uri);

        return $uri->getUri();
    }

    /**
     * @param Uri $parsedUrl
     * @return Uri
     */
    private function encodeParsedUri(Uri $parsedUrl): Uri
    {
        $parsedUrl->setHost(idn_to_ascii($parsedUrl->getHost()));
        $parsedUrl->setPath($this->urlencode($parsedUrl->getPath()));
        $parsedUrl->setQuery($this->urlencode($parsedUrl->getQuery()));
        $parsedUrl->setFragment($this->urlencode($parsedUrl->getFragment()));

        return $parsedUrl;
    }

    /**
     * @param Uri $parsedUrl
     * @return Uri
     */
    private function decodeParsedUri(Uri $parsedUrl): Uri
    {
        $parsedUrl->setHost(idn_to_utf8($parsedUrl->getHost()));
        $parsedUrl->setPath(urldecode($parsedUrl->getPath()));
        $parsedUrl->setQuery(urldecode($parsedUrl->getQuery()));
        $parsedUrl->setFragment(urldecode($parsedUrl->getFragment()));

        return $parsedUrl;
    }

    /**
     * @param string|null $uri
     * @return string
     */
    private function urlencode(?string $uri): string
    {
        if ($uri === null) {
            return '';
        }

        $uri = urlencode($uri);

        return str_replace(['%2F', '%3F', '%23', '%26', '%3D'], ['/', '?', '#', '&', '='], $uri);
    }
}
