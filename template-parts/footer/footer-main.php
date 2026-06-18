<?php
/**
 * Store footer (footer-main): link columns, trust badge, copyright bar.
 *
 * Loaded by footer.php for store views. Bespoke rules in
 * assets/css/src/04-sections/footer-main.css.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<footer class="dz-footer-main bg-surface-warm border-t border-hair">
	<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(3.6rem,5vw,5.6rem)]">
		<?php
		get_template_part( 'template-parts/footer/footer-links', null, array( 'context' => 'main' ) );
		get_template_part( 'template-parts/footer/footer-trust' );
		?>
	</div>
	<div class="bg-ink">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[1.6rem] flex flex-col items-center text-center gap-[.5rem] text-[1.25rem] text-hair-strong">
			<span><?php esc_html_e( '© تمامی حقوق برای این فروشگاه محفوظ است · ۱۳۹۷–۱۴۰۵', 'dashtzad' ); ?></span>
			<span class="text-hair-strong/70"><?php esc_html_e( 'دشت‌زاد کشت و تجارت ایرانیان', 'dashtzad' ); ?></span>
		</div>
	</div>
</footer>
