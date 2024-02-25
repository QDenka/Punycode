<?php

namespace Qdenka\Punycode\ValueObjects;

use Qdenka\Punycode\Exceptions\InvalidUrlException;

final class Uri
{
    private array $uri;

    /**
     * @throws InvalidUrlException
     */
    public function __construct(string $url)
    {
        $this->uri = parse_url($url);
        if ($this->uri === false) {
            throw new InvalidUrlException('Invalid URL');
        }

        if (!isset($this->uri['host'])) {
            $this->uri['host'] = explode('/', $this->uri['path'])[0];
            $this->uri['path'] = str_replace($this->uri['host'], '', $this->uri['path']);
        }
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->uri['host'] ?? '';
    }

    /**
     * @return string
     */
    public function getScheme(): string
    {
        return $this->uri['scheme'] ?? '';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->uri['path'] ?? '';
    }

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->uri['query'] ?? '';
    }

    /**
     * @return string
     */
    public function getFragment(): ?string
    {
        return $this->uri['fragment'] ?? '';
    }

    /**
     * @return string
     */
    public function getUser(): ?string
    {
        return $this->uri['user'] ?? '';
    }

    /**
     * @return string
     */
    public function getPass(): ?string
    {
        return $this->uri['pass'] ?? '';
    }

    /**
     * @return string
     */
    public function getPort(): string
    {
        return $this->uri['port'] ?? '';
    }

    /**
     * @return string
     */
    public function getAuthority(): string
    {
        $user = $this->getUser();
        $pass = $this->getPass();
        $pass = ($user || $pass) ? "$pass@" : '';
        $port = $this->getPort();

        return $user . $pass . $this->getHost() . $port;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        $scheme = $this->getScheme() ? $this->getScheme() . '://' : '';
        $host = $this->getAuthority();
        $path = $this->getPath();
        $query = $this->getQuery() ? '?' . $this->getQuery() : '';
        $fragment = $this->getFragment() ? '#' . $this->getFragment() : '';
        return "$scheme$host$path$query$fragment";
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getUri();
    }

    public function setHost(string $host): void
    {
        $this->uri['host'] = $host;
    }

    public function setQuery(string $query): void
    {
        $this->uri['query'] = $query;
    }

    public function setFragment(string $fragment): void
    {
        $this->uri['fragment'] = $fragment;
    }

    public function setPath(string $path): void
    {
        $this->uri['path'] = $path;
    }
}
