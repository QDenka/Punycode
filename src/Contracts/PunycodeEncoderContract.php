<?php

namespace Qdenka\Punycode\Contracts;

use Qdenka\Punycode\ValueObjects\Uri;

interface PunycodeEncoderContract
{
    /**
     * Encode the URL to Punycode.
     *
     * @param Uri $uri
     * @return string
     * @throws \Throwable
     */
    public function encode(Uri $uri): string;
}
