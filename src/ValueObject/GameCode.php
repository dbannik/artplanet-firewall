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
 * Class GameCode.
 */
class GameCode
{
    const CSSOLD = 'cssold';

    const CSS = 'css';

    const CSGO = 'csgo';

    const CS = 'cs';

    /**
     * @var array
     */
    public static $codes = [
        self::CS     => 'Counter-Strike',
        self::CSSOLD => 'Counter-Strike Source v34',
        self::CSS    => 'Counter-Strike Source',
        self::CSGO   => 'Counter-Strike Global Offensive',
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * GameCode constructor.
     *
     * @param string $value
     */
    public function __construct(string $value)
    {
        Assert::keyExists(self::$codes, $value);
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    public static function createResourceIdFromGameCode(string $code): ResourceId
    {
        $gameCode = new static($code);

        switch ((string) $gameCode) {
            case self::CS:
                $resourceId = ResourceId::CS;
                break;
            case self::CSS:
            case self::CSSOLD:
                $resourceId = ResourceId::CSS;
                break;
            case self::CSGO:
                $resourceId = ResourceId::CSGO;
                break;
            default:
                $resourceId = 0;
        }

        return new ResourceId($resourceId);
    }
}
