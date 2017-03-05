<?php

namespace HiveSDK\Device;

trait OnOffTrait {

    public function on(){
        $this->client->put('/nodes/' . $this->id, [
            'nodes' => [
                [
                    "attributes" => [
                        "state" => [
                            "targetValue" => "ON"
                        ]
                    ]
                ]
            ]
        ]);
    }

    public function off(){
        $this->client->put('/nodes/' . $this->id, [
            'nodes' => [
                [
                    "attributes" => [
                        "state" => [
                            "targetValue" => "OFF"
                        ]
                    ]
                ]
            ]
        ]);
    }

}