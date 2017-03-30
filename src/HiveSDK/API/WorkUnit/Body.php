<?php

namespace HiveSDK\API\WorkUnit;

class Body{

    protected $data;

    public function set($path, $value){
        $parts = explode('/', $path);
        $this->data = $this->traverse($this->data, $parts, $value);
        return $this;
    }

    public function read(){
        $data = $this->data;
        $this->reset();
        return $data;
    }

    public function reset(){
        $this->reset = array();
        return $this;
    }

    public function hasChanges(){
        return !empty($this->data);
    }

    protected function traverse($cursor, $parts, $value){
        $part = array_shift($parts);

        if($part){
            $cursor[$part] = isset($cursor[$part])? $cursor[$part] : array();
            $cursor[$part] = $this->traverse($cursor[$part], $parts, $value);
            return $cursor;
        }else{
            return $value;
        }
    }

}