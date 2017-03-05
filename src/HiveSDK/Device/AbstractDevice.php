<?php

namespace HiveSDK\Device;

use HiveSDK\API\Client;

abstract class AbstractDevice{

    /**
     * @var string
     */
    public $id;
    /**
     * @var Client
     */
    public $client;

    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

}