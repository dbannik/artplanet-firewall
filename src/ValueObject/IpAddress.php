<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 1:35.
 */

namespace ArtplanetFirewall\ValueObject;

use Webmozart\Assert\Assert;

/**
 * Class IpAddress.
 */
class IpAddress
{
    /**
     * @var string
     */
    private $value;

    /**
     * IpAddress constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::regex($value, '/^[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}$/');
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}
