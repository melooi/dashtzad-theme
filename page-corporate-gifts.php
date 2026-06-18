<?php
/**
 * Corporate gifts (هدایای سازمانی) — PAGE CONTENT ONLY.
 *
 * نسخه‌ی مرجع در wp/pages/. فقط «محتوای صفحه» (بدون get_header()/get_footer()).
 * صفحه‌ی B2B با تمرکز بر جعبه‌های هدیه‌ی برندشده، شخصی‌سازی و پیش‌فاکتور.
 * CSS اختصاصی: wp/css/corporate-gifts.css → assets/css/src/04-sections/corporate-gifts.css
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_occasions = array(
	array( 'icon' => 'fa-seedling', 'label' => 'نوروز' ),
	array( 'icon' => 'fa-moon', 'label' => 'شب یلدا' ),
	array( 'icon' => 'fa-user-tie', 'label' => 'روز کارمند' ),
	array( 'icon' => 'fa-ribbon', 'label' => 'افتتاحیه و رویداد' ),
	array( 'icon' => 'fa-handshake-angle', 'label' => 'قدردانی از مشتری' ),
);

$dz_collections = array(
	array( 'icon' => 'fa-box', 'tone' => 'bg-green text-white', 'name' => 'جعبه کلاسیک دشت‌زاد', 'desc' => 'آجیل ممتاز، خرما و چای در جعبه‌ی چوبی شکیل با کارت تبریک.', 'from' => 'از ۹۸۰٬۰۰۰', 'tag' => 'پرفروش' ),
	array( 'icon' => 'fa-gem', 'tone' => 'bg-clay text-white', 'name' => 'جعبه لوکس ویژه', 'desc' => 'زعفران قوطی‌دار، پسته اعلا و خشکبار درجه‌یک در باکس مخمل.', 'from' => 'از ۱٬۸۵۰٬۰۰۰', 'tag' => 'لوکس' ),
	array( 'icon' => 'fa-mug-saucer', 'tone' => 'bg-gold text-white', 'name' => 'ست چای و دمنوش', 'desc' => 'چای ممتاز لاهیجان و دمنوش‌های گیاهی همراه با لیوان اختصاصی.', 'from' => 'از ۶۴۰٬۰۰۰', 'tag' => 'اقتصادی' ),
);

$dz_custom = array(
	array( 'icon' => 'fa-stamp', 'tone' => 'bg-green-soft text-green-deep', 'hover' => 'group-hover/t:bg-green', 'title' => 'درج لوگوی شما', 'desc' => 'چاپ لوگو و نام سازمان روی جعبه، روبان و کارت تبریک.' ),
	array( 'icon' => 'fa-palette', 'tone' => 'bg-clay-soft text-clay-deep', 'hover' => 'group-hover/t:bg-clay', 'title' => 'بسته‌بندی اختصاصی', 'desc' => 'انتخاب رنگ، جنس جعبه و چیدمان محصولات مطابق سلیقه‌ی شما.' ),
	array( 'icon' => 'fa-file-invoice', 'tone' => 'bg-amber-soft text-gold-deep', 'hover' => 'group-hover/t:bg-gold', 'title' => 'فاکتور رسمی', 'desc' => 'صدور فاکتور رسمی با کد اقتصادی برای سفارش‌های سازمانی.' ),
	array( 'icon' => 'fa-handshake', 'tone' => 'bg-green-soft text-green-deep', 'hover' => 'group-hover/t:bg-green', 'title' => 'مشاوره‌ی رایگان', 'desc' => 'کارشناس ما در چیدمان سبد و انتخاب بودجه همراه‌تان است.' ),
);

$dz_steps = array(
	array( 'n' => '۱', 'icon' => 'fa-list-check', 'title' => 'انتخاب و سفارش', 'desc' => 'مناسبت، تعداد و بودجه را به ما بگویید.' ),
	array( 'n' => '۲', 'icon' => 'fa-pen-ruler', 'title' => 'طراحی و نمونه', 'desc' => 'طرح بسته‌بندی و چیدمان سبد را برایتان آماده می‌کنیم.' ),
	array( 'n' => '۳', 'icon' => 'fa-clipboard-check', 'title' => 'تایید نهایی', 'desc' => 'پس از تایید طرح و پیش‌فاکتور، سفارش وارد تولید می‌شود.' ),
	array( 'n' => '۴', 'icon' => 'fa-truck-ramp-box', 'title' => 'تولید و ارسال', 'desc' => 'جعبه‌ها آماده و در زمان مقرر تحویل سازمان شما می‌شوند.' ),
);
get_header();
?>
<main data-screen-label="corporate-gifts">

	<!-- hero -->
	<section class="dz-lead-hero" data-screen-label="gifts-hero">
		<div class="dz-lead-hero__inner mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<span class="dz-lead-hero__kicker"><i class="fa-solid fa-gift"></i> <?php esc_html_e( 'هدایای سازمانی دشت‌زاد', 'dashtzad' ); ?></span>
			<h1 class="dz-lead-hero__title"><?php esc_html_e( 'هدیه‌ی سازمانی، به نام برند شما', 'dashtzad' ); ?></h1>
			<p class="dz-lead-hero__sub"><?php esc_html_e( 'برای کارکنان، مشتریان و شرکای تجاری‌تان یک هدیه‌ی اصیل و ماندگار انتخاب کنید — جعبه‌های دست‌چینِ آجیل، زعفران، چای و خشکبار، با بسته‌بندی اختصاصی و لوگوی سازمان شما.', 'dashtzad' ); ?></p>
			<div class="dz-lead-hero__cta">
				<a class="dz-btn dz-btn--solid" href="#quote"><i class="fa-solid fa-file-invoice"></i> <?php esc_html_e( 'دریافت پیش‌فاکتور', 'dashtzad' ); ?></a>
				<a class="dz-btn dz-btn--clear" href="#collections"><i class="fa-solid fa-box-open"></i> <?php esc_html_e( 'مشاهده مجموعه‌ها', 'dashtzad' ); ?></a>
			</div>
			<div class="dz-lead-hero__stats">
				<span><b class="num">۳۰۰+</b> <?php esc_html_e( 'سازمان طرف قرارداد', 'dashtzad' ); ?></span>
				<span class="dz-lead-hero__dot" aria-hidden="true"></span>
				<span><i class="fa-solid fa-stamp text-honey"></i> <?php esc_html_e( 'چاپ لوگو', 'dashtzad' ); ?></span>
				<span class="dz-lead-hero__dot" aria-hidden="true"></span>
				<span><i class="fa-solid fa-file-invoice text-honey"></i> <?php esc_html_e( 'فاکتور رسمی', 'dashtzad' ); ?></span>
			</div>
		</div>
	</section>

	<!-- occasions -->
	<section class="py-[clamp(3.2rem,4.5vw,4.8rem)]">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<p class="dz-occ-lead"><?php esc_html_e( 'برای هر مناسبتی، یک هدیه‌ی درخور:', 'dashtzad' ); ?></p>
			<div class="dz-occ-grid">
				<?php foreach ( $dz_occasions as $dz_o ) : ?>
					<div class="dz-occ"><span class="dz-occ__ic"><i class="fa-solid <?php echo esc_attr( $dz_o['icon'] ); ?>"></i></span> <span class="dz-occ__l"><?php echo esc_html( $dz_o['label'] ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- collections -->
	<section class="py-[clamp(3.6rem,5.5vw,6rem)] bg-surface-warm border-y border-hair" id="collections">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'مجموعه‌های آماده', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'جعبه‌های هدیه‌ی سازمانی', 'dashtzad' ); ?></h2>
				<p class="text-ink-soft text-[1.5rem] mt-[.8rem] max-w-[62rem]"><?php esc_html_e( 'از یک نقطه شروع کنید؛ هر مجموعه را می‌توانیم مطابق بودجه و سلیقه‌ی شما شخصی‌سازی کنیم.', 'dashtzad' ); ?></p>
			</div>
			<div class="grid grid-cols-1 md:grid-cols-3 gap-[clamp(1.6rem,2.2vw,2.4rem)]">
				<?php foreach ( $dz_collections as $dz_c ) : ?>
					<a class="dz-bundle" href="#quote">
						<div class="dz-bundle__media dz-placeholder"><span class="dz-placeholder__label absolute start-[1.2rem] end-[1.2rem] bottom-[1.2rem] mx-auto w-fit">عکس <?php echo esc_html( $dz_c['name'] ); ?></span><span class="dz-bundle__icon <?php echo esc_attr( $dz_c['tone'] ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_c['icon'] ); ?>"></i></span><span class="dz-bundle__tag"><?php echo esc_html( $dz_c['tag'] ); ?></span></div>
						<div class="dz-bundle__body">
							<h3 class="dz-bundle__name"><?php echo esc_html( $dz_c['name'] ); ?></h3>
							<p class="dz-bundle__desc"><?php echo esc_html( $dz_c['desc'] ); ?></p>
							<div class="dz-bundle__foot">
								<span class="dz-bundle__price num"><?php echo esc_html( $dz_c['from'] ); ?> <span class="dz-bundle__t"><?php esc_html_e( 'تومان', 'dashtzad' ); ?></span></span>
								<span class="dz-bundle__go"><?php esc_html_e( 'پیش‌فاکتور', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left"></i></span>
							</div>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- customization -->
	<section class="py-[clamp(3.6rem,5.5vw,6rem)]">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'به نام شما', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'هر جعبه، نمایندهٔ برند شما', 'dashtzad' ); ?></h2>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[clamp(1.6rem,2vw,2.2rem)]">
				<?php foreach ( $dz_custom as $dz_b ) : ?>
					<div class="group/t bg-white border border-hair rounded-lg p-[2.6rem_2.2rem] hover:border-green hover:shadow-card hover:-translate-y-[3px] transition-all">
						<div class="w-[5.6rem] h-[5.6rem] rounded-md grid place-items-center <?php echo esc_attr( $dz_b['tone'] ); ?> text-[2.2rem] mb-[1.8rem] <?php echo esc_attr( $dz_b['hover'] ); ?> group-hover/t:text-white transition-colors"><i class="fa-solid <?php echo esc_attr( $dz_b['icon'] ); ?>"></i></div>
						<h3 class="font-display font-bold text-[1.85rem]"><?php echo esc_html( $dz_b['title'] ); ?></h3>
						<p class="text-ink-soft text-[1.4rem] leading-[1.8] mt-[.8rem]"><?php echo esc_html( $dz_b['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- steps -->
	<section class="py-[clamp(3.6rem,5.5vw,6rem)] bg-surface-warm border-y border-hair">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'مسیر سفارش', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'از ایده تا تحویل، در چهار گام', 'dashtzad' ); ?></h2>
			</div>
			<div class="dz-steps">
				<?php foreach ( $dz_steps as $dz_s ) : ?>
					<div class="dz-step">
						<span class="dz-step__n num"><?php echo esc_html( $dz_s['n'] ); ?></span>
						<span class="dz-step__ic"><i class="fa-solid <?php echo esc_attr( $dz_s['icon'] ); ?>"></i></span>
						<h3 class="dz-step__t"><?php echo esc_html( $dz_s['title'] ); ?></h3>
						<p class="dz-step__d"><?php echo esc_html( $dz_s['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- quote form -->
	<section class="py-[clamp(3.6rem,5.5vw,6.4rem)]" id="quote">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-quote">
				<div class="dz-quote__intro">
					<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em]"><i class="fa-solid fa-file-invoice"></i> <?php esc_html_e( 'درخواست پیش‌فاکتور', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.4rem,3vw,3.4rem)] leading-[1.18] mt-[1.2rem] text-white"><?php esc_html_e( 'سفارش هدیه‌ی سازمانی خود را شروع کنید', 'dashtzad' ); ?></h2>
					<p class="text-white/80 text-[1.55rem] leading-[1.9] mt-[1.2rem]"><?php esc_html_e( 'مناسبت، تعداد و بودجه را بنویسید؛ کارشناس ما با طرح پیشنهادی و پیش‌فاکتور با شما تماس می‌گیرد.', 'dashtzad' ); ?></p>
					<ul class="dz-quote__list">
						<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'طراحی نمونه پیش از تولید', 'dashtzad' ); ?></li>
						<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'چاپ لوگو و کارت اختصاصی', 'dashtzad' ); ?></li>
						<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'تحویل در زمان مقرر شما', 'dashtzad' ); ?></li>
					</ul>
				</div>
				<form class="dz-quote__form" id="giftForm" onsubmit="return dzGiftSubmit(event)">
					<div class="dz-form-row">
						<div class="dz-field">
							<label for="gName"><?php esc_html_e( 'نام و سازمان', 'dashtzad' ); ?> <span class="req">*</span></label>
							<input type="text" id="gName" required placeholder="<?php esc_attr_e( 'مثلا زهرا رحیمی — شرکت آبان', 'dashtzad' ); ?>" />
						</div>
						<div class="dz-field">
							<label for="gPhone"><?php esc_html_e( 'شماره موبایل', 'dashtzad' ); ?> <span class="req">*</span></label>
							<input type="tel" id="gPhone" required inputmode="tel" dir="ltr" placeholder="۰۹۱۲ ۰۰۰ ۰۰۰۰" />
						</div>
					</div>
					<div class="dz-form-row">
						<div class="dz-field">
							<label for="gOcc"><?php esc_html_e( 'مناسبت', 'dashtzad' ); ?></label>
							<select id="gOcc">
								<option value="" disabled selected><?php esc_html_e( 'انتخاب کنید', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'نوروز', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'شب یلدا', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'روز کارمند', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'افتتاحیه و رویداد', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'سایر', 'dashtzad' ); ?></option>
							</select>
						</div>
						<div class="dz-field">
							<label for="gCount"><?php esc_html_e( 'تعداد تقریبی', 'dashtzad' ); ?></label>
							<select id="gCount">
								<option value="" disabled selected><?php esc_html_e( 'انتخاب کنید', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'زیر ۵۰ عدد', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( '۵۰ تا ۲۰۰ عدد', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( '۲۰۰ تا ۵۰۰ عدد', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'بالای ۵۰۰ عدد', 'dashtzad' ); ?></option>
							</select>
						</div>
					</div>
					<div class="dz-field">
						<label for="gNote"><?php esc_html_e( 'توضیحات و بودجه', 'dashtzad' ); ?></label>
						<textarea id="gNote" placeholder="<?php esc_attr_e( 'مثلا: بودجه تقریبی هر جعبه، نوع محصولات مورد علاقه، تاریخ تحویل…', 'dashtzad' ); ?>"></textarea>
					</div>
					<button class="dz-btn dz-btn--solid w-full" type="submit"><i class="fa-solid fa-paper-plane"></i> <?php esc_html_e( 'ارسال درخواست پیش‌فاکتور', 'dashtzad' ); ?></button>
					<div class="dz-form-ok" id="giftOk"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'درخواست شما ثبت شد! کارشناس ما به‌زودی تماس می‌گیرد.', 'dashtzad' ); ?></div>
				</form>
			</div>
		</div>
	</section>

</main>

<script>
(function () {
	function hdrH(){ var h = document.querySelector('.dz-header-main'); return h ? h.offsetHeight : 170; }
	function syncHdrVar(){ document.documentElement.style.setProperty('--hdr-h', hdrH() + 'px'); }
	syncHdrVar();
	window.addEventListener('resize', syncHdrVar);
	document.addEventListener('dz:partials-ready', syncHdrVar);
})();
function dzGiftSubmit(e){
	e.preventDefault();
	var f = document.getElementById('giftForm'), ok = document.getElementById('giftOk');
	f.querySelectorAll('input, select, textarea').forEach(function (el) { el.value = ''; el.selectedIndex = 0; });
	ok.classList.add('show');
	setTimeout(function () { ok.classList.remove('show'); }, 6000);
	return false;
}
</script>

<?php
get_footer();
