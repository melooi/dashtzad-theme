<?php
/**
 * Template Name: صفحه اصلی
 * Home (front page) — PAGE CONTENT ONLY.
 *
 * نسخه‌ی مرجع در wp/pages/. این فایل تمپلیت کامل صفحه اصلی است:
 *   - get_header() و get_footer() را صدا می‌زند (هدر/فوتر: header-main / footer-main)
 *   - محتوای <main> بین get_header و get_footer رندر می‌شود.
 * CSS اختصاصی: wp/css/home.css → assets/css/src/04-sections/{hero,journey,reviews}.css
 *
 * NOTE: گریدهای محصول فعلاً از آرایه‌ی نمونه پر می‌شوند (مطابق یادداشت product-card).
 *       در مرحله‌ی WooCommerce با WP_Query/wc_get_products جایگزین شود.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- نمونه‌داده: پرفروش‌ها (اسکرولر افقی) --- */
$dz_best = array(
	array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج هاشمی درجه‌یک گیلان', 'rate' => '۴٫۹', 'reviews' => '۳۱۲', 'old_price' => 890000, 'price' => 740000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
	array( 'cat' => 'خشکبار', 'cat_icon' => 'fa-bowl-food', 'cat_tone' => 'text-clay', 'name' => 'برگه گلابی خشک ممتاز', 'rate' => '۴٫۸', 'reviews' => '۱۲۴', 'old_price' => 460000, 'price' => 372000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ), array( 'label' => 'تخفیف', 'icon' => 'fa-tag', 'classes' => 'bg-amber-soft text-gold-deep' ) ) ),
	array( 'cat' => 'چای', 'cat_icon' => 'fa-mug-hot', 'cat_tone' => 'text-gold-deep', 'name' => 'چای سیاه ممتاز لاهیجان', 'rate' => '۴٫۷', 'reviews' => '۸۹', 'old_price' => 0, 'price' => 285000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
	array( 'cat' => 'حبوبات', 'cat_icon' => 'fa-seedling', 'cat_tone' => 'text-green', 'name' => 'لوبیا چیتی درشت دماوند', 'rate' => '۴٫۶', 'reviews' => '۲۰۷', 'old_price' => 0, 'price' => 198000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
	array( 'cat' => 'ادویه', 'cat_icon' => 'fa-mortar-pestle', 'cat_tone' => 'text-clay', 'name' => 'زعفران سرگل نگین قائنات', 'rate' => '۴٫۸', 'reviews' => '۱۴۲', 'old_price' => 0, 'price' => 980000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
	array( 'cat' => 'آجیل', 'cat_icon' => 'fa-bowl-food', 'cat_tone' => 'text-clay', 'name' => 'پسته اکبری خندان ممتاز', 'rate' => '۴٫۹', 'reviews' => '۳۱۸', 'old_price' => 1280000, 'price' => 1120000, 'badges' => array( array( 'label' => 'پرفروش', 'icon' => 'fa-fire', 'classes' => 'bg-clay-soft text-clay-deep' ) ) ),
);

/* --- نمونه‌داده: محصولات ویژه (گرید سه‌ستونه، توضیح‌دار) --- */
$dz_feat = array(
	array( 'cat' => 'ادویه', 'cat_icon' => 'fa-mortar-pestle', 'cat_tone' => 'text-gold-deep', 'name' => 'زعفران سرگل اعلا — قوطی هدیه', 'desc' => 'برداشت تازه قائنات، رشته‌بلند و خوش‌رنگ؛ در قوطی شکیل مناسب هدیه.', 'rate' => '۵٫۰', 'reviews' => '۴۸', 'old_price' => 0, 'price' => 1250000 ),
	array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج دم‌سیاه معطر درجه‌یک', 'desc' => 'دانه‌بلند و خوش‌عطر، مناسب مجالس؛ مستقیم از شالیزارهای شمال.', 'rate' => '۴٫۹', 'reviews' => '۷۶', 'old_price' => 0, 'price' => 980000 ),
	array( 'cat' => 'خشکبار', 'cat_icon' => 'fa-apple-whole', 'cat_tone' => 'text-clay', 'name' => 'توت خشک سفید اعلا', 'desc' => 'شیرینِ طبیعی و بدون شکر افزوده؛ میان‌وعده‌ای سالم برای همه.', 'rate' => '۴٫۸', 'reviews' => '۱۳۹', 'old_price' => 390000, 'price' => 315000 ),
	array( 'cat' => 'آجیل', 'cat_icon' => 'fa-bowl-food', 'cat_tone' => 'text-clay', 'name' => 'آجیل شب مخصوص دشت‌زاد', 'desc' => 'ترکیب دست‌چین پسته، بادام، فندق و کشمش؛ تازه بوداده.', 'rate' => '۴٫۹', 'reviews' => '۳۱۸', 'old_price' => 1480000, 'price' => 1290000 ),
	array( 'cat' => 'برنج', 'cat_icon' => 'fa-bowl-rice', 'cat_tone' => 'text-green', 'name' => 'برنج طارم هاشمی معطر', 'desc' => 'عطر بی‌نظیر و پخت قلمی؛ انتخابِ همیشگی سفره‌های ایرانی.', 'rate' => '۴٫۹', 'reviews' => '۷۶', 'old_price' => 820000, 'price' => 690000 ),
	array( 'cat' => 'خشکبار', 'cat_icon' => 'fa-apple-whole', 'cat_tone' => 'text-clay', 'name' => 'خرمای مضافتی بم درجه‌یک', 'desc' => 'نرم، شهدی و تازه؛ بسته‌بندی بهداشتی برای ماندگاری بیشتر.', 'rate' => '۴٫۸', 'reviews' => '۱۳۹', 'old_price' => 0, 'price' => 268000 ),
);

/* --- دسته‌بندی‌های اسلایدر بالا --- */
$dz_cats = array(
	array( 'slug' => 'rice',   'icon' => 'fa-bowl-rice',     'tone' => 'bg-green text-white group-hover/cat:bg-green-deep', 'name' => 'برنج',   'sub' => 'هاشمی، طارم، دم‌سیاه' ),
	array( 'slug' => 'legume', 'icon' => 'fa-seedling',      'tone' => 'bg-clay text-white group-hover/cat:bg-clay-deep',   'name' => 'حبوبات', 'sub' => 'لوبیا، عدس، نخود' ),
	array( 'slug' => 'nuts',   'icon' => 'fa-apple-whole',   'tone' => 'bg-green text-white group-hover/cat:bg-green-deep', 'name' => 'خشکبار', 'sub' => 'برگه، توت، خرما' ),
	array( 'slug' => 'tea',    'icon' => 'fa-mug-hot',       'tone' => 'bg-gold text-white group-hover/cat:bg-gold-deep',   'name' => 'چای',    'sub' => 'چای و دمنوش گیاهی' ),
	array( 'slug' => 'spice',  'icon' => 'fa-mortar-pestle', 'tone' => 'bg-green text-white group-hover/cat:bg-green-deep', 'name' => 'ادویه',  'sub' => 'زعفران، دارچین، هل' ),
	array( 'slug' => 'ajil',   'icon' => 'fa-bowl-food',     'tone' => 'bg-gold text-white group-hover/cat:bg-gold-deep',   'name' => 'آجیل',   'sub' => 'پسته، بادام، گردو' ),
);
get_header();
?>
<main data-screen-label="home">

	<!-- 1 · HERO -->
	<section class="relative overflow-hidden min-h-[clamp(46rem,70vh,64rem)] flex items-center bg-[#16261b] border-b border-hair" data-screen-label="hero">
		<div class="absolute inset-0 dz-hero-bg" role="img" aria-label="<?php esc_attr_e( 'دشت و درختِ تنها در سپیده‌دم', 'dashtzad' ); ?>"></div>
		<div class="absolute inset-0 dz-hero-scrim"></div>
		<div class="relative z-[2] w-full mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="max-w-[60rem] text-white py-[clamp(3rem,6vw,6rem)]">
				<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] tracking-[.02em] text-white bg-white/[.14] border border-white/[.34] rounded-full px-[1.6rem] py-[.8rem] backdrop-blur-sm"><i class="fa-solid fa-wheat-awn text-honey"></i> <?php esc_html_e( 'چهار نسل اصالت از سال ۱۳۰۵', 'dashtzad' ); ?></span>
				<h1 class="font-display font-bold text-[clamp(3.6rem,6vw,6.4rem)] leading-[1.06] tracking-[-.02em] mt-[2rem] text-balance [text-shadow:0_2px_34px_oklch(.15_.03_70/.55)]"><?php esc_html_e( 'طعمِ اصیلِ ایران،', 'dashtzad' ); ?><br /><span class="text-honey"><?php esc_html_e( 'مستقیم', 'dashtzad' ); ?></span> <?php esc_html_e( 'از دلِ دشت', 'dashtzad' ); ?></h1>
				<p class="text-white/90 text-[clamp(1.55rem,1.9vw,1.9rem)] leading-[1.9] mt-[1.8rem] max-w-[48rem]"><?php esc_html_e( 'برنج، حبوبات، خشکبار، چای، ادویه و آجیل مرغوب — برداشت‌شده از باغ‌های دماوند و رسیده به سفره شما، بدون واسطه و با ضمانت اصالت دشت‌زاد.', 'dashtzad' ); ?></p>
				<div class="flex flex-wrap gap-[1.2rem] mt-[2.8rem]">
					<a class="inline-flex items-center justify-center gap-[.9rem] font-bold rounded-md text-[1.7rem] px-[2.8rem] py-[1.6rem] bg-green text-white shadow-[0_6px_18px_color-mix(in_oklch,var(--green),transparent_72%)] hover:bg-green-deep transition-all active:translate-y-px" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><i class="fa-solid fa-bag-shopping"></i> <?php esc_html_e( 'ورود به فروشگاه', 'dashtzad' ); ?></a>
					<a class="inline-flex items-center justify-center gap-[.9rem] font-bold rounded-md text-[1.7rem] px-[2.8rem] py-[1.6rem] bg-white/[.12] border-[1.5px] border-white/[.55] text-white hover:bg-white hover:text-green-deep hover:border-white transition-all active:translate-y-px" href="<?php echo esc_url( home_url( '/special-sale/' ) ); ?>"><i class="fa-solid fa-bolt"></i> <?php esc_html_e( 'فروش ویژه', 'dashtzad' ); ?></a>
				</div>
				<div class="flex flex-wrap gap-[1rem_2.4rem] mt-[2.8rem] pt-[2.4rem] border-t border-dashed border-white/30">
					<span class="inline-flex items-center gap-[.8rem] font-semibold text-[1.4rem] text-white/[.88]"><i class="fa-solid fa-leaf text-honey text-[1.6rem]"></i> <?php esc_html_e( 'طبیعی و بدون افزودنی', 'dashtzad' ); ?></span>
					<span class="inline-flex items-center gap-[.8rem] font-semibold text-[1.4rem] text-white/[.88]"><i class="fa-solid fa-shield-halved text-honey text-[1.6rem]"></i> <?php esc_html_e( 'ضمانت اصالت', 'dashtzad' ); ?></span>
					<span class="inline-flex items-center gap-[.8rem] font-semibold text-[1.4rem] text-white/[.88]"><i class="fa-solid fa-star text-honey text-[1.6rem]"></i> <?php esc_html_e( 'رضایت ۱۲٬۰۰۰+ مشتری', 'dashtzad' ); ?></span>
				</div>
			</div>
		</div>
	</section>

	<!-- 2 · CATEGORIES -->
	<section class="py-[clamp(4rem,6vw,7rem)]" data-screen-label="categories">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="flex items-end justify-between gap-[2rem] mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<div class="min-w-0">
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'دسته‌بندی‌های اصلی', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'از کجا شروع کنیم؟', 'dashtzad' ); ?></h2>
					<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]"><?php esc_html_e( 'شش خانواده اصلی محصولات دشت‌زاد — هرکدام مستقیم از تامین‌کننده مورد اعتماد ما.', 'dashtzad' ); ?></p>
				</div>
				<a class="inline-flex items-center gap-[.7rem] font-bold text-[1.45rem] text-green flex-none pb-[.4rem] whitespace-nowrap hover:text-green-deep transition-colors group/sa" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'همه محصولات', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left text-[1.3rem] group-hover/sa:-translate-x-1 transition-transform"></i></a>
			</div>
			<div class="flex gap-[clamp(1.4rem,1.8vw,2rem)] overflow-x-auto dz-no-scroll pb-[1rem] [scroll-snap-type:x_proximity]">
				<?php foreach ( $dz_cats as $dz_cat ) : ?>
					<a class="group/cat relative flex flex-col rounded-lg overflow-hidden bg-white flex-none w-[clamp(20rem,24vw,24rem)] [scroll-snap-align:start] border border-hair hover:border-green hover:shadow-card hover:-translate-y-1 transition-all" href="<?php echo esc_url( home_url( '/shop/?cat=' . $dz_cat['slug'] ) ); ?>">
						<div class="relative h-[13rem] grid place-items-center bg-[linear-gradient(155deg,var(--green-soft),#fff_88%)]"><span class="w-[7rem] h-[7rem] rounded-full <?php echo esc_attr( $dz_cat['tone'] ); ?> grid place-items-center text-[3rem] shadow-card border-[3px] border-white group-hover/cat:scale-110 group-hover/cat:-rotate-[5deg] transition-transform"><i class="fa-solid <?php echo esc_attr( $dz_cat['icon'] ); ?>"></i></span></div>
						<div class="p-[1.8rem] flex flex-col gap-[.3rem] items-center text-center"><span class="font-display font-bold text-[1.85rem]"><?php echo esc_html( $dz_cat['name'] ); ?></span><span class="text-[1.3rem] text-ink-faint"><?php echo esc_html( $dz_cat['sub'] ); ?></span><span class="mt-[1rem] inline-flex items-center gap-[.6rem] font-bold text-[1.35rem] text-green group-hover/cat:gap-[1rem] transition-all"><?php esc_html_e( 'مشاهده', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span></div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 3 · BEST SELLERS -->
	<section class="py-[clamp(4rem,6vw,7rem)] bg-surface-warm border-y border-hair" data-screen-label="best-sellers">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="flex items-end justify-between gap-[2rem] mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<div class="min-w-0">
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'محبوب‌ترین‌ها', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'محصولات پرفروش', 'dashtzad' ); ?></h2>
					<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]"><?php esc_html_e( 'آن‌چه مشتریان دشت‌زاد بیش از همه به سفره خود راه می‌دهند.', 'dashtzad' ); ?></p>
				</div>
				<a class="inline-flex items-center gap-[.7rem] font-bold text-[1.45rem] text-green flex-none pb-[.4rem] whitespace-nowrap hover:text-green-deep transition-colors group/sa" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'مشاهده همه', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left text-[1.3rem] group-hover/sa:-translate-x-1 transition-transform"></i></a>
			</div>
			<div class="flex gap-[clamp(1.6rem,2vw,2.4rem)] overflow-x-auto dz-no-scroll pb-[1rem] [scroll-snap-type:x_proximity]">
				<?php foreach ( $dz_best as $dz_p ) : ?>
					<div class="flex-none w-[clamp(22rem,24vw,26rem)] [scroll-snap-align:start]">
						<?php get_template_part( 'components/product/product-card', null, $dz_p ); ?>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- 4 · FEATURED -->
	<section class="py-[clamp(4rem,6vw,7rem)]" data-screen-label="featured">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="flex items-end justify-between gap-[2rem] mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<div class="min-w-0">
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'دست‌چینِ دشت‌زاد', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'محصولات ویژه', 'dashtzad' ); ?></h2>
					<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]"><?php esc_html_e( 'گزیده‌ای از مرغوب‌ترین محصولات فصل — محدود، ممتاز و دست‌چین‌شده.', 'dashtzad' ); ?></p>
				</div>
				<a class="inline-flex items-center gap-[.7rem] font-bold text-[1.45rem] text-green flex-none pb-[.4rem] whitespace-nowrap hover:text-green-deep transition-colors group/sa" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><?php esc_html_e( 'مشاهده همه', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left text-[1.3rem] group-hover/sa:-translate-x-1 transition-transform"></i></a>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[clamp(1.8rem,2.4vw,2.6rem)]">
				<?php
				foreach ( $dz_feat as $dz_p ) :
					$dz_p['with_desc'] = true;
					$dz_p['badges']    = array( array( 'label' => 'ویژه', 'icon' => 'fa-crown', 'type' => 'vip' ) );
					get_template_part( 'components/product/product-card', null, $dz_p );
				endforeach;
				?>
			</div>
		</div>
	</section>

	<!-- 5 · BRAND STORY -->
	<section class="py-[clamp(4rem,6vw,7rem)] bg-surface-warm border-y border-hair" data-screen-label="story">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="grid grid-cols-1 md:grid-cols-[.92fr_1.08fr] gap-[clamp(2.4rem,4vw,5rem)] items-center">
				<div class="relative order-first md:order-none">
					<?php dz_placeholder( 'عکس باغ خانوادگی دماوند یا پرتره‌ای از باغبان دشت‌زاد', 'rounded-xl h-[clamp(36rem,42vw,48rem)] shadow-pop' ); ?>
					<div class="absolute bottom-[-1.4rem] end-[-1.4rem] w-[11rem] h-[11rem] rounded-full bg-green-deep text-white grid place-items-center text-center shadow-pop border-[3px] border-gold"><b class="block font-display font-bold text-[2.8rem] leading-none num">۱۳۰۵</b><span class="block text-[1.15rem] text-white/[.82] mt-[.4rem]"><?php esc_html_e( 'سالِ آغاز', 'dashtzad' ); ?></span></div>
				</div>
				<div>
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'روایت دشت‌زاد', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4.2rem)] leading-[1.18] mt-[1.2rem] tracking-[-.01em]"><?php esc_html_e( 'چهار نسل، یک پیمان:', 'dashtzad' ); ?><br /><?php esc_html_e( 'طبیعی و دست‌نخورده', 'dashtzad' ); ?></h2>
					<p class="text-ink-soft text-[1.6rem] leading-[2] mt-[1.6rem] max-w-[58rem]"><?php esc_html_e( 'داستان دشت‌زاد از سال ۱۳۰۵ در باغ‌های دماوند آغاز شد؛ جایی که خانواده‌ای زمین را به دست خود بارور کرد و آموخت که بهترین طعم، از صبر و احترام به طبیعت به دست می‌آید.', 'dashtzad' ); ?></p>
					<p class="text-ink-soft text-[1.6rem] leading-[2] mt-[1.4rem] max-w-[58rem]"><?php esc_html_e( 'امروز همان پیمان ادامه دارد: محصول را مستقیم از باغ و مزرعه می‌گیریم، بدون واسطه و بدون افزودنی به دست شما می‌رسانیم — تا طعمی که می‌چشید، همان طعمِ اصیلِ زمین ایران باشد.', 'dashtzad' ); ?></p>
					<div class="flex items-center gap-[1.4rem] mt-[2.4rem]">
						<span class="w-[5rem] h-[5rem] rounded-full bg-green text-white grid place-items-center font-display font-bold text-[2.4rem] border-2 border-gold flex-none">د</span>
						<div><b class="block font-bold text-[1.55rem]"><?php esc_html_e( 'خانواده دشت‌زاد', 'dashtzad' ); ?></b><span class="block text-[1.3rem] text-ink-faint mt-[.2rem]"><?php esc_html_e( 'باغ‌های دماوند، از ۱۳۰۵', 'dashtzad' ); ?></span></div>
					</div>
					<div class="mt-[2.6rem]"><a class="inline-flex items-center justify-center gap-[.9rem] font-bold rounded-md text-[1.6rem] px-[2.2rem] py-[1.35rem] bg-white text-ink border-[1.5px] border-hair-strong hover:text-green hover:border-green transition-all" href="<?php echo esc_url( home_url( '/brand-story/' ) ); ?>"><i class="fa-solid fa-book-open-reader"></i> <?php esc_html_e( 'داستان کامل ما', 'dashtzad' ); ?></a></div>
				</div>
			</div>
		</div>
	</section>

	<!-- 6 · TRUST -->
	<section class="py-[clamp(4rem,6vw,7rem)]" data-screen-label="trust">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'چرا دشت‌زاد؟', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'خریدی مطمئن، از باغ تا درِ خانه', 'dashtzad' ); ?></h2>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[clamp(1.6rem,2vw,2.2rem)]">
				<div class="group/t bg-white border border-hair rounded-lg p-[2.6rem_2.2rem] hover:border-green hover:shadow-card hover:-translate-y-[3px] transition-all">
					<div class="w-[5.6rem] h-[5.6rem] rounded-md grid place-items-center bg-green-soft text-green-deep text-[2.2rem] mb-[1.8rem] group-hover/t:bg-green group-hover/t:text-white transition-colors"><i class="fa-solid fa-truck-fast"></i></div>
					<h3 class="font-display font-bold text-[1.85rem]"><?php esc_html_e( 'ارسال سریع', 'dashtzad' ); ?></h3>
					<p class="text-ink-soft text-[1.4rem] leading-[1.8] mt-[.8rem]"><?php esc_html_e( 'تهران در ۲۴ ساعت و سایر شهرها ۲ تا ۴ روز کاری؛ بسته‌بندی امن و سالم.', 'dashtzad' ); ?></p>
				</div>
				<div class="group/t bg-white border border-hair rounded-lg p-[2.6rem_2.2rem] hover:border-green hover:shadow-card hover:-translate-y-[3px] transition-all">
					<div class="w-[5.6rem] h-[5.6rem] rounded-md grid place-items-center bg-clay-soft text-clay-deep text-[2.2rem] mb-[1.8rem] group-hover/t:bg-clay group-hover/t:text-white transition-colors"><i class="fa-solid fa-shield-halved"></i></div>
					<h3 class="font-display font-bold text-[1.85rem]"><?php esc_html_e( 'ضمانت اصالت', 'dashtzad' ); ?></h3>
					<p class="text-ink-soft text-[1.4rem] leading-[1.8] mt-[.8rem]"><?php esc_html_e( 'هر محصول با تضمین کیفیت دشت‌زاد؛ طبیعی، تازه و دقیقاً همان‌که سفارش داده‌اید.', 'dashtzad' ); ?></p>
				</div>
				<div class="group/t bg-white border border-hair rounded-lg p-[2.6rem_2.2rem] hover:border-green hover:shadow-card hover:-translate-y-[3px] transition-all">
					<div class="w-[5.6rem] h-[5.6rem] rounded-md grid place-items-center bg-amber-soft text-gold-deep text-[2.2rem] mb-[1.8rem] group-hover/t:bg-gold group-hover/t:text-white transition-colors"><i class="fa-solid fa-rotate-left"></i></div>
					<h3 class="font-display font-bold text-[1.85rem]"><?php esc_html_e( 'بازگشت ۷ روزه', 'dashtzad' ); ?></h3>
					<p class="text-ink-soft text-[1.4rem] leading-[1.8] mt-[.8rem]"><?php esc_html_e( 'تا ۷ روز پس از دریافت، بدون قید و شرط امکان بازگشت کالای باز‌نشده وجود دارد.', 'dashtzad' ); ?></p>
				</div>
				<div class="group/t bg-white border border-hair rounded-lg p-[2.6rem_2.2rem] hover:border-green hover:shadow-card hover:-translate-y-[3px] transition-all">
					<div class="w-[5.6rem] h-[5.6rem] rounded-md grid place-items-center bg-green-soft text-green-deep text-[2.2rem] mb-[1.8rem] group-hover/t:bg-green group-hover/t:text-white transition-colors"><i class="fa-solid fa-headset"></i></div>
					<h3 class="font-display font-bold text-[1.85rem]"><?php esc_html_e( 'پشتیبانی همه‌روزه', 'dashtzad' ); ?></h3>
					<p class="text-ink-soft text-[1.4rem] leading-[1.8] mt-[.8rem]"><?php esc_html_e( 'کارشناسان ما همه‌روزه از ۹ تا ۲۱ پاسخ‌گوی سوال‌ها و سفارش‌های شما هستند.', 'dashtzad' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 7 · JOURNEY -->
	<section class="dz-home-journey__deco relative overflow-hidden bg-green-deep text-white py-[clamp(4rem,6vw,7rem)]" data-screen-label="farm-to-home">
		<div class="relative mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="text-center max-w-[64rem] mx-auto mb-[clamp(3rem,4vw,4.4rem)]">
				<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-honey before:rounded-[.2rem]"><?php esc_html_e( 'از دشت تا خانه', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(3rem,4vw,4.4rem)] leading-[1.14] mt-[1.2rem]"><?php esc_html_e( 'مسیرِ هر محصول، شفاف و بدون واسطه', 'dashtzad' ); ?></h2>
				<p class="text-white/80 text-[1.6rem] leading-[1.9] mt-[1.2rem]"><?php esc_html_e( 'از لحظه برداشت در باغ تا رسیدن به سفره شما، هر گام را خودمان مراقبت می‌کنیم.', 'dashtzad' ); ?></p>
			</div>
			<div class="dz-home-journey__line relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[clamp(1.6rem,2.4vw,2.8rem)]">
				<div class="group/j relative z-[1] text-center flex flex-col items-center gap-[1.2rem]">
					<span class="w-[6.8rem] h-[6.8rem] rounded-full bg-green-deep border-2 border-white/35 grid place-items-center text-[2.6rem] text-honey [box-shadow:0_0_0_.8rem_var(--green-deep)] group-hover/j:-translate-y-1 group-hover/j:border-honey transition-all"><i class="fa-solid fa-mountain-sun"></i></span>
					<span class="font-bold text-[1.2rem] tracking-[.1em] text-white/60"><?php esc_html_e( 'گام اول', 'dashtzad' ); ?></span>
					<h3 class="font-display font-bold text-[2rem]"><?php esc_html_e( 'برداشت از باغ', 'dashtzad' ); ?></h3>
					<p class="text-white/[.78] text-[1.4rem] leading-[1.8] max-w-[24rem]"><?php esc_html_e( 'محصول در اوج رسیدگی و با دست از باغ‌های دماوند چیده می‌شود.', 'dashtzad' ); ?></p>
				</div>
				<div class="group/j relative z-[1] text-center flex flex-col items-center gap-[1.2rem]">
					<span class="w-[6.8rem] h-[6.8rem] rounded-full bg-green-deep border-2 border-white/35 grid place-items-center text-[2.6rem] text-honey [box-shadow:0_0_0_.8rem_var(--green-deep)] group-hover/j:-translate-y-1 group-hover/j:border-honey transition-all"><i class="fa-solid fa-sun-plant-wilt"></i></span>
					<span class="font-bold text-[1.2rem] tracking-[.1em] text-white/60"><?php esc_html_e( 'گام دوم', 'dashtzad' ); ?></span>
					<h3 class="font-display font-bold text-[2rem]"><?php esc_html_e( 'فرآوری طبیعی', 'dashtzad' ); ?></h3>
					<p class="text-white/[.78] text-[1.4rem] leading-[1.8] max-w-[24rem]"><?php esc_html_e( 'با گرمای ملایم و بدون افزودنی، طعم و عطر طبیعی حفظ می‌شود.', 'dashtzad' ); ?></p>
				</div>
				<div class="group/j relative z-[1] text-center flex flex-col items-center gap-[1.2rem]">
					<span class="w-[6.8rem] h-[6.8rem] rounded-full bg-green-deep border-2 border-white/35 grid place-items-center text-[2.6rem] text-honey [box-shadow:0_0_0_.8rem_var(--green-deep)] group-hover/j:-translate-y-1 group-hover/j:border-honey transition-all"><i class="fa-solid fa-box-open"></i></span>
					<span class="font-bold text-[1.2rem] tracking-[.1em] text-white/60"><?php esc_html_e( 'گام سوم', 'dashtzad' ); ?></span>
					<h3 class="font-display font-bold text-[2rem]"><?php esc_html_e( 'بسته‌بندی بهداشتی', 'dashtzad' ); ?></h3>
					<p class="text-white/[.78] text-[1.4rem] leading-[1.8] max-w-[24rem]"><?php esc_html_e( 'در بسته‌بندی درب‌دار و ایمن، برای تازه‌ماندن تا آخرین لحظه.', 'dashtzad' ); ?></p>
				</div>
				<div class="group/j relative z-[1] text-center flex flex-col items-center gap-[1.2rem]">
					<span class="w-[6.8rem] h-[6.8rem] rounded-full bg-green-deep border-2 border-white/35 grid place-items-center text-[2.6rem] text-honey [box-shadow:0_0_0_.8rem_var(--green-deep)] group-hover/j:-translate-y-1 group-hover/j:border-honey transition-all"><i class="fa-solid fa-house-chimney-window"></i></span>
					<span class="font-bold text-[1.2rem] tracking-[.1em] text-white/60"><?php esc_html_e( 'گام چهارم', 'dashtzad' ); ?></span>
					<h3 class="font-display font-bold text-[2rem]"><?php esc_html_e( 'رسیدن به خانه شما', 'dashtzad' ); ?></h3>
					<p class="text-white/[.78] text-[1.4rem] leading-[1.8] max-w-[24rem]"><?php esc_html_e( 'ارسال سریع و مطمئن، مستقیم به درِ خانه در سراسر کشور.', 'dashtzad' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- 8 · REVIEWS -->
	<section class="py-[clamp(4rem,6vw,7rem)]" data-screen-label="reviews">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="flex items-end justify-between gap-[2rem] mb-[clamp(2.4rem,3.5vw,3.6rem)] flex-wrap">
				<div class="min-w-0">
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'تجربه مشتریان', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'نظرات مشتریان دشت‌زاد', 'dashtzad' ); ?></h2>
				</div>
				<div class="flex items-center gap-[1.4rem] flex-wrap">
					<span class="inline-flex items-center gap-[1rem] bg-white border border-hair rounded-full px-[1.8rem] py-[1rem] shadow-soft">
						<b class="font-display font-bold text-[2.4rem] text-green-deep num">۴٫۸</b>
						<span class="text-gold text-[1.5rem] inline-flex gap-[.2rem]"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i></span>
						<span class="text-[1.35rem] text-ink-faint"><?php esc_html_e( 'از ۱۲٬۰۰۰+ خرید', 'dashtzad' ); ?></span>
					</span>
				</div>
			</div>
			<div class="dz-review-deck">
				<div class="dz-review-deck__stage">
					<figure class="dz-review-card flex flex-col gap-[1.6rem] bg-white border border-hair rounded-lg p-[2.6rem]">
						<span class="text-gold text-[1.45rem]"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
						<blockquote class="dz-review-card__t text-[1.55rem] leading-[1.95] text-ink flex-1"><?php esc_html_e( 'واقعاً طعمش طبیعیه، اصلاً شیرینی مصنوعی نداره. بچه‌ها به‌جای پاستیل اینو می‌خورن. بسته‌بندیش هم تمیز و مرتب بود.', 'dashtzad' ); ?></blockquote>
						<figcaption class="flex items-center gap-[1.2rem] pt-[1.6rem] border-t border-hair">
							<span class="w-[4.8rem] h-[4.8rem] rounded-sm grid place-items-center flex-none bg-green-soft text-green-deep font-display font-bold text-[1.7rem]">م</span>
							<span><span class="block font-bold text-[1.55rem]">مریم احمدی</span><span class="block text-[1.3rem] text-ink-faint mt-[.2rem]">تهران · <span class="text-green font-bold inline-flex items-center gap-[.4rem]"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'خرید تاییدشده', 'dashtzad' ); ?></span></span></span>
						</figcaption>
					</figure>
					<figure class="dz-review-card flex flex-col gap-[1.6rem] bg-white border border-hair rounded-lg p-[2.6rem]">
						<span class="text-gold text-[1.45rem]"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
						<blockquote class="dz-review-card__t text-[1.55rem] leading-[1.95] text-ink flex-1"><?php esc_html_e( 'کیفیت محصول فوق‌العاده‌ست؛ تازه و خوش‌عطر. قوطی هدیه‌اش رو برای عید گرفتم، خیلی شیک بود و ارسال هم سریع انجام شد.', 'dashtzad' ); ?></blockquote>
						<figcaption class="flex items-center gap-[1.2rem] pt-[1.6rem] border-t border-hair">
							<span class="w-[4.8rem] h-[4.8rem] rounded-sm grid place-items-center flex-none bg-clay-soft text-clay-deep font-display font-bold text-[1.7rem]">ح</span>
							<span><span class="block font-bold text-[1.55rem]">حسین رضایی</span><span class="block text-[1.3rem] text-ink-faint mt-[.2rem]">اصفهان · <span class="text-green font-bold inline-flex items-center gap-[.4rem]"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'خرید تاییدشده', 'dashtzad' ); ?></span></span></span>
						</figcaption>
					</figure>
					<figure class="dz-review-card flex flex-col gap-[1.6rem] bg-white border border-hair rounded-lg p-[2.6rem]">
						<span class="text-gold text-[1.45rem]"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
						<blockquote class="dz-review-card__t text-[1.55rem] leading-[1.95] text-ink flex-1"><?php esc_html_e( 'دومین باره سفارش می‌دم. ارسالشون سریعه و محصول دقیقاً مثل عکسه. حس می‌کنی از یه باغ واقعی اومده؛ به همه پیشنهاد می‌دم.', 'dashtzad' ); ?></blockquote>
						<figcaption class="flex items-center gap-[1.2rem] pt-[1.6rem] border-t border-hair">
							<span class="w-[4.8rem] h-[4.8rem] rounded-sm grid place-items-center flex-none bg-amber-soft text-gold-deep font-display font-bold text-[1.7rem]">ع</span>
							<span><span class="block font-bold text-[1.55rem]">علی کریمی</span><span class="block text-[1.3rem] text-ink-faint mt-[.2rem]">مشهد · <span class="text-green font-bold inline-flex items-center gap-[.4rem]"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'خرید تاییدشده', 'dashtzad' ); ?></span></span></span>
						</figcaption>
					</figure>
				</div>
				<div class="flex items-center justify-center gap-[1.6rem] mt-[2.6rem]">
					<button class="dz-review-deck__prev w-[4.8rem] h-[4.8rem] rounded-full grid place-items-center bg-white border-[1.5px] border-hair-strong text-ink text-[1.6rem] flex-none hover:border-green hover:text-green hover:-translate-y-[2px] hover:shadow-soft transition-all" type="button" aria-label="<?php esc_attr_e( 'نظر قبلی', 'dashtzad' ); ?>"><i class="fa-solid fa-chevron-right"></i></button>
					<div class="dz-review-deck__dots flex items-center gap-[.8rem]"></div>
					<button class="dz-review-deck__next w-[4.8rem] h-[4.8rem] rounded-full grid place-items-center bg-white border-[1.5px] border-hair-strong text-ink text-[1.6rem] flex-none hover:border-green hover:text-green hover:-translate-y-[2px] hover:shadow-soft transition-all" type="button" aria-label="<?php esc_attr_e( 'نظر بعدی', 'dashtzad' ); ?>"><i class="fa-solid fa-chevron-left"></i></button>
				</div>
				<span class="w-full text-center text-[1.25rem] text-ink-faint mt-[1.4rem] inline-flex items-center gap-[.6rem] justify-center"><i class="fa-solid fa-hand-pointer text-clay"></i> <?php esc_html_e( 'برای دیدن نظر بعدی، کارت را بکشید یا کلیک کنید', 'dashtzad' ); ?></span>
			</div>
		</div>
	</section>

	<!-- 9 · SEASONAL BANNERS -->
	<section class="py-[clamp(4rem,6vw,7rem)] bg-surface-warm border-y border-hair" data-screen-label="seasonal">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'فصل و مناسبت', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.8rem,3.6vw,4rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'برای هر بهانه خوب', 'dashtzad' ); ?></h2>
				<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]"><?php esc_html_e( 'از سفره نوروز تا شب یلدا، هدایای سازمانی و خرید عمده — دشت‌زاد کنار شماست.', 'dashtzad' ); ?></p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-[clamp(1.6rem,2.2vw,2.4rem)]">
				<a class="group/b relative overflow-hidden rounded-xl min-h-[30rem] flex shadow-card hover:-translate-y-1 hover:shadow-pop transition-all" href="<?php echo esc_url( home_url( '/corporate-gifts/#collections' ) ); ?>">
					<div class="dz-placeholder absolute inset-0 group-hover/b:scale-105 transition-transform duration-500"><span class="dz-placeholder__label absolute start-[1.2rem] end-[1.2rem] top-[1.2rem] mx-auto w-fit">عکس سفره هفت‌سین و سبزه نوروزی</span></div>
					<div class="absolute inset-0 dz-scrim-up"></div>
					<div class="relative mt-auto p-[clamp(2.4rem,3vw,3.4rem)] text-white flex flex-col gap-[1rem]">
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.25rem] text-ink bg-honey rounded-full px-[1.2rem] py-[.5rem] w-fit"><i class="fa-solid fa-seedling"></i> <?php esc_html_e( 'ویژه نوروز', 'dashtzad' ); ?></span>
						<span class="font-display font-bold text-[clamp(2.6rem,3.2vw,3.4rem)] leading-[1.18] text-balance"><?php esc_html_e( 'سال نو را با طعم برکت آغاز کنید', 'dashtzad' ); ?></span>
						<span class="text-white/85 text-[1.5rem] leading-[1.7] max-w-[42rem]"><?php esc_html_e( 'آجیل، چای، زعفران و کالکشن‌های بهاری برای سفره سال نو و دید و بازدید عید.', 'dashtzad' ); ?></span>
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.5rem] text-white bg-white/[.14] border-[1.5px] border-white/[.34] rounded-full px-[2rem] py-[1.1rem] w-fit mt-[.8rem] group-hover/b:bg-white group-hover/b:text-green-deep group-hover/b:gap-[1.1rem] transition-all"><?php esc_html_e( 'مشاهده کالکشن نوروز', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span>
					</div>
				</a>
				<a class="group/b relative overflow-hidden rounded-xl min-h-[30rem] flex shadow-card hover:-translate-y-1 hover:shadow-pop transition-all" href="<?php echo esc_url( home_url( '/corporate-gifts/#collections' ) ); ?>">
					<div class="dz-placeholder absolute inset-0 group-hover/b:scale-105 transition-transform duration-500"><span class="dz-placeholder__label absolute start-[1.2rem] end-[1.2rem] top-[1.2rem] mx-auto w-fit">عکس شب یلدا، انار و آجیل</span></div>
					<div class="absolute inset-0 dz-scrim-up"></div>
					<div class="relative mt-auto p-[clamp(2.4rem,3vw,3.4rem)] text-white flex flex-col gap-[1rem]">
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.25rem] text-ink bg-honey rounded-full px-[1.2rem] py-[.5rem] w-fit"><i class="fa-solid fa-moon"></i> <?php esc_html_e( 'شب یلدا', 'dashtzad' ); ?></span>
						<span class="font-display font-bold text-[clamp(2.6rem,3.2vw,3.4rem)] leading-[1.18] text-balance"><?php esc_html_e( 'بلندترین شب سال، با طعم دورهمی', 'dashtzad' ); ?></span>
						<span class="text-white/85 text-[1.5rem] leading-[1.7] max-w-[42rem]"><?php esc_html_e( 'سبدهای زمستانی یلدا — آجیل، انار خشک، باسلوق و چای، برای شب‌نشینی خانوادگی.', 'dashtzad' ); ?></span>
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.5rem] text-white bg-white/[.14] border-[1.5px] border-white/[.34] rounded-full px-[2rem] py-[1.1rem] w-fit mt-[.8rem] group-hover/b:bg-white group-hover/b:text-green-deep group-hover/b:gap-[1.1rem] transition-all"><?php esc_html_e( 'مشاهده کالکشن یلدا', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span>
					</div>
				</a>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-[clamp(1.6rem,2.2vw,2.4rem)] mt-[clamp(1.6rem,2.2vw,2.4rem)]">
				<a class="group/b relative overflow-hidden rounded-xl min-h-[24rem] flex shadow-card hover:-translate-y-1 hover:shadow-pop transition-all" href="<?php echo esc_url( home_url( '/corporate-gifts/' ) ); ?>">
					<div class="dz-placeholder absolute inset-0 group-hover/b:scale-105 transition-transform duration-500"><span class="dz-placeholder__label absolute start-[1.2rem] end-[1.2rem] top-[1.2rem] mx-auto w-fit">عکس جعبه هدیه سازمانی لوکس با روبان</span></div>
					<div class="absolute inset-0 dz-scrim-up"></div>
					<div class="relative mt-auto p-[clamp(2.4rem,3vw,3.4rem)] text-white flex flex-col gap-[1rem]">
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.25rem] text-ink bg-honey rounded-full px-[1.2rem] py-[.5rem] w-fit"><i class="fa-solid fa-gift"></i> <?php esc_html_e( 'سازمانی', 'dashtzad' ); ?></span>
						<span class="font-display font-bold text-[clamp(2.6rem,3.2vw,3.4rem)] leading-[1.18] text-balance"><?php esc_html_e( 'هدایای سازمانی به نام برند شما', 'dashtzad' ); ?></span>
						<span class="text-white/85 text-[1.5rem] leading-[1.7] max-w-[42rem]"><?php esc_html_e( 'بسته‌بندی اختصاصی، درج لوگو و فاکتور رسمی — مشاوره رایگان چیدمان سبد.', 'dashtzad' ); ?></span>
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.5rem] text-white bg-white/[.14] border-[1.5px] border-white/[.34] rounded-full px-[2rem] py-[1.1rem] w-fit mt-[.8rem] group-hover/b:bg-white group-hover/b:text-green-deep group-hover/b:gap-[1.1rem] transition-all"><?php esc_html_e( 'دریافت پیش‌فاکتور', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span>
					</div>
				</a>
				<a class="group/b relative overflow-hidden rounded-xl min-h-[24rem] flex shadow-card hover:-translate-y-1 hover:shadow-pop transition-all" href="<?php echo esc_url( home_url( '/bulk-order/' ) ); ?>">
					<div class="dz-placeholder absolute inset-0 group-hover/b:scale-105 transition-transform duration-500"><span class="dz-placeholder__label absolute start-[1.2rem] end-[1.2rem] top-[1.2rem] mx-auto w-fit">عکس کیسه‌ها و بسته‌های عمده محصولات</span></div>
					<div class="absolute inset-0 dz-scrim-up"></div>
					<div class="relative mt-auto p-[clamp(2.4rem,3vw,3.4rem)] text-white flex flex-col gap-[1rem]">
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.25rem] text-ink bg-honey rounded-full px-[1.2rem] py-[.5rem] w-fit"><i class="fa-solid fa-box-open"></i> <?php esc_html_e( 'خرید عمده', 'dashtzad' ); ?></span>
						<span class="font-display font-bold text-[clamp(2.6rem,3.2vw,3.4rem)] leading-[1.18] text-balance"><?php esc_html_e( 'خرید عمده با قیمت پلکانی', 'dashtzad' ); ?></span>
						<span class="text-white/85 text-[1.5rem] leading-[1.7] max-w-[42rem]"><?php esc_html_e( 'برای رستوران، فروشگاه و مصرف بالا — هرچه بیشتر، قیمت هر واحد کمتر.', 'dashtzad' ); ?></span>
						<span class="inline-flex items-center gap-[.7rem] font-bold text-[1.5rem] text-white bg-white/[.14] border-[1.5px] border-white/[.34] rounded-full px-[2rem] py-[1.1rem] w-fit mt-[.8rem] group-hover/b:bg-white group-hover/b:text-green-deep group-hover/b:gap-[1.1rem] transition-all"><?php esc_html_e( 'استعلام قیمت عمده', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span>
					</div>
				</a>
			</div>
		</div>
	</section>

	<!-- 10 · NEWSLETTER -->
	<section class="py-[clamp(4rem,6vw,7rem)] mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]" id="newsletter">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-[clamp(2.4rem,4vw,4rem)] items-center bg-green-deep dz-home-journey__deco relative overflow-hidden rounded-xl p-[clamp(2.8rem,4vw,4.8rem)] text-white">
			<div class="relative">
				<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em]"><i class="fa-solid fa-envelope-open-text"></i> <?php esc_html_e( 'خبرنامه دشت‌زاد', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.2vw,3.6rem)] leading-[1.16] mt-[1.2rem]"><?php esc_html_e( 'هر هفته، یک دستور تازه در ایمیلت', 'dashtzad' ); ?></h2>
				<p class="text-white/80 text-[1.6rem] leading-[1.8] mt-[1.2rem] max-w-[52rem]"><?php esc_html_e( 'به خبرنامه دشت‌زاد بپیوند و گزیده بهترین مقاله‌ها، دستورهای فصلی و تخفیف‌های ویژه فروشگاه را اول از همه دریافت کن.', 'dashtzad' ); ?></p>
			</div>
			<div class="relative">
				<form class="dz-newsletter flex flex-col sm:flex-row gap-[1rem]" method="post" action="#newsletter">
					<input type="text" required autocomplete="off" placeholder="<?php esc_attr_e( 'شماره موبایل خود را وارد کنید', 'dashtzad' ); ?>" aria-label="<?php esc_attr_e( 'شماره موبایل یا ایمیل', 'dashtzad' ); ?>" dir="ltr" class="dz-newsletter__input flex-1 bg-white text-ink text-[1.5rem] rounded-md px-[1.8rem] py-[1.4rem] border-none outline-none min-w-0 placeholder:text-ink-faint text-center" />
					<button class="inline-flex items-center justify-center gap-[.9rem] font-bold rounded-md text-[1.6rem] px-[2.2rem] py-[1.4rem] bg-honey text-ink hover:bg-gold transition-all active:translate-y-px flex-none" type="submit"><i class="fa-solid fa-paper-plane"></i> <?php esc_html_e( 'عضویت', 'dashtzad' ); ?></button>
				</form>
				<p class="text-white/70 text-[1.3rem] mt-[1.2rem] inline-flex items-center gap-[.6rem]"><i class="fa-solid fa-lock"></i> <?php esc_html_e( 'شماره یا ایمیلت پیش ما امن است؛ هر وقت بخواهی لغو اشتراک کن.', 'dashtzad' ); ?></p>
				<p class="dz-newsletter__ok text-honey text-[1.4rem] mt-[1rem] hidden items-center gap-[.6rem]"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'عضویت‌ات ثبت شد! اولین شماره به‌زودی می‌رسد.', 'dashtzad' ); ?></p>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
