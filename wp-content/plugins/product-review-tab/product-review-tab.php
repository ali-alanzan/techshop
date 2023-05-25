<?php
/*
Plugin Name: Product Review
Plugin URI: http://techshop.local
Description: Add tab to product single tab 
Version: 1.0.0
Author: Ali Alanzan
Author URI: http://techshop.local
Text Domain: techshop
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


// Add new tab filter
add_filter( 'woocommerce_product_tabs', 'single_product_review_new_product_tab' );
function single_product_review_new_product_tab( $tabs ) { 
    if(post_type_exists("product_review")):
        $tabs['new_tab'] = array(
            'title' 	=> __( 'Product Reviews', 'woocommerce' ),
            'priority' 	=> 50,
            'callback' 	=> 'woo_new_product_tab_content' 
        );
        return $tabs; 
    endif;
}




 // The new tab content callback
function woo_new_product_tab_content() {
    $id = get_the_ID();
    // Get all product reviews
    $reviews = new WP_Query(array(
        "post_type" => "product_review",
        "posts_per_page" => -1,
        "meta_key" => "product_product_review",
        "meta_value" => $id
    ));

    $reviews_rating = [];
    $reviews_items = [];

    // check if there is any reviws
    if($reviews->have_posts()):
    include_once "./styles.php";
        ?>
<h1>Rating <span class='rating-render'></span></h1> <!-- Tab rating title -->
<div class='prd-rvs-reviews'> <!-- Tab rating container -->

        <?php
        // start loop of reviews
        $x=0;
        while($reviews->have_posts()):
            $reviews->the_post(); 
            // store rating
            $rating = get_post_meta(get_the_ID(),"rating_product_review", true);
            $reviews_rating[] = $rating;

            // content
            $content = strip_tags(get_the_content(get_the_ID()));
            
            // show only last 3 by default
            if( $x < 3 ):
                ?>
                <!-- Product review title -->
                <h3 class="title"> <?php   the_title(); ?> </h3>
               
                <?php
                // <!-- Box content -->
                    echo '<div class="prd-rvs-review">';
                    $author = get_post_meta(get_the_ID(),"product_review_author", true);
                    $author = empty($author) ? get_the_author() : $author;
                ?>
                <!-- content -->
                    <p class="content"> <?php  echo  $content; ?> </p> 
                <!-- rating -->
                    <p class="rating">   <?php echo $rating; ?>/5 </p>
                <!-- author -->
                    <p class="author">  By <?php echo $author; ?>  </p>
                <?php
               echo "</div>"; 
                //<!-- Box content end -->
            endif;
            $x++;
        endwhile;
        wp_reset_postdata();
        // end while
        $reviews_rating_sum = array_sum($reviews_rating); // sum all ratings
        $reviews_rating_count  = count($reviews_rating); // count all reviews
        
        // result for all reviews
        $result_percentage  = $reviews_rating_sum / $reviews_rating_count;

?>
</div> <!-- Tab reviews container -->

<script>jQuery('.rating-render').text('<?= round($result_percentage, PHP_ROUND_HALF_DOWN) ?>')</script>
<?php
    endif;

  // The new tab content goes here.. 
}