<?php
class Prr_Api_Fields {
    function register() {
        // Add ajax to return products from search
        add_action("wp_ajax_search_product_search_post_prr", [$this,"search_product_search_post_prr_callback"]);
    }
    
    // search the products
    function search_product_search_post_prr_callback() {
        $return = [];
        $products = array();
        $value = $_REQUEST["value"]; // get the keyword from search
       
        // store all ids by keyword search
        $product_ids = wc_get_products( array( 
            'return' => 'ids', 'limit' => -1,
            's' => $value
        ) );
        foreach ( $product_ids as $product_id ) {
            $product = wc_get_product( $product_id ); // get the product

            if ( is_object( $product ) ) { // validate the product
                $title = wp_kses_post( $product->get_formatted_name() ); // get Title
                
                // store the product in the $products
                $products[] = array(
                    "title" => $title,
                    "id" => $product_id
                );
            }
        }

        // return the products
        echo json_encode($products, JSON_UNESCAPED_UNICODE);
        die;
    }
}
