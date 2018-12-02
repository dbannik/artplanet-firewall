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
 * Class GetResource.
 */
class GetResource implements ResourceInterface
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
     * @var string
     */
    private $portType = 'UDP';

    /**
     * GetResource constructor.
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
            'ip'          => (string) $this->ipAddress,
            'port_number' => (string) $this->gamePort,
            'port_type'   => $this->portType,
        ];
    }
}
