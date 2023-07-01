<?php

use PHPUnit\Framework\TestCase;
use Qdenka\Punycode\Identifier;

class IdentifierTest extends TestCase
{
    public function testIsPunycode()
    {
        $this->assertTrue(Identifier::isPunycode('xn--80ak6aa92e.com'));
        $this->assertFalse(Identifier::isPunycode('example.com'));
    }

    public function testIsUnicode()
    {
        $this->assertTrue(Identifier::isUnicode('домен.рф'));
    }
}