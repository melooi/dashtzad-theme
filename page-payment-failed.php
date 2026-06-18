<?php
/**
 * Template Name: پرداخت ناموفق
 * پیش‌نمایش — پرداخت ناموفق — FULL-WIDTH STANDALONE (نسخه‌ی مرجع wp/pages/).
 *
 * صفحهٔ نتیجهٔ پرداخت ناموفق با هدر اختصاصی تیره و بدون فوتر سایت (طراحی متمرکز).
 * این صفحه از هدر/فوتر مشترک قالب پیروی نمی‌کند؛ یک قالب تمام‌عرض است.
 * هنگام انتقال → page-payment-failed.php (بدون get_header/get_footer).
 * CSS اختصاصی: wp/css/payment-failed.css.
 *
 * پیام صادقانه و بدون فشار دروغین: «وجهی کسر نشده» و سبد «محفوظ ماند».
 * تایمر نگه‌داری سبد واقعی است (۱۵ دقیقه، localStorage)، نه تایمر جعلی فروش.
 * تصاویر: placeholder راه‌راه؛ نشان تومان: toman.svg. منبع: payment-failed.html.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<!-- ============== HERO ============== -->
<header class="hero" data-screen-label="payment-failed">
	<div class="wrap">
		<div class="hero__top">
			<a class="brandmark" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<span class="brandmark__seal">د</span>
				<span>
					<span class="brandmark__name">دشت‌زاد</span>
					<span class="brandmark__tag" style="display:block;">روایت یک نسل از ۱۳۰۵</span>
				</span>
			</a>
		</div>

		<div class="hero__body">
			<div class="medal">
				<span class="medal__halo"></span>
				<svg class="medal__svg" viewBox="0 0 130 130" aria-hidden="true">
					<defs>
						<linearGradient id="claygrad" x1="0" y1="0" x2="1" y2="1">
							<stop offset="0" stop-color="#f0a52e"/>
							<stop offset="1" stop-color="#c2410c"/>
						</linearGradient>
					</defs>
					<circle class="ring-bg" cx="65" cy="65" r="60"></circle>
					<circle class="ring-clay" cx="65" cy="65" r="60"></circle>
					<line class="bang" x1="65" y1="42" x2="65" y2="72"></line>
					<circle class="bang-dot" cx="65" cy="88" r="0.6"></circle>
				</svg>
			</div>

			<div class="eyebrow hero__eyebrow rise" data-d="1">پرداخت ناتمام ماند</div>
			<h1 class="hero__title rise" data-d="2">پرداخت کامل نشد، <em>مریم عزیز</em></h1>
			<p class="hero__sub rise" data-d="3">تراکنش از سوی بانک تأیید نشد و سفارش هنوز ثبت نشده است. نگران نباشید؛ تنها با یک تلاش دوباره، همه‌چیز دقیقاً مثل قبل برایتان آماده می‌شود.</p>

			<div class="safepill rise" data-d="3"><i class="fa-solid fa-shield-halved"></i> هیچ مبلغی از حساب شما کسر نشده است</div>
		</div>
	</div>
</header>

<!-- ============== STAGE ============== -->
<main class="stage">
	<div class="wrap">

		<!-- quick facts -->
		<div class="metastrip">
			<div class="metastrip__cell">
				<div class="metastrip__ic"><i class="fa-solid fa-circle-exclamation"></i></div>
				<div>
					<div class="metastrip__k">وضعیت پرداخت</div>
					<div class="metastrip__v">ناموفق · تأیید نشد</div>
				</div>
			</div>
			<div class="metastrip__cell">
				<div class="metastrip__ic metastrip__ic--gold"><i class="fa-solid fa-wallet"></i></div>
				<div>
					<div class="metastrip__k">مبلغ قابل پرداخت</div>
					<div class="metastrip__v"><span class="num">۹۹۰٬۰۰۰</span> <span class="toman-mark"></span> · پرداخت اینترنتی</div>
				</div>
			</div>
			<div class="metastrip__cell">
				<div class="metastrip__ic metastrip__ic--green"><i class="fa-solid fa-basket-shopping"></i></div>
				<div>
					<div class="metastrip__k">سبد خرید شما</div>
					<div class="metastrip__v"><span class="ok">محفوظ ماند</span> · <span class="num">۲ کالا</span></div>
				</div>
			</div>
		</div>

		<div class="cols">

			<!-- چه اتفاقی افتاد -->
			<section>
				<div class="seclabel">
					
					<h2 class="seclabel__t">چه پیش آمد؟</h2>
					<span class="seclabel__line"></span>
				</div>

				<div class="explain">
					<div class="explain__ic"><i class="fa-solid fa-credit-card"></i></div>
					<div>
						<div class="explain__t">پرداخت توسط درگاه بانک تأیید نشد</div>
						<div class="explain__d">روند پرداخت پیش از تکمیل متوقف شد، بنابراین سفارش ثبت نشد و وجهی هم برداشت نشد. این اتفاق معمولاً موقتی است و تلاش دوباره مشکل را حل می‌کند.</div>
						<div class="explain__code"><i class="fa-solid fa-hashtag"></i> کد پیگیری تراکنش: <b class="num" id="trackCode">PSP-۴۰۲۱۷</b><button class="explain__copy" type="button" id="copyCode" aria-label="کپی کد پیگیری"><i class="fa-regular fa-copy"></i> کپی</button></div>
					</div>
				</div>

				<div class="seclabel" style="margin-top:3.4rem;">
					
					<h2 class="seclabel__t">چند علت رایج</h2>
					<span class="seclabel__line"></span>
				</div>

				<div class="reasons">
					<div class="reason">
						<div class="reason__ic"><i class="fa-solid fa-coins"></i></div>
						<div>
							<div class="reason__t">موجودی کافی نبود</div>
							<div class="reason__d">مانده حساب یا سقف مجاز خرید روزانه کارت کفاف مبلغ سفارش را نداده است.</div>
						</div>
					</div>
					<div class="reason">
						<div class="reason__ic"><i class="fa-solid fa-clock"></i></div>
						<div>
							<div class="reason__t">رمز پویا منقضی شد</div>
							<div class="reason__d">رمز دوم یک‌بارمصرف (OTP) دیر وارد شد یا زمان آن به پایان رسید.</div>
						</div>
					</div>
					<div class="reason">
						<div class="reason__ic"><i class="fa-solid fa-wifi"></i></div>
						<div>
							<div class="reason__t">قطع ارتباط لحظه‌ای</div>
							<div class="reason__d">اتصال اینترنت یا درگاه بانک در میانه پرداخت دچار وقفه شده است.</div>
						</div>
					</div>
				</div>
			</section>

			<!-- سبد خرید محفوظ -->
			<section>
				<div class="seclabel">
					
					<h2 class="seclabel__t">سبد خرید شما</h2>
					<span class="seclabel__line"></span>
				</div>

				<div class="savedcard">
					<div class="savedcard__head">
						<i class="fa-solid fa-circle-check"></i>
						<span class="t">دست‌نخورده باقی ماند</span>
						<span class="sub num">۲ کالا</span>
					</div>
					<div class="savedcard__body">
						<div class="lines">
							<div class="line">
								<div class="line__thumb"><span>عکس برگه گلابی</span></div>
								<div class="line__body">
									<div class="line__name">برگه گلابی خشک ممتاز</div>
									<div class="line__sub">۵۰۰ گرم · زیپ‌کیپ کرافت</div>
								</div>
								<div class="line__end">
									<span class="line__qty num">۲ عدد</span>
									<span class="price num">۷۴۴٬۰۰۰ <span class="toman-mark"></span></span>
								</div>
							</div>
							<div class="line">
								<div class="line__thumb"><span>عکس برگه زردآلو</span></div>
								<div class="line__body">
									<div class="line__name">برگه زردآلوی طلایی</div>
									<div class="line__sub">۲۵۰ گرم · زیپ‌کیپ کرافت</div>
								</div>
								<div class="line__end">
									<span class="line__qty num">۱ عدد</span>
									<span class="price num">۲۴۶٬۰۰۰ <span class="toman-mark"></span></span>
								</div>
							</div>
						</div>

						<div class="savedtotal">
							<span class="k">جمع قابل پرداخت</span>
							<span class="v num">۹۹۰٬۰۰۰ <span class="toman-mark"></span></span>
						</div>
						<div class="holdcart" id="holdCart">
							<div class="holdcart__top">
								<span class="holdcart__ic"><i class="fa-solid fa-clock"></i></span>
								<div class="holdcart__b">
									<div class="holdcart__k" id="holdLabel">زمان باقی‌مانده برای نگه‌داری سبد خرید</div>
								</div>
								<span class="holdcart__clock num" id="holdClock">۱۵:۰۰</span>
							</div>
							<div class="holdcart__bar"><span class="holdcart__barfill" id="holdBar"></span></div>
						</div>
						<p class="holdnote" id="holdNote"><i class="fa-solid fa-circle-info"></i> پیش از پایان زمان، پرداخت را کامل کنید تا کالاهای سبدتان برایتان محفوظ بماند.</p>
					</div>
				</div>
			</section>
		</div>

		<!-- actions -->
		<div class="actions">
			<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/checkout/' ) ); ?>"><i class="fa-solid fa-rotate-right"></i> تلاش دوباره برای پرداخت</a>
			<a class="btn btn--ghost" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><i class="fa-solid fa-headset"></i> تماس با پشتیبانی</a>
		</div>

	</div>
</main>

<script>
	(function(){
		var clock = document.getElementById('holdClock'),
		    box = document.getElementById('holdCart'),
		    bar = document.getElementById('holdBar'),
		    note = document.getElementById('holdNote'),
		    label = document.getElementById('holdLabel');
		if(!clock) return;
		var KEY = 'dz_hold_until', DUR = 15 * 60 * 1000;
		var until = parseInt(localStorage.getItem(KEY) || '0', 10);
		if(!until || until < Date.now()){ until = Date.now() + DUR; localStorage.setItem(KEY, String(until)); }
		function fa(n){ return String(n).replace(/[0-9]/g, function(d){ return '۰۱۲۳۴۵۶۷۸۹'[d]; }); }
		function pad(n){ return n < 10 ? '0' + n : '' + n; }
		var t = setInterval(tick, 1000);
		function tick(){
			var ms = until - Date.now();
			if(ms <= 0){
				clock.textContent = '۰۰:۰۰';
				box.classList.add('expired');
				if(bar) bar.style.width = '0%';
				if(label) label.textContent = 'زمان نگه‌داری سبد به پایان رسید';
				if(note) note.innerHTML = '<i class="fa-solid fa-circle-info"></i> ممکن است برخی قیمت‌ها و موجودی‌ها به‌روزرسانی شده باشند.';
				clearInterval(t); return;
			}
			var m = Math.floor(ms / 60000), s = Math.floor((ms % 60000) / 1000);
			clock.textContent = fa(pad(m)) + ':' + fa(pad(s));
			if(bar) bar.style.width = (ms / DUR * 100) + '%';
		}
		tick();
	})();

	(function(){
		var btn = document.getElementById('copyCode');
		if(!btn) return;
		btn.addEventListener('click', function(){
			var code = document.getElementById('trackCode');
			var txt = code ? code.textContent.trim() : '';
			function done(){ btn.classList.add('copied'); btn.innerHTML = '<i class="fa-solid fa-check"></i> کپی شد'; setTimeout(function(){ btn.classList.remove('copied'); btn.innerHTML = '<i class="fa-regular fa-copy"></i> کپی'; }, 1800); }
			if(navigator.clipboard && navigator.clipboard.writeText){ navigator.clipboard.writeText(txt).then(done, done); }
			else { var ta = document.createElement('textarea'); ta.value = txt; document.body.appendChild(ta); ta.select(); try{ document.execCommand('copy'); }catch(e){} document.body.removeChild(ta); done(); }
		});
	})();
</script>

<?php
get_footer();
