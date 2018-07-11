<?php

$rootDir = dirname(__DIR__);

include "{$rootDir}/vendor/autoload.php";

use Cityfrog\Ipay\IpayClient;

$login = '';
$secretKey = '';

$client = new IpayClient($login, $secretKey);

try {
    $data = $client->sendRequest('Check', [
        "msisdn" => '380638237766',
        "user_id" => '1',
    ]);

    print_r($data);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}

