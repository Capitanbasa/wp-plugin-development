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

if( !class_exists('hercivalPlugin')){
    class hercivalPlugin{
        public $hercivalPluginName;

        function __construct(){
            $this->hercivalPluginName =  plugin_basename(__FILE__);
        }

        function register(){
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue'));
            add_action( 'admin_menu', array( $this, 'add_admin_page') );
            add_filter("plugin_action_links_$this->hercivalPluginName" ,array($this, 'settings_link') );
        }

        public function settings_link($links){
            $setting_link = '<a href="admin.php?page=hercival_plugin">Settings</a>';
            array_push($links, $setting_link);
            return $links;
        }
        public function add_admin_page(){
            add_menu_page('Hercival Plugin', 'Hercival', 'manage_options', 'hercival_plugin',array($this, 'admin_index'), 'dashicons-store', 110);

        }
        public function admin_index(){
            require_once plugin_dir_path(__FILE__).'/template/admin.php';
        }


        function create_post_type(){
            add_action('init', array($this, 'custom_post_type') );
        }

        function activation(){
            require_once plugin_dir_path(__FILE__).'/inc/hercival-plugin-activation.php';
            $hercivalActivation = new hercivalPluginActivation();
            $hercivalActivation->activate();
        }

        function deactivation(){
            require_once plugin_dir_path(__FILE__).'/inc/hercival-plugin-deactivate.php';
            hercivalPluginDeactivation::deactivate();
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
    //plugin activation
    register_activation_hook(__FILE__, array($hercivalPlugin, 'activation' ) );

    //plugin deactivation
    register_deactivation_hook(__FILE__, array($hercivalPlugin, 'deactivation' ) );
}

