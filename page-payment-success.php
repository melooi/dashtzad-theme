<?php
/**
 * Template Name: پرداخت موفق
 * پیش‌نمایش — پرداخت موفق — FULL-WIDTH STANDALONE (نسخه‌ی مرجع wp/pages/).
 *
 * صفحهٔ نتیجهٔ پرداخت با هدر اختصاصی تیره و بدون فوتر سایت (طراحی متمرکز).
 * این صفحه از هدر/فوتر مشترک قالب پیروی نمی‌کند؛ یک قالب تمام‌عرض است.
 * هنگام انتقال → page-payment-success.php (بدون get_header/get_footer،
 * یا با قالب خالی). CSS اختصاصی: wp/css/payment-success.css.
 *
 * داده‌ها نمونه‌اند (شماره سفارش/مبلغ/آدرس)؛ هنگام WooCommerce از داده‌ی سفارش
 * واقعی (WC_Order) پر شوند. تصاویر: placeholder راه‌راه؛ نشان تومان: toman.svg.
 * منبع: payment-success.html (ریشه).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<!-- ============== HERO ============== -->
<header class="hero" data-screen-label="payment-success">
	<div class="wrap">
		<div class="hero__top">
			<a class="brandmark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="brandmark__seal">د</span>
				<span>
					<span class="brandmark__name">دشت‌زاد</span>
					<span class="brandmark__tag" style="display:block;">روایت یک نسل از ۱۳۰۵</span>
				</span>
			</a>
			<span class="hero__support"><i class="fa-solid fa-headset"></i> پشتیبانی سفارش‌ها — <span class="num">۰۲۱ ۹۱۰۰۲۴۰۰</span></span>
		</div>

		<div class="hero__body">
			<div class="medal">
				<span class="medal__halo"></span>
				<svg class="medal__svg" viewBox="0 0 130 130" aria-hidden="true">
					<defs>
						<linearGradient id="goldgrad" x1="0" y1="0" x2="1" y2="1">
							<stop offset="0" stop-color="#f0c252"/>
							<stop offset="1" stop-color="#a9781f"/>
						</linearGradient>
					</defs>
					<circle class="ring-bg" cx="65" cy="65" r="60"></circle>
					<circle class="ring-gold" cx="65" cy="65" r="60"></circle>
					<path class="tick" d="M45 66 L59 80 L86 49"></path>
				</svg>
				<i class="fa-solid fa-star medal__pip"></i>
				<i class="fa-solid fa-star medal__pip"></i>
				<i class="fa-solid fa-star medal__pip"></i>
			</div>

			<div class="eyebrow hero__eyebrow rise" data-d="1">پرداخت با موفقیت تأیید شد</div>
			<h1 class="hero__title rise" data-d="2">سپاس از خرید شما، <em>مریم عزیز</em></h1>
			<p class="hero__sub rise" data-d="3">سفارشتان ثبت و پرداخت تأیید شد. همین حالا برگه‌های گلابیِ دماوند را برایتان بسته‌بندی می‌کنیم؛ هر مرحله از مسیر را با پیامک به شما خبر می‌دهیم.</p>

			<div class="ordernum rise" data-d="3">
				<span class="ordernum__label">شماره سفارش</span>
				<span class="ordernum__val num" id="orderNum">DZ-۱۴۰۵۰۳۲۹</span>
				<button class="ordernum__copy" id="copyBtn"><i class="fa-regular fa-copy"></i> کپی</button>
			</div>
		</div>
	</div>

	<svg class="hero__wave" viewBox="0 0 1440 80" preserveAspectRatio="none" aria-hidden="true">
		<path fill="currentColor" d="M0,80 L0,40 L1440,40 L1440,80 Z"></path>
	</svg>
</header>

<!-- ============== STAGE ============== -->
<main class="stage">
	<div class="wrap">

		<div class="cols">

			<!-- فاکتور فروش -->
			<section class="invoice">
				<div class="seclabel">
					<h2 class="seclabel__t">فاکتور فروش</h2>
					<span class="seclabel__line"></span>
					<span class="seclabel__aside num">۲ کالا</span>
				</div>

				<div class="inv-sheet" id="invSheet">
					<div class="inv-head">
						<div class="inv-head__brand">
							<span class="inv-seal">د</span>
							<div>
								<div class="inv-brandname">دشت‌زاد</div>
								<div class="inv-brandtag">خشکبار و برگهٔ ممتاز · از ۱۳۰۵</div>
							</div>
						</div>
						<div class="inv-head__doc">
							<div class="inv-doctitle">فاکتور فروش</div>
							<div class="inv-docmeta"><span>شماره فاکتور</span><b class="num">DZ-۱۴۰۵۰۳۲۹</b></div>
							<div class="inv-docmeta"><span>تاریخ صدور</span><b class="num">۲۹ خرداد ۱۴۰۵</b></div>
						</div>
					</div>

					<div class="inv-parties">
						<div class="inv-party">
							<span class="inv-party__ic"><i class="fa-solid fa-user"></i></span>
							<div>
								<div class="inv-party__k">اطلاعات مشتری</div>
								<div class="inv-party__v">مریم احمدی</div>
								<div class="inv-party__sub num">۰۹۱۲ ۳۴۵ ۶۷۸۹ · تهران، سعادت‌آباد</div>
							</div>
						</div>
					</div>

					<table class="inv-table">
						<thead>
							<tr>
								<th class="inv-c-no">ردیف</th>
								<th class="inv-c-desc">شرح کالا</th>
								<th class="inv-c-qty">تعداد</th>
								<th class="inv-c-unit">قیمت واحد</th>
								<th class="inv-c-sum">قیمت کل</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="inv-c-no num">۱</td>
								<td class="inv-c-desc"><span class="inv-item">برگه گلابی خشک ممتاز</span><span class="inv-item__sub">۵۰۰ گرم · زیپ‌کیپ کرافت</span></td>
								<td class="inv-c-qty num">۲</td>
								<td class="inv-c-unit num">۴۶۰٬۰۰۰ <span class="toman-mark"></span></td>
								<td class="inv-c-sum num">۹۲۰٬۰۰۰ <span class="toman-mark"></span></td>
							</tr>
							<tr>
								<td class="inv-c-no num">۲</td>
								<td class="inv-c-desc"><span class="inv-item">برگه زردآلوی طلایی</span><span class="inv-item__sub">۲۵۰ گرم · زیپ‌کیپ کرافت</span></td>
								<td class="inv-c-qty num">۱</td>
								<td class="inv-c-unit num">۲۴۶٬۰۰۰ <span class="toman-mark"></span></td>
								<td class="inv-c-sum num">۲۴۶٬۰۰۰ <span class="toman-mark"></span></td>
							</tr>
						</tbody>
					</table>

					<div class="inv-foot">
						<div class="inv-stamp">
							<span class="inv-stamp__ring"><i class="fa-solid fa-check"></i></span>
							<div>
								<div class="inv-stamp__t">تسویه‌شده</div>
								<div class="inv-stamp__d">کارت ****۶۲۷۱ · کد پیگیری <span class="num">۸۲۴۵۱۹۰۳</span></div>
							</div>
						</div>
						<div class="inv-totals">
							<div class="inv-trow"><span>مجموع کالاها</span><span class="num">۱٬۱۶۶٬۰۰۰ <span class="toman-mark"></span></span></div>
							<div class="inv-trow inv-trow--save"><span>سود شما از این خرید</span><span class="num">−۱۷۶٬۰۰۰ <span class="toman-mark"></span></span></div>
							<div class="inv-trow"><span>هزینه ارسال</span><span class="inv-free">رایگان</span></div>
							<div class="inv-grand"><span>مبلغ پرداخت‌شده</span><span class="num">۹۹۰٬۰۰۰ <span class="toman-mark"></span></span></div>
						</div>
					</div>
				</div>

				<div class="inv-actions">
					<button class="btn-inv" type="button" id="downloadInvoice"><i class="fa-solid fa-file-arrow-down"></i> دانلود فاکتور (PDF)</button>
					<button class="btn-inv btn-inv--ghost" type="button" id="printInvoice"><i class="fa-solid fa-print"></i> چاپ</button>
				</div>
			</section>

			<!-- اطلاعات ارسال -->
			<section class="delivery">
				<div class="eta">
					<div class="eta__big">تحویل تا دوشنبه ۲ تیر</div>
				</div>
				<div class="eta" style="margin-top:-1.4rem;padding-bottom:0;border-bottom:none;margin-bottom:2.6rem;">
					<div class="eta__small">ارسال با پیک اختصاصی دشت‌زاد در تهران — <b>۲۴ تا ۴۸ ساعت</b> پس از آماده‌سازی.</div>
				</div>

				<ul class="track-timeline">
					<li class="track-step is-done">
						<span class="track-step__dot"><i class="fa-solid fa-check"></i></span>
						<div class="track-step__b"><div class="track-step__t">سفارش ثبت شد</div><div class="track-step__d">امروز · <span class="num">۱۰:۲۴</span></div></div>
					</li>
					<li class="track-step is-current">
						<span class="track-step__dot"><i class="fa-solid fa-box-open"></i></span>
						<div class="track-step__b"><div class="track-step__t">در حال آماده‌سازی</div><div class="track-step__d"><b>هم‌اکنون</b> · بسته‌بندی در انبار دماوند</div></div>
					</li>
					<li class="track-step is-pending">
						<span class="track-step__dot"><i class="fa-solid fa-truck"></i></span>
						<div class="track-step__b"><div class="track-step__t">تحویل به پیک</div><div class="track-step__d"><span class="num">۱</span> تیر</div></div>
					</li>
					<li class="track-step is-pending">
						<span class="track-step__dot"><i class="fa-solid fa-house"></i></span>
						<div class="track-step__b"><div class="track-step__t">تحویل به شما</div><div class="track-step__d"><span class="num">۲</span> تیر</div></div>
					</li>
				</ul>

				<div class="addr">
					<div class="addr__row">
						<div class="addr__ic"><i class="fa-solid fa-user"></i></div>
						<div>
							<div class="addr__k">گیرنده</div>
							<div class="addr__v num">مریم احمدی · ۰۹۱۲ ۳۴۵ ۶۷۸۹</div>
						</div>
					</div>
					<div class="addr__row">
						<div class="addr__ic"><i class="fa-solid fa-map-location-dot"></i></div>
						<div>
							<div class="addr__k">نشانی تحویل</div>
							<div class="addr__v">تهران، سعادت‌آباد، خیابان علامه طباطبایی شمالی، کوچه ۱۸ شرقی، پلاک ۱۲، واحد ۴ — <span class="num">کد پستی ۱۹۹۷۸۵۴۳۲۱</span></div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<!-- actions -->
		<div class="actions">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/track/' ) ); ?>"><i class="fa-solid fa-location-crosshairs"></i> پیگیری سفارش</a>
			<a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa-solid fa-arrow-right-long"></i> بازگشت به فروشگاه</a>
		</div>

		<div class="reassure">
			<span class="reassure__item"><i class="fa-solid fa-shield-halved"></i> ضمانت اصالت و <b>بازگشت ۷ روزه</b></span>
			<span class="reassure__sep"></span>
			<span class="reassure__item"><i class="fa-solid fa-receipt"></i> فاکتور به ایمیل شما ارسال شد</span>
			<span class="reassure__sep"></span>
			<span class="reassure__item"><i class="fa-solid fa-headset"></i> پشتیبانی <b>۹ تا ۲۱</b> همه‌روزه</span>
		</div>

	</div>
</main>

<div class="toast" id="toast"><i class="fa-solid fa-check"></i> شماره سفارش کپی شد</div>

<script>
	(function () {
		var copyBtn = document.getElementById('copyBtn');
		var toast = document.getElementById('toast');
		var t;
		if (!copyBtn) return;
		copyBtn.addEventListener('click', function () {
			var txt = document.getElementById('orderNum').textContent.trim();
			function flash() {
				toast.setAttribute('data-show', 'true');
				clearTimeout(t);
				t = setTimeout(function () { toast.removeAttribute('data-show'); }, 1900);
			}
			if (navigator.clipboard && navigator.clipboard.writeText) {
				navigator.clipboard.writeText(txt).then(flash, flash);
			} else { flash(); }
		});
	})();

	/* invoice → print / save as PDF */
	(function () {
		function printInvoice(){ window.print(); }
		var dl = document.getElementById('downloadInvoice');
		var pr = document.getElementById('printInvoice');
		if (dl) dl.addEventListener('click', printInvoice);
		if (pr) pr.addEventListener('click', printInvoice);
	})();

	/* order timeline → light up steps in sequence (observer when supported, with a guaranteed fallback) */
	(function () {
		var tl = document.querySelector('.track-timeline');
		if (!tl) return;
		var steps = Array.prototype.slice.call(tl.querySelectorAll('.track-step'));
		var played = false;
		function play(){
			if (played) return; played = true;
			var delay = 200;
			steps.forEach(function (step) {
				setTimeout(function () { step.classList.add('lit'); }, delay);
				delay += step.classList.contains('is-pending') ? 320 : 950;
			});
		}
		if ('IntersectionObserver' in window) {
			var io = new IntersectionObserver(function (entries) {
				entries.forEach(function (e) { if (e.isIntersecting) { play(); io.disconnect(); } });
			}, { threshold: 0.2 });
			io.observe(tl);
		}
		/* fallback: play shortly after load regardless of observer support/firing */
		setTimeout(play, 900);
	})();
</script>

<?php
get_footer();
