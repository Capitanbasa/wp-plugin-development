<?php
/**
 * @package HercivalPLugin
 */ 

 class hercivalPluginDeactivation{
     public static function deactivate(){
        flush_rewrite_rules();
     }
 }