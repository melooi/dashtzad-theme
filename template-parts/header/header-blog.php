<?php
/**
 * Blog / magazine header (header-blog): promo bar, brand, search, shop+login, nav.
 *
 * Loaded by header.php for blog views (posts index, single post, post category,
 * tag, author, date archive, blog search). Same visual language and tokens as
 * the store header; bespoke rules in assets/css/src/04-sections/header-blog.css.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<header class="dz-header-blog sticky top-0 z-[80] bg-paper shadow-[0_1px_0_var(--hair)]">
	<!-- promo bar -->
	<div class="bg-ink">
		<div class="mx-auto max-w-[124rem] flex items-center justify-between gap-[1.6rem] text-[1.2rem] text-hair-strong px-[clamp(1.6rem,4vw,4rem)] py-[.8rem]">
			<span class="inline-flex items-center gap-[.8rem]"><i class="fa-solid fa-book-open text-gold"></i> <?php esc_html_e( 'مجله دشت‌زاد — هر هفته دستور پخت و راهنمای تازه از سفره ایرانی', 'dashtzad' ); ?></span>
			<span class="hidden sm:inline-flex items-center gap-[.8rem]"><span><?php esc_html_e( 'فروش ویژه تابستانه‌ی فروشگاه دشت‌زاد —', 'dashtzad' ); ?> <b class="text-honey font-bold"><?php esc_html_e( 'تا ۲۵٪ تخفیف', 'dashtzad' ); ?></b></span></span>
		</div>
	</div>

	<!-- main bar -->
	<div class="mx-auto max-w-[124rem] flex items-center gap-[2rem] px-[clamp(1.6rem,4vw,4rem)] py-[1.5rem]">
		<?php
		get_template_part(
			'template-parts/header/shared-brand',
			null,
			array(
				'href'    => home_url( '/blog/' ),
				'tagline' => __( 'مجله — روایت یک نسل از ۱۳۰۵', 'dashtzad' ),
			)
		);

		get_template_part(
			'template-parts/header/search',
			null,
			array(
				'placeholder' => __( 'جستجو در مقاله‌ها، دستورها و دمنوش‌ها…', 'dashtzad' ),
				'post_type'   => 'post',
			)
		);
		?>

		<div class="flex items-center gap-[1.2rem] flex-none ms-auto md:ms-0">
			<a class="inline-flex items-center gap-[.8rem] font-bold text-[1.4rem] rounded-md px-[1.6rem] py-[1.05rem] bg-green-soft text-green-deep hover:bg-green hover:text-white transition-all" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><i class="fa-solid fa-store"></i> <span class="hidden sm:inline"><?php esc_html_e( 'فروشگاه دشت‌زاد', 'dashtzad' ); ?></span></a>
			<a class="inline-flex items-center gap-[.8rem] font-bold text-[1.4rem] rounded-md px-[1.6rem] py-[1.05rem] border-[1.5px] border-hair-strong text-ink hover:border-green hover:text-green transition-all" href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>"><i class="fa-regular fa-user"></i> <span class="hidden sm:inline"><?php esc_html_e( 'ورود', 'dashtzad' ); ?></span></a>
		</div>
	</div>

	<?php
	get_template_part( 'template-parts/header/desktop-nav', null, array( 'context' => 'blog' ) );
	get_template_part( 'template-parts/header/mobile-nav', null, array( 'context' => 'blog' ) );
	?>
</header>
