<?php
/**
 * Mobile header (below lg) — bespoke, ecommerce-focused.
 *
 * A dedicated phone/small-tablet header — NOT a compressed desktop header:
 *   row 1 : menu toggle  …  brand (center)  …  cart|shop · account
 *   row 2 : full-width search bar (always visible, rotating placeholder)
 *   off-canvas right-hand drawer: account · quick links (only «فروشگاه»
 *           expands into the category grid) · order tracking · support.
 *
 * Pure CSS toggle (hidden checkbox #dz-mnav) — no JS dependency. Shown below
 * lg; hidden at lg+ where header-main.php's desktop bar + desktop-nav take over.
 * Bespoke rules live in assets/css/src/04-sections/header-mobile.css.
 *
 * @var array $args { context: 'main'|'blog', commerce: 'cart'|'shop' }
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_context  = ( isset( $args['context'] ) && 'blog' === $args['context'] ) ? 'blog' : 'main';
$dz_items    = dz_nav_items( $dz_context );
$dz_commerce = ( isset( $args['commerce'] ) && 'shop' === $args['commerce'] ) ? 'shop' : 'cart';
?>
<!-- سوییچ کشو (مخفی) — کنترل بدون جاوااسکریپت -->
<input type="checkbox" id="dz-mnav" class="dz-mnav-toggle" aria-hidden="true" tabindex="-1">

<div class="dz-mhead">
	<!-- ردیف اصلی: همبرگر | برند | سبد/فروشگاه + ورود -->
	<div class="flex items-center gap-[1rem] px-[1.6rem] py-[1.1rem]">
		<div class="flex-1 flex items-center justify-start">
			<label class="dz-iconbtn" for="dz-mnav" role="button" aria-label="<?php esc_attr_e( 'باز کردن منو', 'dashtzad' ); ?>"><i class="fa-solid fa-bars"></i></label>
		</div>

		<a class="flex items-center gap-[.9rem] flex-none" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="font-display font-bold text-[2.1rem] leading-none"><?php bloginfo( 'name' ); ?></span>
			<?php dz_brand_seal( 'w-[4rem] h-[4rem] text-[2rem]' ); ?>
		</a>

		<div class="flex-1 flex items-center justify-end gap-[.2rem]">
			<?php if ( 'shop' === $dz_commerce ) : ?>
				<a class="dz-iconbtn" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>" aria-label="<?php esc_attr_e( 'فروشگاه دشت‌زاد', 'dashtzad' ); ?>"><i class="fa-solid fa-store"></i></a>
			<?php else : ?>
				<a class="dz-iconbtn" href="<?php echo esc_url( home_url( '/cart/' ) ); ?>" aria-label="<?php esc_attr_e( 'سبد خرید', 'dashtzad' ); ?>">
					<i class="fa-solid fa-cart-shopping"></i>
					<span data-cart-count class="dz-iconbtn__badge" style="display:none">۰</span>
				</a>
			<?php endif; ?>
			<a class="dz-iconbtn" href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>" aria-label="<?php esc_attr_e( 'ورود / حساب کاربری', 'dashtzad' ); ?>"><i class="fa-regular fa-user"></i></a>
		</div>
	</div>

	<!-- ردیف جستجو -->
	<div class="px-[1.6rem] pb-[1.2rem]">
		<form class="dz-msearch" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<i class="fa-solid fa-magnifying-glass dz-msearch__icon"></i>
			<input type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" data-rotate-ph class="dz-msearch__input" placeholder="<?php esc_attr_e( 'جستجو در فروشگاه دشت‌زاد…', 'dashtzad' ); ?>" aria-label="<?php esc_attr_e( 'جستجو', 'dashtzad' ); ?>" />
			<?php if ( 'blog' === $dz_context ) : ?>
				<input type="hidden" name="post_type" value="post" />
			<?php endif; ?>
		</form>
	</div>
</div>

<!-- پس‌زمینه تیره (کلیک برای بستن) -->
<label class="dz-drawer-backdrop" for="dz-mnav" aria-hidden="true"></label>

<!-- کشوی منو -->
<aside class="dz-drawer" role="dialog" aria-modal="true" aria-label="<?php esc_attr_e( 'منوی اصلی', 'dashtzad' ); ?>">
	<div class="dz-drawer__head">
		<div class="flex items-center gap-[.9rem]">
			<?php dz_brand_seal( 'w-[3.8rem] h-[3.8rem] text-[1.9rem]' ); ?>
			<span class="font-display font-bold text-[2rem]"><?php bloginfo( 'name' ); ?></span>
		</div>
		<label class="dz-drawer__close" for="dz-mnav" role="button" aria-label="<?php esc_attr_e( 'بستن منو', 'dashtzad' ); ?>"><i class="fa-solid fa-xmark"></i></label>
	</div>

	<div class="dz-drawer__body">
		<a class="dz-drawer__account" href="<?php echo esc_url( home_url( '/my-account/' ) ); ?>">
			<i class="fa-regular fa-user"></i>
			<?php esc_html_e( 'ورود / ثبت‌نام', 'dashtzad' ); ?>
			<i class="fa-solid fa-arrow-left"></i>
		</a>

		<div>
			<p class="dz-drawer__label"><?php esc_html_e( 'دسترسی سریع', 'dashtzad' ); ?></p>
			<div class="dz-drawer__links">
				<?php
				foreach ( $dz_items as $dz_item ) :
					// خانه در فروشگاه حذف می‌شود (برند خودش به خانه می‌رود).
					if ( 'main' === $dz_context && ! empty( $dz_item['bold'] ) ) {
						continue;
					}

					if ( ! empty( $dz_item['mega'] ) ) :
						// فروشگاه — تنها آیتم بازشو؛ دسته‌بندی‌ها داخلش باز می‌شوند.
						?>
						<div class="dz-drawer__acc">
							<input type="checkbox" id="dz-shop-acc" class="dz-drawer__acc-toggle" aria-hidden="true">
							<label class="dz-drawer__acc-head" for="dz-shop-acc">
								<i class="fa-solid <?php echo esc_attr( $dz_item['icon'] ); ?>"></i>
								<span><?php echo esc_html( $dz_item['label'] ); ?></span>
								<i class="fa-solid fa-angle-down dz-drawer__acc-caret"></i>
							</label>
							<div class="dz-drawer__acc-panel">
								<div>
									<div class="dz-drawer__acc-inner">
										<a class="dz-drawer__acc-all" href="<?php echo esc_url( $dz_item['url'] ); ?>"><?php esc_html_e( 'همه محصولات فروشگاه', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></a>
										<div class="dz-drawer__cats">
											<?php foreach ( dz_shop_mega_cats() as $dz_cat ) : ?>
												<a class="dz-drawer__cat" href="<?php echo esc_url( home_url( '/product-category/' ) ); ?>">
													<span class="dz-drawer__cat-ic <?php echo esc_attr( $dz_cat['tone'] ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_cat['icon'] ); ?>"></i></span>
													<?php echo esc_html( $dz_cat['label'] ); ?>
												</a>
											<?php endforeach; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php
					else :
						?>
						<a class="dz-drawer__link" href="<?php echo esc_url( $dz_item['url'] ); ?>">
							<i class="fa-solid <?php echo esc_attr( $dz_item['icon'] ); ?>"></i>
							<?php echo esc_html( $dz_item['label'] ); ?>
						</a>
						<?php
					endif;
				endforeach;
				?>
			</div>
		</div>

		<div class="dz-drawer__util">
			<div class="dz-drawer__links">
				<a class="dz-drawer__link" href="<?php echo esc_url( home_url( '/track/' ) ); ?>">
					<i class="fa-solid fa-location-dot"></i>
					<?php esc_html_e( 'پیگیری سفارش', 'dashtzad' ); ?>
				</a>
				<a class="dz-drawer__link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
					<i class="fa-solid fa-headset"></i>
					<?php esc_html_e( 'پشتیبانی و تماس با ما', 'dashtzad' ); ?>
				</a>
			</div>
		</div>
	</div>
</aside>
