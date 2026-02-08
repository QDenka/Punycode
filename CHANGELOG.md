# Changelog

## [v1.3.0] - 2026-02-08

### Bug Fixes
- **Uri::getAuthority()** — fixed port missing colon separator (`example.com8080` → `example.com:8080`)
- **Uri::getAuthority()** — fixed user:pass missing colon separator (`userpass@host` → `user:pass@host`)
- **Uri::__construct()** — replaced `str_replace` with `substr` for reliable host fallback extraction
- **Identifier::isPunycode()** — now correctly detects Punycode in full URLs (`http://xn--tda.com/`)
- **Identifier::isUnicode()** — now detects actual non-ASCII characters instead of any valid UTF-8 string
- **PunycodeConverter** — added error handling for `idn_to_ascii()` / `idn_to_utf8()` returning `false`
- **Converter::$converter** — declared as `?PunycodeConverter = null` for proper initialization

### Improvements
- Integrated `UriValidator` into `Uri` constructor (was created but never used)
- Consistent return types: `getFragment()`, `getUser()`, `getPass()` now return `string` instead of `?string`

### CI/CD
- Added GitHub Actions CI pipeline: tests on PHP 7.4, 8.0, 8.1, 8.2, 8.3, 8.4
- Code coverage report with Codecov integration
- PHP CS Fixer (PSR-12) code style checks
- PHPStan level 5 static analysis
- Security audit via `composer audit`
- Auto-release pipeline on tag push (`v*`)

### Tests
- Added tests for URLs with port
- Added tests for URLs with user:pass authentication
- Added tests for invalid URLs (InvalidUrlException)
- Added tests for ASCII URLs (no-op encode/decode)
- Added tests for empty arrays
- Added `UriTest.php` — full coverage of Uri Value Object
- Expanded `IdentifierTest.php` — full URL support, ASCII vs Unicode detection

### Chore
- Removed `composer.lock` from repository (libraries should not commit lock files)
- Added `phpunit.xml` configuration
- Added `.php-cs-fixer.php` configuration
