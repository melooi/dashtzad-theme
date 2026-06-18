<?php
/**
 * Template Name: در حال ساخت
 * page-soon.php — صفحه‌ی موقت «در حال ساخت» برای بخش‌هایی که هنوز آماده نشده‌اند.
 * هدر/فوتر از قالب می‌آید. این صفحه را در پیشخوان وردپرس به هر برگه‌ای که هنوز
 * آماده نیست اختصاص بده (Page Attributes → Template → «در حال ساخت»).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main data-screen-label="در حال ساخت" class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(6rem,12vw,14rem)]">
	<div class="max-w-[56rem] mx-auto text-center flex flex-col items-center">
		<?php dz_brand_seal( 'w-[7rem] h-[7rem] text-[3.4rem]' ); ?>
		<span class="inline-flex items-center gap-[.8rem] mt-[2.8rem] font-bold text-[1.3rem] tracking-[.04em] text-clay bg-clay-soft rounded-full px-[1.6rem] py-[.8rem]"><i class="fa-solid fa-screwdriver-wrench"></i> <?php esc_html_e( 'در حال ساخت', 'dashtzad' ); ?></span>
		<h1 class="font-display font-bold text-[clamp(3rem,5vw,4.6rem)] leading-[1.12] tracking-[-.02em] mt-[2rem] text-ink text-balance"><?php esc_html_e( 'این بخش به‌زودی آماده می‌شود', 'dashtzad' ); ?></h1>
		<p class="text-ink-soft text-[clamp(1.55rem,1.9vw,1.8rem)] leading-[1.9] mt-[1.6rem] max-w-[44rem]"><?php esc_html_e( 'در حال آماده‌سازی این صفحه هستیم. کمی صبر کنید؛ به‌زودی با محتوای کامل بازمی‌گردیم.', 'dashtzad' ); ?></p>
		<div class="flex flex-wrap items-center justify-center gap-[1.2rem] mt-[3.2rem]">
			<a class="inline-flex items-center gap-[.8rem] font-bold text-[1.5rem] text-white bg-green rounded-md px-[2.4rem] py-[1.3rem] hover:bg-green-deep transition-colors" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa-solid fa-house"></i> <?php esc_html_e( 'بازگشت به خانه', 'dashtzad' ); ?></a>
			<a class="inline-flex items-center gap-[.8rem] font-bold text-[1.5rem] text-green-deep bg-green-soft rounded-md px-[2.4rem] py-[1.3rem] hover:bg-green hover:text-white transition-colors" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><i class="fa-solid fa-store"></i> <?php esc_html_e( 'رفتن به فروشگاه', 'dashtzad' ); ?></a>
		</div>
	</div>
</main>

<?php
get_footer();
