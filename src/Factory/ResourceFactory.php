<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 18:24.
 */

namespace ArtplanetFirewall\Factory;

use ArtplanetFirewall\Component\Resource\CreateCounterStrikeGlobalOffensiveResource;
use ArtplanetFirewall\Component\Resource\CreateCounterStrikeResource;
use ArtplanetFirewall\Component\Resource\CreateCounterStrikeSourceResource;
use ArtplanetFirewall\Component\Resource\ResourceInterface;
use ArtplanetFirewall\Exception\ArtplanetFirewallException;
use ArtplanetFirewall\ValueObject\IpAddress;
use ArtplanetFirewall\ValueObject\ResourceId;
use ArtplanetFirewall\ValueObject\TcpPort;
use ArtplanetFirewall\ValueObject\UdpPort;

/**
 * Class ResourceFactory.
 */
class ResourceFactory
{
    /**
     * @param ResourceId $resourceId
     * @param IpAddress  $address
     * @param TcpPort    $tcpPort
     * @param UdpPort    $udpPort
     * @param int        $slots
     *
     * @throws ArtplanetFirewallException
     *
     * @return ResourceInterface
     */
    public static function factory(ResourceId $resourceId, IpAddress $address, TcpPort $tcpPort, UdpPort $udpPort, int $slots): ResourceInterface
    {
        switch ($resourceId->getValue()) {
            case ResourceId::CS:
                return new CreateCounterStrikeResource($address, $tcpPort, $udpPort, $slots);
            break;
            case ResourceId::CSS:
                return new CreateCounterStrikeSourceResource($address, $tcpPort, $udpPort, $slots);
            break;
            case ResourceId::CSGO:
                return new CreateCounterStrikeGlobalOffensiveResource($address, $tcpPort, $udpPort, $slots);
                break;
            default:
                throw new ArtplanetFirewallException(\sprintf('Resource is not supported (%s)', $resourceId));
        }
    }
}
