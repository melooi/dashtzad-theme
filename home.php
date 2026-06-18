<?php
/**
 * home.php — Blog / magazine posts index (خانه مجله).
 *
 * تمپلیت ایندکس نوشته‌ها. هدر/فوتر از قالب می‌آید (header-blog / footer-blog از طریق
 * dz_is_blog_context()). محتوای طراحی‌شده اینجاست؛ منتقل‌شده از مرجع wp/pages/blog-home.php.
 * CSS: assets/css/src/04-sections/blog-home.css (در input.css ایمپورت شده).
 *
 * NOTE: نوشته‌ها فعلاً نمونه‌اند. در مرحله‌ی بعد با WP_Query / the_loop جایگزین شوند:
 *       حلقه‌ی اصلی وردپرس به‌جای آرایه‌ی $dz_posts و فیلدهای ویژه.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* --- نوشته‌های فرعیِ هیرو --- */
$dz_side = array(
	array( 'cat' => 'دستور پخت', 'cat_icon' => 'fa-utensils', 'tone' => 'text-clay', 'title' => 'راز ته‌دیگِ طلایی و ترد بدون چسبیدن', 'date' => '۲ روز پیش', 'read' => '۶ دقیقه' ),
	array( 'cat' => 'راهنمای خرید', 'cat_icon' => 'fa-magnifying-glass', 'tone' => 'text-green', 'title' => 'چطور برنج مرغوب را از روی ظاهر بشناسیم؟', 'date' => '۴ روز پیش', 'read' => '۸ دقیقه' ),
	array( 'cat' => 'دمنوش', 'cat_icon' => 'fa-mug-hot', 'tone' => 'text-gold-deep', 'title' => 'پنج دمنوش گرم برای شب‌های سرد زمستان', 'date' => '۱ هفته پیش', 'read' => '۵ دقیقه' ),
);

/* --- دسته‌های مجله --- */
$dz_cats = array(
	array( 'label' => 'همه', 'active' => true ),
	array( 'label' => 'دستور پخت', 'active' => false ),
	array( 'label' => 'راهنمای خرید', 'active' => false ),
	array( 'label' => 'سلامت و تغذیه', 'active' => false ),
	array( 'label' => 'فرهنگ غذا', 'active' => false ),
	array( 'label' => 'دمنوش و چای', 'active' => false ),
);

/* --- نوشته‌های تازه --- */
$dz_posts = array(
	array( 'cat' => 'دستور پخت', 'cat_icon' => 'fa-utensils', 'tone' => 'bg-clay-soft text-clay-deep', 'title' => 'خورش قیمه‌ی مجلسی با گوشت لخم و لپه‌ی دشت‌زاد', 'excerpt' => 'از انتخاب لپه تا جا افتادن خورش — هر آن‌چه برای یک قیمه‌ی بی‌نقص لازم دارید.', 'author' => 'سمیرا توکلی', 'date' => '۳ روز پیش', 'read' => '۷ دقیقه' ),
	array( 'cat' => 'راهنمای خرید', 'cat_icon' => 'fa-magnifying-glass', 'tone' => 'bg-green-soft text-green-deep', 'title' => 'زعفران اصل را چگونه از تقلبی تشخیص دهیم؟', 'excerpt' => 'پنج نشانه‌ی ساده که با آن‌ها هیچ‌وقت زعفران تقلبی نمی‌خرید.', 'author' => 'رضا میرزایی', 'date' => '۵ روز پیش', 'read' => '۶ دقیقه' ),
	array( 'cat' => 'سلامت و تغذیه', 'cat_icon' => 'fa-heart-pulse', 'tone' => 'bg-amber-soft text-gold-deep', 'title' => 'خواص خشکبار؛ کدام میان‌وعده برای شما بهتر است؟', 'excerpt' => 'مقایسه‌ی ارزش غذایی بادام، گردو، پسته و خرما در یک نگاه.', 'author' => 'دکتر نگار اسدی', 'date' => '۱ هفته پیش', 'read' => '۹ دقیقه' ),
	array( 'cat' => 'فرهنگ غذا', 'cat_icon' => 'fa-book-open', 'tone' => 'bg-green-soft text-green-deep', 'title' => 'سفره‌ی نوروزی؛ از هفت‌سین تا سبزی‌پلو با ماهی', 'excerpt' => 'ریشه‌ی آیین‌های غذایی نوروز و جای هر خوراک روی سفره‌ی عید.', 'author' => 'سمیرا توکلی', 'date' => '۱ هفته پیش', 'read' => '۸ دقیقه' ),
	array( 'cat' => 'دمنوش و چای', 'cat_icon' => 'fa-mug-hot', 'tone' => 'bg-amber-soft text-gold-deep', 'title' => 'دم‌کردن چای لاهیجان؛ نسبت‌ها و دمای درست', 'excerpt' => 'چای پررنگ و خوش‌عطر، بدون تلخی — راز در دما و زمان دم است.', 'author' => 'رضا میرزایی', 'date' => '۲ هفته پیش', 'read' => '۵ دقیقه' ),
	array( 'cat' => 'دستور پخت', 'cat_icon' => 'fa-utensils', 'tone' => 'bg-clay-soft text-clay-deep', 'title' => 'حلوای زعفرانی نرم و لطیف برای مهمانی', 'excerpt' => 'با چند نکته‌ی ساده، حلوایی یکدست و خوش‌عطر بپزید که همه تعریفش را کنند.', 'author' => 'سمیرا توکلی', 'date' => '۲ هفته پیش', 'read' => '۶ دقیقه' ),
);

