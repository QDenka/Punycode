<?php

namespace Qdenka\Punycode\Services;

use Exception;
use Qdenka\Punycode\Contracts\PunycodeDecoderContract;
use Qdenka\Punycode\Contracts\PunycodeEncoderContract;
use Qdenka\Punycode\Exceptions\InvalidUrlException;
use Qdenka\Punycode\Exceptions\ModuleNotFoundException;
use Spoofchecker;

/**
 * Class UrlPunycodeConverter
 *
 * This class is responsible for encoding and decoding URLs to and from Punycode.
 */
class PunycodeConverter implements PunycodeEncoderContract, PunycodeDecoderContract
{
    /**
     * @var Spoofchecker
     */
    private Spoofchecker $spoofChecker;


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
        $this->spoofChecker = new Spoofchecker();
    }

    /**
     * Encode the URL into Punycode.
     *
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function encode(string $url): string
    {
        $parsedUrl = $this->parseUrl($url);
        $this->checkUrl($parsedUrl);
        $parsedUrl = parse_url($url);

        $parsedUrl['host'] = idn_to_ascii($parsedUrl['host'], IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        return $this->unparseUrl($parsedUrl);
    }

    /**
     * Decode the Punycode URL back to its original form.
     *
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function decode(string $url): string
    {
        $parsedUrl = $this->parseUrl($url);
        $this->checkUrl($parsedUrl);

        $parsedUrl['host'] = idn_to_utf8($parsedUrl['host'], IDNA_DEFAULT, INTL_IDNA_VARIANT_UTS46);
        return $this->unparseUrl($parsedUrl);
    }

    /**
     * @param array $parsedUrl
     * @return void
     * @throws InvalidUrlException
     */
    private function checkUrl(array $parsedUrl): void
    {
        if (!isset($parsedUrl['host']) || $this->spoofChecker->isSuspicious($parsedUrl['host'])) {
            throw new InvalidUrlException('Invalid URL provided: ' . $this->unparseUrl($parsedUrl));
        }
    }

    /**
     * @param string $url
     * @return array
     */
    private function parseUrl(string $url): array
    {
        return parse_url($url);
    }

    /**
     * Build the URL back from its parsed components.
     *
     * @param array $parsedUrl
     * @return string
     */
    private function unparseUrl(array $parsedUrl): string
    {
        $scheme = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
        $user = $parsedUrl['user'] ?? '';
        $pass = isset($parsedUrl['pass']) ? ':' . $parsedUrl['pass'] : '';
        $pass = ($user || $pass) ? "$pass@" : '';
        $host = $parsedUrl['host'] ?? '';
        $port = isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '';
        $path = $parsedUrl['path'] ?? '';
        $query = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';
        $fragment = isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '';
        return "$scheme$user$pass$host$port$path$query$fragment";
    }
}
