# Punycode Converter

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://github.com/qdenka/Punycode/blob/main/LICENSE)
[![Build Status](https://travis-ci.com/qdenka/punycode.svg?branch=main)](https://travis-ci.com/your-username/your-library)
[![Coverage Status](https://coveralls.io/repos/github/qdenka/punycode/badge.svg?branch=main)](https://coveralls.io/github/your-username/your-library?branch=main)

Punycode Converter is a PHP library that provides functions to encode and decode URLs using Punycode.

## Installation

You can install the library via Composer. Run the following command:

```bash
composer require qdenka/punycode
```

## Usage

```php
use Qdenka\Punycode\Converter;

// Encode a URL to Punycode
$encodedUrl = Converter::encode('http://www.üñïçø∂é.com/');

// Decode a Punycode URL back to its original form
$decodedUrl = Converter::decode('http://xn--tda.com/');

// Encode an array of URLs to Punycode
$urls = ['http://www.üñïçø.com/testcase', 'ßlåh.com'];
$encodedUrls = Converter::encodeFromArray($urls);

// Decode an array of Punycode URLs back to their original forms
$punycodeUrls = ['xn--tda.com', 'http://www.example.com/url1'];
$decodedUrls = Converter::decodeFromArray($punycodeUrls);
```