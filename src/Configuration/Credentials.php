<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 4:32.
 */

namespace ArtplanetFirewall\Configuration;

class Credentials
{
    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $url;

    /**
     * Credentials constructor.
     *
     * @param string $email
     * @param string $key
     * @param string $url
     */
    public function __construct(string $email, string $key, string $url)
    {
        $this->email = $email;
        $this->key   = $key;
        $this->url   = $url;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }
}
