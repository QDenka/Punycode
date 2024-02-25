<?php

namespace Qdenka\Punycode\Contracts;

use Qdenka\Punycode\ValueObjects\Uri;

interface PunycodeDecoderContract
{
    /**
     * Decode the Punycode URL back to its original form.
     *
     * @param Uri $uri
     * @return string
     * @throws \Throwable
     */
    public function decode(Uri $uri): string;
}
