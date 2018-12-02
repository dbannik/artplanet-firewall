<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 16:24.
 */

namespace ArtplanetFirewall\Processor;

use ArtplanetFirewall\Component\Resource\DeleteResource;
use ArtplanetFirewall\Component\Resource\GetResource;
use ArtplanetFirewall\Configuration\Credentials;
use ArtplanetFirewall\Connection\ApiResponse;
use ArtplanetFirewall\Connection\Connection;
use ArtplanetFirewall\Exception\ArtplanetFirewallException;
use ArtplanetFirewall\Factory\ResourceFactory;
use ArtplanetFirewall\ValueObject\GameCode;
use ArtplanetFirewall\ValueObject\IpAddress;
use ArtplanetFirewall\ValueObject\TcpPort;
use ArtplanetFirewall\ValueObject\UdpPort;

/**
 * Class RulesProcessor.
 */
class RulesProcessor
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * RulesProcessor constructor.
     *
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->connection = new Connection($credentials);
    }

    /**
     * @param string $gameCode
     * @param string $address
     * @param int    $tcpPort
     * @param int    $udpPort
     * @param int    $slots
     *
     * @throws ArtplanetFirewallException
     */
    public function add(string $gameCode, string $address, int $tcpPort, int $udpPort, int $slots): void
    {
        $resource = ResourceFactory::factory(
            GameCode::createResourceIdFromGameCode($gameCode),
            new IpAddress($address),
            new TcpPort($tcpPort),
            new UdpPort($udpPort),
            $slots
        );
        $apiResponse = $this->connection->send($resource, '/api/append');
        if ($apiResponse->isError()) {
            throw new ArtplanetFirewallException((string) $apiResponse->getMessage());
        }
    }

    /**
     * @param string $gameCode
     * @param string $address
     * @param int    $tcpPort
     * @param int    $udpPort
     * @param int    $slots
     *
     * @throws ArtplanetFirewallException
     */
    public function forceAdd(string $gameCode, string $address, int $tcpPort, int $udpPort, int $slots): void
    {
        try {
            $this->add($gameCode, $address, $tcpPort, $udpPort, $slots);
        } catch (ArtplanetFirewallException $exception) {
            $this->delete($address, $udpPort);
        }
    }

    /**
     * @param string $address
     * @param int    $port
     *
     * @throws ArtplanetFirewallException
     *
     * @return ApiResponse
     */
    public function get(string $address, int $port): ApiResponse
    {
        $resource    = new GetResource(new IpAddress($address), new UdpPort($port));
        $apiResponse = $this->connection->send($resource, '/api/get');
        if ($apiResponse->isError()) {
            throw new ArtplanetFirewallException((string) $apiResponse->getMessage());
        }

        return $apiResponse;
    }

    /**
     * @param string $address
     * @param int    $port
     *
     * @throws ArtplanetFirewallException
     */
    public function delete(string $address, int $port): void
    {
        $resource    = new DeleteResource(new IpAddress($address), new UdpPort($port));
        $apiResponse = $this->connection->send($resource, '/api/delete');
        if ($apiResponse->isError()) {
            throw new ArtplanetFirewallException((string) $apiResponse->getMessage());
        }
    }
}
