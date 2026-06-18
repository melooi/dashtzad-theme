<?php
/**
 * Collection landing (مجموعه / کالکشن مناسبتی) — PAGE CONTENT ONLY.
 *
 * نسخه‌ی مرجع در wp/pages/. فقط «محتوای صفحه» (بدون get_header()/get_footer()).
 * صفحه‌ی ویترینیِ یک مجموعه‌ی دست‌چین — برخلاف category که آرشیو فیلتردارِ یک
 * دسته است، collection یک لندینگِ روایت‌محور برای یک تم/مناسبت است.
 * CSS اختصاصی: wp/css/collection.css → assets/css/src/04-sections/collection.css
 *
 * NOTE: گرید محصول نمونه است (مطابق یادداشت product-card)؛ در WooCommerce با
 *       محصولاتِ منتسب به همین کالکشن جایگزین شود.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- بسته‌ها/زیرمجموعه‌های این کالکشن --- */
$dz_bundles = array(
	array( 'icon' => 'fa-basket-shopping', 'tone' => 'bg-green text-white', 'name' => 'سبد کامل نوروزی', 'desc' => 'آجیل عید، چای، زعفران و خشکبار — همه در یک سبد آماده هدیه.', 'from' => 'از ۱٬۴۵۰٬۰۰۰', 'count' => '۸ قلم' ),
	array( 'icon' => 'fa-bowl-food', 'tone' => 'bg-clay text-white', 'name' => 'آجیل مخصوص عید', 'desc' => 'ترکیب دست‌چین پسته، بادام، فندق و کشمش؛ تازه بوداده.', 'from' => 'از ۹۸۰٬۰۰۰', 'count' => '۵ نوع' ),
	array( 'icon' => 'fa-mug-hot', 'tone' => 'bg-gold text-white', 'name' => 'چای و دمنوش بهاری', 'desc' => 'چای ممتاز لاهیجان و دمنوش‌های گیاهی برای دید و بازدید عید.', 'from' => 'از ۴۲۰٬۰۰۰', 'count' => '۶ نوع' ),
);

