<?php
/**
 * @package HercivalPLugin
 */ 

namespace Inc;
 class Activate{
    public function activate(){
        flush_rewrite_rules();
    }
 }