<?php

namespace Cityfrog\Ipay;

use Guzzle\Http\Client as GuzzleClient;

/**
 * Class IpayClient
 * @package Cityfrog\Ipay
 */
class IpayClient
{
    /** @var string $login */
    protected $login;

    /** @var string $sign */
    protected $sign;

    /** @var GuzzleClient $guzzleClient */
    protected $guzzleClient;

    /**
     * @param string $login
     * @param string $sign
     */
    public function __constructor(string $login, string $sign)
    {
        $this->login = $login;
        $this->sign = $sign;

        $this->guzzleClient = new GuzzleClient();
    }

    /**
     * @return array
     */
    protected function getAuth(): array
    {
        $time = (new \DateTime())->format(Constant::TIME_FORMAT);

        return [
            'login' => $this->login,
            'time' => $time,
            'sign' => md5($time . $this->sign)
        ];
    }

    /**
     * @param string $action
     * @param array $body
     *
     * @return array
     */
    public function createRequestData(string $action, array $body): array
    {
        return [
            'request' => [
                'auth' => $this->getAuth(),
                'action' => $action,
                'body' => $body
            ]
        ];
    }

    /**
     * @param string $action
     * @param array $body
     * @return array
     * @throws \Exception
     */
    public function sendRequest(string $action, array $body = []): array
    {
        $request = $this->guzzleClient->post(
            Constant::IPAY_URL,
            [],
            json_encode($this->createRequestData($action, $body))
        );

        try {
            $response = $request->send();
        } catch (\Exception $exception) {
            throw $exception;
        }

        return $response->json();
    }
}
