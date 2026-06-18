<?php
/**
 * Template Name: پرسش‌های متداول
 * پیش‌نمایش — پرسش‌های متداول — PAGE CONTENT ONLY (نسخه‌ی مرجع wp/pages/).
 *
 * این فایل فقط «محتوای صفحه» است:
 *   - بدون get_header() و get_footer()
 *   - هدر/فوتر از قالب اصلی می‌آید (header-main / footer-main)
 * هنگام انتقال، محتوای همین <main> داخل page-faq.php (بین get_header و get_footer) قرار می‌گیرد.
 * CSS اختصاصی: wp/css/faq.css → assets/css/src/04-sections/faq.css
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
			<div class="faq-hero__top">
				<span class="faq-hero__kicker"><i class="fa-solid fa-circle-question"></i> همراه شما، پیش و پس از خرید</span>
				<span class="legal-updated"><i class="fa-regular fa-calendar-check"></i> آخرین به‌روزرسانی: ۱۲ خرداد ۱۴۰۵</span>
			</div>
			<h1 class="faq-hero__title">پرسش‌های متداول</h1>
			<p class="faq-hero__sub">از اصالت و نگهداری محصول تا ارسال، پرداخت و بازگشت کالا؛ پاسخِ روشن و بی‌حاشیه‌ی پرتکرارترین پرسش‌ها این‌جاست. اگر باز هم سوالی ماند، تیم پشتیبانی دشت‌زاد با دل‌گرمی کنار شماست.</p>
			<form class="faq-hero__search" onsubmit="return false;">
				<i class="fa-solid fa-magnifying-glass"></i>
				<input type="search" id="faqSearch" placeholder="سوالتان را بنویسید… مثلاً «ارسال» یا «مرجوعی»" aria-label="جستجو در پرسش‌ها" autocomplete="off" />
				<button class="faq-hero__clear" type="button" id="faqSearchClear" hidden><i class="fa-solid fa-xmark"></i> پاک کردن</button>
			</form>

			<div class="faq-hero__chips">
				<a class="faq-chip" href="#g-product"><i class="fa-solid fa-wheat-awn"></i> محصولات و نگهداری</a>
				<a class="faq-chip" href="#g-ship"><i class="fa-solid fa-truck-fast"></i> ارسال و تحویل</a>
				<a class="faq-chip" href="#g-return"><i class="fa-solid fa-shield-heart"></i> ضمانت و بازگشت</a>
				<a class="faq-chip" href="#g-pay"><i class="fa-solid fa-credit-card"></i> پرداخت و خرید</a>
				<a class="faq-chip" href="#g-account"><i class="fa-solid fa-circle-user"></i> حساب کاربری</a>
				<a class="faq-chip" href="#g-club"><i class="fa-solid fa-medal"></i> باشگاه مشتریان</a>
				<a class="faq-chip" href="#g-corporate"><i class="fa-solid fa-gift"></i> هدایای سازمانی</a>
			</div>
		</div>
	</div>
</section>

<!-- ============================= BODY ============================= -->
<main class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]" data-screen-label="faq">
	<div class="faq-layout">

		<!-- ===== side category nav ===== -->
		<aside class="faq-nav" id="faqNav">
			<div class="faq-nav__h"><i class="fa-solid fa-layer-group"></i> دسته‌بندی پرسش‌ها</div>
			<a href="#g-product" data-target="g-product"><span class="faq-nav__ic"><i class="fa-solid fa-wheat-awn"></i></span> محصولات و نگهداری</a>
			<a href="#g-ship" data-target="g-ship"><span class="faq-nav__ic"><i class="fa-solid fa-truck-fast"></i></span> ارسال و تحویل</a>
			<a href="#g-return" data-target="g-return"><span class="faq-nav__ic"><i class="fa-solid fa-shield-heart"></i></span> ضمانت و بازگشت کالا</a>
			<a href="#g-pay" data-target="g-pay"><span class="faq-nav__ic"><i class="fa-solid fa-credit-card"></i></span> پرداخت و خرید</a>
			<a href="#g-account" data-target="g-account"><span class="faq-nav__ic"><i class="fa-solid fa-circle-user"></i></span> حساب کاربری و پروفایل</a>
			<a href="#g-club" data-target="g-club"><span class="faq-nav__ic"><i class="fa-solid fa-medal"></i></span> باشگاه مشتریان و امتیازها</a>
			<a href="#g-corporate" data-target="g-corporate"><span class="faq-nav__ic"><i class="fa-solid fa-gift"></i></span> هدایای سازمانی</a>
			<div class="faq-nav__sep"></div>
			<a class="faq-nav__contact" href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">
				<i class="fa-solid fa-scale-balanced"></i>
				<span><b>قوانین و مقررات</b><span>شرایط خرید و حریم خصوصی</span></span>
			</a>
		</aside>

		<!-- ===== accordion groups ===== -->
		<div class="faq-main">

			<!-- empty state (search) -->
			<div class="faq-empty" id="faqEmpty">
				<i class="fa-regular fa-face-frown"></i>
				<p>پرسشی با این عبارت پیدا نشد. عبارت دیگری را امتحان کنید یا با پشتیبانی تماس بگیرید.</p>
			</div>

			<!-- GROUP 1 — products, authenticity & storage -->
			<section class="faq-group" id="g-product">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-wheat-awn"></i></span>
					<div>
						<h2 class="faq-group__t">محصولات، اصالت و نگهداری</h2>
						<p class="faq-group__n">تاریخ مصرف، نگهداری، اصالت زعفران، وزن و استانداردها</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">محصولات تاریخ تولید و مصرف دارند؟ ماندگاری‌شان چقدر است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله. روی هر بسته <strong>تاریخ تولید/بسته‌بندی</strong> و <strong>تاریخ انقضا (یا بهترین زمان مصرف)</strong> درج شده است. ماندگاری تقریبی محصولات در شرایط نگهداری درست به این صورت است:</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-bowl-rice"></i> برنج: تا ۱۸ ماه</span>
								<span class="faq-fact"><i class="fa-solid fa-seedling"></i> حبوبات: تا ۱۲ ماه</span>
								<span class="faq-fact"><i class="fa-solid fa-mortar-pestle"></i> زعفران: تا ۲۴ ماه</span>
								<span class="faq-fact"><i class="fa-solid fa-bowl-food"></i> خشکبار و آجیل: ۶ تا ۹ ماه</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-circle-info"></i><span>این بازه‌ها برای بسته‌بندیِ پلمب‌شده و نگهداری در جای خشک و خنک است. برنج کهنه با گذر زمان عطر و خاصیت دانه‌دانه‌شدنش بهتر هم می‌شود.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">محصولات را چطور نگهداری کنم که تازه بمانند و آفت نزنند؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>کلید ماندگاری، نگهداری در جای <strong>خشک، خنک و دور از نور و رطوبت</strong> است. پس از باز کردن بسته، محتویات را در ظرف دربسته بریزید:</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-box"></i> برنج و حبوبات: ظرف دربسته، دور از رطوبت</span>
								<span class="faq-fact"><i class="fa-solid fa-snowflake"></i> برای جلوگیری از شپشه: نگهداری در فریزر</span>
								<span class="faq-fact"><i class="fa-solid fa-jar"></i> زعفران: شیشه دربسته، دور از نور</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-lightbulb"></i><span>گذاشتن چند حبه نمک خشک یا چند برگ بو لای برنج، یک ترفند خانگیِ قدیمی برای دور نگه‌داشتن آفت است. خشکبار و آجیل را برای ماندگاری بیشتر در یخچال نگه دارید.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">اصالت و خلوص زعفران چطور تضمین می‌شود؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>زعفران دشت‌زاد از نوع <strong>سرگلِ خالص</strong> است؛ بدون رنگ مصنوعی، پُرکُن یا اجزای افزوده. کیفیت آن بر پایه استاندارد بین‌المللی زعفران یعنی <strong>ISO 3632</strong> سنجیده می‌شود — استانداردی که میزان رنگ‌دهی (کروسین)، تلخی (پیکروکروسین) و عطر (سافرانال) را اندازه می‌گیرد.</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-flask-vial"></i> آزمون آزمایشگاهی طبق ISO 3632</span>
								<span class="faq-fact"><i class="fa-solid fa-ban"></i> بدون رنگ و افزودنی</span>
								<span class="faq-fact"><i class="fa-solid fa-certificate"></i> دارای استاندارد ملی</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-circle-check"></i><span>یک آزمایش ساده خانگی: زعفران اصل در آب سرد به‌آرامی و یکدست رنگ می‌دهد، نه فوری و پررنگ؛ و رشته‌ها رنگ خود را پس از خیساندن از دست نمی‌دهند.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">وزن درج‌شده روی بسته دقیق است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله. وزن نوشته‌شده روی بسته، <strong>وزن خالصِ محصول</strong> (بدون بسته‌بندی) است و با ترازوهای کالیبره‌شده و مطابق الزامات <strong>سازمان ملی استاندارد ایران</strong> توزین می‌شود.</p>
							<div class="faq-note"><i class="fa-solid fa-scale-balanced"></i><span>برای محصولات طبیعی و فله ممکن است اختلاف بسیار ناچیز و مجاز وجود داشته باشد؛ اگر وزن دریافتی به‌طور محسوس کمتر بود، طبق <a href="#g-return">ضمانت بازگشت کالا</a> رسیدگی می‌شود.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">محصولات چه مجوزها و استانداردهایی دارند؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>همه محصولات خوراکی دشت‌زاد دارای مجوزهای بهداشتی لازم برای عرضه و فروش هستند:</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-shield-halved"></i> پروانه بهداشت از سازمان غذا و دارو</span>
								<span class="faq-fact"><i class="fa-solid fa-certificate"></i> نشان استاندارد ملی برای اقلام مشمول</span>
								<span class="faq-fact"><i class="fa-solid fa-box-tissue"></i> بسته‌بندی بهداشتی و پلمب‌دار</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-circle-info"></i><span>مشخصات و مجوز هر محصول در صفحه همان کالا در <a href="<?php echo esc_url( home_url( '/' ) ); ?>">فروشگاه</a> قابل مشاهده است.</span></div>
						</div></div></div>
					</article>

				</div>
			</section>

			<!-- GROUP 2 — shipping -->
			<section class="faq-group" id="g-ship">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-truck-fast"></i></span>
					<div>
						<h2 class="faq-group__t">ارسال و تحویل</h2>
						<p class="faq-group__n">زمان رسیدن، هزینه ارسال و پیگیری سفارش</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">ارسال چقدر طول می‌کشد؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>سفارش‌هایی که تا <strong>ساعت ۱۲ ظهر</strong> ثبت شوند، همان روز کاری بسته‌بندی و تحویل پست/پیک می‌شوند. زمان رسیدن به دست شما بسته به مقصد است:</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-location-dot"></i> تهران: ۱ تا ۲ روز کاری</span>
								<span class="faq-fact"><i class="fa-solid fa-map"></i> مراکز استان‌ها: ۲ تا ۳ روز کاری</span>
								<span class="faq-fact"><i class="fa-solid fa-mountain-sun"></i> سایر شهرها: ۳ تا ۴ روز کاری</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-circle-info"></i><span>روزهای تعطیل رسمی جزو روزهای کاری حساب نمی‌شوند. در ایام پرسفارش (مثل شب عید) ممکن است یک روز به این بازه اضافه شود؛ در آن صورت پیش از خرید اطلاع‌رسانی می‌کنیم.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">هزینه ارسال چطور حساب می‌شود؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>هزینه ارسال بر اساس <strong>وزن سفارش</strong> و <strong>مقصد</strong> محاسبه و پیش از نهایی‌شدن خرید، در صفحه پرداخت به‌صورت دقیق به شما نمایش داده می‌شود؛ هیچ هزینه پنهانی وجود ندارد.</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-gift"></i> خرید بالای ۷۰۰٬۰۰۰ تومان: ارسال رایگان</span>
								<span class="faq-fact"><i class="fa-solid fa-box"></i> سفارش‌های سنگین: بر اساس تعرفه باربری</span>
							</div>
							<p>برای شهرهای دارای پیک، امکان <strong>ارسال سریع همان‌روز</strong> هم با هزینه جداگانه در دسترس است.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">سفارشم را چطور پیگیری کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>به‌محض ارسال سفارش، یک <strong>کد رهگیری</strong> از طریق پیامک برایتان فرستاده می‌شود. وضعیت سفارش را به دو روش می‌توانید ببینید:</p>
							<ul class="faq-steps">
								<li><b>۱</b><span>از صفحه <a href="<?php echo esc_url( home_url( '/track/' ) ); ?>">پیگیری سفارش</a> با کد رهگیری و شماره موبایل، مرحله‌به‌مرحله وضعیت را ببینید.</span></li>
								<li><b>۲</b><span>کد رهگیری را در سامانه شرکت پست/پیک وارد کنید تا موقعیت دقیق مرسوله را دنبال کنید.</span></li>
							</ul>
							<div class="faq-note"><i class="fa-solid fa-bell"></i><span>در هر مرحله (تایید، بسته‌بندی، ارسال و تحویل) یک پیامک به‌روزرسانی دریافت می‌کنید.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">به سراسر کشور ارسال دارید؟ بسته‌بندی مواد غذایی چطور است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله، به <strong>سراسر ایران</strong> از طریق پست و باربری ارسال می‌کنیم. محصولات خوراکی با <strong>بسته‌بندی بهداشتی، پلمب‌شده و مقاوم</strong> ارسال می‌شوند تا سالم و تازه به دستتان برسند.</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-truck"></i> ارسال به همه شهرها و روستاها</span>
								<span class="faq-fact"><i class="fa-solid fa-box-tissue"></i> لفاف محافظ برای اقلام شکننده</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-circle-info"></i><span>برای مناطق دورافتاده ممکن است یک تا دو روز به زمان ارسال اضافه شود. ارسال به خارج از کشور فعلاً تنها برای سفارش‌های خاص و با هماهنگی پشتیبانی انجام می‌شود.</span></div>
						</div></div></div>
					</article>

				</div>
			</section>

			<!-- GROUP 3 — quality guarantee & returns -->
			<section class="faq-group faq-group--clay" id="g-return">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-shield-heart"></i></span>
					<div>
						<h2 class="faq-group__t">ضمانت کیفیت و بازگشت کالا</h2>
						<p class="faq-group__n">کالای معیوب، مهلت پیگیری، مدارک لازم و نحوه جبران</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">امکان مرجوع‌کردن کالا هست؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله. کالای سالم را تا <strong>۷ روز</strong> پس از دریافت می‌توانید مرجوع کنید، به شرط آن‌که <strong>بسته‌بندی باز نشده</strong> و کالا دست‌نخورده باشد. کافی است از بخش <a href="<?php echo esc_url( home_url( '/track/' ) ); ?>">پیگیری سفارش</a> درخواست مرجوعی را ثبت کنید.</p>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-triangle-exclamation"></i><span>اقلام خوراکیِ <strong>باز یا مصرف‌شده</strong> به دلیل بهداشتی قابل مرجوع نیستند، مگر ایراد کیفی داشته باشند. شرح کامل در <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">شرایط مرجوعی</a>.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">با محصول مشکل‌دار یا خراب چطور برخورد می‌شود؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>پیش از هر چیز عذرخواهی می‌کنیم و خیالتان راحت باشد که <strong>هزینه‌ای بابت آن نمی‌پردازید</strong>. روند رسیدگی ساده است:</p>
							<ul class="faq-steps">
								<li><b>۱</b><span>مشکل را از بخش پیگیری سفارش یا از طریق پشتیبانی ثبت کنید.</span></li>
								<li><b>۲</b><span>کارشناسان ما طی <strong>۲۴ ساعت</strong> بررسی و با شما تماس می‌گیرند.</span></li>
								<li><b>۳</b><span>به‌انتخاب شما، جبران انجام می‌شود (جزئیات در پرسش‌های پایین‌تر).</span></li>
							</ul>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">مهلت پیگیری کالای معیوب چند روز است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>هرچه زودتر اطلاع دهید، رسیدگی سریع‌تر است. بازه زمانی ثبت مشکل به این صورت است:</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-box-open"></i> کالای معیوب یا مغایر: تا ۴۸ ساعت پس از تحویل</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-magnifying-glass"></i> ایراد کیفیِ پنهان: تا ۷ روز پس از تحویل</span>
							</div>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-clock"></i><span>برای ثبت سریع‌تر، بهتر است بسته آسیب‌دیده را پیش از باز کردنِ کامل، همان لحظه تحویل بررسی کنید.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">برای ثبت مشکل حتماً باید عکس یا ویدیو بفرستم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله، ثبت <strong>عکس یا ویدیو</strong> کمک می‌کند مشکل سریع‌تر و دقیق‌تر بررسی شود و معمولاً نیاز به ارسال کالا برای کارشناسی را حذف می‌کند.</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-camera"></i> یک عکس واضح از کالا</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-box"></i> عکس بسته‌بندی و برچسب</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-video"></i> ویدیوی باز کردن بسته (در صورت امکان)</span>
							</div>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-circle-info"></i><span>اگر امکان تهیه عکس نبود، باز هم می‌توانید درخواست را ثبت کنید؛ تنها ممکن است بررسی کمی بیشتر طول بکشد.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">پول من برمی‌گردد یا کالای جایگزین می‌فرستید؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>پس از تایید مشکل، <strong>انتخاب با شماست</strong>:</p>
							<ul class="faq-steps">
								<li><b>۱</b><span><strong>ارسال جایگزین رایگان:</strong> کالای سالم در اولین فرصت و بدون هزینه ارسال برای شما فرستاده می‌شود.</span></li>
								<li><b>۲</b><span><strong>بازگشت کامل وجه:</strong> مبلغ طی <strong>۳ تا ۵ روز کاری</strong> به حساب یا کیف پول شما در سایت بازمی‌گردد.</span></li>
							</ul>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-handshake-angle"></i><span>اگر فقط بخشی از سفارش مشکل داشته باشد، جبران تنها برای همان قلم انجام می‌شود و بقیه سفارش دست‌نخورده می‌ماند.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">کیفیت برنج‌ها چطور تضمین می‌شود؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>برنج‌های دشت‌زاد مستقیم از <strong>شالیزارهای شمال و باغ‌های خانوادگی</strong> تامین می‌شوند؛ بدون واسطه، بدون اسانس و رنگ افزودنی. هر بسته با همین وسواس کنترل می‌شود:</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-seedling"></i> صددرصد طبیعی، بدون افزودنی</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-calendar-check"></i> درج سال برداشت روی بسته</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-wind"></i> بوجاری و سورت دانه‌به‌دانه</span>
							</div>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-award"></i><span><strong>ضمانت عطر و دانه‌دانه‌شدن:</strong> اگر برنج دریافتی مطابق توضیحات نبود، بدون چون‌وچرا تعویض می‌شود یا وجهش بازمی‌گردد.</span></div>
						</div></div></div>
					</article>

				</div>
			</section>

			<!-- GROUP 4 — payment -->
			<section class="faq-group faq-group--gold" id="g-pay">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-shield-halved"></i></span>
					<div>
						<h2 class="faq-group__t">پرداخت و روش‌های خرید</h2>
						<p class="faq-group__n">امنیت تراکنش، روش‌های پرداخت و خرید عمده</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">پرداخت در دشت‌زاد چقدر امن است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>پرداخت‌ها از طریق <strong>درگاه بانکی معتبر و مورد تایید شاپرک</strong> انجام می‌شود و تمام ارتباط شما با سایت با پروتکل امن <strong>SSL</strong> رمزنگاری شده است.</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-lock"></i> رمزنگاری SSL سرتاسری</span>
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-credit-card"></i> اطلاعات کارت نزد ما ذخیره نمی‌شود</span>
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-building-columns"></i> درگاه رسمی بانکی</span>
							</div>
							<p>اطلاعات کارت شما فقط در صفحه بانک وارد می‌شود و دشت‌زاد به آن دسترسی ندارد.</p>
							<div class="faq-note faq-note--gold"><i class="fa-solid fa-shield-heart"></i><span>اگر مبلغی از حساب شما کسر شد اما سفارش ثبت نشد، طبق قوانین بانکی حداکثر تا <strong>۷۲ ساعت</strong> به‌صورت خودکار بازمی‌گردد.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چه روش‌های پرداختی دارید؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>برای راحتی شما چند روش پرداخت در دسترس است:</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-credit-card"></i> پرداخت آنلاین با همه کارت‌های شتاب</span>
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-wallet"></i> کیف پول دشت‌زاد</span>
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-money-bill-wave"></i> پرداخت در محل (شهرهای منتخب)</span>
							</div>
							<div class="faq-note faq-note--gold"><i class="fa-solid fa-circle-info"></i><span>پرداخت در محل برای همه مناطق فعال نیست؛ در صورت پشتیبانی، این گزینه هنگام نهایی‌کردن سفارش نمایش داده می‌شود.</span></div>
						</div></div></div>
					</article>

				</div>
			</section>

			<!-- GROUP 5 — account & profile -->
			<section class="faq-group" id="g-account">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-circle-user"></i></span>
					<div>
						<h2 class="faq-group__t">حساب کاربری و پروفایل</h2>
						<p class="faq-group__n">ساخت حساب، ثبت آدرس، رمز عبور، اطلاعات حقوقی و باشگاه مشتریان</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چگونه حساب کاربری بسازم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>ساخت حساب در چند ثانیه انجام می‌شود:</p>
							<ul class="faq-steps">
								<li><b>۱</b><span>روی گزینه «ورود / ثبت‌نام» کلیک کنید و شماره موبایل خود را وارد کنید.</span></li>
								<li><b>۲</b><span>کد فعال‌سازی پیامک‌شده را وارد کنید تا حساب ساخته شود.</span></li>
								<li><b>۳</b><span>از بخش «تکمیل اطلاعات»، نام و مشخصات خود را کامل کنید.</span></li>
							</ul>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور آدرس خود را در حساب کاربری ثبت کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>پس از تکمیل اطلاعات کاربری، به بخش <strong>«نشانی‌ها»</strong> در حساب کاربری خود بروید و آدرس جدید را با <strong>کد پستی و جزئیات دقیق</strong> ثبت کنید. می‌توانید چند آدرس ذخیره کنید و هنگام خرید یکی را انتخاب کنید.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چگونه یک رمز عبور امن بسازم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>رمز قوی و غیرقابل‌حدس، بهترین سپر در برابر نفوذ به حساب شماست:</p>
							<div class="faq-facts">
								<span class="faq-fact"><i class="fa-solid fa-key"></i> دست‌کم ۸ کاراکتر</span>
								<span class="faq-fact"><i class="fa-solid fa-font"></i> ترکیب حروف بزرگ، کوچک، عدد و نماد</span>
								<span class="faq-fact"><i class="fa-solid fa-user-secret"></i> پرهیز از اطلاعات قابل‌حدس (تاریخ تولد، شماره موبایل)</span>
							</div>
							<div class="faq-note"><i class="fa-solid fa-shield-halved"></i><span>از یک رمز تکراری در چند سایت استفاده نکنید؛ برای هر حساب یک رمز یکتا بسازید.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">رمز عبورم را فراموش کرده‌ام؛ چطور بازیابی کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>جای نگرانی نیست. در صفحه ورود، گزینه <strong>«فراموشی رمز عبور»</strong> را بزنید؛ کد تایید به موبایل شما پیامک می‌شود و پس از تایید، می‌توانید رمز تازه‌ای تعریف کنید.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور مشخصات و ایمیل خود را ویرایش کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>پس از ورود به حساب کاربری، به بخش <strong>«پروفایل / اطلاعات شخصی»</strong> بروید و گزینه <strong>«ویرایش اطلاعات شخصی»</strong> را بزنید تا نام، ایمیل و سایر مشخصات را به‌روز کنید.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور شماره کارت خود را ثبت کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>در حساب کاربری، بخش <strong>اطلاعات بانکی / کارت‌ها</strong>، شماره کارت خود را وارد کنید. این شماره برای <strong>بازگشت وجه</strong> سفارش‌های مرجوعی یا لغو‌شده استفاده می‌شود.</p>
							<div class="faq-note"><i class="fa-solid fa-circle-info"></i><span>شماره کارت باید به نام صاحب حساب کاربری باشد.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور برای شرکت یا شخص حقوقی خرید کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>وارد پروفایل شوید، گزینه <strong>«ویرایش اطلاعات شخصی»</strong> و سپس <strong>«ایجاد اطلاعات حقوقی»</strong> را انتخاب و اطلاعات شرکت (نام، شناسه ملی و کد اقتصادی) را ثبت کنید تا فاکتور رسمی صادر شود.</p>
							<a class="legal-link" href="#g-corporate"><i class="fa-solid fa-gift"></i> بیشتر درباره خرید سازمانی</a>
						</div></div></div>
					</article>

				</div>
			</section>

			<!-- GROUP 6 — customer club & points -->
			<section class="faq-group faq-group--gold" id="g-club">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-medal"></i></span>
					<div>
						<h2 class="faq-group__t">باشگاه مشتریان و امتیازها</h2>
						<p class="faq-group__n">عضویت، کسب و خرج امتیاز، ثبت دیدگاه و کدهای تخفیف</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">برای عضویت در باشگاه مشتریان چه کاری باید بکنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>هیچ اقدام جداگانه‌ای لازم نیست. <strong>به‌محض ساخت حساب کاربری</strong> در دشت‌زاد، به‌صورت خودکار عضو باشگاه مشتریان می‌شوید و می‌توانید امتیاز جمع کنید.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور امتیاز جمع کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>دو راه ساده برای جمع‌کردن امتیاز دارید:</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-cart-shopping"></i> خرید کالا</span>
								<span class="faq-fact faq-fact--gold"><i class="fa-solid fa-star"></i> ثبت دیدگاه تایید‌شده</span>
							</div>
							<div class="faq-note faq-note--gold"><i class="fa-solid fa-calculator"></i><span>امتیاز خرید بر اساس مبلغ سفارش محاسبه می‌شود (به ازای هر <strong>۱۰٬۰۰۰ تومان</strong> خرید، ۱ امتیاز) و به نوع کالا بستگی ندارد.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور برای کالای خریداری‌شده دیدگاه، عکس یا فیلم ثبت کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>به بخش <a href="<?php echo esc_url( home_url( '/track/' ) ); ?>">پیگیری سفارش</a> بروید، روی <strong>«جزئیات»</strong> سفارش و سپس <strong>«ثبت نظر»</strong> بزنید تا دیدگاه، عکس و فیلم خود را از کالا ثبت کنید.</p>
							<div class="faq-note faq-note--gold"><i class="fa-solid fa-circle-check"></i><span>پس از تایید دیدگاه توسط کارشناسان، امتیاز آن برای شما ثبت می‌شود؛ تا پیش از تایید، در بخش تاریخچه با وضعیت «در صف بررسی» دیده می‌شود.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">امتیاز خرید چه زمانی به حسابم می‌نشیند؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>امتیاز خرید، <strong>پس از تحویل سفارش</strong> و گذشت مهلت بازگشت کالا (تا ۷ روز) و به‌شرط عدم مرجوعی، به حساب شما افزوده می‌شود. تا آن زمان، امتیاز در بخش تاریخچه با وضعیت «در صف بررسی» قابل مشاهده است.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">چطور امتیازم را خرج کنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>در صفحه باشگاه مشتریان، به بخش <strong>«جوایز»</strong> بروید تا پیشنهادهای متنوع را ببینید. امتیازها را می‌توانید صرف دریافت <strong>کد تخفیف</strong> و پیشنهادهای ویژه کنید.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">کدهای تخفیفِ دریافتی‌ام را کجا ببینم و تا کی اعتبار دارند؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>همه کدهای تخفیفی که با خرج‌کردن امتیاز دریافت کرده‌اید، در صفحه <strong>«تاریخچه»</strong> باشگاه با جزئیات و <strong>تاریخ انقضا</strong> قابل مشاهده‌اند.</p>
							<div class="faq-note faq-note--gold"><i class="fa-solid fa-triangle-exclamation"></i><span>پس از پایان اعتبار، کدهای تخفیف قابل تمدید یا تعویض نیستند. کد دریافتی به جهت امنیت، تنها در حساب کاربری خودتان قابل استفاده است.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">اعتبار امتیازها تا چه زمانی است؟ آیا به پول تبدیل می‌شوند؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>امتیازهای کسب‌شده در هر سال، <strong>تا پایان سال بعد</strong> معتبرند و پس از آن منقضی می‌شوند. امتیازها <strong>صرفاً</strong> برای استفاده از پیشنهادهای باشگاه هستند و <strong>قابل نقد شدن نیستند</strong>.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">حساب کاربری سازمانی (حقوقی) هم امتیاز می‌گیرد؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>باشگاه مشتریان دشت‌زاد در حال حاضر تنها برای <strong>اشخاص حقیقی</strong> فعال است و حساب‌های کاربری حقوقی امکان جمع‌کردن امتیاز ندارند.</p>
						</div></div></div>
					</article>

				</div>
			</section>

			<!-- GROUP 7 — corporate gifts & B2B -->
			<section class="faq-group faq-group--clay" id="g-corporate">
				<div class="faq-group__head">
					<span class="faq-group__ic"><i class="fa-solid fa-gift"></i></span>
					<div>
						<h2 class="faq-group__t">هدایای سازمانی و خرید سازمانی</h2>
						<p class="faq-group__n">فاکتور رسمی، بسته‌بندی اختصاصی، توزیع چندمقصده و تسویه</p>
					</div>
				</div>
				<div class="faq-list">

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">شرایط صدور فاکتور رسمی چگونه است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>برای خریدهای سازمانی و عمده، <strong>فاکتور رسمی</strong> همراه با اطلاعات حقوقی و مالیات بر ارزش افزوده صادر می‌شود. کافی است پیش از ثبت سفارش، اطلاعات زیر را به کارشناس فروش سازمانی بدهید:</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-building"></i> نام شرکت و شناسه ملی</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-hashtag"></i> کد اقتصادی و نشانی</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-percent"></i> شامل ارزش افزوده</span>
							</div>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-file-invoice"></i><span>نسخه رسمی فاکتور پس از تایید سفارش برای شما ارسال می‌شود.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">تحویل سفارش هدایای سازمانی چگونه است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بسته به حجم سفارش، تحویل به دو صورت انجام می‌شود: <strong>تحویل یک‌جا</strong> به آدرس سازمان، یا <strong>توزیع جداگانه</strong> به گیرندگان. زمان‌بندی تحویل با هماهنگی قبلی و توسط کارشناس اختصاصی تنظیم می‌شود.</p>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-calendar-check"></i><span>برای مناسبت‌های خاص (مانند عید یا روزهای سازمانی) بهتر است سفارش را چند روز زودتر ثبت کنید.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">امکان بسته‌بندی محصول دیگری کنار محصولات دشت‌زاد وجود دارد؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله؛ امکان بسته‌بندی اقلام دیگر در کنار محصولات دشت‌زاد وجود دارد. جهت هماهنگی تماس بگیرید.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">امکان توزیع هدایای سازمانی به آدرس‌های مختلف وجود دارد؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله. کافی است فهرست <strong>گیرندگان و آدرس‌ها</strong> را در قالب یک فایل در اختیار ما بگذارید تا هر هدیه به‌صورت جداگانه به مقصد خودش ارسال شود.</p>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-map-location-dot"></i><span>هزینه توزیع چندمقصده بر اساس تعداد و پراکندگی آدرس‌ها محاسبه و پیش از تایید به شما اعلام می‌شود.</span></div>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">می‌توانیم کارت‌های هدیه را شخصی‌سازی کنیم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله. امکان درج <strong>لوگوی سازمان، پیام اختصاصی</strong> و طراحی کارت متناسب با هویت بصری شما وجود دارد تا هدیه حسّ و حال برند شما را داشته باشد.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">می‌توانیم ترکیب محصولی خودمان را انتخاب کنیم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>بله. سبد هدیه را می‌توانید از میان محصولات دشت‌زاد به‌دلخواه و متناسب با <strong>بودجه موردنظر</strong> بچینید؛ کارشناس ما هم برای چیدمان بهتر پیشنهاد می‌دهد.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">برای پیگیری سفارش چه کاری باید بکنم؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>برای سفارش‌های سازمانی، یک <strong>کارشناس اختصاصی</strong> پیگیری را برعهده دارد و در هر مرحله شما را در جریان می‌گذارد. همچنین وضعیت سفارش از صفحه <a href="<?php echo esc_url( home_url( '/track/' ) ); ?>">پیگیری سفارش</a> و از طریق پیامک قابل پیگیری است.</p>
						</div></div></div>
					</article>

					<article class="faq-item">
						<button class="faq-q" type="button">
							<span class="faq-q__ic"><i class="fa-solid fa-plus"></i></span>
							<span class="faq-q__txt">نحوه تسویه‌حساب چگونه است؟</span>
						</button>
						<div class="faq-a"><div class="faq-a__inner"><div class="faq-a__body">
							<p>تسویه‌حساب به چند روش امکان‌پذیر است:</p>
							<div class="faq-facts">
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-credit-card"></i> پرداخت آنلاین</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-building-columns"></i> واریز به حساب شرکتی</span>
								<span class="faq-fact faq-fact--clay"><i class="fa-solid fa-file-invoice-dollar"></i> تسویه مرحله‌ای (سازمانی)</span>
							</div>
							<div class="faq-note faq-note--clay"><i class="fa-solid fa-handshake"></i><span>برای سازمان‌ها، امکان تسویه مرحله‌ای (پیش‌پرداخت و تسویه مابقی پس از تایید) با توافق وجود دارد. حساب به نام «دشت‌زاد کشت و تجارت ایرانیان» است.</span></div>
							<a class="legal-link" href="#contact"><i class="fa-solid fa-headset"></i> تماس با کارشناس فروش سازمانی</a>
						</div></div></div>
					</article>

				</div>
			</section>

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
	/* ---------- accordion ---------- */
	var items = Array.prototype.slice.call(document.querySelectorAll('.faq-item'));
	items.forEach(function(item){
		var q = item.querySelector('.faq-q');
		if(!q) return;
		q.addEventListener('click', function(){
			var open = item.classList.contains('is-open');
			var group = item.closest('.faq-group');
			if(group){ group.querySelectorAll('.faq-item.is-open').forEach(function(o){ if(o !== item) o.classList.remove('is-open'); }); }
			item.classList.toggle('is-open', !open);
		});
	});
	if(items[0]) items[0].classList.add('is-open');

	/* ---------- live search filter ---------- */
	var input = document.getElementById('faqSearch');
	var clearBtn = document.getElementById('faqSearchClear');
	var groups = Array.prototype.slice.call(document.querySelectorAll('.faq-group'));
	var empty = document.getElementById('faqEmpty');
	function norm(s){ return (s||'').replace(/\u200c/g,' ').replace(/[\u064B-\u0652]/g,'').toLowerCase().trim(); }
	function runSearch(){
		if(!input) return;
		var q = norm(input.value);
		if(clearBtn) clearBtn.hidden = !input.value;
		var anyVisible = false;
		groups.forEach(function(group){
			var groupHas = false;
			group.querySelectorAll('.faq-item').forEach(function(item){
				var text = norm(item.textContent);
				var match = !q || text.indexOf(q) !== -1;
				item.style.display = match ? '' : 'none';
				if(match){ groupHas = true; anyVisible = true; }
				if(q && match) item.classList.add('is-open');
			});
			group.classList.toggle('is-hidden', !groupHas);
		});
		if(empty) empty.classList.toggle('show', !anyVisible);
	}
	if(input) input.addEventListener('input', runSearch);
	if(clearBtn) clearBtn.addEventListener('click', function(){ input.value=''; runSearch(); input.focus(); });

	/* ---------- sticky offset synced to header height ---------- */
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);

	/* ---------- side-nav scroll spy + smooth scroll ---------- */
	var links = Array.prototype.slice.call(document.querySelectorAll('#faqNav a[data-target]'));
	var sections = links.map(function(a){ return document.getElementById(a.dataset.target); });
	function paint(){
		var trigger = hdrH() + 60;
		var idx = 0;
		sections.forEach(function(s,i){ if(s && s.getBoundingClientRect().top < trigger) idx = i; });
		links.forEach(function(a,i){ a.classList.toggle('is-active', i === idx); });
	}
	window.addEventListener('scroll', paint, { passive:true });
	function jump(t){ var y = t.getBoundingClientRect().top + window.scrollY - hdrH() - 16; window.scrollTo({ top:y, behavior:'smooth' }); }
	links.forEach(function(a){ a.addEventListener('click', function(e){ e.preventDefault(); var t = document.getElementById(a.dataset.target); if(t) jump(t); }); });
	Array.prototype.slice.call(document.querySelectorAll('a[href^="#"]')).forEach(function(a){
		if(a.dataset.target) return;
		a.addEventListener('click', function(e){ var id = a.getAttribute('href').slice(1); var t = id && document.getElementById(id); if(t){ e.preventDefault(); jump(t); } });
	});
	paint();
})();
</script>

<?php
get_footer();
