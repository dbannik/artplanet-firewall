<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 4:03.
 */

namespace ArtplanetFirewall\ValueObject;

use Webmozart\Assert\Assert;

/**
 * Class ResourceId.
 */
class ResourceId
{
    use ValueObjectTrait;

    const CSGO = 1;

    const CS   = 78;

    const CSS  = 79;

    const MC   = 84;

    const SAMP = 87;

    const CRMP = 89;

    /**
     * @var array
     */
    public static $resources = [
        self::CS   => 'Counter-Strike',
        self::CSS  => 'Counter-Strike Source',
        self::CSGO => 'Counter-Strike Global Offensive',
        self::MC   => 'Minecraft',
        self::SAMP => 'GTA:SA',
        self::CRMP => 'GTA:CR',
    ];

    /**
     * @var int
     */
    private $value;

    /**
     * ResourceId constructor.
     *
     * @param int $value
     */
    public function __construct(int $value)
    {
        Assert::keyExists(self::$resources, $value);
        $this->value = $value;
    }
}
