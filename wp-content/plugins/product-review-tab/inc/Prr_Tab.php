<?php
class Prr_Tab {
    function register() {
        // Add single tab to product tab
        add_filter( 'woocommerce_product_tabs', [$this, 'single_product_review_new_product_tab'] );
    }

    // Filter single tab callback
    function single_product_review_new_product_tab() {
        if(post_type_exists("product_review")): // Add tab if post type registered
            $tabs['new_tab'] = array(
                'title' 	=> __( 'Product Reviews', 'woocommerce' ),
                'priority' 	=> 50,
                'callback' 	=> [$this, 'woo_new_product_tab_content'] 
            );
            return $tabs; 
        endif;
    }



    // The new tab content callback
    function woo_new_product_tab_content() {
            $id = get_the_ID();

            // Get all product reviews by Visited Product
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
                ?>
        <style>
            .prd-rvs-reviews .title {
                margin-bottom: 10px;
                border-bottom: 1px solid #777;
                padding-top: 15px;
            }
        </style>
        <h3>Avarage Rating: <span class='rating-render'></span></h3> <!-- Tab rating title -->
        <div class='prd-rvs-reviews'> <!-- Tab rating container -->

                <?php
                // start loop of reviews
                $x=0;
                while($reviews->have_posts()):
                    $reviews->the_post(); 
                    // store rating
                    $reviews_rating[] = $rating;

                    // meta field
                    $rating = get_post_meta(get_the_ID(),"rating_product_review", true);
                    $content = strip_tags(get_the_content(get_the_ID()));
                    $author = get_post_meta(get_the_ID(),"product_review_author", true);
                    $author = empty($author) ? get_the_author() : $author;
                    $meta_fields = array(
                        "rating" => $rating,
                        "content" => $content,
                        "author" => $author,
                    );
                    // show only last 3 by default
                    if( $x < 3 ) {
                        ?>
                        <h3 class="title"> <?php   the_title(); ?> </h3>
                        <!-- content -->
                        <p class="content"> <?php  echo  $content; ?> </p> 

                            <!-- author -->
                            <p class="author">  By <?php echo $author; ?> Review <b><?php echo $rating; ?>/5</b> </p>
                        <?php

                    } else {
                        $reviews_items[] = $meta_fields;
                    }
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


        <!-- Append the rate to the span element in the Heading of the Tab -->
        <script>
            var rresult_pre = `<?= $result_percentage ?>`;
            jQuery('.rating-render').text(rresult_pre.substring(0, rresult_pre.indexOf('.')+2));
        </script>   

        <?php
            endif;

        // The new tab content goes here.. 
        }
}