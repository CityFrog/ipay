<?php

namespace Cityfrog\Ipay\Service;

use Cityfrog\Ipay\Exceptions\IpayException;

/**
 * Class UserService
 * @package Cityfrog\Ipay\Service
 *
 * You can find documentation by link - https://walletmc.ipay.ua/doc.php
 */
class UserService extends AbstractService
{
    /**
     * @return array
     */
    public function check(): array
    {
        return $this->getClient()->sendRequest('Check');
    }

    /**
     * @return array
     */
    public function invite(): array
    {
        return $this->getClient()->sendRequest('Invite');
    }

    /**
     * @param string $lang
     * @param string $successUrl
     * @param string $errorUrl
     *
     * @return string
     */
    public function inviteByUrl(string $lang = 'ru', string $successUrl = null, string $errorUrl = null): string
    {
        $response = $this->sendRequest('InviteByURL', [
            'lang'        => $lang,
            'success_url' => $successUrl,
            'error_url'   => $errorUrl
        ]);

        return $response['url'];
    }

    /**
     * @param string $lang
     * @param string $successUrl
     * @param string $errorUrl
     *
     * @return string
     */
    public function registerByUrl(string $lang = 'ru', string $successUrl = null, string $errorUrl = null): string
    {
        $response = $this->sendRequest('RegisterByURL', [
            'lang'        => $lang,
            'success_url' => $successUrl,
            'error_url'   => $errorUrl
        ]);

        return $response['url'];
    }

    /**
     * @param string $lang
     *
     * @return string
     */
    public function testInvite(string $lang = 'ru'): string
    {
        $response = $this->sendRequest('TestInvite', [
            'lang' => $lang
        ]);

        return $response['url'];
    }

    /**
     * @return array
     * @throws IpayException
     */
    public function registerPurchaseByURL(): array
    {
        throw new IpayException('Method has not implemented yet');

        return $this->sendRequest('RegisterPurchaseByURL', [
            // @TODO Need implement Purchase params
        ]);
    }
}
