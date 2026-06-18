<?php
/**
 * Product category archive (category / taxonomy product_cat) — PAGE CONTENT ONLY.
 *
 * نسخه‌ی مرجع در wp/pages/. فقط «محتوای صفحه»:
 *   - بدون get_header() / get_footer() (هدر/فوتر از قالب: header-main / footer-main)
 *   - هنگام انتقال، محتوای همین <main> داخل تمپلیت آرشیو (archive-product.php /
 *     taxonomy-product_cat.php) بین get_header و get_footer قرار می‌گیرد.
 * CSS اختصاصی: wp/css/category.css → assets/css/src/04-sections/category.css
 *
 * داده‌محور: ساختار دسته‌ها و «فیلترهای اختصاصی هر دسته» از یک منبع واحد در
 * inc/template-tags.php → dz_product_categories() خوانده می‌شود. هر دستهٔ اصلی
 * (برنج، حبوبات، خشکبار، چای، ادویه، آجیل) زیردسته‌ها و گروه‌های فیلترِ خودش را دارد.
 *
 * NOTE: گرید محصول و شمارنده‌ها فعلاً نمونه‌اند. در مرحله‌ی WooCommerce،
 *       $dz_slug از ترمِ جاری (get_queried_object()->slug) گرفته شود و گرید با
 *       the_loop / wc_get_products جایگزین گردد.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- دستهٔ جاری (در ووکامرس از ترمِ آرشیو می‌آید) --- */
$dz_slug = 'rice'; // نمونه: rice | legume | nuts | tea | spice | ajil
$dz_cat  = dz_get_category( $dz_slug );

/* --- نمونه‌داده‌ی محصولات این دسته (در WP با the_loop جایگزین شود) --- */
$dz_products_by_cat = array(
	'rice' => array(
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج هاشمی درجه‌یک گیلان', 'rate' => '۴٫۹', 'reviews' => '۳۱۲', 'old_price' => 0, 'price' => 980000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج طارم هاشمی معطر', 'rate' => '۴٫۸', 'reviews' => '۱۸۶', 'old_price' => 0, 'price' => 870000, 'badges' => array() ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج دم‌سیاه معطر درجه‌یک', 'rate' => '۴٫۹', 'reviews' => '۷۶', 'old_price' => 1180000, 'price' => 980000, 'badges' => array( array( 'label' => 'تخفیف', 'icon' => 'fa-tag', 'classes' => 'bg-amber-soft text-gold-deep' ) ) ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج صدری دودی شمال', 'rate' => '۴٫۷', 'reviews' => '۵۴', 'old_price' => 0, 'price' => 720000, 'badges' => array() ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج عنبربو جنوب ممتاز', 'rate' => '۴٫۶', 'reviews' => '۴۸', 'old_price' => 0, 'price' => 540000, 'badges' => array() ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج هاشمی کشت‌دوم', 'rate' => '۴٫۵', 'reviews' => '۳۲', 'old_price' => 0, 'price' => 690000, 'badges' => array() ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج فجر معطر گرگان', 'rate' => '۴٫۶', 'reviews' => '۶۷', 'old_price' => 0, 'price' => 480000, 'badges' => array( array( 'label' => 'ویژه', 'icon' => 'fa-crown', 'classes' => 'bg-amber-soft text-gold-deep' ) ) ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج طارم ارگانیک ۵ کیلویی', 'rate' => '۴٫۹', 'reviews' => '۱۲۴', 'old_price' => 4600000, 'price' => 4150000, 'badges' => array( array( 'label' => 'تخفیف', 'icon' => 'fa-tag', 'classes' => 'bg-amber-soft text-gold-deep' ) ) ),
		array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج هاشمی ممتاز ۱۰ کیلویی', 'rate' => '۴٫۸', 'reviews' => '۲۰۵', 'old_price' => 0, 'price' => 9400000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
	),
);

/* fallback: اگر برای این دسته نمونه‌محصول نبود، از مجموعهٔ برنج استفاده شود */
$dz_items = isset( $dz_products_by_cat[ $dz_slug ] ) ? $dz_products_by_cat[ $dz_slug ] : reset( $dz_products_by_cat );

