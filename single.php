<?php
/**
 * single.php — Single blog post (یک نوشته‌ی مجله).
 *
 * تک‌نوشته‌ی مجله. هدر/فوتر از قالب می‌آید (header-blog / footer-blog از طریق
 * dz_is_blog_context()). محتوای طراحی‌شده اینجاست؛ منتقل‌شده از مرجع wp/pages/blog-single.php.
 * CSS: assets/css/src/04-sections/blog-single.css (در input.css ایمپورت شده).
 *
 * NOTE: متن مقاله و محصولِ پیشنهادی فعلاً نمونه‌اند. در مرحله‌ی بعد:
 *       - تیتر/تاریخ/نویسنده/محتوا با the_title()/the_date()/the_author()/the_content()
 *       - محصول مرتبط و نوشته‌های مرتبط از متادیتا یا کوئری.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- محصول مرتبط (سایدبار) --- */
$dz_related_product = array(
	'cat' => 'حبوبات', 'cat_icon' => 'fa-seedling', 'cat_tone' => 'text-green',
	'name' => 'لپه‌ی درشت دماوند ممتاز', 'rate' => '۴٫۸', 'reviews' => '۱۹۶',
	'old_price' => 0, 'price' => 168000,
);

/* --- نوشته‌های مرتبط --- */
$dz_related = array(
	array( 'cat' => 'دستور پخت', 'cat_icon' => 'fa-utensils', 'tone' => 'bg-clay-soft text-clay-deep', 'title' => 'راز ته‌دیگِ طلایی و ترد بدون چسبیدن', 'read' => '۶ دقیقه' ),
	array( 'cat' => 'راهنمای خرید', 'cat_icon' => 'fa-magnifying-glass', 'tone' => 'bg-green-soft text-green-deep', 'title' => 'چطور برنج مرغوب را از روی ظاهر بشناسیم؟', 'read' => '۸ دقیقه' ),
	array( 'cat' => 'فرهنگ غذا', 'cat_icon' => 'fa-book-open', 'tone' => 'bg-green-soft text-green-deep', 'title' => 'سفره‌ی نوروزی؛ از هفت‌سین تا سبزی‌پلو با ماهی', 'read' => '۸ دقیقه' ),
);

