<?php

namespace HiveSDK\Device;

use HiveSDK\Util\Colour;

class BulbColour extends BulbWhite {

    public function setColour($colour){
        $helper = new Colour();
        $hsv = $helper->auto($colour);

        $this->getWorkUnit()->set('attributes/hsvHue/targetValue', $hsv[0]);
        $this->getWorkUnit()->set('attributes/hsvSaturation/targetValue', $hsv[1]);
        $this->getWorkUnit()->set('attributes/hsvValue/targetValue', $hsv[2]);
        $this->getWorkUnit()->set('attributes/colourMode/targetValue', 'COLOUR');
    }

}