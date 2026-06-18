<?php
/**
 * Enqueue compiled theme assets.
 *
 * Styles  → assets/css/tailwind.css  (built locally via: npm run build)
 *           Tailwind v4 is compiled to a static file inside the theme.
 *           No CDN, no browser build, no fallback — the local file is the
 *           single source of styles. Run `npm install && npm run build`
 *           before going live so tailwind.css exists.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'wp_enqueue_scripts', 'dz_enqueue_assets' );
/**
 * Front-end styles & scripts.
 */
function dz_enqueue_assets() {
	// Compiled Tailwind (local build). The only stylesheet — no CDN.
	$tailwind_css = DZ_DIR . '/assets/css/tailwind.css';
	$css_ver      = file_exists( $tailwind_css ) ? (string) filemtime( $tailwind_css ) : DZ_VERSION;
	wp_enqueue_style(
		'dashtzad-tailwind',
		DZ_URI . '/assets/css/tailwind.css',
		array(),
		$css_ver
	);

	// Icons (Font Awesome) via jsDelivr — reachable in Iran where cdnjs is often blocked.
	// For full offline/independence, self-host: download FA into assets/vendor/fontawesome/ and point here.
	wp_enqueue_style( 'font-awesome', 'https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css', array(), '6.5.2' );

	// Theme JS (interactions).
	$app_js = DZ_DIR . '/assets/js/app.js';
	$jsver  = file_exists( $app_js ) ? (string) filemtime( $app_js ) : DZ_VERSION;
	wp_enqueue_script( 'dashtzad-app', DZ_URI . '/assets/js/app.js', array(), $jsver, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_filter( 'language_attributes', 'dz_force_rtl_lang' );
/**
 * Guarantee dir="rtl" on the html element.
 *
 * @param string $output Existing attributes.
 * @return string
 */
function dz_force_rtl_lang( $output ) {
	if ( false === strpos( $output, 'dir=' ) ) {
		$output .= ' dir="rtl"';
	}
	return $output;
}
