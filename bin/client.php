<?php

require(__DIR__ . '/../vendor/autoload.php');
$authentication = require(__DIR__ . '/_buildAuthentication.php');

$method = 'get';
$path = null;
$payload = null;

$arguments = $argv;
array_shift($arguments);

while($key = array_shift($arguments)){
    switch($key){
        case '--path':
            $path = array_shift($arguments);
            break;
        case '--method':
            $method = array_shift($arguments);
            break;
        case '--payload':
            $payload = array_shift($arguments);
            break;
    }
}

if(empty($path)){
    throw new \InvalidArgumentException('--path is required');
}

$client = new \HiveSDK\API\Client($authentication);
$response = $client->$method($path, $payload);

echo json_encode($response->body, JSON_PRETTY_PRINT);