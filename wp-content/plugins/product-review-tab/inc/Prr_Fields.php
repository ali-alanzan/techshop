<?php
// rating_product_review
// product_product_review
// product_review_author
class Prr_Fields {
    function register() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
		add_action( 'save_post',      array( $this, 'save'         ) );
    }

    function add_meta_box() {
		// Limit meta box to certain post types.
        add_meta_box(
            'product_review_fields',
            __( 'Product review fields', 'techshop' ),
            array( $this, 'render_meta_box_content' ),
            $post_type,
            'advanced',
            'high'
        );
    }

	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
    function render_meta_box_content() {


		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'product_review_metabox', 'product_review_metabox_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$rating = get_post_meta(  get_the_ID(), 'rating_product_review', true );
		$product = get_post_meta( get_the_ID(), 'product_product_review', true );
		$author = get_post_meta(  get_the_ID(), 'product_review_author', true );
        $product_title = is_numeric($product) ? get_the_title($product) : "";
		// Display the form, using the current value.
?>
        <style>
            .group-field {
                width: 100%;
                padding: 20px 0;
            }
            .group-field > label{
                width:80px; 
                display:inline-block;
            }
            .group-field > input {
                width:200px; 
            }
            #reset-product-prr {
                color: #f00;
                font-size: 22px;
                margin: 5px 3px;
                cursor: pointer;
            }
            .search_product-container {
                width: 100%;
                margin: 10px 10px;
                display: table;
            }
            .search_product-container label{
                width: auto;
                margin: 8px 10px;
                background-color: #ddd;
                padding: 4px 8px;
            }

        </style>
		<div class="group-field">
            <label for="rating_product_review">
                <?php _e( 'Rating', 'techshop' ); ?>
            </label>
            <input type="number" min="1" step="1" max="5" id="rating_product_review" name="rating_product_review" value="<?php echo esc_attr( $rating ); ?>" />
        </div>

        <?php
    global $post, $woocommerce;

    $product_ids = wc_get_products( array( 'return' => 'ids', 'limit' => -1 ) );
    if( empty($product_ids) )
        $product_ids = array();
    ?>
    <div class="group-field">
        <?php if ( $woocommerce->version >= '3.0' ) : ?>
            <label for="products-products-review">
                <?php _e( 'Product', 'woocommerce' ); ?>
            </label>
            
            <input type="hidden" value="<?= admin_url("admin-ajax.php") ?>" id="search_product-ajax">
            <input type="text" name="search_product" id="search_product" value="<?= $product_title; ?>">
            <div class="search_product-container">
                <?php 
                    if(!empty($product_title)):
                        echo '
                        <label>
                            <input type="radio" name="product_product_review" value="'.$product.'" checked/>
                            '.$product_title.'
                        </label>
                        ';
                    endif;
                ?>
            </div>
            <!-- <input list="products-products-review" name="product_product_review" id="products-products-input"> -->
            <!-- <datalist id="products-products-review"> -->
                <?php
                    // foreach ( $product_ids as $product_id ) {
                    //     $product = wc_get_product( $product_id );
                    //     if ( is_object( $product ) ) {
                    //         echo '<option value="'.wp_kses_post( $product->get_formatted_name() ).'" data-id="'.$product_id.'">';
                    //     }
                    // }
                ?>
            <!-- </datalist> -->
            <!-- <a id="reset-product-prr">x</a> -->
        <?php endif; ?>
    </div>
    <?php
        ?>
		<div class="group-field">
            <label for="product_review_author">
                <?php _e( 'Author', 'techshop' ); ?>
            </label>
            <input type="text" id="product_review_author" name="product_review_author" value="<?php echo esc_attr( $author ); ?>" />
        </div>
<?php
    }

	/**
	 * Save the meta when the post is saved.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	public function save( $post_id ) {

		/*
		 * We need to verify this came from the our screen and with proper authorization,
		 * because save_post can be triggered at other times.
		 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['product_review_metabox_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['product_review_metabox_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'product_review_metabox' ) ) {
			return $post_id;
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/* OK, it's safe for us to save the data now. */

		// Sanitize the user input.
		$rating = sanitize_text_field( $_POST['rating_product_review'] );
		$product = sanitize_text_field( $_POST['product_product_review'] );
		$author = sanitize_text_field( $_POST['product_review_author'] );

		// Update the meta field.
		update_post_meta( $post_id, 'rating_product_review', $rating );
		update_post_meta( $post_id, 'product_product_review', $product );
		update_post_meta( $post_id, 'product_review_author', $author );
        
	}

}