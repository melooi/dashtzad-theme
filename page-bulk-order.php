<?php
/**
 * Bulk order (خرید عمده) — PAGE CONTENT ONLY.
 *
 * نسخه‌ی مرجع در wp/pages/. فقط «محتوای صفحه» (بدون get_header()/get_footer()).
 * صفحه‌ی فروشِ B2B با تمرکز بر قیمت پلکانی، فاکتور رسمی و استعلامِ عمده.
 * CSS اختصاصی: wp/css/bulk-order.css → assets/css/src/04-sections/bulk-order.css
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_audiences = array(
	array( 'icon' => 'fa-utensils', 'label' => 'رستوران و کافه' ),
	array( 'icon' => 'fa-store', 'label' => 'فروشگاه و سوپرمارکت' ),
	array( 'icon' => 'fa-industry', 'label' => 'صنایع غذایی' ),
	array( 'icon' => 'fa-champagne-glasses', 'label' => 'تشریفات و مجالس' ),
);

$dz_benefits = array(
	array( 'icon' => 'fa-chart-line', 'tone' => 'bg-green-soft text-green-deep', 'hover' => 'group-hover/t:bg-green', 'title' => 'قیمت پلکانی', 'desc' => 'هرچه حجم سفارش بیشتر، قیمت هر واحد کمتر — تا ۲۵٪ صرفه‌جویی.' ),
	array( 'icon' => 'fa-file-invoice', 'tone' => 'bg-clay-soft text-clay-deep', 'hover' => 'group-hover/t:bg-clay', 'title' => 'فاکتور رسمی', 'desc' => 'صدور فاکتور رسمی با کد اقتصادی برای همه‌ی سفارش‌های عمده.' ),
	array( 'icon' => 'fa-truck-fast', 'tone' => 'bg-amber-soft text-gold-deep', 'hover' => 'group-hover/t:bg-gold', 'title' => 'ارسال سراسری', 'desc' => 'ارسال مطمئن به سراسر کشور با باربری معتمد و بسته‌بندی صنعتی.' ),
	array( 'icon' => 'fa-user-tie', 'tone' => 'bg-green-soft text-green-deep', 'hover' => 'group-hover/t:bg-green', 'title' => 'کارشناس اختصاصی', 'desc' => 'یک کارشناس فروش، از استعلام تا تحویل، همراه کسب‌وکار شماست.' ),
);

$dz_tiers = array(
	array( 'name' => 'عمده‌ی خرد', 'range' => '۱۰ تا ۵۰ کیلو', 'off' => '۱۰٪', 'feats' => array( 'تخفیف پایه روی همه اقلام', 'فاکتور رسمی', 'ارسال سراسری' ), 'featured' => false ),
	array( 'name' => 'عمده‌ی متوسط', 'range' => '۵۰ تا ۲۰۰ کیلو', 'off' => '۱۸٪', 'feats' => array( 'تخفیف ویژه‌ی حجمی', 'فاکتور رسمی + مهلت تسویه', 'ارسال رایگان سراسری', 'کارشناس اختصاصی' ), 'featured' => true ),
	array( 'name' => 'عمده‌ی کلان', 'range' => 'بالای ۲۰۰ کیلو', 'off' => 'تا ۲۵٪', 'feats' => array( 'بهترین قیمت هر واحد', 'قرارداد تامین دوره‌ای', 'اولویت موجودی و ارسال', 'مدیر حساب اختصاصی' ), 'featured' => false ),
);

$dz_steps = array(
	array( 'n' => '۱', 'icon' => 'fa-file-pen', 'title' => 'ثبت درخواست', 'desc' => 'فرم استعلام را پر کنید یا با ما تماس بگیرید.' ),
	array( 'n' => '۲', 'icon' => 'fa-file-invoice-dollar', 'title' => 'دریافت پیش‌فاکتور', 'desc' => 'کارشناس ما حداکثر ظرف یک روز کاری پیش‌فاکتور می‌فرستد.' ),
	array( 'n' => '۳', 'icon' => 'fa-handshake', 'title' => 'تایید و پرداخت', 'desc' => 'پس از توافق، سفارش نهایی و فاکتور رسمی صادر می‌شود.' ),
	array( 'n' => '۴', 'icon' => 'fa-truck-ramp-box', 'title' => 'بسته‌بندی و ارسال', 'desc' => 'سفارش با بسته‌بندی صنعتی به سراسر کشور ارسال می‌شود.' ),
);
get_header();
?>
<main data-screen-label="bulk-order">

	<!-- hero -->
	<section class="dz-lead-hero" data-screen-label="bulk-hero">
		<div class="dz-lead-hero__inner mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<span class="dz-lead-hero__kicker"><i class="fa-solid fa-box-open"></i> <?php esc_html_e( 'خرید عمده دشت‌زاد', 'dashtzad' ); ?></span>
			<h1 class="dz-lead-hero__title"><?php esc_html_e( 'خرید عمده با قیمت پلکانی', 'dashtzad' ); ?></h1>
			<p class="dz-lead-hero__sub"><?php esc_html_e( 'برای رستوران، فروشگاه، کافه و هر کسب‌وکار با مصرف بالا — برنج، حبوبات، خشکبار، چای و ادویه‌ی مرغوب، مستقیم از باغ و بدون واسطه. هرچه بیشتر بخرید، قیمت هر واحد کمتر می‌شود.', 'dashtzad' ); ?></p>
			<div class="dz-lead-hero__cta">
				<a class="dz-btn dz-btn--solid" href="#quote"><i class="fa-solid fa-file-invoice"></i> <?php esc_html_e( 'دریافت استعلام قیمت', 'dashtzad' ); ?></a>
				<a class="dz-btn dz-btn--clear" href="tel:02192002661"><i class="fa-solid fa-phone"></i> <?php esc_html_e( '۰۲۱-۹۲۰۰۲۶۶۱', 'dashtzad' ); ?></a>
			</div>
			<div class="dz-lead-hero__stats">
				<span><b class="num">۱۵۰+</b> <?php esc_html_e( 'کسب‌وکار طرف قرارداد', 'dashtzad' ); ?></span>
				<span class="dz-lead-hero__dot" aria-hidden="true"></span>
				<span><i class="fa-solid fa-file-invoice text-honey"></i> <?php esc_html_e( 'فاکتور رسمی', 'dashtzad' ); ?></span>
				<span class="dz-lead-hero__dot" aria-hidden="true"></span>
				<span><i class="fa-solid fa-truck-fast text-honey"></i> <?php esc_html_e( 'ارسال سراسری', 'dashtzad' ); ?></span>
			</div>
		</div>
	</section>

	<!-- audiences -->
	<section class="py-[clamp(3.2rem,4.5vw,4.8rem)]">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="dz-aud-grid">
				<?php foreach ( $dz_audiences as $dz_a ) : ?>
					<div class="dz-aud"><span class="dz-aud__ic"><i class="fa-solid <?php echo esc_attr( $dz_a['icon'] ); ?>"></i></span> <span class="dz-aud__l"><?php echo esc_html( $dz_a['label'] ); ?></span></div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- benefits -->
	<section class="py-[clamp(3.2rem,5vw,5.6rem)] bg-surface-warm border-y border-hair">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="mb-[clamp(2.4rem,3.5vw,3.6rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><?php esc_html_e( 'چرا خرید عمده از دشت‌زاد؟', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'مزیتِ خریدِ مستقیم و بی‌واسطه', 'dashtzad' ); ?></h2>
			</div>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-[clamp(1.6rem,2vw,2.2rem)]">
				<?php foreach ( $dz_benefits as $dz_b ) : ?>
					<div class="group/t bg-white border border-hair rounded-lg p-[2.6rem_2.2rem] hover:border-green hover:shadow-card hover:-translate-y-[3px] transition-all">
						<div class="w-[5.6rem] h-[5.6rem] rounded-md grid place-items-center <?php echo esc_attr( $dz_b['tone'] ); ?> text-[2.2rem] mb-[1.8rem] <?php echo esc_attr( $dz_b['hover'] ); ?> group-hover/t:text-white transition-colors"><i class="fa-solid <?php echo esc_attr( $dz_b['icon'] ); ?>"></i></div>
						<h3 class="font-display font-bold text-[1.85rem]"><?php echo esc_html( $dz_b['title'] ); ?></h3>
						<p class="text-ink-soft text-[1.4rem] leading-[1.8] mt-[.8rem]"><?php echo esc_html( $dz_b['desc'] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- tiered pricing -->
	<section class="py-[clamp(3.6rem,5.5vw,6rem)]">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)]">
			<div class="text-center max-w-[60rem] mx-auto mb-[clamp(2.8rem,4vw,4rem)]">
				<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em]"><?php esc_html_e( 'هرچه بیشتر، ارزان‌تر', 'dashtzad' ); ?></span>
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'پله‌های تخفیف عمده', 'dashtzad' ); ?></h2>
				<p class="text-ink-soft text-[1.5rem] mt-[.8rem]"><?php esc_html_e( 'درصد تخفیف بر اساس حجم کل سفارش محاسبه می‌شود. برای قیمت دقیق، استعلام بگیرید.', 'dashtzad' ); ?></p>
			</div>
			<div class="dz-tier-grid">
				<?php foreach ( $dz_tiers as $dz_t ) : ?>
					<div class="dz-tier<?php echo $dz_t['featured'] ? ' is-featured' : ''; ?>">
						<?php if ( $dz_t['featured'] ) : ?><span class="dz-tier__flag"><i class="fa-solid fa-star"></i> <?php esc_html_e( 'محبوب‌ترین', 'dashtzad' ); ?></span><?php endif; ?>
						<span class="dz-tier__name"><?php echo esc_html( $dz_t['name'] ); ?></span>
						<span class="dz-tier__range"><?php echo esc_html( $dz_t['range'] ); ?></span>
						<div class="dz-tier__off"><span class="num"><?php echo esc_html( $dz_t['off'] ); ?></span> <span class="dz-tier__off-l"><?php esc_html_e( 'تخفیف', 'dashtzad' ); ?></span></div>
						<ul class="dz-tier__feats">
							<?php foreach ( $dz_t['feats'] as $dz_f ) : ?>
								<li><i class="fa-solid fa-check"></i> <?php echo esc_html( $dz_f ); ?></li>
							<?php endforeach; ?>
						</ul>
						<a class="dz-btn <?php echo $dz_t['featured'] ? 'dz-btn--solid' : 'dz-btn--outline'; ?> dz-tier__cta" href="#quote"><?php esc_html_e( 'استعلام این پله', 'dashtzad' ); ?></a>
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
				<h2 class="font-display font-bold text-[clamp(2.6rem,3.4vw,3.8rem)] mt-[1.1rem] tracking-[-.01em]"><?php esc_html_e( 'از استعلام تا تحویل، در چهار گام', 'dashtzad' ); ?></h2>
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
					<span class="inline-flex items-center gap-[.8rem] font-bold text-[1.3rem] text-honey tracking-[.04em]"><i class="fa-solid fa-file-invoice"></i> <?php esc_html_e( 'استعلام قیمت عمده', 'dashtzad' ); ?></span>
					<h2 class="font-display font-bold text-[clamp(2.4rem,3vw,3.4rem)] leading-[1.18] mt-[1.2rem] text-white"><?php esc_html_e( 'درخواست‌تان را بفرستید، قیمت می‌دهیم', 'dashtzad' ); ?></h2>
					<p class="text-white/80 text-[1.55rem] leading-[1.9] mt-[1.2rem]"><?php esc_html_e( 'فرم را پر کنید؛ کارشناس فروش دشت‌زاد حداکثر ظرف یک روز کاری با پیش‌فاکتور با شما تماس می‌گیرد.', 'dashtzad' ); ?></p>
					<ul class="dz-quote__list">
						<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'بدون هیچ هزینه و تعهدی', 'dashtzad' ); ?></li>
						<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'پاسخ حداکثر ظرف یک روز کاری', 'dashtzad' ); ?></li>
						<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'مشاوره‌ی رایگان انتخاب محصول', 'dashtzad' ); ?></li>
					</ul>
				</div>
				<form class="dz-quote__form" id="bulkForm" onsubmit="return dzBulkSubmit(event)">
					<div class="dz-form-row">
						<div class="dz-field">
							<label for="bName"><?php esc_html_e( 'نام و نام خانوادگی', 'dashtzad' ); ?> <span class="req">*</span></label>
							<input type="text" id="bName" required placeholder="<?php esc_attr_e( 'مثلا زهرا رحیمی', 'dashtzad' ); ?>" />
						</div>
						<div class="dz-field">
							<label for="bPhone"><?php esc_html_e( 'شماره موبایل', 'dashtzad' ); ?> <span class="req">*</span></label>
							<input type="tel" id="bPhone" required inputmode="tel" dir="ltr" placeholder="۰۹۱۲ ۰۰۰ ۰۰۰۰" />
						</div>
					</div>
					<div class="dz-form-row">
						<div class="dz-field">
							<label for="bBiz"><?php esc_html_e( 'نوع کسب‌وکار', 'dashtzad' ); ?></label>
							<select id="bBiz">
								<option value="" disabled selected><?php esc_html_e( 'انتخاب کنید', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'رستوران / کافه', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'فروشگاه / سوپرمارکت', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'صنایع غذایی', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'تشریفات و مجالس', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'سایر', 'dashtzad' ); ?></option>
							</select>
						</div>
						<div class="dz-field">
							<label for="bQty"><?php esc_html_e( 'حجم تقریبی سفارش', 'dashtzad' ); ?></label>
							<select id="bQty">
								<option value="" disabled selected><?php esc_html_e( 'انتخاب کنید', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( '۱۰ تا ۵۰ کیلو', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( '۵۰ تا ۲۰۰ کیلو', 'dashtzad' ); ?></option>
								<option><?php esc_html_e( 'بالای ۲۰۰ کیلو', 'dashtzad' ); ?></option>
							</select>
						</div>
					</div>
					<div class="dz-field">
						<label for="bItems"><?php esc_html_e( 'محصولات مورد نظر', 'dashtzad' ); ?> <span class="req">*</span></label>
						<textarea id="bItems" required placeholder="<?php esc_attr_e( 'مثلا: برنج هاشمی ۱۰۰ کیلو، لپه ۵۰ کیلو، چای ۲۰ کیلو…', 'dashtzad' ); ?>"></textarea>
					</div>
					<button class="dz-btn dz-btn--solid w-full" type="submit"><i class="fa-solid fa-paper-plane"></i> <?php esc_html_e( 'ارسال درخواست استعلام', 'dashtzad' ); ?></button>
					<div class="dz-form-ok" id="bulkOk"><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'درخواست شما ثبت شد! کارشناس ما به‌زودی تماس می‌گیرد.', 'dashtzad' ); ?></div>
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
function dzBulkSubmit(e){
	e.preventDefault();
	var f = document.getElementById('bulkForm'), ok = document.getElementById('bulkOk');
	f.querySelectorAll('input, select, textarea').forEach(function (el) { el.value = ''; el.selectedIndex = 0; });
	ok.classList.add('show');
	setTimeout(function () { ok.classList.remove('show'); }, 6000);
	return false;
}
</script>

<?php
get_footer();