/* محدودهٔ قیمتِ سریع (مشترک) */
$dz_price_quick = array( 'زیر ۵۰۰ هزار', '۵۰۰ تا ۱ میلیون', 'بالای ۱ میلیون' );
get_header();
?>
<main data-screen-label="category">

	<!-- breadcrumb -->
	<nav class="dz-crumb" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'dashtzad' ); ?>">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<ol class="dz-crumb__list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa-solid fa-house"></i> <?php esc_html_e( 'خانه', 'dashtzad' ); ?></a></li>
				<li aria-hidden="true"><i class="fa-solid fa-angle-left"></i></li>
				<li><a href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'فروشگاه', 'dashtzad' ); ?></a></li>
				<li aria-hidden="true"><i class="fa-solid fa-angle-left"></i></li>
				<li aria-current="page"><?php echo esc_html( $dz_cat['name'] ); ?></li>
			</ol>
		</div>
	</nav>

	<!-- category header band -->
	<header class="dz-cat-hero" data-screen-label="category-hero">
		<div class="dz-cat-hero__inner mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-cat-hero__top">
				<span class="dz-cat-hero__icon"><i class="fa-solid <?php echo esc_attr( $dz_cat['icon'] ); ?>"></i></span>
				<div class="min-w-0">
					<span class="dz-cat-hero__kicker"><i class="fa-solid fa-store"></i> <?php esc_html_e( 'فروشگاه دشت‌زاد', 'dashtzad' ); ?></span>
					<h1 class="dz-cat-hero__title"><?php echo esc_html( $dz_cat['name'] ); ?></h1>
					<p class="dz-cat-hero__count"><b class="num"><?php echo esc_html( $dz_cat['count'] ); ?></b> <?php esc_html_e( 'محصول در این دسته', 'dashtzad' ); ?></p>
				</div>
			</div>
			<p class="dz-cat-hero__desc"><?php echo esc_html( $dz_cat['desc'] ); ?></p>
			<div class="dz-cat-hero__chips dz-no-scroll">
				<?php foreach ( $dz_cat['subcats'] as $dz_sc ) : ?>
					<a href="#" class="dz-cat-chip<?php echo ! empty( $dz_sc['active'] ) ? ' is-active' : ''; ?>"><?php echo esc_html( $dz_sc['label'] ); ?> <span class="dz-cat-chip__n num"><?php echo esc_html( $dz_sc['count'] ); ?></span></a>
				<?php endforeach; ?>
			</div>
		</div>
	</header>

	<!-- body -->
	<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(2.8rem,4vw,4rem)]">

		<!-- toolbar -->
		<div class="dz-cat-toolbar">
			<button class="dz-cat-toolbar__filter" type="button" data-filter-open aria-label="<?php esc_attr_e( 'نمایش فیلترها', 'dashtzad' ); ?>"><i class="fa-solid fa-sliders"></i> <?php esc_html_e( 'فیلترها', 'dashtzad' ); ?></button>
			<span class="dz-cat-toolbar__count"><?php esc_html_e( 'نمایش', 'dashtzad' ); ?> <b class="num">۱۲</b> <?php esc_html_e( 'از', 'dashtzad' ); ?> <b class="num"><?php echo esc_html( $dz_cat['count'] ); ?></b> <?php esc_html_e( 'محصول', 'dashtzad' ); ?></span>
			<label class="dz-cat-sort">
				<span class="dz-cat-sort__l"><i class="fa-solid fa-arrow-down-wide-short"></i> <?php esc_html_e( 'مرتب‌سازی', 'dashtzad' ); ?></span>
				<select class="dz-cat-sort__sel" aria-label="<?php esc_attr_e( 'مرتب‌سازی محصولات', 'dashtzad' ); ?>">
					<option><?php esc_html_e( 'پیش‌فرض فروشگاه', 'dashtzad' ); ?></option>
					<option><?php esc_html_e( 'پرفروش‌ترین', 'dashtzad' ); ?></option>
					<option><?php esc_html_e( 'جدیدترین', 'dashtzad' ); ?></option>
					<option><?php esc_html_e( 'ارزان‌ترین', 'dashtzad' ); ?></option>
					<option><?php esc_html_e( 'گران‌ترین', 'dashtzad' ); ?></option>
					<option><?php esc_html_e( 'بیشترین امتیاز', 'dashtzad' ); ?></option>
				</select>
			</label>
		</div>

		<div class="dz-cat-layout">

			<!-- filters (اختصاصیِ همین دسته) -->
			<aside class="dz-cat-filters" data-filter-panel>
				<div class="dz-cat-filters__head">
					<span class="font-display font-bold text-[1.85rem]"><?php esc_html_e( 'فیلترها', 'dashtzad' ); ?></span>
					<button class="dz-cat-filters__close" type="button" data-filter-close aria-label="<?php esc_attr_e( 'بستن', 'dashtzad' ); ?>"><i class="fa-solid fa-xmark"></i></button>
				</div>

				<?php foreach ( $dz_cat['filters'] as $dz_g ) : ?>
					<div class="dz-filter-group">
						<h3 class="dz-filter-group__h"><?php echo esc_html( $dz_g['title'] ); ?></h3>
						<?php foreach ( $dz_g['options'] as $dz_o ) : ?>
							<label class="dz-check">
								<input type="<?php echo 'radio' === $dz_g['type'] ? 'radio' : 'checkbox'; ?>"<?php echo ! empty( $dz_g['name'] ) ? ' name="' . esc_attr( $dz_g['name'] ) . '"' : ''; ?><?php echo ! empty( $dz_o['checked'] ) ? ' checked' : ''; ?> />
								<span><?php echo esc_html( $dz_o['label'] ); ?></span>
								<?php if ( isset( $dz_o['count'] ) ) : ?><span class="dz-check__n num"><?php echo esc_html( $dz_o['count'] ); ?></span><?php endif; ?>
							</label>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>

				<!-- محدودهٔ قیمت (مشترک همهٔ دسته‌ها) -->
				<div class="dz-filter-group">
					<h3 class="dz-filter-group__h"><?php esc_html_e( 'محدوده قیمت (تومان)', 'dashtzad' ); ?></h3>
					<div class="dz-price-row">
						<input type="text" inputmode="numeric" class="dz-price-in" placeholder="<?php esc_attr_e( 'از', 'dashtzad' ); ?>" aria-label="<?php esc_attr_e( 'حداقل قیمت', 'dashtzad' ); ?>" />
						<span class="dz-price-sep">—</span>
						<input type="text" inputmode="numeric" class="dz-price-in" placeholder="<?php esc_attr_e( 'تا', 'dashtzad' ); ?>" aria-label="<?php esc_attr_e( 'حداکثر قیمت', 'dashtzad' ); ?>" />
					</div>
					<div class="dz-price-quick">
						<?php foreach ( $dz_price_quick as $dz_pq ) : ?>
							<button type="button" class="dz-cat-chip"><?php echo esc_html( $dz_pq ); ?></button>
						<?php endforeach; ?>
					</div>
				</div>

				<!-- امتیاز مشتریان (مشترک) -->
				<div class="dz-filter-group">
					<h3 class="dz-filter-group__h"><?php esc_html_e( 'امتیاز مشتریان', 'dashtzad' ); ?></h3>
					<label class="dz-check"><input type="radio" name="dz-rate" /> <span class="dz-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> <?php esc_html_e( 'و بالاتر', 'dashtzad' ); ?></span></label>
					<label class="dz-check"><input type="radio" name="dz-rate" /> <span class="dz-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i> <?php esc_html_e( 'و بالاتر', 'dashtzad' ); ?></span></label>
				</div>

				<div class="dz-cat-filters__foot">
					<button type="button" class="dz-btn dz-btn--primary"><i class="fa-solid fa-check"></i> <?php esc_html_e( 'اعمال فیلترها', 'dashtzad' ); ?></button>
					<button type="button" class="dz-btn dz-btn--ghost"><?php esc_html_e( 'حذف همه', 'dashtzad' ); ?></button>
				</div>
			</aside>
			<div class="dz-cat-backdrop" data-filter-close></div>

			<!-- results -->
			<div class="min-w-0">
				<div class="dz-cat-active">
					<span class="dz-cat-active__l"><?php esc_html_e( 'فیلترهای فعال:', 'dashtzad' ); ?></span>
					<button type="button" class="dz-tag-x"><?php esc_html_e( 'موجود', 'dashtzad' ); ?> <i class="fa-solid fa-xmark"></i></button>
					<button type="button" class="dz-cat-active__clear"><?php esc_html_e( 'پاک‌کردن همه', 'dashtzad' ); ?></button>
				</div>

				<div class="grid grid-cols-2 lg:grid-cols-3 gap-[clamp(1.4rem,2vw,2.4rem)]">
					<?php foreach ( $dz_items as $dz_p ) : get_template_part( 'components/product/product-card', null, $dz_p ); endforeach; ?>
				</div>

				<!-- pagination -->
				<nav class="dz-pager" aria-label="<?php esc_attr_e( 'صفحه‌بندی', 'dashtzad' ); ?>">
					<a class="dz-pager__b dz-pager__b--nav is-disabled" aria-disabled="true"><i class="fa-solid fa-angle-right"></i></a>
					<a class="dz-pager__b is-active num" aria-current="page">۱</a>
					<a class="dz-pager__b num" href="#">۲</a>
					<a class="dz-pager__b num" href="#">۳</a>
					<span class="dz-pager__dots">…</span>
					<a class="dz-pager__b num" href="#">۴</a>
					<a class="dz-pager__b dz-pager__b--nav" href="#"><i class="fa-solid fa-angle-left"></i></a>
				</nav>
			</div>
		</div>

		<!-- SEO description -->
		<section class="dz-cat-about">
			<h2 class="font-display font-bold text-[clamp(2.2rem,2.8vw,2.8rem)] mb-[1.2rem]"><?php printf( esc_html__( 'خرید %s از دشت‌زاد', 'dashtzad' ), esc_html( $dz_cat['name'] ) ); ?></h2>
			<p><?php echo esc_html( $dz_cat['desc'] ); ?></p>
			<p><?php esc_html_e( 'دشت‌زاد از سال ۱۳۰۵ محصولات خود را مستقیم از باغ‌داران و کشاورزانِ مورد اعتماد تامین می‌کند تا بدون واسطه و با حفظ تازگی به دست شما برسد؛ با ضمانت اصالت و بازگشت وجه.', 'dashtzad' ); ?></p>
		</section>

	</div>

</main>

<script>
(function () {
	/* sticky offset از ارتفاع هدر */
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);

	/* پنل فیلتر موبایل */
	document.querySelectorAll('[data-filter-open]').forEach(function (b) {
		b.addEventListener('click', function () { document.body.classList.add('dz-filter-open'); });
	});
	document.querySelectorAll('[data-filter-close]').forEach(function (b) {
		b.addEventListener('click', function () { document.body.classList.remove('dz-filter-open'); });
	});
})();
</script>

<?php
get_footer();
