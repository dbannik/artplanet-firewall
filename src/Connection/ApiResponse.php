<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 19:03.
 */

namespace ArtplanetFirewall\Connection;

/**
 * Class ApiResponse.
 */
class ApiResponse
{
    /**
     * @var array
     */
    private $data;

    /**
     * ApiResponse constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        if ($this->data === [] || (isset($this->data['status']) && 'ERROR' === $this->data['status'])) {
            return true;
        }

        return false;
    }

    /**
     * @return null|int
     */
    public function getErrorCode(): ?int
    {
        return $this->data['error_code'] ?: null;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->data['message'] ?: null;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
