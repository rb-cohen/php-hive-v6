<?php

use HiveSDK\API\Authentication\Credentials;
use HiveSDK\API\Client;
use HiveSDK\Device\BulbColour;

require(__DIR__ . '/../vendor/autoload.php');

$id = 'c6fc2554-91e8-4d43-93dd-47b34fde462f';
$username = 'user@hive.com';
$password = '';

$authentication = new Credentials($username, $password);
$client = new Client($authentication);

$bulb = new BulbColour($id, $client);
$bulb->on()
    ->setBrightness(50)
    ->setColour('#ff0000')
    ->apply();