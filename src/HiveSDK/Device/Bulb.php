<?php

namespace HiveSDK\Device;

class Bulb extends AbstractDevice {

    use OnOffTrait;

    public function setBrightness($brightness){
        $this->client->put('/nodes/' . $this->id, [
            'nodes' => [
                [
                    "attributes" => [
                        "brightness" => [
                            "targetValue" => (int) $brightness
                        ]
                    ]
                ]
            ]
        ]);
    }

}