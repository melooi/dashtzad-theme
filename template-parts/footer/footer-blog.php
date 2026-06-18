<?php
/**
 * Blog / magazine footer (footer-blog): link columns + copyright bar.
 *
 * Loaded by footer.php for blog views. No trust badge (store-only). Bespoke
 * rules in assets/css/src/04-sections/footer-blog.css.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="dz-footer-blog bg-paper border-t border-hair">
	<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(3.6rem,5vw,5.6rem)]">
		<?php get_template_part( 'template-parts/footer/footer-links', null, array( 'context' => 'blog' ) ); ?>
	</div>
	<div class="bg-ink">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[1.6rem] flex flex-col sm:flex-row items-center justify-between gap-[1rem] text-[1.25rem] text-hair-strong">
			<span><?php printf( esc_html__( '© %s مجله دشت‌زاد — تمام حقوق محفوظ است.', 'dashtzad' ), esc_html( dz_format_jalali_date( null, 'Y' ) ) ); ?></span>
			<span><?php esc_html_e( 'ساخته‌شده با ریشه در زمین ایران', 'dashtzad' ); ?></span>
		</div>
	</div>
</footer>