/* --- محصولات دست‌چین این کالکشن --- */
$dz_picks = array(
	array( 'cat' => 'آجیل', 'cat_icon' => 'fa-bowl-food', 'cat_tone' => 'text-clay', 'name' => 'آجیل شب مخصوص دشت‌زاد', 'rate' => '۴٫۹', 'reviews' => '۳۱۸', 'old_price' => 1480000, 'price' => 1290000 ),
	array( 'cat' => 'ادویه', 'cat_icon' => 'fa-mortar-pestle', 'cat_tone' => 'text-gold-deep', 'name' => 'زعفران سرگل اعلا — قوطی هدیه', 'rate' => '۵٫۰', 'reviews' => '۴۸', 'old_price' => 0, 'price' => 1250000 ),
	array( 'cat' => 'چای', 'cat_icon' => 'fa-mug-hot', 'cat_tone' => 'text-gold-deep', 'name' => 'چای سیاه ممتاز لاهیجان', 'rate' => '۴٫۷', 'reviews' => '۸۹', 'old_price' => 0, 'price' => 285000 ),
	array( 'cat' => 'آجیل', 'cat_icon' => 'fa-bowl-food', 'cat_tone' => 'text-clay', 'name' => 'پسته اکبری خندان ممتاز', 'rate' => '۴٫۹', 'reviews' => '۳۱۸', 'old_price' => 1280000, 'price' => 1120000 ),
	array( 'cat' => 'میوه خشک', 'cat_icon' => 'fa-apple-whole', 'cat_tone' => 'text-clay', 'name' => 'توت خشک سفید اعلا', 'rate' => '۴٫۸', 'reviews' => '۱۳۹', 'old_price' => 390000, 'price' => 315000 ),
	array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج دم‌سیاه معطر درجه‌یک', 'rate' => '۴٫۹', 'reviews' => '۷۶', 'old_price' => 0, 'price' => 980000 ),
	array( 'cat' => 'خشکبار', 'cat_icon' => 'fa-apple-whole', 'cat_tone' => 'text-clay', 'name' => 'خرمای مضافتی بم درجه‌یک', 'rate' => '۴٫۸', 'reviews' => '۱۳۹', 'old_price' => 0, 'price' => 268000 ),
	array( 'cat' => 'ادویه', 'cat_icon' => 'fa-mortar-pestle', 'cat_tone' => 'text-clay', 'name' => 'زعفران سرگل نگین قائنات', 'rate' => '۴٫۸', 'reviews' => '۱۴۲', 'old_price' => 0, 'price' => 980000 ),
);
get_header();
?>
<main data-screen-label="collection">

	<!-- breadcrumb -->
	<nav class="dz-crumb" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'dashtzad' ); ?>">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<ol class="dz-crumb__list">
				<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa-solid fa-house"></i> <?php esc_html_e( 'خانه', 'dashtzad' ); ?></a></li>
				<li aria-hidden="true"><i class="fa-solid fa-angle-left"></i></li>
				<li><a href="<?php echo esc_url( home_url( '/collections/' ) ); ?>"><?php esc_html_e( 'مجموعه‌ها', 'dashtzad' ); ?></a></li>
				<li aria-hidden="true"><i class="fa-solid fa-angle-left"></i></li>
				<li aria-current="page"><?php esc_html_e( 'کالکشن نوروز', 'dashtzad' ); ?></li>
			</ol>
		</div>
	</nav>

	<!-- editorial hero -->
	<header class="dz-coll-hero" data-screen-label="collection-hero">
		<div class="dz-placeholder dz-coll-hero__bg"><span class="dz-placeholder__label absolute start-[1.2rem] top-[1.2rem] mx-auto w-fit">عکس فضای نوروزی — سفره هفت‌سین، سبزه و آجیل عید</span></div>
		<div class="dz-coll-hero__scrim"></div>
		<div class="dz-coll-hero__inner mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<span class="dz-coll-hero__badge"><i class="fa-solid fa-seedling"></i> <?php esc_html_e( 'مجموعه ویژه نوروز ۱۴۰۵', 'dashtzad' ); ?></span>
			<h1 class="dz-coll-hero__title"><?php esc_html_e( 'سال نو را با', 'dashtzad' ); ?> <span class="text-honey"><?php esc_html_e( 'طعم برکت', 'dashtzad' ); ?></span> <?php esc_html_e( 'آغاز کنید', 'dashtzad' ); ?></h1>
			<p class="dz-coll-hero__sub"><?php esc_html_e( 'گزیده‌ای دست‌چین از آجیل، زعفران، چای و خشکبارِ مرغوب دشت‌زاد — چیده‌شده برای سفره هفت‌سین، هدیه عید و دید و بازدیدِ سالِ نو.', 'dashtzad' ); ?></p>
			<div class="dz-coll-hero__stats">
				<span><b class="num">۲۴</b> <?php esc_html_e( 'محصولِ دست‌چین', 'dashtzad' ); ?></span>
				<span class="dz-coll-hero__dot" aria-hidden="true"></span>
				<span><b class="num">۳</b> <?php esc_html_e( 'سبدِ آماده هدیه', 'dashtzad' ); ?></span>
				<span class="dz-coll-hero__dot" aria-hidden="true"></span>
				<span><i class="fa-solid fa-truck-fast text-honey"></i> <?php esc_html_e( 'ارسال ویژه پیش از عید', 'dashtzad' ); ?></span>
			</div>
			<div class="dz-coll-hero__cta">
				<a class="dz-btn dz-btn--solid" href="#picks"><i class="fa-solid fa-arrow-down"></i> <?php esc_html_e( 'مشاهده محصولات مجموعه', 'dashtzad' ); ?></a>
				<a class="dz-btn dz-btn--clear" href="#bundles"><i class="fa-solid fa-gift"></i> <?php esc_html_e( 'سبدهای آماده هدیه', 'dashtzad' ); ?></a>
			</div>
		</div>
	</header>

	<!-- intro story -->
	<section class="dz-coll-intro">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-coll-intro__grid">
				<div>
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'درباره این مجموعه', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.4rem,3vw,3.4rem)] leading-[1.2] mt-[1.2rem] tracking-[-.01em]"><?php esc_html_e( 'هرچه برای یک سفره نوروزی پربرکت لازم است', 'dashtzad' ); ?></h2>
					<p class="text-ink-soft text-[1.6rem] leading-[2] mt-[1.4rem] max-w-[58rem]"><?php esc_html_e( 'هر سال، پیش از نوروز، بهترین محصولات فصل را از باغ‌داران مورد اعتمادمان دست‌چین می‌کنیم و در قالب یک مجموعه‌ی هماهنگ کنار هم می‌گذاریم. از آجیلِ تازه بوداده تا زعفرانِ خوش‌رنگ و چایِ معطر — همه با ضمانت اصالت دشت‌زاد.', 'dashtzad' ); ?></p>
					<ul class="dz-coll-feats">
						<li><i class="fa-solid fa-leaf"></i> <?php esc_html_e( 'طبیعی، تازه و بدون افزودنی', 'dashtzad' ); ?></li>
						<li><i class="fa-solid fa-box-open"></i> <?php esc_html_e( 'بسته‌بندی شکیلِ مناسب هدیه', 'dashtzad' ); ?></li>
						<li><i class="fa-solid fa-truck-fast"></i> <?php esc_html_e( 'تضمین ارسال پیش از تعطیلات عید', 'dashtzad' ); ?></li>
					</ul>
				</div>
				<div class="dz-coll-intro__media">
					<?php dz_placeholder( 'عکس چیدمان آجیل و زعفران روی سفره نوروزی', 'rounded-xl h-[clamp(28rem,34vw,38rem)] shadow-pop' ); ?>
				</div>
			</div>
		</div>
	</section>

	<!-- bundles -->
	<section class="dz-coll-band" id="bundles">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'آماده‌ی هدیه', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'سبدهای آماده‌ی نوروزی', 'dashtzad' ); ?></h2>
				<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]"><?php esc_html_e( 'بسته‌های دست‌چین برای آن‌که بدون دغدغه، یک هدیه‌ی کامل و شکیل را انتخاب کنید.', 'dashtzad' ); ?></p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-[clamp(1.6rem,2.2vw,2.4rem)]">
				<?php foreach ( $dz_bundles as $dz_b ) : ?>
					<a class="dz-bundle" href="#">
						<div class="dz-bundle__media dz-placeholder"><span class="dz-placeholder__label absolute start-[1.2rem] end-[1.2rem] bottom-[1.2rem] mx-auto w-fit">عکس <?php echo esc_html( $dz_b['name'] ); ?></span><span class="dz-bundle__icon <?php echo esc_attr( $dz_b['tone'] ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_b['icon'] ); ?>"></i></span></div>
						<div class="dz-bundle__body">
							<span class="dz-bundle__count"><i class="fa-solid fa-layer-group"></i> <?php echo esc_html( $dz_b['count'] ); ?></span>
							<h3 class="dz-bundle__name"><?php echo esc_html( $dz_b['name'] ); ?></h3>
							<p class="dz-bundle__desc"><?php echo esc_html( $dz_b['desc'] ); ?></p>
							<div class="dz-bundle__foot">
								<span class="dz-bundle__price num"><?php echo esc_html( $dz_b['from'] ); ?> <span class="dz-bundle__t"><?php esc_html_e( 'تومان', 'dashtzad' ); ?></span></span>
								<span class="dz-bundle__go"><?php esc_html_e( 'مشاهده', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- curated picks -->
	<section class="py-[clamp(4rem,6vw,6.4rem)]" id="picks">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="flex items-end justify-between gap-[2rem] mb-[clamp(2.4rem,3.5vw,3.6rem)] flex-wrap">
				<div class="min-w-0">
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'دست‌چینِ دشت‌زاد', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'گزیده‌ی کالکشن نوروز', 'dashtzad' ); ?></h2>
				</div>
				<a class="inline-flex items-center gap-[.7rem] font-bold text-[1.45rem] text-green flex-none pb-[.4rem] whitespace-nowrap hover:text-green-deep transition-colors group/sa" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'همه محصولات فروشگاه', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left text-[1.3rem] group-hover/sa:-translate-x-1 transition-transform"></i></a>
			</div>
			<div class="grid grid-cols-2 lg:grid-cols-4 gap-[clamp(1.4rem,2vw,2.4rem)]">
				<?php
				foreach ( $dz_picks as $dz_p ) :
					$dz_p['badges'] = array( array( 'label' => 'ویژه نوروز', 'icon' => 'fa-seedling', 'classes' => 'bg-green-soft text-green-deep' ) );
					get_template_part( 'components/product/product-card', null, $dz_p );
				endforeach;
				?>
			</div>
		</div>
	</section>

	<!-- gifting CTA -->
	<section class="dz-coll-cta-wrap">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-coll-cta">
				<div class="relative">
					<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em]"><i class="fa-solid fa-building"></i> <?php esc_html_e( 'برای کسب‌وکارها', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.4rem,3vw,3.4rem)] leading-[1.18] mt-[1.2rem] text-white"><?php esc_html_e( 'هدیه‌ی نوروزی به نام برند شما', 'dashtzad' ); ?></h2>
					<p class="text-white/80 text-[1.55rem] leading-[1.9] mt-[1.2rem] max-w-[52rem]"><?php esc_html_e( 'برای هدایای سازمانی و سفارش‌های عمده‌ی نوروزی، بسته‌بندی اختصاصی با لوگوی شما و فاکتور رسمی آماده می‌کنیم.', 'dashtzad' ); ?></p>
				</div>
				<div class="dz-coll-cta__btns">
					<a class="dz-btn dz-btn--honey" href="<?php echo esc_url( home_url( '/corporate-gifts/' ) ); ?>"><i class="fa-solid fa-gift"></i> <?php esc_html_e( 'هدایای سازمانی', 'dashtzad' ); ?></a>
					<a class="dz-btn dz-btn--clear" href="<?php echo esc_url( home_url( '/bulk-order/' ) ); ?>"><i class="fa-solid fa-box-open"></i> <?php esc_html_e( 'خرید عمده', 'dashtzad' ); ?></a>
				</div>
			</div>
		</div>
	</section>

</main>

<script>
(function () {
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);
})();
</script>

<?php
get_footer();
