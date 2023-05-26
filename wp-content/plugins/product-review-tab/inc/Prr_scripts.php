<?php 
// Load initial scripts
class Prr_scripts {
	// create my own version codes
	public $js_ver  = "1.1";
	// $css_ver = "1.1";
	
    function register() {

        // Admin - Product review metabox field(s) scripts
        add_action( 'admin_enqueue_scripts', [$this, 'load_admin_scripts'] );
    }

    // Admin
    function load_admin_scripts() {
        global $post;

        if( isset($post->post_type) && $post->post_type == "product_review" && isset($_GET["action"]) && $_GET["action"] == "edit" ) {
// Javascript for Admin search products
            wp_enqueue_script( 'prr-scripts', plugins_url( '../js/admin-prr-scripts.js', __FILE__ ) );

// CSS Styles
            wp_register_style( 'admin-prr-styles', 	plugins_url( '../css/admin-prr-styles.css', 	 __FILE__ ) );
            wp_enqueue_style ( 'admin-prr-styles' );
        }
    }

}

