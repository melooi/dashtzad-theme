<?php
/**
 * Store header (header-main): promo bar, brand, search, cart/login, primary nav.
 *
 * Loaded by header.php for store views and — unified — for blog views too.
 * Only the nav items and the commerce icon switch by context:
 *   main : cart button + store nav
 *   blog : shop button + magazine nav
 * Layout composed from Tailwind utilities inline; bespoke rules live in
 * assets/css/src/04-sections/header-main.css.
 *
 * @var array $args { context: 'main'|'blog', commerce: 'cart'|'shop' }
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_context  = ( isset( $args['context'] ) && 'blog' === $args['context'] ) ? 'blog' : 'main';
$dz_commerce = ( isset( $args['commerce'] ) && 'shop' === $args['commerce'] ) ? 'shop' : 'cart';
?>
<header class="dz-header-main sticky top-0 z-[80] bg-paper shadow-[0_1px_0_var(--hair)]">
	<!-- promo bar -->
	<div class="bg-ink">
		<div class="mx-auto max-w-[124rem] flex items-center justify-between gap-[1.6rem] text-[1.2rem] text-hair-strong px-[clamp(1.6rem,4vw,4rem)] py-[.8rem]">
			<span class="inline-flex items-center gap-[.8rem]"><i class="fa-solid fa-truck-fast text-gold"></i> <?php esc_html_e( 'ارسال رایگان برای سفارش‌های بالای', 'dashtzad' ); ?> <b class="text-honey font-bold">۷۰۰٬۰۰۰ <?php esc_html_e( 'تومان', 'dashtzad' ); ?></b> <?php esc_html_e( 'در سراسر کشور', 'dashtzad' ); ?></span>
			<span class="hidden sm:inline-flex items-center gap-[.8rem]"><span><?php esc_html_e( 'مستقیم از باغ‌های دماوند —', 'dashtzad' ); ?> <b class="text-honey font-bold"><?php esc_html_e( 'بدون واسطه', 'dashtzad' ); ?></b></span></span>
		</div>
	</div>

	<!-- main bar (desktop only — mobile uses template-parts/header/mobile-header) -->
	<div class="mx-auto max-w-[124rem] hidden lg:flex items-center gap-[2rem] px-[clamp(1.6rem,4vw,4rem)] py-[1.5rem]">
		<?php
		get_template_part(
			'template-parts/header/shared-brand',
			null,
			array( 'tagline' => __( 'از باغ خانوادگی تا سفره شما — ۱۳۰۵', 'dashtzad' ) )
		);

		get_template_part(
			'template-parts/header/search',
			null,
			array( 'placeholder' => __( 'جستجو در فروشگاه دشت‌زاد…', 'dashtzad' ) )
		);
		?>

		<div class="flex items-center gap-[1.2rem] flex-none ms-auto md:ms-0">
			<?php if ( 'shop' === $dz_commerce ) : ?>
				<a class="inline-flex items-center gap-[.8rem] font-bold text-[1.4rem] rounded-md px-[1.6rem] py-[1.05rem] bg-green-soft text-green-deep hover:bg-green hover:text-white transition-all" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><i class="fa-solid fa-store"></i> <span class="hidden sm:inline"><?php esc_html_e( 'فروشگاه دشت‌زاد', 'dashtzad' ); ?></span></a>
			<?php else : ?>
				<a class="relative inline-flex items-center gap-[.8rem] font-bold text-[1.4rem] rounded-md px-[1.6rem] py-[1.05rem] bg-green-soft text-green-deep hover:bg-green hover:text-white transition-all group/cart" href="<?php echo esc_url( home_url( '/cart/' ) ); ?>">
					<i class="fa-solid fa-cart-shopping"></i>
					<span class="hidden sm:inline"><?php esc_html_e( 'سبد خرید', 'dashtzad' ); ?></span>
					<span data-cart-count class="grid place-items-center min-w-[1.9rem] h-[1.9rem] px-[.5rem] rounded-full bg-clay text-white text-[1.15rem] font-bold group-hover/cart:bg-gold group-hover/cart:text-ink" style="display:none">۰</span>
				</a>
			<?php endif; ?>
			<a class="inline-flex items-center gap-[.8rem] font-bold text-[1.4rem] rounded-md px-[1.6rem] py-[1.05rem] border-[1.5px] border-hair-strong text-ink hover:border-green hover:text-green transition-all" href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>"><i class="fa-regular fa-user"></i> <span class="hidden sm:inline"><?php esc_html_e( 'ورود', 'dashtzad' ); ?></span></a>
		</div>
	</div>

	<?php
	get_template_part( 'template-parts/header/desktop-nav', null, array( 'context' => $dz_context ) );
	get_template_part(
		'template-parts/header/mobile-header',
		null,
		array(
			'context'  => $dz_context,
			'commerce' => $dz_commerce,
		)
	);
	?>
</header>
