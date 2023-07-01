<?php

namespace Qdenka\Punycode\Contracts;

interface PunycodeDecoderContract
{
    /**
     * Decode the Punycode URL back to its original form.
     *
     * @param string $url
     * @return string
     * @throws \Throwable
     */
    public function decode(string $url): string;
}