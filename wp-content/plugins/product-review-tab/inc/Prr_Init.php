<?php 
// Register post type
class Prr_Init {
    function register() {
        // Register post type with init wp core
        add_action( 'init', [$this, 'product_review_post_type_init'] );
    }

    function product_review_post_type_init() {
        // Strings
        $labels = array(
            'name'                  => __( 'Product reviews', 'techshop' ),
            'singular_name'         => __( 'Product review', 'techshop' ),
            'menu_name'             => _x( 'Product review', 'Admin Menu text', 'textdomain' ),
            'name_admin_bar'        => _x( 'Product review', 'Add New on Toolbar', 'textdomain' ),
            'add_new'               => __( 'Add New', 'textdomain' ),
            'add_new_item'          => __( 'Add New Product review', 'textdomain' ),
            'new_item'              => __( 'New Product review', 'textdomain' ),
            'edit_item'             => __( 'Edit Product review', 'textdomain' ),
            'view_item'             => __( 'View Product review', 'textdomain' ),
            'all_items'             => __( 'All Product reviews', 'textdomain' ),
            'search_items'          => __( 'Search Product reviews', 'textdomain' ),
            'parent_item_colon'     => __( 'Parent Product reviews:', 'textdomain' ),
            'not_found'             => __( 'No Product reviews found.', 'textdomain' ),
            'not_found_in_trash'    => __( 'No Product reviews found in Trash.', 'textdomain' ),
            'featured_image'        => _x( 'Product review Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
            'archives'              => _x( 'Product review archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
            'insert_into_item'      => _x( 'Insert into Product review', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Product review', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
            'filter_items_list'     => _x( 'Filter Product reviews list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
            'items_list_navigation' => _x( 'Product reviews list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
            'items_list'            => _x( 'Product reviews list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
        );

        // Arguments
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'product-review' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail'),
        );
    

        // Register post type
        $post_type = register_post_type( 'product_review', $args );

    }
}

