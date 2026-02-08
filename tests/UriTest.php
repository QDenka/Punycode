<?php

use PHPUnit\Framework\TestCase;
use Qdenka\Punycode\Exceptions\InvalidUrlException;
use Qdenka\Punycode\ValueObjects\Uri;

class UriTest extends TestCase
{
    public function testBasicUrlParsing(): void
    {
        $uri = new Uri('https://example.com/path');
        $this->assertEquals('https', $uri->getScheme());
        $this->assertEquals('example.com', $uri->getHost());
        $this->assertEquals('/path', $uri->getPath());
    }

    public function testUrlWithPort(): void
    {
        $uri = new Uri('https://example.com:8080/path');
        $this->assertEquals('8080', $uri->getPort());
        $this->assertEquals('https://example.com:8080/path', $uri->getUri());
    }

    public function testUrlWithUserPass(): void
    {
        $uri = new Uri('https://user:pass@example.com/path');
        $this->assertEquals('user', $uri->getUser());
        $this->assertEquals('pass', $uri->getPass());
        $this->assertEquals('https://user:pass@example.com/path', $uri->getUri());
    }

    public function testUrlWithUserOnly(): void
    {
        $uri = new Uri('https://user@example.com/path');
        $this->assertEquals('user', $uri->getUser());
        $this->assertEquals('', $uri->getPass());
        $this->assertEquals('https://user@example.com/path', $uri->getUri());
    }

    public function testUrlWithUserPassAndPort(): void
    {
        $uri = new Uri('https://user:pass@example.com:3000/path');
        $this->assertEquals('https://user:pass@example.com:3000/path', $uri->getUri());
    }

    public function testUrlWithQueryAndFragment(): void
    {
        $uri = new Uri('https://example.com/path?key=value#section');
        $this->assertEquals('key=value', $uri->getQuery());
        $this->assertEquals('section', $uri->getFragment());
        $this->assertEquals('https://example.com/path?key=value#section', $uri->getUri());
    }

    public function testDomainWithoutScheme(): void
    {
        $uri = new Uri('example.com/path');
        $this->assertEquals('example.com', $uri->getHost());
        $this->assertEquals('/path', $uri->getPath());
    }

    public function testToString(): void
    {
        $uri = new Uri('https://example.com/path');
        $this->assertEquals('https://example.com/path', (string) $uri);
    }

    public function testSetters(): void
    {
        $uri = new Uri('https://example.com/path');
        $uri->setHost('new.com');
        $uri->setPath('/new-path');
        $uri->setQuery('q=1');
        $uri->setFragment('top');
        $this->assertEquals('https://new.com/new-path?q=1#top', $uri->getUri());
    }

    public function testInvalidUrlThrowsException(): void
    {
        $this->expectException(InvalidUrlException::class);
        new Uri('');
    }
}
