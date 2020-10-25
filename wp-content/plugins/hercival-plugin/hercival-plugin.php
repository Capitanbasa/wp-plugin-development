<?php
/**
 * @package HercivalPLugin
 * Plugin Name: Hercival Plugin
 * Plugin URI: https://hercivalaragon.com/
 * Description: Hercival Plugin is a wordpress plugin development tutorial
 * Version: 1.0.0
 * Author: Hercival Aragon
 * Author URI: https://hercivalaragon.com/
 * License: GPLv2 or later
 * Text Domain: hercival-plugin
 */ 

//  if( ! defined('ABSPATH') ){
//      die;
//  }

defined('ABSPATH') or die('Forbidden');

class hercivalPlugin{
    function __construct(){
        add_action('init', array($this, 'custom_post_type') );
    }

    function register(){
        add_action('admin_enqueue_scripts', array( $this, 'enqueue'));
    }
    function activation(){
        $this->custom_post_type();
        flush_rewrite_rules();
    }

    function deactivation(){
        flush_rewrite_rules();
    }

    function uninstall(){

    }
    function custom_post_type(){
        register_post_type( 'book', ['public' => true, 'label' => 'Books', 'menu_icon' => 'dashicons-book'] );
    }
    function enqueue(){
        wp_enqueue_style( 'hercival-style', plugins_url('/assets/style.css', __FILE__) );
        wp_enqueue_script( 'hercival-script', plugins_url('/assets/script.js', __FILE__) );
    }

}
if( class_exists('hercivalPlugin') ){
    $hercivalPlugin = new hercivalPlugin('shit happens');
    $hercivalPlugin->register();
}

register_activation_hook(__FILE__, array($hercivalPlugin, 'activation' ) );
register_deactivation_hook(__FILE__, array($hercivalPlugin, 'deactivation' ) );

