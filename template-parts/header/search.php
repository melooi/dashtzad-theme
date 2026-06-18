<?php
/**
 * Shared header search form.
 *
 * Options via get_template_part()'s $args:
 *   placeholder string  Input placeholder.
 *   action      string  Form action URL. Default home.
 *   post_type   string  Restrict results to a post type ('' = all). e.g. 'post' for the blog.
 *   class       string  Form wrapper utility classes.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_search = wp_parse_args(
	( isset( $args ) && is_array( $args ) ) ? $args : array(),
	array(
		'placeholder' => __( 'جستجو در فروشگاه دشت‌زاد…', 'dashtzad' ),
		'action'      => home_url( '/' ),
		'post_type'   => '',
		'class'       => 'hidden md:flex items-center gap-[1rem] flex-1 bg-white border-[1.5px] border-hair-strong rounded-md px-[1.6rem] py-[1.15rem] focus-within:border-green transition-colors',
	)
);
?>
<form class="<?php echo esc_attr( $dz_search['class'] ); ?>" role="search" method="get" action="<?php echo esc_url( $dz_search['action'] ); ?>">
	<i class="fa-solid fa-magnifying-glass text-ink-faint"></i>
	<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" data-rotate-ph placeholder="<?php echo esc_attr( $dz_search['placeholder'] ); ?>" aria-label="<?php esc_attr_e( 'جستجو', 'dashtzad' ); ?>" class="flex-1 text-[1.4rem] text-ink bg-transparent border-none outline-none min-w-0 placeholder:text-ink-faint" />
	<?php if ( '' !== $dz_search['post_type'] ) : ?>
		<input type="hidden" name="post_type" value="<?php echo esc_attr( $dz_search['post_type'] ); ?>" />
	<?php endif; ?>
</form>
