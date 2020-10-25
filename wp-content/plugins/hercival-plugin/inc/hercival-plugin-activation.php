<?php
/**
 * @package HercivalPLugin
 */ 

 class hercivalPluginActivation{
    function activate(){
        flush_rewrite_rules();
    }
 }