<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 5:09.
 */

namespace ArtplanetFirewall\Component\Resource;

use ArtplanetFirewall\ValueObject\IpAddress;
use ArtplanetFirewall\ValueObject\ResourceId;
use ArtplanetFirewall\ValueObject\TcpPort;
use ArtplanetFirewall\ValueObject\UdpPort;

/**
 * Class CreateCounterStrikeResource.
 */
class CreateCounterStrikeResource implements ResourceInterface
{
    /**
     * @var IpAddress
     */
    private $ipAddress;

    /**
     * @var TcpPort
     */
    private $rcon;

    /**
     * @var UdpPort
     */
    private $gamePort;

    /**
     * @var int
     */
    private $slots;

    /**
     * @var int
     */
    private $resourceId = ResourceId::CSGO;

    /**
     * CreateCounterStrikeResource constructor.
     *
     * @param IpAddress $ipAddress
     * @param TcpPort   $rcon
     * @param UdpPort   $gamePort
     * @param int       $slots
     */
    public function __construct(IpAddress $ipAddress, TcpPort $rcon, UdpPort $gamePort, int $slots)
    {
        $this->ipAddress = $ipAddress;
        $this->rcon      = $rcon;
        $this->gamePort  = $gamePort;
        $this->slots     = $slots;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'ip'          => (string) $this->ipAddress,
            'rcon'        => (string) $this->rcon,
            'gameport'    => (string) $this->gamePort,
            'max_online'  => $this->slots,
            'resource_id' => (string) $this->resourceId,
        ];
    }
}
