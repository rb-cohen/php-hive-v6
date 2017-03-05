<?php

namespace HiveSDK\Util;

class Colour{

    public function auto($colour){
        if(preg_match('/rgb\(([0-9\s]+),([0-9\s]+),([0-9\s]+)\)/', $colour, $matches)){
            return $this->rgbToHsv($matches[1], $matches[2], $matches[3]);
        }

        if(preg_match('/#?([0-9a-f]{6})/', $colour, $matches)){
            $hex = $matches[1];
            list($r, $g, $b) = $this->hexToRgb($hex);
            return $this->rgbToHsv($r, $g, $b);
        }

        if($matches = preg_match('/([0-9]+),([0-9]+),([0-9]+)/', $colour)){
            return explode(',', $colour);
        }
    }

    public function hexToRgb($hex){
        if(strpos($hex, '#') !== 0){
            $hex = '#' . $hex;
        }

        return sscanf($hex, "#%02x%02x%02x");
    }

    public function rgbToHsv($r, $g, $b){
        $r = $r / 255;
        $g = $g / 255;
        $b = $b / 255;

        $v = max($r, $g, $b);
        $diff = $v - min($r, $g, $b);

        $diffc = function($c) use ($v, $diff) {
            return ($v - $c) / 6 / $diff + 1 / 2;
        };

        if($diff == 0){
            $h = $s = 0;
        }else{
            $s = $diff / $v;
            $rr = $diffc($r);
            $gg = $diffc($g);
            $bb = $diffc($b);

            if($r === $v){
                $h = $bb - $gg;
            }else if($g === $v){
                $h = (1 / 3) + $rr - $bb;
            }else if($b === $v){
                $h = (2 / 3) + $gg - $rr;
            }

            if($h < 0){
                $h += 1;
            }else if($h > 1){
                $h -= 1;
            }
        }

        return [ round($h * 360), round($s * 100), round($v * 100) ];
    }

}