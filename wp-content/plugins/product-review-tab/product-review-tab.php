<?php
/*
Plugin Name: Product Review Tab
Plugin URI: http://techshop.local
Description: Create Product Review post type, Create metabox, Add tab to product single page 
Version: 1.0.0
Author: Ali Alanzan
Author URI: http://techshop.local
Text Domain: techshop

P.S: Prr or prr is the prefix of Product of the product review
*/
if(!defined('ABSPATH')){
 exit;
}



/**
 * The code that runs during plugin activation
 */
function activate_product_review_plugin()
{

    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'activate_product_review_plugin' );
/**
 * The code that runs during plugin deactivation
 */
function deactivate_product_review_plugin()
{
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'deactivate_product_review_plugin' );


/**
 * Auto load services
*/

// services
// Service is name of file starts with Prr_ as prefix
// Location:    ./inc/
$prr_files = [
    'Init', // Register post type
    'Fields', // Add meta fields
    'Api_Fields', // Api search & select product
    'scripts', // Load styles & scripts
    'Tab', // Add Tab to Product
];

// check for plugin using plugin name
if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))):

    // Autoload the services
    foreach($prr_files as $file) {
        $className = "Prr_".$file; // prepare the class name
        include_once "inc/{$className}.php"; // include file name

        $class = new $className(); // init the class
        $class->register(); // call the register method to apply the class
    }

endif;