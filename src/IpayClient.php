<?php

namespace CityFrog\Ipay;

/**
 * Class IpayClient
 * @package CityFrog\Ipay
 */
class IpayClient
{
    /** @var string $login */
    protected $login;

    /** @var string $sign */
    protected $sign;

    /**
     * @param string $login
     * @param string $sign
     */
    public function __constructor(string $login, string $sign)
    {
        $this->login = $login;
        $this->sign = $sign;

        $this->
    }

    /**
     * @return array
     */
    protected function getAuth(): array
    {
        $time = (new \DateTime())->format(Constant::TIME_FORMAT);

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
}