get_header();
?>
<main data-screen-label="blog-single">

	<!-- breadcrumb -->
	<nav class="dz-crumb" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'dashtzad' ); ?>">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<ol class="dz-crumb__list">
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><i class="fa-solid fa-book-open"></i> <?php esc_html_e( 'مجله', 'dashtzad' ); ?></a></li>
				<li aria-hidden="true"><i class="fa-solid fa-angle-left"></i></li>
				<li><a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>"><?php esc_html_e( 'دستور پخت', 'dashtzad' ); ?></a></li>
				<li aria-hidden="true"><i class="fa-solid fa-angle-left"></i></li>
				<li aria-current="page"><?php esc_html_e( 'قورمه‌سبزی جا‌افتاده', 'dashtzad' ); ?></li>
			</ol>
		</div>
	</nav>

	<!-- article header -->
	<header class="dz-art-head">
		<div class="mx-auto max-w-[82rem] px-[clamp(1.6rem,4vw,4rem)]">
			<span class="dz-tag dz-tag--clay"><i class="fa-solid fa-utensils"></i> <?php esc_html_e( 'دستور پخت', 'dashtzad' ); ?></span>
			<h1 class="dz-art-title"><?php esc_html_e( 'فوت‌وفنِ یک قورمه‌سبزیِ جا‌افتاده؛ از سبزی تا لیموعمانی', 'dashtzad' ); ?></h1>
			<p class="dz-art-lead"><?php esc_html_e( 'قورمه‌سبزی بیش از یک خورش است؛ صبر می‌خواهد و ترتیب. در این نوشته قدم‌به‌قدم می‌رویم تا یک قورمه‌ی خوش‌رنگ، خوش‌عطر و جا‌افتاده داشته باشیم.', 'dashtzad' ); ?></p>
			<div class="dz-art-meta">
				<span class="dz-byline"><span class="dz-byline__av">س</span> <span><b><?php esc_html_e( 'سمیرا توکلی', 'dashtzad' ); ?></b><span class="dz-byline__role"><?php esc_html_e( 'سردبیر مجله دشت‌زاد', 'dashtzad' ); ?></span></span></span>
				<span class="dz-art-meta__sep" aria-hidden="true"></span>
				<span><i class="fa-regular fa-calendar"></i> <?php esc_html_e( '۲۸ بهمن ۱۴۰۴', 'dashtzad' ); ?></span>
				<span><i class="fa-regular fa-clock"></i> <?php esc_html_e( '۱۰ دقیقه مطالعه', 'dashtzad' ); ?></span>
			</div>
		</div>
	</header>

	<!-- featured image -->
	<figure class="dz-art-figure">
		<div class="mx-auto max-w-[100rem] px-[clamp(1.6rem,4vw,4rem)]">
			<?php dz_placeholder( 'عکس شاخصِ نوشته — قابلمه‌ی قورمه‌سبزی روی اجاق', 'rounded-xl h-[clamp(26rem,42vw,48rem)] shadow-card' ); ?>
		</div>
	</figure>

	<!-- body + sidebar -->
	<div class="mx-auto max-w-[100rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(2.8rem,4vw,4rem)]">
		<div class="dz-art-layout">

			<!-- article body -->
			<article class="dz-prose">
				<p><?php esc_html_e( 'قورمه‌سبزی شاید محبوب‌ترین خورش سفره‌ی ایرانی باشد؛ اما تفاوت یک قورمه‌ی معمولی با یک قورمه‌ی به‌یادماندنی، در چند جزئیات کوچک پنهان است. در ادامه، مرحله‌به‌مرحله این جزئیات را مرور می‌کنیم.', 'dashtzad' ); ?></p>

				<h2><?php esc_html_e( 'سرخ‌کردن سبزی؛ مهم‌ترین مرحله', 'dashtzad' ); ?></h2>
				<p><?php esc_html_e( 'راز عطر و رنگ تیره‌ی قورمه‌سبزی در صبر هنگام سرخ‌کردن سبزی است. سبزی را با حرارت ملایم و روغن کافی آن‌قدر تفت دهید تا کاملا تیره و معطر شود. این کار ممکن است نیم‌ساعت طول بکشد، اما ارزشش را دارد.', 'dashtzad' ); ?></p>

				<blockquote><?php esc_html_e( 'سبزیِ خوب تفت‌داده، نیمی از کارِ قورمه است؛ اگر اینجا عجله کنید، هیچ ادویه‌ای جای آن را نمی‌گیرد.', 'dashtzad' ); ?></blockquote>

				<h2><?php esc_html_e( 'لپه را جداگانه بپزید', 'dashtzad' ); ?></h2>
				<p><?php esc_html_e( 'برای آن‌که لپه له نشود و خورش لعابِ یکدست بگیرد، بهتر است لپه را جداگانه نیم‌پز کنید و در اواسط پخت به خورش اضافه کنید. لپه‌ی درشت و تازه، دیرتر له می‌شود و بافت خورش را حفظ می‌کند.', 'dashtzad' ); ?></p>

				<!-- inline product recommendation -->
				<aside class="dz-prose-product">
					<div class="dz-prose-product__media dz-placeholder"><span class="dz-placeholder__label">عکس محصول</span></div>
					<div class="dz-prose-product__body">
						<span class="dz-prose-product__k"><i class="fa-solid fa-basket-shopping"></i> <?php esc_html_e( 'در این دستور استفاده شده', 'dashtzad' ); ?></span>
						<h3><?php esc_html_e( 'لپه‌ی درشت دماوند ممتاز', 'dashtzad' ); ?></h3>
						<p><?php esc_html_e( 'درشت، تازه و یکدست؛ دیر له می‌شود و بافت خورش را حفظ می‌کند.', 'dashtzad' ); ?></p>
						<div class="dz-prose-product__foot">
							<span class="dz-prose-product__price num">۱۶۸٬۰۰۰ <span><?php esc_html_e( 'تومان', 'dashtzad' ); ?></span></span>
							<a class="dz-btn dz-btn--solid" href="<?php echo esc_url( home_url( '/shop/' ) ); ?>"><i class="fa-solid fa-cart-shopping"></i> <?php esc_html_e( 'مشاهده محصول', 'dashtzad' ); ?></a>
						</div>
					</div>
				</aside>

				<h2><?php esc_html_e( 'لیموعمانی و زمان افزودن آن', 'dashtzad' ); ?></h2>
				<p><?php esc_html_e( 'لیموعمانی را اواخر پخت اضافه کنید تا تلخی‌اش به خورش منتقل نشود. چند سوراخ کوچک روی آن ایجاد کنید تا طعم و عطرش آزاد شود، اما کامل در خورش نخوابد.', 'dashtzad' ); ?></p>
				<ul>
					<li><?php esc_html_e( 'سبزی تازه و خشک‌شده را به نسبت متعادل ترکیب کنید.', 'dashtzad' ); ?></li>
					<li><?php esc_html_e( 'گوشت را پیش از افزودن سبزی، با پیاز و زردچوبه خوب تفت دهید.', 'dashtzad' ); ?></li>
					<li><?php esc_html_e( 'خورش باید دست‌کم دو ساعت با حرارت ملایم بجوشد تا جا بیفتد.', 'dashtzad' ); ?></li>
				</ul>

				<h2><?php esc_html_e( 'جمع‌بندی', 'dashtzad' ); ?></h2>
				<p><?php esc_html_e( 'قورمه‌سبزی غذای صبر است. اگر به سبزی، لپه و لیموعمانی وقت بدهید، نتیجه‌اش خورشی است خوش‌رنگ و خوش‌عطر که بوی آن خانه را پر می‌کند. نوش جان!', 'dashtzad' ); ?></p>

				<!-- tags -->
				<div class="dz-art-tags">
					<span class="dz-art-tags__l"><?php esc_html_e( 'برچسب‌ها:', 'dashtzad' ); ?></span>
					<a href="#"><?php esc_html_e( 'قورمه‌سبزی', 'dashtzad' ); ?></a>
					<a href="#"><?php esc_html_e( 'خورش ایرانی', 'dashtzad' ); ?></a>
					<a href="#"><?php esc_html_e( 'حبوبات', 'dashtzad' ); ?></a>
					<a href="#"><?php esc_html_e( 'آشپزی', 'dashtzad' ); ?></a>
				</div>

				<!-- share -->
				<div class="dz-art-share">
					<span class="dz-art-share__l"><i class="fa-solid fa-share-nodes"></i> <?php esc_html_e( 'این نوشته را هم‌رسانی کنید', 'dashtzad' ); ?></span>
					<div class="dz-art-share__row">
						<a href="#" aria-label="<?php esc_attr_e( 'تلگرام', 'dashtzad' ); ?>"><i class="fa-brands fa-telegram"></i></a>
						<a href="#" aria-label="<?php esc_attr_e( 'واتساپ', 'dashtzad' ); ?>"><i class="fa-brands fa-whatsapp"></i></a>
						<a href="#" aria-label="<?php esc_attr_e( 'اینستاگرام', 'dashtzad' ); ?>"><i class="fa-brands fa-instagram"></i></a>
						<a href="#" aria-label="<?php esc_attr_e( 'کپی پیوند', 'dashtzad' ); ?>"><i class="fa-solid fa-link"></i></a>
					</div>
				</div>

				<!-- author bio -->
				<div class="dz-art-author">
					<span class="dz-art-author__av">س</span>
					<div>
						<b class="dz-art-author__name"><?php esc_html_e( 'سمیرا توکلی', 'dashtzad' ); ?></b>
						<span class="dz-art-author__role"><?php esc_html_e( 'سردبیر مجله دشت‌زاد', 'dashtzad' ); ?></span>
						<p><?php esc_html_e( 'دوازده سال است درباره‌ی آشپزی و فرهنگ غذای ایران می‌نویسد. باور دارد بهترین دستورها همان‌هایی‌اند که نسل‌به‌نسل سر سفره‌ها زنده مانده‌اند.', 'dashtzad' ); ?></p>
					</div>
				</div>
			</article>

			<!-- sidebar -->
			<aside class="dz-art-aside">
				<div class="dz-toc" data-toc>
					<span class="dz-toc__h"><i class="fa-solid fa-list-ul"></i> <?php esc_html_e( 'فهرست مطالب', 'dashtzad' ); ?></span>
					<a href="#" class="is-active"><?php esc_html_e( 'سرخ‌کردن سبزی', 'dashtzad' ); ?></a>
					<a href="#"><?php esc_html_e( 'لپه را جداگانه بپزید', 'dashtzad' ); ?></a>
					<a href="#"><?php esc_html_e( 'لیموعمانی و زمان افزودن', 'dashtzad' ); ?></a>
					<a href="#"><?php esc_html_e( 'جمع‌بندی', 'dashtzad' ); ?></a>
				</div>

				<div class="dz-aside-product">
					<span class="dz-aside-product__k"><i class="fa-solid fa-tag"></i> <?php esc_html_e( 'محصول مرتبط', 'dashtzad' ); ?></span>
					<?php get_template_part( 'components/product/product-card', null, $dz_related_product ); ?>
				</div>
			</aside>
		</div>

		<!-- related posts -->
		<section class="dz-art-related">
			<h2 class="font-display font-bold text-[clamp(2.2rem,2.8vw,2.8rem)] mb-[clamp(2rem,3vw,2.6rem)]"><?php esc_html_e( 'نوشته‌های مرتبط', 'dashtzad' ); ?></h2>
			<div class="dz-art-related__grid">
				<?php foreach ( $dz_related as $dz_r ) : ?>
					<article class="dz-post">
						<a class="dz-post__media dz-placeholder" href="#"><span class="dz-placeholder__label absolute start-[1.2rem] bottom-[1.2rem] mx-auto w-fit">عکس نوشته</span><span class="dz-post__tag <?php echo esc_attr( $dz_r['tone'] ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_r['cat_icon'] ); ?>"></i> <?php echo esc_html( $dz_r['cat'] ); ?></span></a>
						<div class="dz-post__body">
							<h3 class="dz-post__title"><a href="#"><?php echo esc_html( $dz_r['title'] ); ?></a></h3>
							<div class="dz-post__meta"><span class="dz-post__meta-r"><i class="fa-regular fa-clock"></i> <?php echo esc_html( $dz_r['read'] ); ?></span></div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</section>
	</div>

</main>

<script>
(function () {
	function hdrH(){ var h = document.querySelector('.dz-header-blog') || document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);
})();
</script>

<?php
get_footer();
