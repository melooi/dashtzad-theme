<?php
/**
 * Header bootstrap.
 *
 * Owns the document shell (<head>, body open, skip link), then decides which
 * header chrome to load and opens #dz-content. The actual markup lives in
 * template-parts/header/*. Routing only:
 *   store views (home, shop, product, product cat, cart, checkout) → header-main
 *   blog views  (posts, blog archive/category/tag/author, blog search) → header-blog
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-paper text-ink font-sans' ); ?>>
<?php wp_body_open(); ?>

<a class="sr-only focus:not-sr-only" href="#dz-content"><?php esc_html_e( 'پرش به محتوا', 'dashtzad' ); ?></a>

<?php
if ( dz_is_blog_context() ) {
	// هدر یکسان با فروشگاه؛ فقط منوها بلاگ و آیکن فروشگاه به‌جای سبد.
	get_template_part(
		'template-parts/header/header-main',
		null,
		array(
			'context'  => 'blog',
			'commerce' => 'shop',
		)
	);
} else {
	get_template_part( 'template-parts/header/header-main' );
}
?>

<div id="dz-content">
