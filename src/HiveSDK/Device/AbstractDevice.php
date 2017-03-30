<?php

namespace HiveSDK\Device;

use HiveSDK\API\Client;
use HiveSDK\API\WorkUnit\Body;

abstract class AbstractDevice{

    /**
     * @var string
     */
    public $id;
    /**
     * @var Client
     */
    public $client;

    /**
     * @var Body
     */
    protected $workUnit;

    public function __construct($id, Client $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    public function apply(){
        if($this->getWorkUnit()->hasChanges()) {
            $data = $this->getWorkUnit()->read();
            return $this->client->put('/nodes/' . $this->id, [
                'nodes' => [ $data ]
            ]);
        }

        return null;
    }

    public function getWorkUnit(){
        if(null === $this->workUnit){
            $this->workUnit = new Body();
        }

        return $this->workUnit;
    }

}