<?php

require(__DIR__ . '/../vendor/autoload.php');
$authentication = require(__DIR__ . '/_buildAuthentication.php');

$id = null;
$method = 'off';

$arguments = $argv;
array_shift($arguments);

while($key = array_shift($arguments)){
    switch($key){
        case '--id':
            $id = array_shift($arguments);
            break;
        case '--on':
            $method = 'on';
            break;
        case '--off':
            $method = 'off';
            break;
    }
}

$client = new \HiveSDK\API\Client($authentication);

$plug = new \HiveSDK\Device\SmartPlug($id, $client);
$plug->$method();