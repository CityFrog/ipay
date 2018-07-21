<?php

namespace Cityfrog\Ipay\Service;

use Cityfrog\Ipay\Entity\User;
use Cityfrog\Ipay\IpayClient;

/**
 * Class AbstractService
 * @package Cityfrog\Ipay\Service
 */
abstract class AbstractService
{
    /** @var IpayClient $client */
    private $client;

    /** @var User $user */
    private $user;

    /**
     * AbstractService constructor.
     *
     * @param IpayClient $client
     * @param User       $user
     */
    public function __construct(IpayClient $client, User $user)
    {
        $this->client = $client;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return IpayClient
     */
    public function getClient(): IpayClient
    {
        return $this->client;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string $method
     * @param array  $data
     *
     * @return array
     */
    protected function sendRequest(string $method, array $data = []): array
    {
        return $this->getClient()->sendRequest(
            $method,
            array_merge($data, $this->getUser()->getRequestBody())
        );
    }
}
