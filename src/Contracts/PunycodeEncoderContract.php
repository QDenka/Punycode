<?php

namespace Qdenka\Punycode\Contracts;

interface PunycodeEncoderContract
{
    /**
     * Encode the URL to Punycode.
     *
     * @param string $url
     * @return string
     * @throws \Throwable
     */
    public function encode(string $url): string;
}