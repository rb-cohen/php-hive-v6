<?php

namespace HiveSDK\Device;

class Bulb extends AbstractDevice {

    use OnOffTrait;

    public function setBrightness($brightness){
        $this->getWorkUnit()->set('attributes/brightness/targetValue', (int) $brightness);
        return $this;
    }

}