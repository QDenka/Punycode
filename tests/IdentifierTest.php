<?php

use PHPUnit\Framework\TestCase;
use Qdenka\Punycode\Identifier;

class IdentifierTest extends TestCase
{
    public function testIsPunycodeWithDomain(): void
    {
        $this->assertTrue(Identifier::isPunycode('xn--80ak6aa92e.com'));
    }

    public function testIsPunycodeWithFullUrl(): void
    {
        $this->assertTrue(Identifier::isPunycode('http://xn--tda.com/'));
    }

    public function testIsPunycodeWithSubdomain(): void
    {
        $this->assertTrue(Identifier::isPunycode('http://www.xn--tda.com/path'));
    }

    public function testIsNotPunycode(): void
    {
        $this->assertFalse(Identifier::isPunycode('example.com'));
    }

    public function testIsNotPunycodeWithFullUrl(): void
    {
        $this->assertFalse(Identifier::isPunycode('https://example.com/path'));
    }

    public function testIsUnicodeWithCyrillic(): void
    {
        $this->assertTrue(Identifier::isUnicode('домен.рф'));
    }

    public function testIsUnicodeWithChinese(): void
    {
        $this->assertTrue(Identifier::isUnicode('點看.com'));
    }

    public function testIsUnicodeWithUmlauts(): void
    {
        $this->assertTrue(Identifier::isUnicode('münchen.de'));
    }

    public function testIsNotUnicodeWithAscii(): void
    {
        $this->assertFalse(Identifier::isUnicode('example.com'));
    }

    public function testIsNotUnicodeWithPunycode(): void
    {
        $this->assertFalse(Identifier::isUnicode('xn--80ak6aa92e.com'));
    }
}
