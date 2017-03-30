<?php

use HiveSDK\API\Authentication\Credentials;
use HiveSDK\API\Client;
use HiveSDK\Device\SmartPlug;

require(__DIR__ . '/../vendor/autoload.php');

$id = 'c6fc2554-91e8-4d43-93dd-47b34fde462f';
$username = 'user@hive.com';
$password = '';

$authentication = new Credentials($username, $password);
$client = new Client($authentication);

$plug = new SmartPlug($id, $client);
$plug->on()
    ->apply();