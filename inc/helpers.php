<?php
/**
 * Display helpers: Persian digits, Jalali dates, price/toman, sanitizers.
 *
 * Storage/calculation stays in English digits & Gregorian/ISO.
 * Persian digits and Jalali are applied at the DISPLAY layer only.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Convert English digits in a string to Persian digits (display only).
 *
 * @param string|int $value Value to convert.
 * @return string
 */
function dz_fa_digits( $value ) {
	$en = array( '0', '1', '2', '3', '4', '5', '6', '7', '8', '9' );
	$fa = array( '۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹' );
	return str_replace( $en, $fa, (string) $value );
}

/**
 * Format a number with thousands separators and Persian digits.
 *
 * @param int|float $number Raw number (English digits).
 * @return string
 */
function dz_format_number_fa( $number ) {
	$formatted = number_format( (float) $number, 0, '.', '٬' );
	return dz_fa_digits( $formatted );
}

/**
 * Format a Toman price for display. Calculation stays upstream (WooCommerce).
 *
 * @param int|float $amount Amount in Toman.
 * @return string Safe HTML.
 */
function dz_toman( $amount ) {
	return '<span class="inline-flex items-baseline gap-[.4rem] font-display font-bold text-ink num">'
		. esc_html( dz_format_number_fa( $amount ) )
		. ' <span class="text-[1.15rem] text-ink-faint font-semibold">' . esc_html__( 'تومان', 'dashtzad' ) . '</span></span>';
}

/**
 * Gregorian → Jalali conversion (display only).
 *
 * @param int $gy Gregorian year.
 * @param int $gm Gregorian month.
 * @param int $gd Gregorian day.
 * @return array{0:int,1:int,2:int} [jy, jm, jd]
 */
function dz_gregorian_to_jalali( $gy, $gm, $gd ) {
	$g_d_m = array( 0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334 );
	$gy2   = ( $gm > 2 ) ? ( $gy + 1 ) : $gy;
	$days  = 355666 + ( 365 * $gy ) + intdiv( $gy2 + 3, 4 ) - intdiv( $gy2 + 99, 100 )
		+ intdiv( $gy2 + 399, 400 ) + $gd + $g_d_m[ $gm - 1 ];
	$jy    = -1595 + ( 33 * intdiv( $days, 12053 ) );
	$days %= 12053;
	$jy   += 4 * intdiv( $days, 1461 );
	$days %= 1461;
	if ( $days > 365 ) {
		$jy   += intdiv( $days - 1, 365 );
		$days  = ( $days - 1 ) % 365;
	}
	if ( $days < 186 ) {
		$jm = 1 + intdiv( $days, 31 );
		$jd = 1 + ( $days % 31 );
	} else {
		$jm = 7 + intdiv( $days - 186, 30 );
		$jd = 1 + ( ( $days - 186 ) % 30 );
	}
	return array( $jy, $jm, $jd );
}

/**
 * Format a timestamp as a Jalali date string (display only).
 *
 * Supported format tokens: Y (year), m (2-digit month), n (month), d (2-digit day),
 * j (day), F (Persian month name).
 *
 * @param int    $timestamp Unix timestamp (defaults to now).
 * @param string $format    Output format.
 * @return string
 */
function dz_format_jalali_date( $timestamp = null, $format = 'j F Y' ) {
	$timestamp = $timestamp ? (int) $timestamp : current_time( 'timestamp' );
	$gy        = (int) wp_date( 'Y', $timestamp );
	$gm        = (int) wp_date( 'n', $timestamp );
	$gd        = (int) wp_date( 'j', $timestamp );

	list( $jy, $jm, $jd ) = dz_gregorian_to_jalali( $gy, $gm, $gd );

	$months = array( '', 'فروردین', 'اردیبهشت', 'خرداد', 'تیر', 'مرداد', 'شهریور', 'مهر', 'آبان', 'آذر', 'دی', 'بهمن', 'اسفند' );

	$replacements = array(
		'Y' => $jy,
		'm' => str_pad( $jm, 2, '0', STR_PAD_LEFT ),
		'n' => $jm,
		'd' => str_pad( $jd, 2, '0', STR_PAD_LEFT ),
		'j' => $jd,
		'F' => $months[ $jm ],
	);

	$out = strtr( $format, $replacements );
	return dz_fa_digits( $out );
}

/**
 * Normalize Persian search input (Arabic → Persian letters).
 *
 * @param string $text Raw text.
 * @return string
 */
function dz_normalize_fa( $text ) {
	return strtr( (string) $text, array( 'ي' => 'ی', 'ك' => 'ک' ) );
}

/**
 * Decide whether the current view belongs to the blog / magazine.
 *
 * Store chrome (header-main / footer-main): front page, shop, product,
 * product category, cart, checkout — i.e. everything that is NOT a blog view.
 * Blog chrome (header-blog / footer-blog): posts index, single post, post
 * category, tag, author, date archive and blog search.
 *
 * @return bool True when the blog header/footer should be loaded.
 */
function dz_is_blog_context() {
	// The static front page always uses the store chrome, even if it lists posts.
	if ( is_front_page() ) {
		return false;
	}

	return (
		is_home()             // Posts index (blog archive).
		|| is_singular( 'post' ) // Single blog post.
		|| is_category()
		|| is_tag()
		|| is_author()
		|| is_date()
		|| is_search()        // Search results read as a blog/magazine view.
	);
}
