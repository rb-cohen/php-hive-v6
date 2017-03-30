<?php

use HiveSDK\API\Authentication\Credentials;
use HiveSDK\API\Client;
use HiveSDK\Devices;

require(__DIR__ . '/../vendor/autoload.php');

$id = 'c6fc2554-91e8-4d43-93dd-47b34fde462f';
$username = 'user@hive.com';
$password = '';

$authentication = new Credentials($username, $password);
$client = new Client($authentication);

$devices = new Devices($client);
$list = $devices->all();

foreach($list as $device){
    echo 'ID: ' . $device->id . PHP_EOL;
    echo 'Name: ' . $device->name . PHP_EOL;
    echo 'Type: ' . $device->nodeType . PHP_EOL;
    echo PHP_EOL;
}