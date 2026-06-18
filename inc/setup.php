<?php
/**
 * Theme setup: supports, menus, image sizes, i18n.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'after_setup_theme', 'dz_setup' );
/**
 * Register theme supports and menus.
 */
function dz_setup() {
	load_theme_textdomain( 'dashtzad', DZ_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
	) );

	// WooCommerce.
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary' => __( 'منوی اصلی', 'dashtzad' ),
		'footer'  => __( 'منوی فوتر', 'dashtzad' ),
	) );

	// Content image sizes.
	add_image_size( 'dz-card', 640, 640, true );
	add_image_size( 'dz-hero', 1920, 1080, true );
}

add_action( 'init', 'dz_content_width', 0 );
/**
 * Set the editor/content width.
 */
function dz_content_width() {
	$GLOBALS['content_width'] = 1240;
}
