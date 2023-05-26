<?php

/**
 * Trigger this file on Plugin uninstall
 * @package Product Review
 */

if (!defined('WP_UNINSTALL_PLUGIN')) {
	die();
}

// Clear database stored data

$reviews = get_posts( array( 'post_type' => 'product_review', 'numberposts' => -1 ) );

foreach ($reviews as $review) {
	wp_delete_post($review->ID, true);
}


