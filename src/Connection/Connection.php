<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: dmitry
 * Date: 01.12.18
 * Time: 4:39.
 */

namespace ArtplanetFirewall\Connection;

use ArtplanetFirewall\Component\Resource\ResourceInterface;
use ArtplanetFirewall\Configuration\Credentials;
use ArtplanetFirewall\Exception\ArtplanetFirewallException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Connection.
 */
class Connection
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Credentials
     */
    private $credentials;

    /**
     * Connection constructor.
     *
     * @param Credentials $credentials
     */
    public function __construct(Credentials $credentials)
    {
        $this->client      = new Client();
        $this->credentials = $credentials;
    }

    /**
     * @param ResourceInterface $resource
     * @param string            $method
     *
     * @return ApiResponse
     * @throws ArtplanetFirewallException
     */
    public function send(ResourceInterface $resource, string $method): ApiResponse
    {
        $data = \array_merge($resource->getData(), [
            'email'   => $this->credentials->getEmail(),
            'key_api' => $this->credentials->getKey(),
        ]);

        try {
            $response   = $this->client->request('GET', $this->credentials->getUrl() . $method, ['query' => $data, 'connect_timeout' => 3]);
        } catch (GuzzleException $exception) {
            throw new ArtplanetFirewallException(\sprintf('Bad request. info (%s)', $exception->getMessage()));
        }
        $statusCode = $response->getStatusCode();
        if ($statusCode < 200 && $statusCode >= 300) {
            throw new ArtplanetFirewallException(\sprintf('Bad response. info (%s) %s', $statusCode, $response->getReasonPhrase()));
        }

        return new ApiResponse(\json_decode($response->getBody()->getContents(), true));
    }
}
