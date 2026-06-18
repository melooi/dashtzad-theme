<?php
/**
 * Template Name: قوانین و مقررات
 * پیش‌نمایش — قوانین و مقررات — PAGE CONTENT ONLY (نسخه‌ی مرجع wp/pages/).
 *
 * فقط «محتوای صفحه»؛ بدون get_header()/get_footer().
 * هدر/فوتر از قالب اصلی (header-main / footer-main).
 * هنگام انتقال، محتوای <main> داخل page-terms.php قرار می‌گیرد.
 * CSS اختصاصی: wp/css/terms.css (legal-*) + اشتراکی wp/css/faq.css (faq-*).
 *   → assets/css/src/04-sections/{terms,faq}.css
 *
 * منبع: <?php echo esc_url( home_url( '/terms/' ) ); ?> (ریشه). محتوا خط‌به‌خط منتقل شده. فایل terms.css در
 * منبع موجود نبود (۴۰۴) پس استایل legal-* تازه و هماهنگ با طرح نوشته شد.
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
		<span class="legal-updated"><i class="fa-regular fa-calendar-check"></i> آخرین به‌روزرسانی: ۱۲ خرداد ۱۴۰۵</span>
		<div class="faq-hero__inner">
			<span class="faq-hero__kicker"><i class="fa-solid fa-scale-balanced"></i> اعتماد، پایه هر خرید است</span>
			<h1 class="faq-hero__title">قوانین و مقررات</h1>
			<p class="faq-hero__sub">شرایط خرید، حساب کاربری، ارسال، مرجوعی، پرداخت و حریم خصوصی شما را این‌جا روشن و بی‌ابهام نوشته‌ایم. ثبت هر سفارش به‌منزله مطالعه و پذیرش این مقررات است.</p>
			<form class="faq-hero__search" onsubmit="return false;">
				<i class="fa-solid fa-magnifying-glass"></i>
				<input type="search" id="legalSearch" placeholder="جستجو در قوانین… مثلاً «مرجوعی» یا «حریم خصوصی»" aria-label="جستجو در قوانین" autocomplete="off" />
				<button class="faq-hero__clear" type="button" id="legalSearchClear" hidden><i class="fa-solid fa-xmark"></i> پاک کردن</button>
			</form>

			<div class="faq-hero__chips">
				<a class="faq-chip" href="#t-buy"><i class="fa-solid fa-bag-shopping"></i> شرایط خرید</a>
				<a class="faq-chip" href="#t-return"><i class="fa-solid fa-rotate-left"></i> شرایط مرجوعی</a>
				<a class="faq-chip" href="#t-privacy"><i class="fa-solid fa-user-shield"></i> حریم خصوصی</a>
			</div>
		</div>
	</div>
</section>

<!-- ============================= BODY ============================= -->
<main class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]" data-screen-label="terms">
	<div class="faq-layout">

		<!-- ===== TOC nav ===== -->
		<aside class="faq-nav" id="tocNav">
			<div class="faq-nav__h"><i class="fa-solid fa-list-ol"></i> فهرست مقررات</div>
			<a href="#t-general" data-target="t-general"><span class="faq-nav__ic"><i class="fa-solid fa-book-open"></i></span> کلیات و تعاریف</a>
			<a href="#t-account" data-target="t-account"><span class="faq-nav__ic"><i class="fa-solid fa-circle-user"></i></span> حساب کاربری و ثبت‌نام</a>
			<a href="#t-buy" data-target="t-buy"><span class="faq-nav__ic"><i class="fa-solid fa-bag-shopping"></i></span> شرایط خرید و سفارش</a>
			<a href="#t-pay" data-target="t-pay"><span class="faq-nav__ic"><i class="fa-solid fa-credit-card"></i></span> تسویه حساب</a>
			<a href="#t-ship" data-target="t-ship"><span class="faq-nav__ic"><i class="fa-solid fa-truck-fast"></i></span> حمل، تحویل و دریافت</a>
			<a href="#t-return" data-target="t-return"><span class="faq-nav__ic"><i class="fa-solid fa-rotate-left"></i></span> مرجوعی و استرداد</a>
			<a href="#t-address" data-target="t-address"><span class="faq-nav__ic"><i class="fa-solid fa-location-dot"></i></span> مسئولیت ثبت آدرس</a>
			<a href="#t-coupon" data-target="t-coupon"><span class="faq-nav__ic"><i class="fa-solid fa-ticket"></i></span> کد تخفیف</a>
			<a href="#t-ip" data-target="t-ip"><span class="faq-nav__ic"><i class="fa-solid fa-copyright"></i></span> مالکیت معنوی</a>
			<a href="#t-privacy" data-target="t-privacy"><span class="faq-nav__ic"><i class="fa-solid fa-user-shield"></i></span> حریم خصوصی</a>
			<a href="#t-comments" data-target="t-comments"><span class="faq-nav__ic"><i class="fa-solid fa-comments"></i></span> قوانین ارسال نظر</a>
			<a href="#t-force" data-target="t-force"><span class="faq-nav__ic"><i class="fa-solid fa-cloud-bolt"></i></span> قوه قهریه</a>
			<a href="#t-change" data-target="t-change"><span class="faq-nav__ic"><i class="fa-solid fa-gavel"></i></span> تغییر قوانین و اختلاف</a>
			<div class="faq-nav__sep"></div>
			<a class="faq-nav__contact" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">
				<i class="fa-solid fa-circle-question"></i>
				<span><b>پرسشی دارید؟</b><span>به پرسش‌های متداول بروید</span></span>
			</a>
		</aside>

		<!-- ===== legal prose ===== -->
		<div class="legal">

			<!-- empty state (search) -->
			<div class="faq-empty" id="legalEmpty">
				<i class="fa-regular fa-face-frown"></i>
				<p>بندی با این عبارت پیدا نشد. عبارت دیگری را امتحان کنید یا از فهرست کناری استفاده کنید.</p>
			</div>

			<div class="legal-intro">
				<p>فروشگاه دشت‌زاد (با نام حقوقی <strong>شرکت دشت‌زاد کشت و تجارت ایرانیان</strong>) متعهد است محصولاتی طبیعی و باکیفیت را با شفاف‌ترین شرایط ممکن به دست شما برساند. مقرراتی که در ادامه می‌خوانید، چارچوب همکاری ما با شماست و برای حفظ حقوق هر دو طرف تنظیم شده است.</p>
				<p>این مقررات ممکن است هر از چندی به‌روزرسانی شود؛ نسخه معتبر همان است که در زمان ثبت سفارش روی این صفحه قرار دارد.</p>
			</div>

			<!-- 1 — کلیات و تعاریف -->
			<section class="legal-sec" id="t-general">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-book-open"></i></span>
					<div>
						<h2 class="legal-sec__t">کلیات و تعاریف</h2>
						<p class="legal-sec__n">دامنه کاربرد، تعریف‌ها و پذیرش قوانین</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>استفاده از وب‌سایت دشت‌زاد و خدمات آن، برای تمام افرادی که بر اساس قوانین جمهوری اسلامی ایران اهلیت قانونی دارند، به‌شرط رعایت این قوانین مجاز است. ورود به حساب کاربری یا ثبت هر سفارش، به‌منزله آگاهی و پذیرش کامل این مقررات و جایگزین توافق‌های پیشین است.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span><strong>کاربر:</strong> شخصی که با ثبت اطلاعات خود در سایت ثبت‌نام و از خدمات استفاده می‌کند. حداقل سن قانونی برای خرید <strong>۱۸ سال</strong> یا تحت نظارت ولیّ/سرپرست قانونی است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>فروشنده:</strong> فروشگاه دشت‌زاد و هر شخص حقیقی یا حقوقی که کالای خود را در این سایت عرضه می‌کند.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>خرید از دشت‌زاد بر مبنای <strong>قوانین تجارت الکترونیکی</strong> و با رعایت کامل قوانین جاری کشور انجام می‌شود.</span></li>
					</ul>
				</div>
			</section>

			<!-- 2 — حساب کاربری و ثبت‌نام -->
			<section class="legal-sec" id="t-account">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-circle-user"></i></span>
					<div>
						<h2 class="legal-sec__t">حساب کاربری و ثبت‌نام</h2>
						<p class="legal-sec__n">ساخت حساب، صحت اطلاعات و امنیت آن</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>برای استفاده از خدمات و ثبت سفارش، داشتن حساب کاربری لازم است. ثبت‌نام با شماره موبایل و کد فعال‌سازی پیامکی انجام می‌شود.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>کاربر می‌پذیرد که اطلاعات را <strong>صحیح، کامل و به‌روز</strong> وارد کند و تنها با شماره و ایمیلِ متعلق به خود ثبت‌نام نماید.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>مسئولیت حفظ محرمانگی نام کاربری و رمز عبور با کاربر است؛ در صورت سرقت یا مفقودی، باید در سریع‌ترین زمان ممکن به دشت‌زاد اطلاع داده شود.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>حساب کاربری <strong>قائم به شخص و غیرقابل‌انتقال</strong> است و مسئولیت همه فعالیت‌های انجام‌شده از طریق آن، بر عهده‌ی دارنده‌ی حساب است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>کاربر حقوقی باید نماینده حقیقی و اطلاعات حقوقی (نام شرکت، شناسه ملی و کد اقتصادی) را معرفی کند.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>در صورت ارائه اطلاعات نادرست، دشت‌زاد می‌تواند حساب کاربری را مسدود یا از ارائه خدمات خودداری کند.</span></li>
					</ul>
				</div>
			</section>

			<!-- 3 — شرایط خرید و ثبت سفارش -->
			<section class="legal-sec" id="t-buy">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-bag-shopping"></i></span>
					<div>
						<h2 class="legal-sec__t">شرایط خرید و ثبت سفارش</h2>
						<p class="legal-sec__n">قیمت، موجودی، قرارداد الکترونیکی و سفارش</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>ثبت سفارش در دشت‌زاد به‌منزله انعقاد قرارداد الکترونیکی است. لطفاً پیش از نهایی‌کردن خرید به نکات زیر توجه کنید:</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>تمام قیمت‌ها به <strong>تومان</strong> و شامل مالیات بر ارزش افزوده است. قیمت‌ها ممکن است بدون اطلاع قبلی تغییر کند، اما سفارش ثبت‌شده با <strong>قیمت همان لحظه</strong> نهایی می‌شود.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>موجودی کالاها لحظه‌ای است و افزودن به سبد خرید به‌معنای رزرو قطعی نیست. اگر کالایی پس از پرداخت ناموجود شود، دشت‌زاد حق <strong>لغو و استرداد وجه</strong> (حداکثر ظرف ۷۲ ساعت کاری) یا پیشنهاد جایگزین را دارد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>در صورت بروز <strong>خطای آشکار در قیمت</strong>، دشت‌زاد حق بررسی، اصلاح یا ابطال سفارش و بازگرداندن وجه دریافتی را دارد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>روز کاری به‌معنای شنبه تا پنج‌شنبه به‌جز تعطیلات رسمی است. امکان ثبت سفارش به‌صورت <strong>۲۴ ساعته و ۷ روز هفته</strong> فراهم است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>تحویل در اماکن عمومی (کافه، رستوران، هتل و مانند آن) ممکن نیست؛ آدرس باید دقیق و قابل استناد باشد.</span></li>
					</ul>
				</div>
			</section>

			<!-- 4 — تسویه حساب -->
			<section class="legal-sec" id="t-pay">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-credit-card"></i></span>
					<div>
						<h2 class="legal-sec__t">تسویه حساب</h2>
						<p class="legal-sec__n">پرداخت، درگاه امن و کارت‌به‌کارت</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>انجام تسویه‌حساب برای ثبت نهایی سفارش الزامی است. در پایان مراحل ثبت سفارش، درگاه پرداخت اینترنتی امن باز می‌شود.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>پرداخت از طریق <strong>درگاه بانکی مورد تایید شاپرک</strong> انجام می‌شود و مسئولیت ورود اطلاعات بانکی در صفحه بانک با کاربر است؛ این اطلاعات نزد دشت‌زاد ذخیره نمی‌شود.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>در صورت بروز اختلال در پرداخت اینترنتی، با هماهنگی پشتیبانی امکان پرداخت <strong>کارت‌به‌کارت</strong> و سپس ثبت نهایی وجود دارد. کارت‌به‌کارت تنها در صورت اعلام رسمی دشت‌زاد معتبر است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>سفارش تنها <strong>پس از تایید پرداخت</strong> وارد مرحله پردازش می‌شود و سفارش‌های پرداخت‌نشده پس از مدت مشخصی لغو می‌شوند.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>سبد خرید بالای <strong>۳ میلیون تومان</strong> امکان پرداخت در محل ندارد و باید پیش از ارسال به‌صورت اینترنتی تسویه شود.</span></li>
					</ul>
				</div>
			</section>

			<!-- 5 — حمل، تحویل و دریافت -->
			<section class="legal-sec" id="t-ship">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-truck-fast"></i></span>
					<div>
						<h2 class="legal-sec__t">حمل، تحویل و دریافت سفارش</h2>
						<p class="legal-sec__n">زمان‌بندی، روش ارسال و بازرسی هنگام تحویل</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>ارسال سفارش‌ها در محدوده تهران از طریق پیک و در سایر شهرها به‌واسطه پست انجام می‌شود. هر سفارش حداکثر ظرف ۲۴ ساعت کاری پردازش و تحویل پست/پیک می‌شود.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>هزینه ارسال بر اساس <strong>وزن و مقصد</strong> محاسبه و در صفحه پرداخت نمایش داده می‌شود؛ خریدهای بالای ۷۰۰٬۰۰۰ تومان از ارسال رایگان بهره‌مند می‌شوند.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>پس از تحویل مرسوله به شرکت پست/پیک، کد رهگیری برای شما ارسال می‌شود. زمان رسیدن مرسوله تابع همان شرکت است. دشت‌زاد در قبال تاخیرهای خارج از کنترل خود (شرایط جوی، تعطیلات، اختلال پستی) مسئولیتی ندارد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>مکان تحویل، نشانیِ ثبت‌شده توسط کاربر است و پس از تحویل به پست/پیک، تغییر آن ممکن نیست.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>کاربر موظف است هنگام تحویل و <strong>پیش از امضای رسید</strong>، سلامت بسته‌بندی و ظاهر کالا را بررسی کند؛ در صورت آسیب آشکار، از تحویل خودداری و بلافاصله موضوع را به دشت‌زاد اطلاع دهد. امضای رسید بدون بررسی، به‌منزله دریافت سالم کالاست.</span></li>
					</ul>
					<a class="legal-link" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>#g-ship"><i class="fa-solid fa-circle-info"></i> جزئیات زمان و هزینه ارسال در پرسش‌های متداول</a>
				</div>
			</section>

			<!-- 6 — مرجوعی و استرداد -->
			<section class="legal-sec" id="t-return">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-rotate-left"></i></span>
					<div>
						<h2 class="legal-sec__t">شرایط مرجوعی و استرداد (حق انصراف)</h2>
						<p class="legal-sec__n">بازگشت کالا، موارد قابل و غیرقابل مرجوع</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>رضایت شما برای ما در اولویت است. شرایط مرجوع‌کردن و استرداد به این شرح است:</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span><strong>پیش از ارسال:</strong> در صورت انصراف پس از تسویه و پیش از ارسال، کل وجه دریافتی حداکثر ظرف <strong>۷۲ ساعت کاری</strong> بازمی‌گردد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>پس از ارسال:</strong> کالای سالم تا <strong>۷ روز</strong> پس از دریافت و به‌شرط باز نشدن بسته‌بندی و نبود خسارت، قابل استرداد است؛ هزینه بازگشت کالای سالم بر عهده خریدار است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>به دلیل مسائل بهداشتی، اقلام خوراکیِ <strong>باز یا مصرف‌شده</strong> قابل مرجوع‌کردن نیستند، مگر در صورت وجود ایراد کیفی یا مغایرت.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>کالای مرجوعی باید همراه <strong>فاکتور</strong> و در بسته‌بندی اصلی و سالم بازگردانده شود. بازگشت وجه، پس از دریافت و بازبینی کالا و طی ۳ تا ۵ روز کاری انجام می‌شود.</span></li>
					</ul>
					<a class="legal-link" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>#g-return"><i class="fa-solid fa-shield-heart"></i> ضمانت کیفیت و بازگشت کالای معیوب در پرسش‌های متداول</a>
				</div>
			</section>

			<!-- 7 — مسئولیت ثبت آدرس -->
			<section class="legal-sec" id="t-address">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-location-dot"></i></span>
					<div>
						<h2 class="legal-sec__t">مسئولیت مشتری در ثبت آدرس</h2>
						<p class="legal-sec__n">صحت آدرس و پیامدهای اطلاعات نادرست</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>درست‌بودن نشانی و شماره تماس، نقش کلیدی در رسیدن به‌موقع سفارش دارد و مسئولیت آن بر عهده خریدار است.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>آدرس را با ذکر <strong>کد پستی، واحد و نشانه‌های دقیق</strong> و یک شماره تماسِ همراهِ در دسترس وارد کنید.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>اگر مرسوله به‌دلیل <strong>آدرس ناقص یا اشتباه</strong>، عدم پاسخ‌گویی یا غیبت گیرنده به انبار بازگردد، ارسال مجدد با هزینه خریدار انجام می‌شود.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>تا پیش از مرحله ارسال، می‌توانید آدرس را از بخش <a href="<?php echo esc_url( home_url( '/track/' ) ); ?>">سفارش‌های من</a> ویرایش کنید یا با پشتیبانی تماس بگیرید.</span></li>
					</ul>
				</div>
			</section>

			<!-- 8 — کد تخفیف -->
			<section class="legal-sec" id="t-coupon">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-ticket"></i></span>
					<div>
						<h2 class="legal-sec__t">شرایط استفاده از کد تخفیف</h2>
						<p class="legal-sec__n">اعتبار، محدودیت‌ها و نحوه اعمال کد</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>کدهای تخفیف هدیه‌ای از سوی دشت‌زاد هستند و استفاده از آن‌ها تابع شرایط زیر است:</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>هر کد ممکن است شرایط مخصوص خود را داشته باشد: <strong>حداقل مبلغ خرید، تاریخ انقضا، سقف تخفیف</strong> یا اختصاص به دسته‌ای خاص از محصولات.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>جز در مواردی که صراحتاً ذکر شود، کدها <strong>یک‌بار مصرف</strong> بوده و با یکدیگر یا با تخفیف‌های فعالِ سایت <strong>جمع‌پذیر نیستند</strong>.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>کد تخفیف <strong>قابل تبدیل به وجه نقد</strong> نیست و معمولاً تنها روی مبلغ کالاها (نه هزینه ارسال) اعمال می‌شود.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>کد باید پیش از نهایی‌شدن پرداخت در صفحه سبد خرید وارد شود؛ اعمال کد پس از ثبت سفارش ممکن نیست.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>دشت‌زاد حق ابطال کدها را در صورت مشاهده <strong>سوءاستفاده یا تخلف</strong> برای خود محفوظ می‌دارد.</span></li>
					</ul>
				</div>
			</section>

			<!-- 9 — مالکیت معنوی -->
			<section class="legal-sec" id="t-ip">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-copyright"></i></span>
					<div>
						<h2 class="legal-sec__t">مالکیت معنوی</h2>
						<p class="legal-sec__n">حقوق محتوا، تصاویر و اطلاعات سایت</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>محتوای این سایت برای استفاده شخصی و غیرتجاری کاربران عرضه شده است.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>مالکیت معنوی اطلاعات، تصاویر و علائم تجاری موجود در سایت متعلق به <strong>دشت‌زاد</strong> است و هرگونه سوءاستفاده پیگرد قانونی دارد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>استفاده تجاری از محتوا، تصاویر و اطلاعات سایت نیازمند <strong>اجازه کتبی</strong> از دشت‌زاد است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>اطلاعات محصولات از منابع معتبر یا تولیدکننده تهیه شده است. ممکن است در مواردی خطای جزئی داشته باشد؛ این اطلاعات را به‌طور مداوم بازبینی و به‌روز می‌کنیم.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>دشت‌زاد مسئولیتی در قبال اختلالات خارج از حوزه مدیریت خود (نقص اینترنت، مسائل مخابراتی یا سخت‌افزاری) ندارد.</span></li>
					</ul>
				</div>
			</section>

			<!-- 10 — حریم خصوصی -->
			<section class="legal-sec" id="t-privacy">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-user-shield"></i></span>
					<div>
						<h2 class="legal-sec__t">قوانین حریم خصوصی</h2>
						<p class="legal-sec__n">گردآوری، استفاده و حفاظت از اطلاعات شما</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>حفظ حریم خصوصی و امنیت اطلاعات شما یکی از اصول بنیادین دشت‌زاد است. در این بخش به‌روشنی توضیح می‌دهیم که <strong>چه اطلاعاتی</strong>، <strong>چرا</strong> و <strong>چگونه</strong> گردآوری می‌شود و شما چه اختیاراتی نسبت به آن دارید.</p>

					<h3 class="legal-subh"><i class="fa-solid fa-folder-open"></i> چه اطلاعاتی جمع‌آوری می‌کنیم؟</h3>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span><strong>اطلاعات هویتی و تماس:</strong> نام و نام خانوادگی، شماره موبایل و در صورت تمایل، ایمیل شما.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>اطلاعات سفارش و تحویل:</strong> نشانی پستی، کد پستی و تاریخچه سفارش‌ها برای پردازش و ارسال.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>اطلاعات پرداخت:</strong> تنها وضعیت و مبلغ تراکنش نزد ما ثبت می‌شود؛ شماره کارت و رمز بانکی شما <strong>هرگز</strong> ذخیره نمی‌گردد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>اطلاعات فنی:</strong> نوع دستگاه، مرورگر و نشانی IP، صرفاً برای امنیت، رفع خطا و بهبود سایت.</span></li>
					</ul>

					<h3 class="legal-subh"><i class="fa-solid fa-download"></i> چطور این اطلاعات را به دست می‌آوریم؟</h3>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span><strong>به‌صورت مستقیم:</strong> هنگام ثبت‌نام، تکمیل سفارش یا تماس با پشتیبانی، اطلاعات را خودِ شما وارد می‌کنید.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>به‌صورت خودکار:</strong> هنگام استفاده از سایت، بخشی از اطلاعات فنی از طریق کوکی‌ها و ابزارهای تحلیلی ثبت می‌شود.</span></li>
					</ul>

					<h3 class="legal-subh"><i class="fa-solid fa-list-check"></i> از اطلاعات شما چطور استفاده می‌کنیم؟</h3>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>پردازش، ارسال و پیگیری سفارش و اطلاع‌رسانی وضعیت آن از طریق پیامک.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>پشتیبانی، پاسخ به پرسش‌ها و رسیدگی به درخواست‌های مرجوعی.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>بهبود تجربه خرید و (<strong>تنها با رضایت شما</strong>) ارسال پیشنهادها، تخفیف‌ها و خبرنامه.</span></li>
					</ul>

					<h3 class="legal-subh"><i class="fa-solid fa-share-nodes"></i> اطلاعات با چه کسانی به اشتراک گذاشته می‌شود؟</h3>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span><strong>شرکت پست یا پیک:</strong> تنها نشانی و شماره تماسِ لازم برای تحویل مرسوله.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>درگاه پرداخت بانکی:</strong> برای انجام امن تراکنش، تحت نظارت شاپرک و بانک مرکزی.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>مراجع قانونی:</strong> تنها در صورت الزام قانونی و بر اساس درخواست رسمی مرجع ذی‌صلاح.</span></li>
					</ul>
					<div class="faq-note"><i class="fa-solid fa-ban"></i><span>اطلاعات شخصی شما <strong>هرگز</strong> به اشخاص یا شرکت‌های ثالث برای مقاصد تبلیغاتی فروخته یا اجاره داده نمی‌شود.</span></div>

					<h3 class="legal-subh"><i class="fa-solid fa-cookie-bite"></i> کوکی‌ها و فناوری‌های ردیابی</h3>
					<p>از کوکی‌ها برای نگه‌داشتن سبد خرید، ورود امن، یادآوری ترجیحات و سنجش عملکرد سایت استفاده می‌کنیم. می‌توانید کوکی‌ها را از تنظیمات مرورگر خود مدیریت یا حذف کنید؛ تنها توجه داشته باشید که در این صورت ممکن است برخی بخش‌های سایت (مانند سبد خرید) درست کار نکنند.</p>

					<h3 class="legal-subh"><i class="fa-solid fa-shield-halved"></i> امنیت و مدت نگهداری اطلاعات</h3>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>تمام ارتباط شما با سایت با پروتکل امن <strong>SSL</strong> رمزنگاری می‌شود و دسترسی به اطلاعات تنها برای کارکنانِ مجاز و در حد وظیفه ممکن است.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>اطلاعات شما تنها <strong>تا زمانی</strong> نگهداری می‌شود که برای ارائه خدمات یا رعایت الزامات قانونی (مانند نگهداری سوابق مالی) لازم باشد.</span></li>
					</ul>

					<h3 class="legal-subh"><i class="fa-solid fa-user-gear"></i> حقوق شما نسبت به اطلاعاتتان</h3>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>درخواست <strong>دسترسی، اصلاح یا حذف</strong> اطلاعات حساب خود را در هر زمان از طریق پشتیبانی ثبت کنید.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span><strong>لغو اشتراک</strong> پیامک‌ها و ایمیل‌های تبلیغاتی در هر زمان و بدون نیاز به دلیل امکان‌پذیر است.</span></li>
					</ul>

					<div class="faq-note faq-note--gold"><i class="fa-solid fa-child-reaching"></i><span><strong>حریم خصوصی کودکان:</strong> خدمات دشت‌زاد برای بزرگسالان طراحی شده است و ما آگاهانه اطلاعات افراد زیر ۱۸ سال را جمع‌آوری نمی‌کنیم.</span></div>

					<a class="legal-link" href="<?php echo esc_url( home_url( '/faq/' ) ); ?>#g-pay"><i class="fa-solid fa-lock"></i> اطلاعات بیشتر درباره امنیت پرداخت</a>
				</div>
			</section>

			<!-- 11 — قوانین ارسال نظر -->
			<section class="legal-sec" id="t-comments">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-comments"></i></span>
					<div>
						<h2 class="legal-sec__t">قوانین ارسال نظر</h2>
						<p class="legal-sec__n">اشتراک تجربه و چارچوب نقد محصولات</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>هدف از بخش نظرات، اشتراک‌گذاری تجربه خرید و استفاده از محصولات است. هر نظر پس از بررسی کارشناسان و در صورت رعایت قوانین، منتشر می‌شود.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>نقد مناسب، نقدی واقع‌بینانه است که <strong>مزایا و معایب</strong> محصول را بر پایه تجربه شخصی و متناسب با قیمت آن بررسی کند.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>استفاده از <strong>ادبیات محترمانه</strong> الزامی است؛ توهین، کلمات نامناسب یا مطالب مغایر با عرف جامعه تایید نمی‌شوند.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>تنها نظرات <strong>مرتبط با همان محصول</strong> و با نگارش صحیح تایید می‌شوند؛ نقد درباره سایت یا خدمات را از طریق پشتیبانی مطرح کنید.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>دشت‌زاد در قبال درستی یا نادرستی نظرات کاربران مسئولیتی ندارد و نمایش نظر به‌معنای تایید محتوای آن نیست.</span></li>
					</ul>
				</div>
			</section>

			<!-- 12 — قوه قهریه -->
			<section class="legal-sec" id="t-force">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-cloud-bolt"></i></span>
					<div>
						<h2 class="legal-sec__t">قوه قهریه (فورس ماژور)</h2>
						<p class="legal-sec__n">حوادث غیرمترقبه و تعلیق خدمات</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>چنانچه بر اثر وقوع حوادث غیرمترقبه، امکان فعالیت دشت‌زاد کلاً یا بخشی از آن به‌طور موقت ناممکن شود، ثبت سفارش جدید و ارسال سفارش‌های ثبت‌شده به حالت تعلیق درمی‌آید.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>در مدتی که به‌دلیل وقوع حادثه امکان پردازش سفارش وجود ندارد، کاربر حق درخواست ارسال فوری یا استرداد وجه را نخواهد داشت.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>پس از رفع حادثه، در صورت امکان ادامه فعالیت، دشت‌زاد پردازش سفارش‌ها را از سر می‌گیرد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>در صورت ناممکن‌شدن کاملِ پردازش، با توافق طرفین سفارش تعدیل یا لغو و وجه پرداخت‌شده مسترد می‌شود.</span></li>
					</ul>
				</div>
			</section>

			<!-- 13 — تغییر قوانین و حل اختلاف -->
			<section class="legal-sec" id="t-change">
				<div class="legal-sec__head">
					<span class="legal-sec__ic"><i class="fa-solid fa-gavel"></i></span>
					<div>
						<h2 class="legal-sec__t">تغییر قوانین و حل اختلاف</h2>
						<p class="legal-sec__n">به‌روزرسانی مقررات و مرجع رسیدگی</p>
					</div>
				</div>
				<div class="legal-sec__body">
					<p>این مقررات برای حفظ حقوق شما و شفافیتِ همکاری تنظیم شده و ممکن است در طول زمان بهبود یابد.</p>
					<ul class="legal-list">
						<li><i class="fa-solid fa-circle-check"></i><span>دشت‌زاد می‌تواند این مقررات را هر زمان <strong>به‌روزرسانی</strong> کند؛ نسخه معتبر همان است که در لحظه ثبت سفارش روی این صفحه قرار دارد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>تغییرات مهم از طریق سایت و در صورت لزوم پیامک به اطلاع کاربران می‌رسد.</span></li>
						<li><i class="fa-solid fa-circle-check"></i><span>در صورت بروز هرگونه اختلاف، نخست از راه <strong>گفت‌وگوی مستقیم با پشتیبانی</strong> حل‌وفصل می‌شود و در غیر این صورت، تابع <strong>قانون تجارت الکترونیکی</strong> و قوانین جاری جمهوری اسلامی ایران خواهد بود.</span></li>
					</ul>
					<a class="legal-link" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><i class="fa-solid fa-headset"></i> تماس با پشتیبانی دشت‌زاد</a>
				</div>
			</section>

			<div class="legal-foot">
				<b>توضیح:</b> این سند به‌منظور شفافیت و راهنمایی شما تنظیم شده و موارد درج‌نشده یا مبهم در آن، تابع قوانین، آیین‌نامه‌ها و مصوبات مراجع قانونی کشور است. این صفحه متعلق به شرکت <b>دشت‌زاد کشت و تجارت ایرانیان</b> است و در صورت وجود هرگونه ابهام، تیم پشتیبانی آماده پاسخ‌گویی و حل‌وفصل دوستانه است. برای پرسش‌های پرتکرار به صفحه <a href="<?php echo esc_url( home_url( '/faq/' ) ); ?>">پرسش‌های متداول</a> سر بزنید.
			</div>

		</div>
	</div>
</main>

<!-- ============================= CONTACT CTA ============================= -->
<section class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(4rem,6vw,7rem)]" id="contact">
	<div class="faq-contact">
		<div class="faq-contact__l">
			<span class="faq-contact__kicker"><i class="fa-solid fa-headset"></i> هنوز جواب نگرفتید؟</span>
			<h2 class="faq-contact__title">تیم پشتیبانی دشت‌زاد کنار شماست</h2>
			<p class="faq-contact__sub">هر روز از ساعت ۹ تا ۲۱، از طریق راه‌های زیر پاسخگوی پرسش‌ها و سفارش‌های شما هستیم. هرچه باشد، تنهایتان نمی‌گذاریم.</p>
		</div>
		<div class="faq-contact__actions">
			<a class="faq-contact__row" href="tel:02192002661">
				<i class="fa-solid fa-phone"></i>
				<span><b>۰۲۱-۹۲۰۰۲۶۶۱</b><span>تماس تلفنی با پشتیبانی</span></span>
			</a>
			<a class="faq-contact__row" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
				<i class="fa-solid fa-comment-dots"></i>
				<span><b>فرم تماس و گفت‌وگوی آنلاین</b><span>پاسخ در سریع‌ترین زمان ممکن</span></span>
			</a>
			<a class="faq-contact__row" href="mailto:info@dashtzad.ir">
				<i class="fa-solid fa-envelope"></i>
				<span><b>info@dashtzad.ir</b><span>پاسخ ایمیلی حداکثر تا ۲۴ ساعت</span></span>
			</a>
		</div>
	</div>
</section>

<script>
(function(){
	/* ارتفاع هدر چسبان → --hdr-h */
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);

	/* آکاردئون بخش‌های قانون (مثل FAQ): کلیک روی سرستون → باز/بسته، تک‌بازشو */
	var secsAll = Array.prototype.slice.call(document.querySelectorAll('.legal-sec'));
	function openSection(sec){ secsAll.forEach(function(s){ if(s !== sec) s.classList.remove('is-open'); }); sec.classList.add('is-open'); }
	secsAll.forEach(function(sec){
		var head = sec.querySelector('.legal-sec__head');
		if(!head) return;
		head.addEventListener('click', function(){
			var isOpen = sec.classList.contains('is-open');
			secsAll.forEach(function(s){ if(s !== sec) s.classList.remove('is-open'); });
			sec.classList.toggle('is-open', !isOpen);
		});
	});
	if(secsAll[0]) secsAll[0].classList.add('is-open');

	/* جستجوی زنده در قوانین */
	var input = document.getElementById('legalSearch');
	var clearBtn = document.getElementById('legalSearchClear');
	var empty = document.getElementById('legalEmpty');
	function norm(s){ return (s||'').replace(/\u200c/g,' ').replace(/[\u064B-\u0652]/g,'').toLowerCase().trim(); }
	function runSearch(){
		if(!input) return;
		var q = norm(input.value);
		if(clearBtn) clearBtn.hidden = !input.value;
		var any = false;
		secsAll.forEach(function(sec){
			var match = !q || norm(sec.textContent).indexOf(q) !== -1;
			sec.style.display = match ? '' : 'none';
			if(match){ any = true; if(q) sec.classList.add('is-open'); }
		});
		if(empty) empty.classList.toggle('show', !any);
	}
	if(input) input.addEventListener('input', runSearch);
	if(clearBtn) clearBtn.addEventListener('click', function(){ input.value=''; runSearch(); input.focus(); });

	/* فهرست چسبان: scroll-spy + پرش نرم (و باز‌کردن بخش مقصد) */
	var links = Array.prototype.slice.call(document.querySelectorAll('#tocNav a[data-target]'));
	var sections = links.map(function(a){ return document.getElementById(a.dataset.target); });
	function paint(){
		var trigger = hdrH() + 60;
		var idx = 0;
		sections.forEach(function(s,i){ if(s && s.getBoundingClientRect().top < trigger) idx = i; });
		links.forEach(function(a,i){ a.classList.toggle('is-active', i === idx); });
	}
	window.addEventListener('scroll', paint, { passive:true });
	function jump(t){ var y = t.getBoundingClientRect().top + window.scrollY - hdrH() - 16; window.scrollTo({ top:y, behavior:'smooth' }); }
	function go(t){ if(t.classList.contains('legal-sec')){ openSection(t); setTimeout(function(){ jump(t); }, 60); } else { jump(t); } }
	links.forEach(function(a){ a.addEventListener('click', function(e){ e.preventDefault(); var t = document.getElementById(a.dataset.target); if(t) go(t); }); });
	Array.prototype.slice.call(document.querySelectorAll('a[href^="#"]')).forEach(function(a){
		if(a.dataset.target) return;
		a.addEventListener('click', function(e){ var id = a.getAttribute('href').slice(1); var t = id && document.getElementById(id); if(t){ e.preventDefault(); go(t); } });
	});
	paint();
})();
</script>

<?php
get_footer();
