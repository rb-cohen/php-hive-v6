<?php

require(__DIR__ . '/../vendor/autoload.php');
$authentication = require(__DIR__ . '/_buildAuthentication.php');

if(class_exists('Zend\Text\Table\Table') === false){
    echo 'To run this script please install dev dependencies with:' . PHP_EOL . '$ composer install --dev' . PHP_EOL;
    exit(1);
}

$client = new \HiveSDK\API\Client($authentication);

$deviceList = new \HiveSDK\Devices($client);
$devices = $deviceList->all();

$table = new Zend\Text\Table\Table(array('columnWidths' => array(36, 20, 50)));
$table->appendRow(['ID', 'Name', 'NodeType']);

foreach($devices as $device){
    $table->appendRow([
        $device->id,
        (($device->name === $device->nodeType)? 'n/a' : $device->name),
        cleanNodeType($device->nodeType),
    ]);
}

echo $table;


function cleanNodeType($type){
    $type = str_replace('http://alertme.com/schema/json/node.class.', '', $type);
    $type = preg_replace('/.json#?$/', '', $type);
    return $type;
}