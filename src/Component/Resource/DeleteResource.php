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
use ArtplanetFirewall\ValueObject\UdpPort;

/**
 * Class DeleteResource.
 */
class DeleteResource implements ResourceInterface
{
    /**
     * @var IpAddress
     */
    private $ipAddress;

    /**
     * @var UdpPort
     */
    private $gamePort;

    /**
     * DeleteResource constructor.
     *
     * @param IpAddress $ipAddress
     * @param UdpPort   $gamePort
     */
    public function __construct(IpAddress $ipAddress, UdpPort $gamePort)
    {
        $this->ipAddress = $ipAddress;
        $this->gamePort  = $gamePort;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'ip'  => (string) $this->ipAddress,
            'udp' => (string) $this->gamePort,
        ];
    }
}
