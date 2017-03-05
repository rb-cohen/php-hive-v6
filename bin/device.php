<?php

require(__DIR__ . '/../vendor/autoload.php');
$authentication = require(__DIR__ . '/_buildAuthentication.php');

$id = null;
$arguments = $argv;
array_shift($arguments);

while($key = array_shift($arguments)){
    switch($key){
        case '--id':
            $id = array_shift($arguments);
            break;
    }
}

$client = new \HiveSDK\API\Client($authentication);

$deviceList = new \HiveSDK\Devices($client);
$device = $deviceList->id($id);

var_dump($device);