<?php
/**
 * SVG icon helper (sprite-based).
 *
 * Icons live in /assets/icons/sprite.svg as <symbol id="icon-NAME">.
 * Colors inherit from `currentColor`, so set `color` via any utility/class.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // No direct access.
}

/**
 * List of icon names currently available in the sprite.
 * Keep in sync with assets/icons/sprite.svg. Filterable for extensions.
 *
 * @return string[]
 */
function dz_icon_set() {
	$icons = array(
		'user',
		'user-circle',
		'heart',
		'star',
		'lightbulb',
		'folder-open',
		'circle-play',
		'close',
		'instagram',
		'telegram',
		'whatsapp',
	);

	return apply_filters( 'dz_icon_set', $icons );
}

/**
 * Build the markup for a sprite icon.
 *
 * @param string $name  Icon name without the `icon-` prefix (e.g. "user", "cart").
 * @param string $class Extra CSS classes for the <svg>.
 * @return string SVG markup, or '' (with a debug comment) when the icon is unknown.
 */
function dz_get_icon( $name, $class = '' ) {
	$name = sanitize_title( $name );

	if ( ! in_array( $name, dz_icon_set(), true ) ) {
		// Unknown icon: fail safely, surface a hint only while debugging.
		return ( defined( 'WP_DEBUG' ) && WP_DEBUG )
			? '<!-- dz_icon: unknown icon "' . esc_html( $name ) . '" -->'
			: '';
	}

	$sprite  = DZ_URI . '/assets/icons/sprite.svg?v=' . DZ_VERSION;
	$classes = trim( 'dz-icon dz-icon--' . $name . ' ' . $class );
	$href    = esc_url( $sprite ) . '#icon-' . $name;

	return sprintf(
		'<svg class="%1$s" role="img" aria-hidden="true" focusable="false" style="width:1em;height:1em;fill:currentColor;display:inline-block;vertical-align:-0.125em"><use href="%2$s" xlink:href="%2$s"></use></svg>',
		esc_attr( $classes ),
		$href
	);
}

/**
 * Echo a sprite icon.
 *
 * @param string $name  Icon name without the `icon-` prefix.
 * @param string $class Extra CSS classes for the <svg>.
 */
function dz_icon( $name, $class = '' ) {
	// Output is fully escaped inside dz_get_icon().
	echo dz_get_icon( $name, $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}
