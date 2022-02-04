<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Relevanssi Related Posts for Kadence's Post Grid/Carousel
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Makes Kadence's Post Grid/Carousel output related posts according to Relevanssi Pro if `Select Posts By` is `Individually` and `Select Posts` are empty.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */


defined( 'ABSPATH' ) || die;

add_filter( 'render_block_data', function ( $parsed_block ) {
	if ( 'kadence/postgrid' == $parsed_block['blockName'] &&
	     'individual' == $parsed_block['attrs']['queryType'] &&
	     empty( $parsed_block['attrs']['postIds'] ) &&
	     function_exists( 'relevanssi_get_related_post_ids' ) ) {
		global $post;
		$parsed_block['attrs']['postIds'] = relevanssi_get_related_post_ids( $post->ID );
	}
	return $parsed_block;
}, 10 );
