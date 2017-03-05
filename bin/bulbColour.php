<?php

require(__DIR__ . '/../vendor/autoload.php');
$authentication = require(__DIR__ . '/_buildAuthentication.php');

$id = null;
$brightness = null;
$on = false;
$off = false;

$arguments = $argv;
array_shift($arguments);

while($key = array_shift($arguments)){
    switch($key){
        case '--id':
            $id = array_shift($arguments);
            break;
        case '--brightness':
            $brightness = array_shift($arguments);
            break;
        case '--colour':
        case '--color':
            $colour = array_shift($arguments);
            break;
        case '--on':
            $on = true;
            break;
        case '--off':
            $off = true;
            break;
    }
}

$client = new \HiveSDK\API\Client($authentication);

$bulb = new \HiveSDK\Device\BulbColour($id, $client);

if($brightness !== null){
    $bulb->setBrightness($brightness);
}

if($colour !== null){
    $bulb->setColour($colour);
}

if($on){
    $bulb->on();
}

if($off){
    $bulb->off();
}