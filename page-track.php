<?php
/**
 * Template Name: پیگیری سفارش
 * پیش‌نمایش — پیگیری سفارش — PAGE CONTENT ONLY (نسخه‌ی مرجع wp/pages/).
 *
 * فقط «محتوای صفحه»؛ بدون get_header()/get_footer().
 * هدر/فوتر از قالب اصلی (header-main / footer-main).
 * هنگام انتقال، محتوای <main> داخل page-track.php قرار می‌گیرد.
 * CSS اختصاصی: wp/css/track.css (support / track classes) + اشتراکی wp/css/faq.css (faq-hero/fact/steps/note).
 *   → assets/css/src/04-sections/{track,faq}.css
 *
 * منبع: <?php echo esc_url( home_url( '/track/' ) ); ?> (ریشه). محتوا خط‌به‌خط منتقل شده.
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
			<span class="faq-hero__kicker"><i class="fa-solid fa-truck-fast"></i> از انبار تا درِ خانه شما</span>
			<h1 class="faq-hero__title">پیگیری سفارش</h1>
			<p class="faq-hero__sub">شماره سفارش یا شماره موبایلِ ثبت‌شده را وارد کنید تا وضعیت لحظه‌ایِ سفارش‌تان را ببینید. برای دیدن تاریخچه کامل، وارد حساب کاربری شوید.</p>
		</div>
	</div>
</section>

<!-- ============================= BODY ============================= -->
<main class="support-wrap mx-auto px-[clamp(1.6rem,4vw,4rem)]" data-screen-label="track">

	<div class="support-card">
		<div class="support-card__h">
			<span class="support-card__ic"><i class="fa-solid fa-magnifying-glass-location"></i></span>
			<div>
				<h2 class="support-card__t">وضعیت سفارش را ببینید</h2>
				<p class="support-card__n">شماره سفارش (مثلاً DZ-104592) یا شماره موبایل خود را وارد کنید</p>
			</div>
		</div>

		<form class="track-form" id="trackForm" onsubmit="return doTrack(event)">
			<input type="text" id="trackInput" placeholder="شماره سفارش یا شماره موبایل" aria-label="شماره سفارش یا موبایل" />
			<button class="btn btn--primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i> پیگیری</button>
		</form>

		<div class="track-result" id="trackResult">
			<div class="track-meta">
				<span class="faq-fact"><i class="fa-solid fa-receipt"></i> شماره سفارش: <b id="trackId">DZ-104592</b></span>
				<span class="faq-fact"><i class="fa-solid fa-box"></i> ۳ قلم کالا</span>
				<span class="faq-fact"><i class="fa-solid fa-location-dot"></i> تهران</span>
			</div>
			<div class="track-lead">ارسال با پیک اختصاصی دشت‌زاد در تهران — <b>۲۴ تا ۴۸ ساعت</b> پس از آماده‌سازی.</div>
			<ul class="track-timeline">
				<li class="track-step is-done">
					<span class="track-step__dot"><i class="fa-solid fa-check"></i></span>
					<div class="track-step__b"><div class="track-step__t">سفارش ثبت شد</div><div class="track-step__d">امروز · ۱۰:۲۴</div></div>
				</li>
				<li class="track-step is-current">
					<span class="track-step__dot"><i class="fa-solid fa-box-open"></i></span>
					<div class="track-step__b"><div class="track-step__t">در حال آماده‌سازی</div><div class="track-step__d"><b>هم‌اکنون</b> · بسته‌بندی در انبار دماوند</div></div>
				</li>
				<li class="track-step is-pending">
					<span class="track-step__dot"><i class="fa-solid fa-truck"></i></span>
					<div class="track-step__b"><div class="track-step__t">تحویل به پیک</div><div class="track-step__d">۱ تیر</div></div>
				</li>
				<li class="track-step is-pending">
					<span class="track-step__dot"><i class="fa-solid fa-house"></i></span>
					<div class="track-step__b"><div class="track-step__t">تحویل به شما</div><div class="track-step__d">۲ تیر</div></div>
				</li>
			</ul>
		</div>
	</div>

	<div class="support-card">
		<div class="support-card__h">
			<span class="support-card__ic" style="background:var(--clay-soft);color:var(--clay-deep)"><i class="fa-solid fa-circle-question"></i></span>
			<div>
				<h2 class="support-card__t">چطور سفارشم را پیگیری کنم؟</h2>
				<p class="support-card__n">دو راه ساده برای دنبال‌کردن مرسوله</p>
			</div>
		</div>
		<ul class="faq-steps">
			<li><b>۱</b><span>وارد حساب کاربری شوید و به بخش <a href="<?php echo esc_url( home_url( '/account/' ) ); ?>" style="color:var(--green);font-weight:700">سفارش‌های من</a> بروید تا وضعیت مرحله‌به‌مرحله را ببینید.</span></li>
			<li><b>۲</b><span>کد رهگیریِ پیامک‌شده را در سامانه شرکت پست/پیک وارد کنید تا موقعیت دقیق مرسوله را دنبال کنید.</span></li>
		</ul>
		<div class="faq-note" style="margin-top:1.6rem"><i class="fa-solid fa-bell"></i><span>در هر مرحله (تایید، بسته‌بندی، ارسال و تحویل) یک پیامک به‌روزرسانی دریافت می‌کنید. اگر پیگیری به نتیجه نرسید، با <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" style="color:var(--green);font-weight:700">پشتیبانی</a> تماس بگیرید.</span></div>
	</div>

</main>

<script>
(function(){
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);
})();

function dzPlayTimeline(){
	var tl = document.querySelector('#trackResult .track-timeline');
	if(!tl) return;
	var steps = Array.prototype.slice.call(tl.querySelectorAll('.track-step'));
	steps.forEach(function(s){ s.classList.remove('lit'); });
	void tl.offsetWidth;
	var delay = 150;
	steps.forEach(function(step){
		setTimeout(function(){ step.classList.add('lit'); }, delay);
		delay += step.classList.contains('is-pending') ? 320 : 950;
	});
}

function doTrack(e){
	e.preventDefault();
	var v = document.getElementById('trackInput').value.trim();
	if(!v) return false;
	var fa = '۰۱۲۳۴۵۶۷۸۹';
	var norm = v.replace(/[^۰-۹0-9]/g, '');
	var idEl = document.getElementById('trackId');
	if(/^\d/.test(v) || /[۰-۹]/.test(v)){
		idEl.textContent = 'DZ-' + (norm.slice(-6).padStart(6,'1')).replace(/[0-9]/g, function(d){ return fa[+d]; });
	} else {
		idEl.textContent = 'DZ-۱۰۴۵۹۲';
	}
	document.getElementById('trackResult').classList.add('show');
	dzPlayTimeline();
	return false;
}
</script>

<?php
get_footer();
