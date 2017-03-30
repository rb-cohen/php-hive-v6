<?php

namespace HiveSDK;

use HiveSDK\API\Client;

class Devices{

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function all(){
        return $this->client->get('/nodes')->nodes;
    }

    public function id($id){
        $response = $this->client->get('/nodes/' . $id);

        if(empty($response->nodes)){
            throw new \RuntimeException('Device not found');
        }

        if(count($response->nodes) > 1){
            throw new \RuntimeException('More than one device returned');
        }

        return $response->nodes[0];
    }

}