<?php

$sessionId = null;
$username = null;
$password = null;

$arguments = $argv;
array_shift($arguments);

while($key = array_shift($arguments)){
    switch($key){
        case '--sessionId':
            $sessionId = array_shift($arguments);
            break;
        case '--username':
            $username = array_shift($arguments);
            break;
        case '--password':
            $password = array_shift($arguments);
            break;
    }
}

if($sessionId){
    $authentication = new \HiveSDK\API\Authentication\SessionId($sessionId);
}elseif($username || $password){
    $authentication = new \HiveSDK\API\Authentication\Credentials($username, $password);
}else{
    $authentication = new \HiveSDK\API\Authentication\NoAuth();
}

return $authentication;