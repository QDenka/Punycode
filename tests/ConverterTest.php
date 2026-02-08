<?php

use PHPUnit\Framework\TestCase;
use Qdenka\Punycode\Converter;
use Qdenka\Punycode\Exceptions\InvalidUrlException;

class ConverterTest extends TestCase
{
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
        $urls = ['https://點看.com', 'https://домен.рф/testcase', 'сдай-лом.рф/пример', 'test.com/test', 'http://test2.com/test?uri=true'];
        $encodedUrls = Converter::encodeFromArray($urls);
        $this->assertEquals([
            'https://xn--c1yn36f.com',
            'https://xn--d1acufc.xn--p1ai/testcase',
            'xn----7sblvlgns.xn--p1ai/%D0%BF%D1%80%D0%B8%D0%BC%D0%B5%D1%80',
            'test.com/test',
            'http://test2.com/test?uri=true',
        ], $encodedUrls);
    }

    public function testFullUrlEncode(): void
    {
        $url = 'https://привет.рф/мир/тест/#привет=мир';
        $encodedUrl = Converter::encode($url);

        $this->assertEquals(
            'https://xn--b1agh1afp.xn--p1ai/%D0%BC%D0%B8%D1%80/%D1%82%D0%B5%D1%81%D1%82/#%D0%BF%D1%80%D0%B8%D0%B2%D0%B5%D1%82=%D0%BC%D0%B8%D1%80',
            $encodedUrl
        );
    }

    public function testEncodeUrlWithPort(): void
    {
        $encodedUrl = Converter::encode('https://домен.рф:8080/path');
        $this->assertEquals('https://xn--d1acufc.xn--p1ai:8080/path', $encodedUrl);
    }

    public function testDecodeUrlWithPort(): void
    {
        $decodedUrl = Converter::decode('https://xn--d1acufc.xn--p1ai:8080/path');
        $this->assertEquals('https://домен.рф:8080/path', $decodedUrl);
    }

    public function testEncodeUrlWithUserPass(): void
    {
        $encodedUrl = Converter::encode('https://user:pass@домен.рф/path');
        $this->assertEquals('https://user:pass@xn--d1acufc.xn--p1ai/path', $encodedUrl);
    }

    public function testDecodeUrlWithUserPass(): void
    {
        $decodedUrl = Converter::decode('https://user:pass@xn--d1acufc.xn--p1ai/path');
        $this->assertEquals('https://user:pass@домен.рф/path', $decodedUrl);
    }

    public function testEncodeUrlWithUserPassAndPort(): void
    {
        $encodedUrl = Converter::encode('https://user:pass@домен.рф:3000/path');
        $this->assertEquals('https://user:pass@xn--d1acufc.xn--p1ai:3000/path', $encodedUrl);
    }

    public function testEncodeAsciiUrlUnchanged(): void
    {
        $url = 'https://example.com/path?query=1#frag';
        $this->assertEquals($url, Converter::encode($url));
    }

    public function testDecodeAsciiUrlUnchanged(): void
    {
        $url = 'https://example.com/path?query=1#frag';
        $this->assertEquals($url, Converter::decode($url));
    }

    public function testEncodeUrlWithQueryAndFragment(): void
    {
        $url = 'https://домен.рф/путь?запрос=да#фрагмент';
        $encoded = Converter::encode($url);
        $this->assertStringContainsString('xn--d1acufc.xn--p1ai', $encoded);
        $this->assertStringContainsString('?', $encoded);
        $this->assertStringContainsString('#', $encoded);
    }

    public function testInvalidUrlThrowsException(): void
    {
        $this->expectException(InvalidUrlException::class);
        Converter::encode('');
    }

    public function testEmptyArrayEncode(): void
    {
        $this->assertEquals([], Converter::encodeFromArray([]));
    }

    public function testEmptyArrayDecode(): void
    {
        $this->assertEquals([], Converter::decodeFromArray([]));
    }
}
