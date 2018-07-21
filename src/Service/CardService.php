<?php

namespace Cityfrog\Ipay\Service;

/**
 * Class CardService
 * @package Cityfrog\Ipay\Service
 *
 * You can find documentation by link - https://walletmc.ipay.ua/doc.php
 */
class CardService extends AbstractService
{
    /**
     * @return array
     */
    public function cardList(): array
    {
        return $this->sendRequest('List');
    }

    /**
     * @param string $lang
     * @param string $successUrl
     * @param string $errorUrl
     *
     * @return string
     */
    public function addCardByUrl(string $lang = 'ru', string $successUrl = null, string $errorUrl = null): string
    {
        return $this->sendRequest('AddcardByURL', [
            'lang'        => $lang,
            'success_url' => $successUrl,
            'error_url'   => $errorUrl
        ]);
    }

    /**
     * @param string $cardAlias
     *
     * @return string
     */
    public function deleteCard(string $cardAlias): string
    {
        $response = $this->sendRequest('DeleteCard', [
            'card_alias' => $cardAlias
        ]);

        return $response['status'];
    }
}
