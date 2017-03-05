<?php

namespace HiveSDK\Device;

use HiveSDK\Util\Colour;

class BulbColour extends BulbWhite {

    public function setColour($colour){
        $helper = new Colour();
        $hsv = $helper->auto($colour);

        $this->client->put('/nodes/' . $this->id, [
            'nodes' => [
                [
                    "attributes" => [
                        "hsvHue" => [
                            "targetValue" => $hsv[0]
                        ],
                        "hsvSaturation" => [
                            "targetValue" => $hsv[1]
                        ],
                        "hsvValue" => [
                            "targetValue" => $hsv[2]
                        ],
                        "colourMode" => [
                            "targetValue" => "COLOUR"
                        ]
                    ]
                ]
            ]
        ]);
    }

}