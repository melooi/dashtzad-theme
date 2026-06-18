<?php
/**
 * Shared brand lockup (seal + site name + optional tagline).
 *
 * Used by both the store and blog headers, and by the footer columns.
 * Pass options through get_template_part()'s $args:
 *   href       string  Link target (when link=true). Default home.
 *   tagline    string  Second line under the name. '' = name only.
 *   link       bool    Wrap in <a> (header) or render <div> (footer). Default true.
 *   wrap_class string  Wrapper utility classes.
 *   seal       string  Size utilities passed to dz_brand_seal().
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_brand = wp_parse_args(
	( isset( $args ) && is_array( $args ) ) ? $args : array(),
	array(
		'href'       => home_url( '/' ),
		'tagline'    => '',
		'link'       => true,
		'wrap_class' => 'flex items-center gap-[1.1rem] flex-none',
		'seal'       => 'w-[4.6rem] h-[4.6rem] text-[2.3rem]',
	)
);

$dz_tag = $dz_brand['link'] ? 'a' : 'div';
?>
<<?php echo esc_html( $dz_tag ); ?> class="<?php echo esc_attr( $dz_brand['wrap_class'] ); ?>"<?php echo $dz_brand['link'] ? ' href="' . esc_url( $dz_brand['href'] ) . '"' : ''; ?>>
	<?php dz_brand_seal( $dz_brand['seal'] ); ?>
	<?php if ( '' !== $dz_brand['tagline'] ) : ?>
		<span>
			<span class="font-display font-bold text-[2.4rem] leading-none block"><?php bloginfo( 'name' ); ?></span>
			<span class="text-ink-faint text-[1.1rem] mt-[.3rem] tracking-[.02em] block"><?php echo esc_html( $dz_brand['tagline'] ); ?></span>
		</span>
	<?php else : ?>
		<span class="font-display font-bold text-[2.4rem]"><?php bloginfo( 'name' ); ?></span>
	<?php endif; ?>
</<?php echo esc_html( $dz_tag ); ?>>
