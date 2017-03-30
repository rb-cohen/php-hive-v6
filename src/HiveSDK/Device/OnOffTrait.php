<?php

namespace HiveSDK\Device;

trait OnOffTrait {

    public function on(){
        $this->getWorkUnit()->set('attributes/state/targetValue', 'ON');
        return $this;
    }

    public function off(){
        $this->getWorkUnit()->set('attributes/state/targetValue', 'OFF');
        return $this;
    }

}