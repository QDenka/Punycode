<?php

use PHPUnit\Framework\TestCase;
use Qdenka\Punycode\Converter;

class ConverterTest extends TestCase
{
    public function __construct(string $name)
    {
        parent::__construct($name);
    }

    public function testEncode(): void
    {
        $encodedUrl = Converter::encode('https://點看.com');
        $this->assertEquals('https://xn--c1yn36f.com', $encodedUrl);
    }

    public function testDecodeUrl(): void
    {
        $decodedUrl = Converter::decode('https://xn--d1acufc.xn--p1ai/testcase');
        $this->assertEquals('https://домен.рф/testcase', $decodedUrl);
    }

    public function testDecodeFromArray(): void
    {
        $encodedUrls = ['https://xn--c1yn36f.com', 'https://xn--d1acufc.xn--p1ai/testcase'];
        $decodedUrls = Converter::decodeFromArray($encodedUrls);
        $this->assertEquals(['https://點看.com', 'https://домен.рф/testcase'], $decodedUrls);
    }

    public function testEncodeFromArray(): void
    {
        $urls = ['https://點看.com', 'https://домен.рф/testcase', 'сдай-лом.рф/пример'];
        $encodedUrls = Converter::encodeFromArray($urls);
        $this->assertEquals(['https://xn--c1yn36f.com', 'https://xn--d1acufc.xn--p1ai/testcase', 'xn----7sblvlgns.xn--p1ai/%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80'], $encodedUrls);
    }

    public function testFullUrlEncode(): void
    {
        $url = 'https://привет.рф/мир/тест/#привет=мир';
        $encodedUrl = Converter::encode($url);

        $this->assertEquals('https://xn--b1agh1afp.xn--p1ai/%D0%BC%D0%B8%D1%80/%D1%82%D0%B5%D1%81%D1%82/#%D0%BF%D1%80%D0%B8%D0%B2%D0%B5%D1%82=%D0%BC%D0%B8%D1%80', $encodedUrl);
    }
}
