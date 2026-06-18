<?php
/**
 * Template Name: تماس با ما
 * پیش‌نمایش — تماس با ما — PAGE CONTENT ONLY (نسخه‌ی مرجع wp/pages/).
 *
 * فقط «محتوای صفحه»؛ بدون get_header()/get_footer().
 * هدر/فوتر از قالب اصلی (header-main / footer-main).
 * هنگام انتقال، محتوای <main> داخل page-contact.php قرار می‌گیرد.
 * CSS اختصاصی: wp/css/contact.css (contact-*) + اشتراکی wp/css/faq.css (faq-hero).
 *   → assets/css/src/04-sections/{contact,faq}.css
 *
 * منبع: <?php echo esc_url( home_url( '/contact/' ) ); ?> + contact.css (ریشه). محتوا خط‌به‌خط منتقل شده.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<!-- ============================= HERO ============================= -->
<section class="faq-hero">
	<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
		<div class="faq-hero__inner">
			<span class="faq-hero__kicker"><i class="fa-solid fa-headset"></i> همیشه کنار شما</span>
			<h1 class="faq-hero__title">تماس با دشت‌زاد</h1>
			<p class="faq-hero__sub">برای پیگیری سفارش، مشاوره خرید، خرید عمده یا همکاری با دشت‌زاد، از راه‌های زیر با ما در ارتباط باشید. تلاش می‌کنیم در کوتاه‌ترین زمان پاسخ‌گوی شما باشیم.</p>
			<div class="faq-hero__chips">
				<a class="faq-chip" href="tel:02192002661"><i class="fa-solid fa-phone"></i> ۰۲۱-۹۲۰۰۲۶۶۱</a>
				<a class="faq-chip" href="mailto:info@dashtzad.com"><i class="fa-solid fa-envelope"></i> info@dashtzad.com</a>
				<a class="faq-chip" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>"><i class="fa-solid fa-circle-question"></i> پرسش‌های متداول</a>
			</div>
		</div>
	</div>
</section>

<!-- ============================= BODY ============================= -->
<main class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]" data-screen-label="contact">
	<div class="contact-layout">

		<!-- ===== contact form ===== -->
		<section class="contact-form-card">
			<h2 class="contact-form-card__h">فرم تماس با ما</h2>
			<p class="contact-form-card__sub">برای ارسال پیام، فرم زیر را کامل کنید. اگر موضوع پیام شما مربوط به سفارش است، شماره سفارش یا شماره موبایل ثبت‌شده را هم در متن وارد کنید تا سریع‌تر بررسی شود.</p>

			<form class="contact-form" id="contactForm" onsubmit="return submitContact(event)">
				<div class="cf-row">
					<div class="cf-field">
						<label for="cfName">نام و نام خانوادگی <span class="req">*</span></label>
						<input type="text" id="cfName" required placeholder="مثلاً زهرا رحیمی" />
					</div>
					<div class="cf-field">
						<label for="cfPhone">شماره موبایل <span class="req">*</span></label>
						<input type="tel" id="cfPhone" required inputmode="tel" placeholder="۰۹۱۲ ۰۰۰ ۰۰۰۰" />
					</div>
				</div>
				<div class="cf-row">
					<div class="cf-field">
						<label for="cfSubject">موضوع پیام <span class="req">*</span></label>
						<input type="text" id="cfSubject" required placeholder="موضوع پیام خود را بنویسید" />
					</div>
					<div class="cf-field">
						<label for="cfType">نوع درخواست <span class="req">*</span></label>
						<select id="cfType" required>
							<option value="" disabled selected>یک گزینه را انتخاب کنید</option>
							<option>پیگیری سفارش</option>
							<option>مشاوره خرید</option>
							<option>خرید عمده</option>
							<option>همکاری با دشت‌زاد</option>
							<option>انتقاد و پیشنهاد</option>
							<option>مشکل پرداخت</option>
							<option>سایر موارد</option>
						</select>
					</div>
				</div>
				<div class="cf-field">
					<label for="cfText">متن پیام <span class="req">*</span></label>
					<textarea id="cfText" required placeholder="پیام خود را این‌جا بنویسید…"></textarea>
				</div>
				<p class="cf-note"><i class="fa-solid fa-shield-heart"></i> اطلاعات شما نزد ما محفوظ است و تنها برای پاسخ‌گویی استفاده می‌شود.</p>
				<button class="btn btn--primary" type="submit"><i class="fa-solid fa-paper-plane"></i> ارسال پیام</button>
				<div class="cf-ok" id="cfOk"><i class="fa-solid fa-circle-check"></i> پیام شما ثبت شد! کارشناسان ما به‌زودی با شما تماس می‌گیرند.</div>
			</form>
		</section>

		<!-- ===== info column ===== -->
		<aside class="contact-aside">

			<div class="contact-methods">
				<a class="contact-method" href="tel:02192002661">
					<span class="contact-method__ic"><i class="fa-solid fa-phone"></i></span>
					<span><span class="contact-method__l">تلفن تماس</span><span class="contact-method__v">۰۲۱-۹۲۰۰۲۶۶۱</span></span>
				</a>
				<a class="contact-method" href="mailto:info@dashtzad.com">
					<span class="contact-method__ic"><i class="fa-solid fa-envelope"></i></span>
					<span><span class="contact-method__l">ایمیل</span><span class="contact-method__v">info@dashtzad.com</span></span>
				</a>
				<a class="contact-method" href="https://dashtzad.com" rel="nofollow">
					<span class="contact-method__ic"><i class="fa-solid fa-globe"></i></span>
					<span><span class="contact-method__l">وب‌سایت</span><span class="contact-method__v">dashtzad.com</span></span>
				</a>
			</div>

			<div class="contact-social">
				<div class="contact-social__h"><i class="fa-solid fa-share-nodes"></i> ما را در شبکه‌های اجتماعی دنبال کنید</div>
				<div class="contact-social__grid">
					<a class="social-chip" href="#" rel="nofollow"><span class="social-chip__ic"><i class="fa-brands fa-telegram"></i></span> تلگرام</a>
					<a class="social-chip" href="#" rel="nofollow"><span class="social-chip__ic">ا</span> ایتا</a>
					<a class="social-chip" href="#" rel="nofollow"><span class="social-chip__ic">ب</span> بله</a>
					<a class="social-chip" href="#" rel="nofollow"><span class="social-chip__ic">ر</span> روبیکا</a>
					<a class="social-chip" href="#" rel="nofollow"><span class="social-chip__ic"><i class="fa-brands fa-instagram"></i></span> اینستاگرام</a>
				</div>
				<p style="margin-top:1.3rem;font-size:1.3rem;color:var(--ink-faint)">شناسه ما در همه شبکه‌ها: <b style="color:var(--ink)">@dashtzad</b></p>
			</div>

			<div class="contact-info-card">
				<div class="contact-info-card__h"><i class="fa-solid fa-location-dot"></i> آدرس دشت‌زاد</div>
				<p>تهران، پیروزی، خیابان نبرد شمالی، کوچه خزایی، پلاک ۱، واحد ۶</p>
				<div class="contact-hours"><i class="fa-regular fa-clock"></i> ساعت پاسخ‌گویی: شنبه تا پنج‌شنبه، ۹ تا ۲۱</div>
				<div class="contact-map"><div class="ph"><span class="ph__label">نقشه موقعیت دشت‌زاد — این‌جا قرار می‌گیرد</span></div></div>
			</div>

			<a class="link-card" href="<?php echo esc_url( home_url( '/track/' ) ); ?>">
				<span class="link-card__ic"><i class="fa-solid fa-truck-fast"></i></span>
				<span class="link-card__b">
					<span class="link-card__t">پیگیری سریع سفارش</span>
					<span class="link-card__d">وضعیت سفارش خود را با شماره سفارش یا موبایل دنبال کنید.</span>
				</span>
				<i class="fa-solid fa-angle-left link-card__arrow"></i>
			</a>

			<a class="link-card link-card--clay" href="<?php echo esc_url( home_url( '/bulk-order/' ) ); ?>">
				<span class="link-card__ic"><i class="fa-solid fa-handshake"></i></span>
				<span class="link-card__b">
					<span class="link-card__t">خرید عمده و همکاری</span>
					<span class="link-card__d">قیمت ویژه، فاکتور رسمی و هدایای سازمانی برای کسب‌وکارها.</span>
				</span>
				<i class="fa-solid fa-angle-left link-card__arrow"></i>
			</a>

		</aside>
	</div>
</main>

<script>
(function(){
	/* ارتفاع هدر چسبان → --hdr-h (بی‌ضرر اگر استفاده نشود) */
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);
})();

function submitContact(e){
	e.preventDefault();
	var form = document.getElementById('contactForm');
	var ok = document.getElementById('cfOk');
	form.querySelectorAll('input, select, textarea').forEach(function(el){ el.value = ''; el.selectedIndex = 0; });
	ok.classList.add('show');
	setTimeout(function(){ ok.classList.remove('show'); }, 6000);
	return false;
}
</script>

<?php
get_footer();
