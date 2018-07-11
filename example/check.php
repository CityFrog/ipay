<?php

$rootDir = dirname(__DIR__);

include $rootDir . "/vendor/autoload.php";

use Cityfrog\Ipay\IpayClient;
use Cityfrog\Ipay\Entity\User;

$login = 'YOUR LOGIN';
$secretKey = 'YOUR SECRET KEY';

$user = new User('380638237766', '1');

$client = new IpayClient($login, $secretKey);

try {
    $data = $client->registerByUrl($user);

    print_r($data);
    echo "\n\n";
} catch (\Exception $exception) {
    echo "ERROR:" . $exception->getMessage() . "\n";
}

