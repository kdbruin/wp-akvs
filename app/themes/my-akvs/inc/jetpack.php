<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package My AKV Soesterkwartier
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function my_akvs_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );
}
add_action( 'after_setup_theme', 'my_akvs_jetpack_setup' );
