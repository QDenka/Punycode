<?php

use PHPUnit\Framework\TestCase;
use Qdenka\Punycode\Converter;

class ConverterTest extends TestCase
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function testEncode()
    {
        $encodedUrl = Converter::encode('https://點看.com');
        $this->assertEquals('https://xn--c1yn36f.com', $encodedUrl);
    }

    public function testDecodeUrl()
    {
        $decodedUrl = Converter::decode('https://xn--d1acufc.xn--p1ai/testcase');
        $this->assertEquals('https://домен.рф/testcase', $decodedUrl);
    }

    public function testDecodeFromArray()
    {
        $encodedUrls = ['https://xn--c1yn36f.com', 'https://xn--d1acufc.xn--p1ai/testcase'];
        $decodedUrls = Converter::decodeFromArray($encodedUrls);
        $this->assertEquals(['https://點看.com', 'https://домен.рф/testcase'], $decodedUrls);
    }

    public function testEncodeFromArray()
    {
        $urls = ['https://點看.com', 'https://домен.рф/testcase'];
        $encodedUrls = Converter::encodeFromArray($urls);
        $this->assertEquals(['https://xn--c1yn36f.com', 'https://xn--d1acufc.xn--p1ai/testcase'], $encodedUrls);
    }
}
