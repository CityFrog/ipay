<?php

namespace Cityfrog\Ipay;

use Cityfrog\Ipay\Exceptions\IpayException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\GuzzleException;
use Carbon\Carbon;

/**
 * Class IpayClient
 * @package Cityfrog\Ipay
 *
 * You can find documentation by link - https://walletmc.ipay.ua/doc.php
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
    public function __construct(string $login, string $sign)
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
        $time = (new Carbon())
            //
            ->setTimezone('Europe/Kiev')
            ->format(Constant::TIME_FORMAT);

        return [
            'login' => $this->login,
            'time'  => $time,
            'sign'  => md5($time . $this->sign)
        ];
    }

    /**
     * @param string $action
     * @param array  $body
     *
     * @return array
     */
    public function createRequestData(string $action, array $body): array
    {
        return [
            'request' => [
                'auth'   => $this->getAuth(),
                'action' => $action,
                'body'   => $body
            ]
        ];
    }

    /**
     * @param string $action
     * @param array  $body
     *
     * @return array
     *
     * @throws GuzzleException
     * @throws \Exception
     */
    public function sendRequest(string $action, array $body = []): array
    {
        $request = new Request(
            'POST',
            Constant::IPAY_URL,
            [],
            json_encode($this->createRequestData($action, $body))
        );

        try {
            $response = $this->guzzleClient->send($request);

            $ipayResponse = \GuzzleHttp\json_decode($response->getBody()->getContents(), true)['response'];

            if ($ipayResponse['error']) {
                throw new IpayException($ipayResponse['error']);
            }

            return $ipayResponse;
        } catch (GuzzleException $exception) {
            /** @TODO Handle Guzzle Exception */
            throw $exception;
        } catch (\Exception $exception) {
            /** @TODO Handle Exception */
            throw $exception;
        }
    }
}