get_header();
?>
<main data-screen-label="blog-home">

	<!-- featured hero -->
	<section class="dz-blog-hero" data-screen-label="blog-hero">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-blog-hero__head">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'پیشنهاد سردبیر', 'dashtzad' ); ?></span>
			</div>
			<div class="dz-blog-hero__grid">
				<!-- main feature -->
				<a class="dz-feature" href="<?php echo esc_url( home_url( '/blog/sample/' ) ); ?>">
					<div class="dz-feature__media dz-placeholder"><span class="dz-placeholder__label absolute start-[1.2rem] top-[1.2rem] mx-auto w-fit">عکس شاخصِ نوشته‌ی ویژه — بشقاب غذای ایرانی</span></div>
					<div class="dz-feature__scrim"></div>
					<div class="dz-feature__body">
						<span class="dz-tag dz-tag--clay"><i class="fa-solid fa-utensils"></i> <?php esc_html_e( 'دستور پخت', 'dashtzad' ); ?></span>
						<h2 class="dz-feature__title"><?php esc_html_e( 'فوت‌وفنِ یک قورمه‌سبزیِ جا‌افتاده؛ از سبزی تا لیموعمانی', 'dashtzad' ); ?></h2>
						<p class="dz-feature__excerpt"><?php esc_html_e( 'قورمه‌سبزی بیش از یک خورش است؛ صبر می‌خواهد و ترتیب. در این نوشته قدم‌به‌قدم تا یک قورمه‌ی خوش‌رنگ و خوش‌عطر همراه‌تان می‌شویم.', 'dashtzad' ); ?></p>
						<div class="dz-feature__meta">
							<span class="dz-byline"><span class="dz-byline__av">س</span> <?php esc_html_e( 'سمیرا توکلی', 'dashtzad' ); ?></span>
							<span class="dz-dot" aria-hidden="true"></span>
							<span><i class="fa-regular fa-clock"></i> <?php esc_html_e( '۱۰ دقیقه مطالعه', 'dashtzad' ); ?></span>
						</div>
					</div>
				</a>
				<!-- side list -->
				<div class="dz-blog-hero__side">
					<?php foreach ( $dz_side as $dz_s ) : ?>
						<a class="dz-side-post" href="#">
							<div class="dz-side-post__media dz-placeholder"><span class="dz-placeholder__label">عکس</span></div>
							<div class="dz-side-post__body">
								<span class="dz-side-post__cat <?php echo esc_attr( $dz_s['tone'] ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_s['cat_icon'] ); ?>"></i> <?php echo esc_html( $dz_s['cat'] ); ?></span>
								<h3 class="dz-side-post__title"><?php echo esc_html( $dz_s['title'] ); ?></h3>
								<span class="dz-side-post__meta"><?php echo esc_html( $dz_s['date'] ); ?> · <?php echo esc_html( $dz_s['read'] ); ?></span>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- AI assistant band -->
	<section class="dz-blog-ai" id="what-to-cook">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-blog-ai__inner">
				<div class="relative">
					<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em]"><i class="fa-solid fa-wand-magic-sparkles"></i> <?php esc_html_e( 'دستیار آشپزی هوشمند', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] leading-[1.16] mt-[1.2rem] text-white"><?php esc_html_e( 'امروز چی بپزم؟', 'dashtzad' ); ?></h2>
					<p class="text-white/80 text-[1.6rem] leading-[1.9] mt-[1.2rem] max-w-[52rem]"><?php esc_html_e( 'مواد داخل آشپزخانه‌ات را بنویس تا دستیار دشت‌زاد بر اساس همان، یک دستور پختِ ساده و خوش‌مزه پیشنهاد بدهد.', 'dashtzad' ); ?></p>
				</div>
				<div class="dz-blog-ai__form">
					<div class="dz-ai-field">
						<i class="fa-solid fa-basket-shopping"></i>
						<input type="text" placeholder="<?php esc_attr_e( 'مثلا: برنج، لپه، گوشت چرخ‌کرده…', 'dashtzad' ); ?>" aria-label="<?php esc_attr_e( 'مواد موجود', 'dashtzad' ); ?>" />
					</div>
					<a class="dz-btn dz-btn--honey" href="<?php echo esc_url( home_url( '/what-to-cook/' ) ); ?>"><i class="fa-solid fa-wand-magic-sparkles"></i> <?php esc_html_e( 'پیشنهاد بده', 'dashtzad' ); ?></a>
				</div>
			</div>
		</div>
	</section>

	<!-- latest posts -->
	<section class="py-[clamp(4rem,6vw,6.4rem)]" id="latest">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-blog-secthead">
				<div class="min-w-0">
					<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'تازه‌ترین‌ها', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'تازه‌ترین نوشته‌های مجله', 'dashtzad' ); ?></h2>
				</div>
				<div class="dz-blog-chips dz-no-scroll" id="categories">
					<?php foreach ( $dz_cats as $dz_c ) : ?>
						<a href="#" class="dz-blog-chip<?php echo $dz_c['active'] ? ' is-active' : ''; ?>"><?php echo esc_html( $dz_c['label'] ); ?></a>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="dz-post-grid">
				<?php foreach ( $dz_posts as $dz_p ) : ?>
					<article class="dz-post">
						<a class="dz-post__media dz-placeholder" href="#"><span class="dz-placeholder__label absolute start-[1.2rem] bottom-[1.2rem] mx-auto w-fit">عکس نوشته</span><span class="dz-post__tag <?php echo esc_attr( $dz_p['tone'] ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_p['cat_icon'] ); ?>"></i> <?php echo esc_html( $dz_p['cat'] ); ?></span></a>
						<div class="dz-post__body">
							<h3 class="dz-post__title"><a href="#"><?php echo esc_html( $dz_p['title'] ); ?></a></h3>
							<p class="dz-post__excerpt"><?php echo esc_html( $dz_p['excerpt'] ); ?></p>
							<div class="dz-post__meta">
								<span class="dz-byline"><span class="dz-byline__av"><?php echo esc_html( mb_substr( $dz_p['author'], 0, 1, 'UTF-8' ) ); ?></span> <?php echo esc_html( $dz_p['author'] ); ?></span>
								<span class="dz-post__meta-r"><i class="fa-regular fa-clock"></i> <?php echo esc_html( $dz_p['read'] ); ?></span>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="dz-blog-more">
				<a class="dz-btn dz-btn--outline" href="#"><?php esc_html_e( 'نوشته‌های بیشتر', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-down"></i></a>
			</div>
		</div>
	</section>

	<!-- newsletter -->
	<section class="py-[clamp(3.2rem,5vw,5.6rem)] mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]" id="newsletter">
		<div class="dz-blog-news">
			<div class="relative">
				<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em]"><i class="fa-solid fa-envelope-open-text"></i> <?php esc_html_e( 'خبرنامه مجله', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.4rem,3vw,3.4rem)] leading-[1.16] mt-[1.2rem] text-white"><?php esc_html_e( 'هر هفته، یک دستور تازه در ایمیلت', 'dashtzad' ); ?></h2>
				<p class="text-white/80 text-[1.55rem] leading-[1.8] mt-[1.2rem] max-w-[50rem]"><?php esc_html_e( 'به خبرنامه مجله دشت‌زاد بپیوند و گزیده بهترین مقاله‌ها و دستورهای فصلی را اول از همه دریافت کن.', 'dashtzad' ); ?></p>
			</div>
			<form class="dz-blog-news__form" method="post" action="#newsletter">
				<input type="text" required dir="ltr" placeholder="<?php esc_attr_e( 'شماره موبایل خود را وارد کنید', 'dashtzad' ); ?>" aria-label="<?php esc_attr_e( 'شماره موبایل', 'dashtzad' ); ?>" />
				<button class="dz-btn dz-btn--honey" type="submit"><i class="fa-solid fa-paper-plane"></i> <?php esc_html_e( 'عضویت', 'dashtzad' ); ?></button>
			</form>
		</div>
	</section>

</main>

<script>
(function () {
	function hdrH(){ var h = document.querySelector('.dz-header-blog') || document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);

	/* فعال‌سازی چیپ دسته (نمایشی) */
	document.querySelectorAll('.dz-blog-chip').forEach(function (c) {
		c.addEventListener('click', function (e) {
			e.preventDefault();
			document.querySelectorAll('.dz-blog-chip').forEach(function (x) { x.classList.remove('is-active'); });
			c.classList.add('is-active');
		});
	});
})();
</script>

<?php
get_footer();
