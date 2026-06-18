<?php
/**
 * Dashtzad theme bootstrap.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

define( 'DZ_VERSION', '1.0.0' );
define( 'DZ_DIR', get_template_directory() );
define( 'DZ_URI', get_template_directory_uri() );

/**
 * Load a theme include file if it exists.
 *
 * @param string $relative Path relative to the theme root.
 */
function dz_require( $relative ) {
	$path = DZ_DIR . '/' . ltrim( $relative, '/' );
	if ( file_exists( $path ) ) {
		require_once $path;
	}
}

dz_require( 'inc/setup.php' );
dz_require( 'inc/enqueue.php' );
dz_require( 'inc/helpers.php' );
dz_require( 'inc/icons.php' );
dz_require( 'inc/template-tags.php' );

/* WooCommerce-specific includes are loaded only when WooCommerce is active. */
if ( class_exists( 'WooCommerce' ) ) {
	dz_require( 'inc/woocommerce.php' );
	dz_require( 'inc/product-state-resolver.php' );
	if ( is_admin() ) {
		dz_require( 'inc/product-admin-fields.php' );
	}
}
