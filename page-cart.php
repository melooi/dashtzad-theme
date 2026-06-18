<?php
/**
 * Template Name: سبد خرید
 * پیش‌نمایش — سبد خرید — PAGE CONTENT ONLY (نسخه‌ی مرجع wp/pages/).
 *
 * فقط «محتوای صفحه»؛ بدون get_header()/get_footer().
 * هدر/فوتر از قالب اصلی (header-main / footer-main).
 * هنگام انتقال، محتوای <main> داخل page-cart.php قرار می‌گیرد.
 * CSS اختصاصی: wp/css/cart.css → assets/css/src/04-sections/cart.css
 *
 * بازطراحی CRO: استپر پیشرفت خرید، هشدارهای واقعی (ناموجودی/تغییر قیمت/موجودی کم)،
 * پیشنهاد محصول مکمل، زمان تقریبی ارسال، کد تخفیف جمع‌شونده، CTA «ادامه و ثبت سفارش»
 * و نوار CTA ثابت پایین موبایل. بدون دارک‌پترن/تایمر جعلی.
 *
 * منبع داده: <?php echo esc_url( home_url( '/cart/' ) ); ?> + store.js (localStorage). این‌جا با دادهٔ نمونه و JS مستقلِ
 * صفحه بازسازی شده تا بدون موتور سبد هم کار کند. هنگام WooCommerce، گریدها/مبالغ با
 * WC_Cart و لینک‌ها با permalinkها جایگزین شوند (checkout → wc_get_checkout_url()).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
get_header();
?>

<main data-screen-label="cart">

	<!-- ============================= HERO + STEPPER (هیروی تیرهٔ هم‌خانوادهٔ صفحات پرداخت) ============================= -->
	<section class="cart-hero">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] cart-hero__inner">
			<nav class="cart-hero__crumbs">
				<span class="cart-hero__eyebrow"><i class="fa-solid fa-bag-shopping"></i> بازبینی سفارش</span>
				<span aria-hidden="true" style="opacity:.4;margin:0 .2rem">|</span>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a> <i class="fa-solid fa-angle-left"></i>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">فروشگاه</a> <i class="fa-solid fa-angle-left"></i>
				<span>سبد خرید</span>
			</nav>
			<div class="cart-hero__head">
				<h1 class="cart-hero__title">سبد خرید شما</h1>
			</div>

			<!-- نوار پیشرفت خرید: سبد → اطلاعات ارسال → پرداخت -->
			<div class="steps cart-steps steps--ondark" aria-label="مراحل خرید">
				<div class="steps__item active">
					<span class="steps__dot">۱</span>
					<span class="steps__lbl">سبد خرید</span>
				</div>
				<div class="steps__line"></div>
				<div class="steps__item">
					<span class="steps__dot">۲</span>
					<span class="steps__lbl">اطلاعات ارسال</span>
				</div>
				<div class="steps__line"></div>
				<div class="steps__item">
					<span class="steps__dot">۳</span>
					<span class="steps__lbl">پرداخت</span>
				</div>
			</div>
		</div>
	</section>

	<!-- ============================= BODY ============================= -->
	<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
		<div class="cart-layout" id="cartLayout">

			<!-- ===== main: alerts + free-shipping bar + product list + cross-sell ===== -->
			<div class="cart-main" id="cartMain">

				<!-- هشدار واقعی: کالای ناموجود در سبد -->
				<div class="cart-alert cart-alert--warn" id="cartAlert" hidden>
					<i class="fa-solid fa-triangle-exclamation"></i>
					<div>
						<div class="cart-alert__t" id="cartAlertT">۱ کالا در سبد شما ناموجود شده است</div>
						<div class="cart-alert__d">برای ادامه و ثبت سفارش، کالای ناموجود را از سبد حذف کنید. مبلغ قابل پرداخت شامل این کالا نمی‌شود.</div>
					</div>
				</div>

				<div class="freebar done" id="freebar">
					<div class="freebar__top" id="freebarTop">
						<i class="fa-solid fa-truck-fast"></i>
						<span>سفارش شما <b style="color:var(--green-deep)">مشمول ارسال رایگان</b> است! 🎉</span>
					</div>
					<div class="freebar__track"><div class="freebar__fill" id="freebarFill" style="width:100%"></div></div>
				</div>

				<div class="cart-list">
					<div class="cart-list__head">
						<b>محصولات سبد (<span id="listCount">۴</span> عدد)</b>
						<button class="cart-clear" type="button" id="cartClear"><i class="fa-solid fa-trash-can"></i> خالی کردن سبد</button>
					</div>

					<!-- row 1 — تغییر قیمت نسبت به آخرین بازدید -->
					<div class="crow" data-id="rice" data-price="740000" data-old="890000" data-qty="2" data-stock="20">
						<a class="crow__media" href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="ph"><span class="ph__label">عکس برنج هاشمی</span></div></a>
						<div class="crow__info">
							<span class="crow__cat"><i class="fa-solid fa-bowl-rice"></i> برنج</span>
							<h3 class="crow__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">برنج هاشمی درجه‌یک گیلان</a></h3>
							<div class="crow__meta"><span><i class="fa-solid fa-weight-hanging"></i> ۱۰ کیلوگرم</span></div>
							<div class="crow__unit">قیمت واحد: <del>۸۹۰٬۰۰۰</del> ۷۴۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></div>
							<div class="crow__badges">
								<span class="crow__badge crow__badge--chg"><i class="fa-solid fa-arrow-trend-down"></i> قیمت کاهش یافت</span>
							</div>
						</div>
						<div class="crow__r">
							<div class="crow__price num" data-line>۱٬۴۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></div>
							<div class="crow__ctrls">
								<div class="qstep qstep--line" data-step="rice">
									<button type="button" data-act="dec" aria-label="کاهش"><i class="fa-solid fa-minus"></i></button>
									<b data-qty>۲</b>
									<button type="button" data-act="inc" aria-label="افزایش"><i class="fa-solid fa-plus"></i></button>
								</div>
								<button class="crow__remove" type="button" data-remove="rice" aria-label="حذف محصول"><i class="fa-solid fa-trash-can"></i></button>
							</div>
						</div>
					</div>

					<!-- row 2 — موجودی کم -->
					<div class="crow" data-id="saffron" data-price="980000" data-old="0" data-qty="1" data-stock="5">
						<a class="crow__media" href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="ph"><span class="ph__label">عکس زعفران سرگل</span></div></a>
						<div class="crow__info">
							<span class="crow__cat cat-label--clay"><i class="fa-solid fa-mortar-pestle"></i> ادویه و زعفران</span>
							<h3 class="crow__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">زعفران سرگل نگین قائنات</a></h3>
							<div class="crow__meta"><span><i class="fa-solid fa-weight-hanging"></i> ۴٫۶ گرم (یک مثقال)</span></div>
							<div class="crow__unit">قیمت واحد: ۹۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></div>
							<div class="crow__badges">
								<span class="crow__badge crow__badge--low"><i class="fa-solid fa-bolt"></i> تنها ۵ عدد باقی‌مانده</span>
							</div>
						</div>
						<div class="crow__r">
							<div class="crow__price num" data-line>۹۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></div>
							<div class="crow__ctrls">
								<div class="qstep qstep--line" data-step="saffron">
									<button type="button" data-act="dec" aria-label="کاهش"><i class="fa-solid fa-minus"></i></button>
									<b data-qty>۱</b>
									<button type="button" data-act="inc" aria-label="افزایش"><i class="fa-solid fa-plus"></i></button>
								</div>
								<button class="crow__remove" type="button" data-remove="saffron" aria-label="حذف محصول"><i class="fa-solid fa-trash-can"></i></button>
							</div>
						</div>
					</div>

					<!-- row 3 — عادی -->
					<div class="crow" data-id="pistachio" data-price="1120000" data-old="1280000" data-qty="1" data-stock="12">
						<a class="crow__media" href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="ph"><span class="ph__label">عکس پسته اکبری</span></div></a>
						<div class="crow__info">
							<span class="crow__cat cat-label--clay"><i class="fa-solid fa-bowl-food"></i> آجیل</span>
							<h3 class="crow__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">پسته اکبری خندان ممتاز</a></h3>
							<div class="crow__meta"><span><i class="fa-solid fa-weight-hanging"></i> ۱ کیلوگرم</span></div>
							<div class="crow__unit">قیمت واحد: <del>۱٬۲۸۰٬۰۰۰</del> ۱٬۱۲۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></div>
						</div>
						<div class="crow__r">
							<div class="crow__price num" data-line>۱٬۱۲۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></div>
							<div class="crow__ctrls">
								<div class="qstep qstep--line" data-step="pistachio">
									<button type="button" data-act="dec" aria-label="کاهش"><i class="fa-solid fa-minus"></i></button>
									<b data-qty>۱</b>
									<button type="button" data-act="inc" aria-label="افزایش"><i class="fa-solid fa-plus"></i></button>
								</div>
								<button class="crow__remove" type="button" data-remove="pistachio" aria-label="حذف محصول"><i class="fa-solid fa-trash-can"></i></button>
							</div>
						</div>
					</div>

					<!-- row 4 — ناموجود (هشدار واقعی؛ از مبلغ مستثنا) -->
					<div class="crow is-oos" data-id="sesameoil" data-price="320000" data-old="0" data-qty="1" data-stock="0" data-oos="1">
						<a class="crow__media" href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="ph"><span class="ph__label">عکس روغن کنجد</span></div></a>
						<div class="crow__info">
							<span class="crow__cat cat-label--gold"><i class="fa-solid fa-bottle-droplet"></i> روغن</span>
							<h3 class="crow__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">روغن کنجد فرابکر ارگانیک</a></h3>
							<div class="crow__meta"><span><i class="fa-solid fa-weight-hanging"></i> ۵۰۰ میلی‌لیتر</span></div>
							<div class="crow__badges">
								<span class="crow__badge crow__badge--oos"><i class="fa-solid fa-circle-xmark"></i> فعلاً ناموجود</span>
							</div>
						</div>
						<div class="crow__r">
							<div class="crow__oosmsg">از سبد حذف کنید</div>
							<button class="crow__remove" type="button" data-remove="sesameoil" aria-label="حذف محصول"><i class="fa-solid fa-trash-can"></i></button>
						</div>
					</div>

				</div>

				<!-- پیشنهاد مکمل برای افزایش ارزش سفارش -->
				<div class="xsell" id="xsell">
					<div class="xsell__head">
						<i class="fa-solid fa-wand-magic-sparkles"></i>
						<b>این‌ها را هم اضافه کنید</b>
						<span>پرفروش‌های کنار سفارش شما</span>
					</div>
					<div class="xsell__grid">
						<div class="xcard">
							<div class="xcard__media"><div class="ph"><span class="ph__label">عکس چای لاهیجان</span></div></div>
							<div class="xcard__name">چای سیاه ممتاز لاهیجان — ۴۵۰ گرم</div>
							<div class="xcard__row">
								<span class="xcard__price">۲۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></span>
								<button class="xcard__add" type="button" data-add data-id="tea" data-name="چای سیاه ممتاز لاهیجان" data-price="280000" data-img="عکس چای لاهیجان" data-cat="tea" data-cat-label="چای" data-cat-icon="fa-mug-hot" data-cat-class=" cat-label--gold" data-weight="۴۵۰ گرم" data-stock="30" aria-label="افزودن چای به سبد"><i class="fa-solid fa-plus"></i></button>
							</div>
						</div>
						<div class="xcard">
							<div class="xcard__media"><div class="ph"><span class="ph__label">عکس عسل چندگیاه</span></div></div>
							<div class="xcard__name">عسل طبیعی چندگیاه سبلان — ۱ کیلوگرم</div>
							<div class="xcard__row">
								<span class="xcard__price">۴۲۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></span>
								<button class="xcard__add" type="button" data-add data-id="honey" data-name="عسل طبیعی چندگیاه سبلان" data-price="420000" data-img="عکس عسل چندگیاه" data-cat="honey" data-cat-label="عسل" data-cat-icon="fa-jar" data-cat-class=" cat-label--gold" data-weight="۱ کیلوگرم" data-stock="18" aria-label="افزودن عسل به سبد"><i class="fa-solid fa-plus"></i></button>
							</div>
						</div>
						<div class="xcard">
							<div class="xcard__media"><div class="ph"><span class="ph__label">عکس خرمای مضافتی</span></div></div>
							<div class="xcard__name">خرمای مضافتی درجه‌یک بم — ۶۵۰ گرم</div>
							<div class="xcard__row">
								<span class="xcard__price">۱۹۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></span>
								<button class="xcard__add" type="button" data-add data-id="date" data-name="خرمای مضافتی درجه‌یک بم" data-price="190000" data-img="عکس خرمای مضافتی" data-cat="date" data-cat-label="خشکبار" data-cat-icon="fa-seedling" data-cat-class="" data-weight="۶۵۰ گرم" data-stock="40" aria-label="افزودن خرما به سبد"><i class="fa-solid fa-plus"></i></button>
							</div>
						</div>
					</div>
				</div>

			</div>

			<!-- ===== order summary ===== -->
			<aside class="summary" id="cartSummary">
				<h2 class="summary__h">خلاصه سفارش</h2>
				<div class="summary__body">
					<div class="srow"><span>جمع کالاها (<span id="sumCount">۴</span> عدد)</span><b class="num" id="sumSub">۳٬۵۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></b></div>
					<div class="srow save" id="sumSaveRow"><span><i class="fa-solid fa-tag"></i> سود شما از تخفیف</span><b class="num" id="sumSave">۴۶۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></b></div>
					<div class="srow save" id="sumPromoRow" style="display:none"><span><i class="fa-solid fa-ticket"></i> کد تخفیف</span><b class="num" id="sumPromo">− ۰ <span class="toman" role="img" aria-label="تومان"></span></b></div>
					<div class="srow"><span>هزینه ارسال (تقریبی)</span><span id="sumShip"><span class="srow__free">رایگان</span></span></div>
					<div class="srow srow--info"><span><i class="fa-solid fa-clock"></i> زمان ارسال</span><span>۲ تا ۳ روز کاری پس از ثبت سفارش</span></div>

					<div class="srow srow--total"><span>مبلغ قابل پرداخت</span><b class="num" id="sumTotal">۳٬۵۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></b></div>

					<a class="btn btn--primary btn--block summary__cta" href="<?php echo esc_url( home_url( '/checkout/' ) ); ?>" style="margin-top:1.6rem"><i class="fa-solid fa-lock"></i> ادامه و ثبت سفارش</a>
					<div class="summary__cta-note"><i class="fa-solid fa-shield-halved"></i> پرداخت امن از طریق درگاه بانکی · بدون هزینهٔ پنهان</div>

					<!-- کد تخفیف — جمع‌شونده تا صفحه شلوغ نشود -->
					<button class="promo-toggle" type="button" id="promoToggle" aria-expanded="false" aria-controls="promoWrap"><i class="fa-solid fa-ticket"></i> کد تخفیف دارید؟ <i class="fa-solid fa-chevron-down chev"></i></button>
					<div class="promo-wrap" id="promoWrap">
						<div class="promo">
							<input type="text" id="promoInput" placeholder="مثلاً DASHT10" aria-label="کد تخفیف" />
							<button type="button" id="promoApply">اعمال</button>
						</div>
						<div class="promo-msg" id="promoMsg"></div>
					</div>

					<a class="cart-back" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa-solid fa-arrow-right"></i> ادامه خرید</a>
				</div>
				<div class="summary__trust">
					<div><i class="fa-solid fa-shield-halved"></i> پرداخت امن از طریق درگاه بانکی معتبر</div>
					<div><i class="fa-solid fa-rotate-left"></i> ضمانت بازگشت ۷ روزه کالا</div>
					<div><i class="fa-solid fa-box-open"></i> بسته‌بندی امن و ارسال مطمئن</div>
					<div><i class="fa-solid fa-headset"></i> پشتیبانی همه‌روزه ۹ تا ۲۱</div>
				</div>
			</aside>

			<!-- ===== empty state ===== -->
			<div class="cart-empty" id="cartEmpty" style="display:none;grid-column:1/-1">
				<div class="cart-empty__ic"><i class="fa-solid fa-cart-shopping"></i></div>
				<h2>سبد خرید شما خالی است</h2>
				<p>هنوز محصولی به سبد اضافه نکرده‌اید. از فروشگاه دشت‌زاد دیدن کنید و طعمِ اصیلِ ایران را به سفره خود اضافه کنید.</p>
				<a class="btn btn--primary btn--lg" href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa-solid fa-store"></i> رفتن به فروشگاه</a>
			</div>

		</div>
	</div>

	<!-- ===== mobile sticky checkout bar ===== -->
	<div class="cart-mobilebar" id="cartMobilebar" hidden>
		<div class="cart-mobilebar__info">
			<span class="cart-mobilebar__lbl">مبلغ قابل پرداخت</span>
			<span class="cart-mobilebar__total num" id="mbTotal">۳٬۵۸۰٬۰۰۰ <span class="toman" role="img" aria-label="تومان"></span></span>
		</div>
		<a class="btn btn--primary" href="<?php echo esc_url( home_url( '/checkout/' ) ); ?>"><i class="fa-solid fa-lock"></i> ادامه و ثبت سفارش</a>
	</div>

</main>

<script>
(function(){
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);

	var THRESHOLD = 700000, SHIP = 40000, PROMO_RATE = 0.1;
	var PROMO_CODES = ['DASHT10', 'دشت۱۰', 'دشت10'];
	var promoActive = false;

	function toFa(n){ return String(n).replace(/[0-9]/g, function(d){ return '۰۱۲۳۴۵۶۷۸۹'[d]; }); }
	function grp(n){ return toFa(Math.round(n).toLocaleString('en-US')).replace(/,/g, '٬'); }
	function toman(s){ return s + ' <span class="toman" role="img" aria-label="تومان"></span>'; }

	var layout   = document.getElementById('cartLayout');
	var main     = document.getElementById('cartMain');
	var summary  = document.getElementById('cartSummary');
	var empty    = document.getElementById('cartEmpty');
	var mobilebar= document.getElementById('cartMobilebar');
	var alertBox = document.getElementById('cartAlert');

	function rows(){ return Array.prototype.slice.call(document.querySelectorAll('.crow')); }
	function isOOS(row){ return row.getAttribute('data-oos') === '1'; }

	function recompute(){
		var rs = rows();
		if(!rs.length){
			main.style.display = 'none';
			summary.style.display = 'none';
			mobilebar.hidden = true;
			empty.style.display = 'block';
			return;
		}
		main.style.display = '';
		summary.style.display = '';
		mobilebar.hidden = false;
		empty.style.display = 'none';

		var sub = 0, save = 0, count = 0, oosCount = 0;
		rs.forEach(function(row){
			if(isOOS(row)){ oosCount++; return; }
			var price = +row.getAttribute('data-price');
			var old   = +row.getAttribute('data-old');
			var qty   = +row.getAttribute('data-qty');
			var stock = +row.getAttribute('data-stock');
			sub += price * qty;
			count += qty;
			if(old > price) save += (old - price) * qty;
			var lineEl = row.querySelector('[data-line]'); if(lineEl) lineEl.innerHTML = toman(grp(price * qty));
			var qtyEl  = row.querySelector('[data-qty]');  if(qtyEl) qtyEl.textContent = toFa(qty);
			var inc = row.querySelector('[data-act=inc]'); if(inc) inc.disabled = qty >= stock;
		});

		// هشدار ناموجودی
		if(oosCount > 0){
			alertBox.hidden = false;
			document.getElementById('cartAlertT').textContent = toFa(oosCount) + ' کالا در سبد شما ناموجود شده است';
		} else { alertBox.hidden = true; }

		var promoDisc = promoActive ? Math.round(sub * PROMO_RATE) : 0;
		var ship = sub >= THRESHOLD ? 0 : SHIP;
		var total = sub - promoDisc + ship;

		document.getElementById('listCount').textContent = toFa(count);
		document.getElementById('sumCount').textContent = toFa(count);
		document.getElementById('sumSub').innerHTML = toman(grp(sub));

		var saveRow = document.getElementById('sumSaveRow');
		if(save > 0){ saveRow.style.display = ''; document.getElementById('sumSave').innerHTML = toman(grp(save)); }
		else saveRow.style.display = 'none';

		var promoRow = document.getElementById('sumPromoRow');
		if(promoDisc > 0){ promoRow.style.display = ''; document.getElementById('sumPromo').innerHTML = '− ' + toman(grp(promoDisc)); }
		else promoRow.style.display = 'none';

		document.getElementById('sumShip').innerHTML = ship === 0 ? '<span class="srow__free">رایگان</span>' : toman(grp(ship));
		document.getElementById('sumTotal').innerHTML = toman(grp(total));
		document.getElementById('mbTotal').innerHTML = toman(grp(total));

		// freebar
		var fb = document.getElementById('freebar'), top = document.getElementById('freebarTop'), fill = document.getElementById('freebarFill');
		var rem = Math.max(0, THRESHOLD - sub), pct = Math.min(100, Math.round(sub / THRESHOLD * 100));
		if(rem <= 0){
			fb.classList.add('done');
			top.innerHTML = '<i class="fa-solid fa-truck-fast"></i><span>سفارش شما <b style="color:var(--green-deep)">مشمول ارسال رایگان</b> است! 🎉</span>';
		} else {
			fb.classList.remove('done');
			top.innerHTML = '<i class="fa-solid fa-truck-fast"></i><span>فقط <b>' + toman(grp(rem)) + '</b> تا ارسال رایگان فاصله دارید</span>';
		}
		var fillTo = pct + '%';
		fill.style.width = '0%';
		requestAnimationFrame(function(){ requestAnimationFrame(function(){ fill.style.width = fillTo; }); });
	}

	// ساخت ردیف از دادهٔ دکمهٔ پیشنهاد مکمل
	function buildRow(d){
		var catClass = d.catClass || '';
		return '<div class="crow" data-id="' + d.id + '" data-price="' + d.price + '" data-old="0" data-qty="1" data-stock="' + d.stock + '">' +
			'<a class="crow__media" href="<?php echo esc_url( home_url( '/' ) ); ?>"><div class="ph"><span class="ph__label">' + d.img + '</span></div></a>' +
			'<div class="crow__info">' +
				'<span class="crow__cat' + catClass + '"><i class="fa-solid ' + d.catIcon + '"></i> ' + d.catLabel + '</span>' +
				'<h3 class="crow__name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">' + d.name + '</a></h3>' +
				'<div class="crow__meta"><span><i class="fa-solid fa-weight-hanging"></i> ' + d.weight + '</span></div>' +
				'<div class="crow__unit">قیمت واحد: ' + grp(d.price) + ' <span class="toman" role="img" aria-label="تومان"></span></div>' +
			'</div>' +
			'<div class="crow__r">' +
				'<div class="crow__price num" data-line>' + grp(d.price) + ' <span class="toman" role="img" aria-label="تومان"></span></div>' +
				'<div class="crow__ctrls">' +
					'<div class="qstep qstep--line" data-step="' + d.id + '">' +
						'<button type="button" data-act="dec" aria-label="کاهش"><i class="fa-solid fa-minus"></i></button>' +
						'<b data-qty>۱</b>' +
						'<button type="button" data-act="inc" aria-label="افزایش"><i class="fa-solid fa-plus"></i></button>' +
					'</div>' +
					'<button class="crow__remove" type="button" data-remove="' + d.id + '" aria-label="حذف محصول"><i class="fa-solid fa-trash-can"></i></button>' +
				'</div>' +
			'</div>' +
		'</div>';
	}

	layout.addEventListener('click', function(e){
		var btn = e.target.closest('button, a.cart-back');
		if(!btn) return;

		// استپر تعداد
		var step = btn.closest('.qstep[data-step]');
		if(step){
			var row = btn.closest('.crow');
			var qty = +row.getAttribute('data-qty');
			var stock = +row.getAttribute('data-stock');
			var act = btn.getAttribute('data-act');
			if(act === 'inc' && qty < stock) qty++;
			else if(act === 'dec'){ if(qty <= 1){ row.remove(); recompute(); return; } qty--; }
			row.setAttribute('data-qty', qty);
			recompute();
			return;
		}

		// حذف ردیف
		if(btn.hasAttribute('data-remove')){ btn.closest('.crow').remove(); recompute(); return; }

		// خالی کردن سبد
		if(btn.id === 'cartClear'){ if(confirm('همه محصولات از سبد حذف شوند؟')){ rows().forEach(function(r){ r.remove(); }); recompute(); } return; }

		// افزودن از پیشنهاد مکمل
		if(btn.hasAttribute('data-add')){
			var d = btn.dataset;
			var ex = document.querySelector('.crow[data-id="' + d.id + '"]');
			if(ex){ ex.setAttribute('data-qty', (+ex.getAttribute('data-qty')) + 1); }
			else {
				var listEl = document.querySelector('.cart-list');
				var tmp = document.createElement('div');
				tmp.innerHTML = buildRow({ id:d.id, name:d.name, price:+d.price, img:d.img, catLabel:d.catLabel, catIcon:d.catIcon, catClass:d.catClass, weight:d.weight, stock:+d.stock });
				listEl.appendChild(tmp.firstElementChild);
			}
			btn.classList.add('added'); btn.innerHTML = '<i class="fa-solid fa-check"></i>'; btn.disabled = true;
			recompute();
			return;
		}

		// کد تخفیف — نمایش/پنهان
		if(btn.id === 'promoToggle'){
			var wrap = document.getElementById('promoWrap');
			var open = wrap.classList.toggle('open');
			btn.setAttribute('aria-expanded', open ? 'true' : 'false');
			if(open) document.getElementById('promoInput').focus();
			return;
		}

		// اعمال کد تخفیف
		if(btn.id === 'promoApply'){
			var v = (document.getElementById('promoInput').value || '').trim().toUpperCase();
			var msg = document.getElementById('promoMsg');
			var ok = PROMO_CODES.map(function(c){ return c.toUpperCase(); }).indexOf(v) !== -1;
			if(ok){ promoActive = true; msg.className = 'promo-msg ok'; msg.innerHTML = '<i class="fa-solid fa-circle-check"></i> کد تخفیف ۱۰٪ اعمال شد <button type="button" id="promoRemove" style="margin-inline-start:auto;color:var(--clay);font-weight:700">حذف</button>'; }
			else { promoActive = false; msg.className = 'promo-msg err'; msg.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> کد تخفیف معتبر نیست.'; }
			recompute();
			return;
		}

		// حذف کد تخفیف
		if(btn.id === 'promoRemove'){ promoActive = false; document.getElementById('promoInput').value = ''; document.getElementById('promoMsg').className = 'promo-msg'; document.getElementById('promoMsg').innerHTML = ''; recompute(); return; }
	});

	recompute();
})();
</script>

<?php
get_footer();
