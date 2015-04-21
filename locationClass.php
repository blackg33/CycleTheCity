<?php

Class latlng{
    
    public $lat;
    public $long;
    
    public function __contruct($lat, $long){
        $this->lat = $lat;
        $this->long = $long;
    }
}