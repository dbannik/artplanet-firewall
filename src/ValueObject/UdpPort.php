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
 * Class Port.
 */
class UdpPort
{
    use ValueObjectTrait;

    /**
     * @var int
     */
    private $value;

    /**
     * Port constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        Assert::range($value, 0, 65536);
        $this->value = $value;
    }
}
