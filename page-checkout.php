<?php
/**
 * Template Name: تسویه حساب
 * پیش‌نمایش — تسویه حساب — PAGE CONTENT ONLY (نسخه‌ی مرجع wp/pages/).
 *
 * فقط «محتوای صفحه»؛ بدون get_header()/get_footer().
 * هدر/فوتر از قالب اصلی (header-main / footer-main).
 * هنگام انتقال، محتوای <main> داخل page-checkout.php قرار می‌گیرد.
 * CSS اختصاصی: wp/css/checkout.css → assets/css/src/04-sections/checkout.css
 *
 * فرایند چندمرحله‌ای CRO: ورود پیامکی → آدرس ارسال → زمان/روش ارسال → پرداخت.
 * بدون دارک‌پترن، تایمر جعلی یا فشار دروغین. سال برند: ۱۳۱۳.
 *
 * امنیت: nonce برای فرم‌ها، sanitize/validate ورودی‌ها، rate-limit برای OTP.
 *   هندلرهای مرجع پایین در بلوک گاردشده آمده‌اند؛ هنگام انتقال به
 *   dashtzad-theme/inc/ منتقل و به wp_ajax_* وصل شوند (نه داخل تمپلیت).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/* ============================================================
   هندلرهای سمت سرور — نسخهٔ مرجع (به inc/checkout-ajax.php منتقل شود)
   هیچ‌کدام اطلاعات حساس را در HTML چاپ نمی‌کنند.
   ============================================================ */
if ( ! function_exists( 'dz_validate_mobile' ) ) {
	/** اعتبارسنجی موبایل ایران: ۱۱ رقم و شروع با ۰۹. */
	function dz_validate_mobile( $raw ) {
		$m = preg_replace( '/\D+/', '', (string) $raw ); // فقط رقم
		return ( preg_match( '/^09\d{9}$/', $m ) === 1 ) ? $m : false;
	}
}
if ( ! function_exists( 'dz_validate_postcode' ) ) {
	/** اعتبارسنجی کد پستی: دقیقاً ۱۰ رقم. */
	function dz_validate_postcode( $raw ) {
		$p = preg_replace( '/\D+/', '', (string) $raw );
		return ( strlen( $p ) === 10 ) ? $p : false;
	}
}
if ( ! function_exists( 'dz_otp_send' ) ) {
	/**
	 * ارسال کد یک‌بارمصرف با محدودیت نرخ: حداکثر ۳ بار در ساعت برای هر شماره.
	 * @return array{ok:bool, code?:int, msg:string}
	 */
	function dz_otp_send() {
		// nonce
		if ( ! isset( $_POST['dz_otp_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dz_otp_nonce'] ), 'dz_otp' ) ) {
			return array( 'ok' => false, 'msg' => 'درخواست نامعتبر است.' );
		}
		$mobile = dz_validate_mobile( $_POST['mobile'] ?? '' );
		if ( ! $mobile ) {
			return array( 'ok' => false, 'msg' => 'شماره موبایل باید ۱۱ رقم و با ۰۹ شروع شود.' );
		}
		// rate-limit: ۳ بار در ساعت (transient کلیددار با هش شماره)
		$key   = 'dz_otp_' . md5( $mobile );
		$tries = (int) get_transient( $key );
		if ( $tries >= 3 ) {
			return array( 'ok' => false, 'msg' => 'تعداد درخواست‌ها زیاد است. کمی بعد دوباره تلاش کنید.' );
		}
		set_transient( $key, $tries + 1, HOUR_IN_SECONDS );

		// تولید و ارسال کد (پیامک از طریق سرویس‌دهنده). کد هرگز در پاسخ HTML برنمی‌گردد.
		$code = wp_rand( 10000, 99999 );
		set_transient( 'dz_otp_code_' . md5( $mobile ), (string) $code, 2 * MINUTE_IN_SECONDS );
		// dz_sms_gateway_send( $mobile, $code );

		return array( 'ok' => true, 'msg' => 'کد تأیید ارسال شد.' );
	}
}
if ( ! function_exists( 'dz_checkout_save_address' ) ) {
	/** ذخیرهٔ آدرس با sanitize کامل و بررسی nonce. */
	function dz_checkout_save_address() {
		if ( ! isset( $_POST['dz_addr_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['dz_addr_nonce'] ), 'dz_addr' ) ) {
			return array( 'ok' => false, 'msg' => 'درخواست نامعتبر است.' );
		}
		$mobile   = dz_validate_mobile( $_POST['receiver_mobile'] ?? '' );
		$postcode = dz_validate_postcode( $_POST['postcode'] ?? '' );
		if ( ! $mobile )   { return array( 'ok' => false, 'msg' => 'شماره موبایل گیرنده معتبر نیست.' ); }
		if ( ! $postcode ) { return array( 'ok' => false, 'msg' => 'کد پستی باید ۱۰ رقم باشد.' ); }

		$address = array(
			'name'      => sanitize_text_field( $_POST['receiver_name'] ?? '' ),
			'mobile'    => $mobile,
			'province'  => sanitize_text_field( $_POST['province'] ?? '' ),
			'city'      => sanitize_text_field( $_POST['city'] ?? '' ),
			'line'      => sanitize_textarea_field( $_POST['address_line'] ?? '' ),
			'plaque'    => sanitize_text_field( $_POST['plaque'] ?? '' ),
			'unit'      => sanitize_text_field( $_POST['unit'] ?? '' ),
			'postcode'  => $postcode,
			'note'      => sanitize_textarea_field( $_POST['address_note'] ?? '' ),
			'lat'       => isset( $_POST['lat'] ) ? (float) $_POST['lat'] : 0.0,
			'lng'       => isset( $_POST['lng'] ) ? (float) $_POST['lng'] : 0.0,
		);
		if ( '' === $address['name'] || '' === $address['line'] ) {
			return array( 'ok' => false, 'msg' => 'نام گیرنده و آدرس کامل لازم است.' );
		}
		// update_user_meta( get_current_user_id(), 'dz_address', $address );
		return array( 'ok' => true, 'msg' => 'آدرس ذخیره شد.' );
	}
}

/* وضعیت نمایشی — در WP واقعی با is_user_logged_in() جایگزین شود. */
$dz_is_logged_in = false;
$dz_has_address  = true;
get_header();
?>

<main data-screen-label="checkout" class="dz-checkout"
      data-logged="<?php echo $dz_is_logged_in ? '1' : '0'; ?>"
      data-has-address="<?php echo $dz_has_address ? '1' : '0'; ?>">

	<!-- ============================= HERO + STEPPER ============================= -->
	<section class="dz-co-hero">
		<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] dz-co-hero__inner">
			<nav class="dz-co-hero__crumbs" aria-label="مسیر صفحه">
				<span class="dz-co-hero__eyebrow"><i class="fa-solid fa-shield-halved"></i> تسویهٔ امن</span>
				<span aria-hidden="true" style="opacity:.4;margin-inline:.4rem">|</span>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">خانه</a> <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
				<a href="<?php echo esc_url( home_url( '/cart/' ) ); ?>">سبد خرید</a> <i class="fa-solid fa-angle-left" aria-hidden="true"></i>
				<span>تسویه حساب</span>
			</nav>
			<div class="dz-co-hero__head">
				<h1 class="dz-co-hero__title">تکمیل سفارش</h1>
			</div>

			<ol class="dz-steps" id="dzStepper" aria-label="مراحل تکمیل سفارش">
				<li class="dz-steps__item is-active" data-step="1">
					<span class="dz-steps__dot" aria-hidden="true">۱</span>
					<span class="dz-steps__lbl">ورود</span>
				</li>
				<li class="dz-steps__line"></li>
				<li class="dz-steps__item" data-step="2">
					<span class="dz-steps__dot" aria-hidden="true">۲</span>
					<span class="dz-steps__lbl">آدرس</span>
				</li>
				<li class="dz-steps__line"></li>
				<li class="dz-steps__item" data-step="3">
					<span class="dz-steps__dot" aria-hidden="true">۳</span>
					<span class="dz-steps__lbl">ارسال</span>
				</li>
				<li class="dz-steps__line"></li>
				<li class="dz-steps__item" data-step="4">
					<span class="dz-steps__dot" aria-hidden="true">۴</span>
					<span class="dz-steps__lbl">پرداخت</span>
				</li>
			</ol>
		</div>
	</section>

	<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] dz-co-layout">

		<!-- ===================== ستون اصلی (مراحل) ===================== -->
		<div class="dz-co-main">

			<!-- مرحله ۱ — ورود -->
			<section class="dz-step is-active" id="dzStep1" data-step="1" aria-labelledby="dzStep1H">
				<div class="dz-step__h">
					<span class="dz-step__no">۱</span>
					<div class="dz-step__ht">
						<h2 class="dz-step__t" id="dzStep1H" tabindex="-1">ورود به حساب</h2>
						<p class="dz-step__s" data-summary>برای ادامهٔ خرید وارد شوید</p>
					</div>
					<button type="button" class="dz-step__edit" data-edit="1" hidden><i class="fa-solid fa-pen"></i> تغییر</button>
				</div>
				<div class="dz-step__b">
					<div class="dz-co-user" data-when="guest">
						<span class="dz-co-user__av"><i class="fa-solid fa-mobile-screen-button"></i></span>
						<div class="dz-co-user__info">
							<b>ورود با شمارهٔ موبایل</b>
							<span>کد تأیید پیامکی برایتان ارسال می‌شود.</span>
						</div>
					</div>
					<div class="dz-form-actions" style="margin-top:1.4rem">
						<button type="button" class="dz-btn dz-btn--primary" id="dzOpenLogin">
							<i class="fa-solid fa-arrow-left-to-bracket"></i> ورود و ادامهٔ خرید
						</button>
					</div>
				</div>
			</section>

			<!-- مرحله ۲ — آدرس ارسال -->
			<section class="dz-step" id="dzStep2" data-step="2" aria-labelledby="dzStep2H">
				<div class="dz-step__h">
					<span class="dz-step__no">۲</span>
					<div class="dz-step__ht">
						<h2 class="dz-step__t" id="dzStep2H" tabindex="-1">آدرس ارسال</h2>
						<p class="dz-step__s" data-summary>نشانی گیرندهٔ مرسوله</p>
					</div>
					<button type="button" class="dz-step__edit" data-edit="2" hidden><i class="fa-solid fa-pen"></i> تغییر</button>
				</div>
				<div class="dz-step__b" hidden>

					<!-- کارت آدرس ذخیره‌شده -->
					<div class="dz-address-card" data-view="saved">
						<div class="dz-address-card__map">
							<div class="dz-ph"><span class="dz-ph__label">map_thumbnail</span></div>
							<div class="dz-address-card__pin"><i class="fa-solid fa-location-dot"></i></div>
						</div>
						<div class="dz-address-card__body">
							<span class="dz-address-card__tag"><i class="fa-solid fa-house"></i> آدرس من</span>
							<p class="dz-address-card__line">نبرد شمالی، کوچه خزایی، پلاک یک، طبقه سوم، واحد ۶، زنگ ۵</p>
							<p class="dz-address-card__sub">تهران، شهرابی، نبرد، تقاطع فتح‌الله خزایی، سالن زیبایی لینوس، پلاک ۱، واحد ۶</p>
							<div class="dz-address-card__meta">
								<span><i class="fa-solid fa-user"></i> سارا محمدی</span>
								<span><i class="fa-solid fa-phone"></i> <span class="dz-num">۰۹۱۲۳۴۵۶۷۸۹</span></span>
								<span><i class="fa-solid fa-location-crosshairs"></i> روی نقشه ثبت شده</span>
							</div>
							<div class="dz-address-card__acts">
								<button type="button" class="dz-address-card__btn" data-act="change-address"><i class="fa-solid fa-repeat"></i> تغییر آدرس</button>
								<button type="button" class="dz-address-card__btn" data-act="edit-address"><i class="fa-solid fa-pen"></i> ویرایش آدرس</button>
								<button type="button" class="dz-address-card__btn" data-act="show-map"><i class="fa-regular fa-map"></i> آدرس روی نقشه</button>
							</div>
						</div>
					</div>

					<!-- فرم افزودن/ویرایش آدرس -->
					<form class="dz-addr-form" data-view="form" hidden novalidate>
						<?php wp_nonce_field( 'dz_addr', 'dz_addr_nonce' ); ?>
						<div class="dz-field__row">
							<div class="dz-field">
								<label for="dzRecvName">نام گیرنده <span class="dz-req">*</span></label>
								<input type="text" id="dzRecvName" name="receiver_name" autocomplete="name" required>
								<span class="dz-field__err" data-err aria-live="polite"></span>
							</div>
							<div class="dz-field">
								<label for="dzRecvMobile">شماره موبایل <span class="dz-req">*</span></label>
								<input type="tel" id="dzRecvMobile" name="receiver_mobile" inputmode="numeric" maxlength="11" placeholder="۰۹۱۲۳۴۵۶۷۸۹" autocomplete="tel" required>
								<span class="dz-field__err" data-err aria-live="polite"></span>
							</div>
						</div>
						<div class="dz-field__row">
							<div class="dz-field">
								<label for="dzProvince">استان <span class="dz-req">*</span></label>
								<select id="dzProvince" name="province" required>
									<option value="">انتخاب کنید</option>
									<option>تهران</option><option>البرز</option><option>اصفهان</option>
									<option>فارس</option><option>خراسان رضوی</option><option>گیلان</option>
								</select>
							</div>
							<div class="dz-field">
								<label for="dzCity">شهر <span class="dz-req">*</span></label>
								<input type="text" id="dzCity" name="city" required>
								<span class="dz-field__err" data-err aria-live="polite"></span>
							</div>
						</div>
						<div class="dz-field">
							<label for="dzAddrLine">آدرس کامل <span class="dz-req">*</span></label>
							<textarea id="dzAddrLine" name="address_line" rows="2" placeholder="خیابان، کوچه، نشانی دقیق" required></textarea>
							<span class="dz-field__err" data-err aria-live="polite"></span>
						</div>
						<div class="dz-field__row">
							<div class="dz-field">
								<label for="dzPlaque">پلاک</label>
								<input type="text" id="dzPlaque" name="plaque" inputmode="numeric">
							</div>
							<div class="dz-field">
								<label for="dzUnit">واحد</label>
								<input type="text" id="dzUnit" name="unit" inputmode="numeric">
							</div>
						</div>
						<div class="dz-field">
							<label for="dzPostcode">کد پستی <span class="dz-req">*</span></label>
							<input type="text" id="dzPostcode" name="postcode" inputmode="numeric" maxlength="10" placeholder="۱۰ رقم" required>
							<span class="dz-field__err" data-err aria-live="polite"></span>
						</div>
						<div class="dz-field">
							<label for="dzAddrNote">توضیحات تکمیلی</label>
							<textarea id="dzAddrNote" name="address_note" rows="2" placeholder="مثلاً تحویل به نگهبانی"></textarea>
						</div>
						<div class="dz-map" role="group" aria-label="انتخاب موقعیت روی نقشه">
							<div class="dz-ph"><span class="dz-ph__label">map_picker_placeholder</span></div>
							<button type="button" class="dz-map__btn"><i class="fa-solid fa-location-crosshairs"></i> انتخاب موقعیت روی نقشه</button>
						</div>
						<div class="dz-form-actions">
							<button type="submit" class="dz-btn dz-btn--primary"><i class="fa-solid fa-floppy-disk"></i> ذخیرهٔ آدرس</button>
							<button type="button" class="dz-btn dz-btn--ghost" data-act="cancel-address">انصراف</button>
						</div>
					</form>

					<div class="dz-form-actions" style="margin-top:1.6rem" data-when="address-saved">
						<button type="button" class="dz-btn dz-btn--primary" data-next="2"><i class="fa-solid fa-arrow-left"></i> تأیید آدرس و ادامه</button>
					</div>
				</div>
			</section>

			<!-- مرحله ۳ — زمان و روش ارسال -->
			<section class="dz-step" id="dzStep3" data-step="3" aria-labelledby="dzStep3H">
				<div class="dz-step__h">
					<span class="dz-step__no">۳</span>
					<div class="dz-step__ht">
						<h2 class="dz-step__t" id="dzStep3H" tabindex="-1">زمان و روش ارسال</h2>
						<p class="dz-step__s" data-summary>زمان دریافت و شیوهٔ ارسال</p>
					</div>
					<button type="button" class="dz-step__edit" data-edit="3" hidden><i class="fa-solid fa-pen"></i> تغییر</button>
				</div>
				<div class="dz-step__b" hidden>

					<p class="dz-co-sub"><i class="fa-regular fa-calendar"></i> زمان ارسال</p>
					<div class="dz-days" role="radiogroup" aria-label="روز ارسال">
						<label class="dz-day"><input type="radio" name="dz_day" value="1" checked><span class="dz-day__d">دوشنبه</span><span class="dz-day__n">۰۱ تیر</span></label>
						<label class="dz-day"><input type="radio" name="dz_day" value="2"><span class="dz-day__d">سه‌شنبه</span><span class="dz-day__n">۰۲ تیر</span></label>
						<label class="dz-day"><input type="radio" name="dz_day" value="3"><span class="dz-day__d">چهارشنبه</span><span class="dz-day__n">۰۳ تیر</span></label>
						<label class="dz-day"><input type="radio" name="dz_day" value="4"><span class="dz-day__d">پنجشنبه</span><span class="dz-day__n">۰۴ تیر</span></label>
					</div>
					<div class="dz-slots" role="radiogroup" aria-label="بازهٔ ساعت ارسال">
						<label class="dz-slot"><input type="radio" name="dz_slot" value="1" checked><span class="dz-slot__radio" aria-hidden="true"></span><span class="dz-slot__b"><span class="dz-slot__t">۰۹:۰۰ الی ۱۳:۰۰</span><span class="dz-slot__d">بازهٔ صبح</span></span></label>
						<label class="dz-slot"><input type="radio" name="dz_slot" value="2"><span class="dz-slot__radio" aria-hidden="true"></span><span class="dz-slot__b"><span class="dz-slot__t">۱۳:۰۰ الی ۱۷:۰۰</span><span class="dz-slot__d">بازهٔ ظهر</span></span></label>
						<label class="dz-slot"><input type="radio" name="dz_slot" value="3"><span class="dz-slot__radio" aria-hidden="true"></span><span class="dz-slot__b"><span class="dz-slot__t">۱۷:۰۰ الی ۲۱:۰۰</span><span class="dz-slot__d">بازهٔ عصر</span></span></label>
						<label class="dz-slot is-disabled"><input type="radio" name="dz_slot" value="4" disabled><span class="dz-slot__radio" aria-hidden="true"></span><span class="dz-slot__b"><span class="dz-slot__t">۲۱:۰۰ الی ۲۴:۰۰</span><span class="dz-slot__d">تکمیل ظرفیت</span></span></label>
					</div>

					<p class="dz-co-sub"><i class="fa-solid fa-truck"></i> روش ارسال</p>
					<label class="dz-pay-opt">
						<input type="radio" name="dz_ship" value="express" checked>
						<span class="dz-pay-opt__radio" aria-hidden="true"></span>
						<span class="dz-pay-opt__ic"><i class="fa-solid fa-bolt"></i></span>
						<span class="dz-pay-opt__b">
							<span class="dz-pay-opt__t">اکسپرس <span class="dz-pill dz-pill--gold"><i class="fa-solid fa-bolt"></i> سریع‌ترین</span></span>
							<span class="dz-pay-opt__d">تحویل در همان بازهٔ انتخابی</span>
						</span>
						<span class="dz-pay-opt__price"><span class="dz-num">۱۱۷٬۹۰۰</span> <span class="dz-toman" role="img" aria-label="تومان"></span></span>
					</label>
					<label class="dz-pay-opt">
						<input type="radio" name="dz_ship" value="economy">
						<span class="dz-pay-opt__radio" aria-hidden="true"></span>
						<span class="dz-pay-opt__ic"><i class="fa-solid fa-box"></i></span>
						<span class="dz-pay-opt__b">
							<span class="dz-pay-opt__t">ارزان‌تر <span class="dz-pill dz-pill--green"><i class="fa-solid fa-leaf"></i> صرفه‌جویی</span></span>
							<span class="dz-pay-opt__d">تحویل ۱ تا ۲ روز کاری دیرتر</span>
						</span>
						<span class="dz-pay-opt__price"><span class="dz-num">۵۹٬۰۰۰</span> <span class="dz-toman" role="img" aria-label="تومان"></span></span>
					</label>

					<div class="dz-form-actions" style="margin-top:1.6rem">
						<button type="button" class="dz-btn dz-btn--primary" data-next="3"><i class="fa-solid fa-arrow-left"></i> تأیید و ادامه به پرداخت</button>
					</div>
				</div>
			</section>

			<!-- مرحله ۴ — روش پرداخت -->
			<section class="dz-step" id="dzStep4" data-step="4" aria-labelledby="dzStep4H">
				<div class="dz-step__h">
					<span class="dz-step__no">۴</span>
					<div class="dz-step__ht">
						<h2 class="dz-step__t" id="dzStep4H" tabindex="-1">روش پرداخت</h2>
						<p class="dz-step__s" data-summary>شیوهٔ پرداخت مبلغ سفارش</p>
					</div>
					<button type="button" class="dz-step__edit" data-edit="4" hidden><i class="fa-solid fa-pen"></i> تغییر</button>
				</div>
				<div class="dz-step__b" hidden>
					<label class="dz-pay-opt">
						<input type="radio" name="dz_pay" value="gateway" checked>
						<span class="dz-pay-opt__radio" aria-hidden="true"></span>
						<span class="dz-pay-opt__ic"><i class="fa-solid fa-building-columns"></i></span>
						<span class="dz-pay-opt__b">
							<span class="dz-pay-opt__t">درگاه بانکی</span>
							<span class="dz-pay-opt__d">پرداخت از تمامی بانک‌های عضو شتاب</span>
						</span>
					</label>
					<label class="dz-pay-opt">
						<input type="radio" name="dz_pay" value="snapppay">
						<span class="dz-pay-opt__radio" aria-hidden="true"></span>
						<span class="dz-pay-opt__ic"><div class="dz-ph"><span class="dz-ph__label">snapp_pay_installment_image</span></div></span>
						<span class="dz-pay-opt__b">
							<span class="dz-pay-opt__t">پرداخت قسطی با اسنپ‌پی</span>
							<span class="dz-pay-opt__d">۴ قسط بدون کارمزد، ماهانه <b class="dz-num" id="dzInstallment">۲۲۷٬۹۵۰</b> تومان</span>
							<span class="dz-pay-opt__inst"><i class="fa-solid fa-circle-info"></i> بدون نیاز به مدارک؛ تأیید آنی اعتبار</span>
						</span>
					</label>
				</div>
			</section>
		</div>

		<!-- ===================== ستون خلاصه سفارش (چسبان) ===================== -->
		<aside class="dz-co-aside" aria-label="خلاصه سفارش">

			<!-- اطلاعات سفارش -->
			<div class="dz-summary-card">
				<div class="dz-summary-card__h">
					<h2><i class="fa-solid fa-receipt"></i> اطلاعات سفارش</h2>
				</div>
				<div class="dz-summary-card__b">
					<div class="dz-shipto">
						<i class="fa-solid fa-location-dot"></i>
						<div>
							<div class="dz-shipto__k">ارسال به آدرس زیر:</div>
							<div class="dz-shipto__v">
								نبرد شمالی، کوچه خزایی، پلاک یک، طبقه سوم، واحد ۶، زنگ ۵
								<span>نبرد، تقاطع فتح‌الله خزایی، سالن زیبایی لینوس، پلاک ۱، واحد ۶</span>
							</div>
						</div>
					</div>
					<div class="dz-when">
						<i class="fa-regular fa-clock"></i>
						<div>
							<div class="dz-when__k">زمان ارسال مرسوله‌ها:</div>
							<div class="dz-when__v" id="dzWhenSummary">دوشنبه ۰۱ تیر | ۰۹:۰۰ الی ۱۳:۰۰</div>
						</div>
					</div>

					<div class="dz-omini">
						<!-- آیتم ۱ — زمان مشخص -->
						<div class="dz-oitem">
							<div class="dz-oitem__media">
								<div class="dz-ph"><span class="dz-ph__label">product_1</span></div>
								<span class="dz-oitem__q dz-num">۱</span>
							</div>
							<div class="dz-oitem__info">
								<p class="dz-oitem__name">برگه گلابی خشک ممتاز دشت‌زاد — بستهٔ ۵۰۰ گرمی</p>
								<div class="dz-oitem__row dz-oitem__when"><i class="fa-regular fa-clock"></i> دوشنبه ۰۱ تیر | ۰۹:۰۰ الی ۱۳:۰۰</div>
								<div class="dz-oitem__row">
									<span class="dz-oitem__logo"><div class="dz-ph"><span class="dz-ph__label">snapp_box</span></div></span>
									<span class="dz-oitem__ship">اکسپرس — ارزان‌تر</span>
								</div>
							</div>
						</div>
						<!-- آیتم ۲ — تعیین‌نشده -->
						<div class="dz-oitem">
							<div class="dz-oitem__media">
								<div class="dz-ph"><span class="dz-ph__label">product_2</span></div>
								<span class="dz-oitem__q dz-num">۱</span>
							</div>
							<div class="dz-oitem__info">
								<p class="dz-oitem__name">آجیل مخلوط برشتهٔ دشت‌زاد — بستهٔ ۲۵۰ گرمی</p>
								<div class="dz-oitem__row dz-oitem__tbd"><i class="fa-solid fa-clock-rotate-left"></i> زمان ارسال: تعیین نشده</div>
								<div class="dz-oitem__row dz-oitem__tbd"><i class="fa-solid fa-truck"></i> هزینه ارسال: تعیین نشده</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- اطلاعات پرداخت -->
			<div class="dz-summary-card" id="dzPaySummary">
				<button type="button" class="dz-summary-card__toggle" aria-expanded="false" aria-controls="dzPayBody">
					<h2><i class="fa-solid fa-wallet"></i> اطلاعات پرداخت</h2>
					<span class="dz-mobilebar__total"><span class="dz-num">۸۹۲٬۹۰۰</span> <span class="dz-toman" role="img" aria-label="تومان"></span></span>
					<i class="fa-solid fa-chevron-down dz-chev" aria-hidden="true"></i>
				</button>
				<div class="dz-summary-card__b" id="dzPayBody">
					<div class="dz-srow">
						<span>مجموع قیمت کالاها و خدمات</span>
						<b class="dz-num">۱٬۹۹۵٬۲۰۰ <span class="dz-toman" role="img" aria-label="تومان"></span></b>
					</div>
					<div class="dz-srow">
						<span>مجموع هزینهٔ ارسال</span>
						<b class="dz-num">۱۱۷٬۹۰۰ <span class="dz-toman" role="img" aria-label="تومان"></span></b>
					</div>

					<button type="button" class="dz-detail" id="dzDetailBtn" aria-expanded="false" aria-controls="dzDetailRows">
						جزئیات بیشتر <i class="fa-solid fa-chevron-down dz-chev" aria-hidden="true"></i>
					</button>
					<div class="dz-detail-rows" id="dzDetailRows">
						<div class="dz-srow"><span>قیمت کالاها</span><b class="dz-num">۲٬۹۲۰٬۰۰۰ <span class="dz-toman" role="img" aria-label="تومان"></span></b></div>
						<div class="dz-srow is-save"><span>تخفیف کالاها</span><b class="dz-num">−۹۲۴٬۸۰۰ <span class="dz-toman" role="img" aria-label="تومان"></span></b></div>
						<div class="dz-srow"><span>بسته‌بندی</span><b class="dz-num">۰ <span class="dz-toman" role="img" aria-label="تومان"></span></b></div>
					</div>

					<div class="dz-srow is-save">
						<span>سود شما از خرید</span>
						<b class="dz-num">۱٬۲۲۰٬۲۰۰ <span class="dz-toman" role="img" aria-label="تومان"></span><span class="dz-srow__pct dz-num">٪۵۸</span></b>
					</div>

					<!-- تخفیف -->
					<div class="dz-discount">
						<button type="button" class="dz-discount__toggle" id="dzPromoToggle" aria-expanded="false" aria-controls="dzPromoWrap">
							<i class="fa-solid fa-ticket"></i> افزودن کد تخفیف
							<i class="fa-solid fa-chevron-down dz-chev" aria-hidden="true"></i>
						</button>
						<div class="dz-promo" id="dzPromoWrap">
							<label class="dz-sr-only" for="dzPromoInput">کد تخفیف</label>
							<input type="text" id="dzPromoInput" placeholder="کد تخفیف را وارد کنید" autocomplete="off">
							<button type="button" id="dzPromoApply">اعمال</button>
						</div>
						<p class="dz-promo-msg" id="dzPromoMsg" aria-live="polite"></p>
					</div>

					<div class="dz-srow dz-srow--total">
						<span>قابل پرداخت</span>
						<b class="dz-num" id="dzPayable">۸۹۲٬۹۰۰ <span class="dz-toman" role="img" aria-label="تومان"></span></b>
					</div>

					<div class="dz-cta">
						<button type="button" class="dz-btn dz-btn--primary dz-btn--lg dz-btn--block" id="dzPayBtn" aria-label="پرداخت ۸۹۲٬۹۰۰ تومان از طریق درگاه بانکی">
							<i class="fa-solid fa-lock"></i> پرداخت از طریق درگاه بانکی
						</button>
						<p class="dz-co-note"><i class="fa-solid fa-shield-halved"></i> پرداخت امن از طریق درگاه معتبر بانکی</p>
					</div>
				</div>

				<!-- نشان‌های اعتماد -->
				<div class="dz-trust">
					<div><i class="fa-solid fa-lock"></i> پرداخت امن</div>
					<div><i class="fa-solid fa-rotate-left"></i> ضمانت بازگشت ۷ روزه</div>
					<div><i class="fa-solid fa-headset"></i> پشتیبانی ۲۴/۷</div>
					<div><i class="fa-solid fa-shield-heart"></i> ارسال مطمئن</div>
				</div>
			</div>
		</aside>
	</div>

	<!-- ===================== نوار پرداخت چسبان موبایل ===================== -->
	<div class="dz-mobilebar" id="dzMobileBar">
		<div class="dz-mobilebar__info">
			<span class="dz-mobilebar__lbl">قابل پرداخت</span>
			<span class="dz-mobilebar__total"><span class="dz-num" id="dzMobileTotal">۸۹۲٬۹۰۰</span> <span class="dz-toman" role="img" aria-label="تومان"></span></span>
		</div>
		<button type="button" class="dz-btn dz-btn--primary dz-btn--lg" id="dzMobilePay" aria-label="پرداخت ۸۹۲٬۹۰۰ تومان">
			<i class="fa-solid fa-lock"></i> پرداخت
		</button>
	</div>

	<!-- ===================== پاپ‌آپ ورود پیامکی ===================== -->
	<div class="dz-modal" id="dzLoginModal" role="dialog" aria-modal="true" aria-labelledby="dzModalT" hidden>
		<div class="dz-modal__backdrop" data-close></div>
		<div class="dz-modal__card" role="document">
			<button type="button" class="dz-modal__close" data-close aria-label="بستن"><i class="fa-solid fa-xmark"></i></button>
			<div class="dz-modal__brand">د</div>

			<form class="dz-modal__form" id="dzLoginForm" novalidate>
				<?php wp_nonce_field( 'dz_otp', 'dz_otp_nonce' ); ?>

				<!-- گام شماره موبایل -->
				<div class="dz-modal__step" data-otp-step="phone">
					<h2 class="dz-modal__t" id="dzModalT">ورود به دشت‌زاد</h2>
					<p class="dz-modal__s">شمارهٔ موبایل خود را وارد کنید تا کد تأیید برایتان ارسال شود.</p>
					<div class="dz-modal__phone">
						<i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i>
						<label class="dz-sr-only" for="dzPhone">شماره موبایل</label>
						<input type="tel" id="dzPhone" name="mobile" inputmode="numeric" maxlength="11" placeholder="۰۹۱۲ ۳۴۵ ۶۷۸۹" autocomplete="tel">
					</div>
					<p class="dz-field__err" id="dzPhoneErr" aria-live="polite" style="text-align:center"></p>
					<button type="button" class="dz-btn dz-btn--primary dz-btn--block" id="dzSendOtp"><i class="fa-solid fa-paper-plane"></i> ارسال کد تأیید</button>
					<p class="dz-modal__legal">با ورود، <a href="<?php echo esc_url( home_url( '/terms/' ) ); ?>">قوانین و مقررات</a> دشت‌زاد را می‌پذیرم.</p>
				</div>

				<!-- گام کد تأیید -->
				<div class="dz-modal__step" data-otp-step="code" hidden>
					<h2 class="dz-modal__t">کد تأیید را وارد کنید</h2>
					<p class="dz-modal__s">کد ۵ رقمی به شمارهٔ <b id="dzPhoneEcho">۰۹۱۲ ۳۴۵ ۶۷۸۹</b> ارسال شد.</p>
					<div class="dz-otp" id="dzOtp" dir="ltr">
						<input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۱ کد">
						<input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۲ کد">
						<input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۳ کد">
						<input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۴ کد">
						<input type="text" inputmode="numeric" maxlength="1" aria-label="رقم ۵ کد">
					</div>
					<p class="dz-field__err" id="dzOtpErr" aria-live="polite" style="text-align:center"></p>
					<div class="dz-modal__resend">
						<span id="dzTimer" class="dz-num">۰۲:۰۰</span>
						<button type="button" id="dzResend" disabled>ارسال دوباره</button>
					</div>
					<button type="button" class="dz-btn dz-btn--primary dz-btn--block" id="dzVerifyOtp"><i class="fa-solid fa-arrow-left-to-bracket"></i> ورود و ادامهٔ خرید</button>
					<button type="button" class="dz-modal__editphone" id="dzEditPhone"><i class="fa-solid fa-pen"></i> ویرایش شماره</button>
				</div>
			</form>
		</div>
	</div>

	<div class="dz-toast" id="dzToast" role="status" aria-live="polite"><i class="fa-solid fa-circle-check"></i> <span id="dzToastMsg"></span></div>
</main>

<script>
/* ============================================================
   دشت‌زاد — تسویه حساب (vanilla JS، بدون فریم‌ورک)
   مراحل SPA-like، نوار پیشرفت، اعتبارسنجی، تایمر OTP، محاسبهٔ قسط.
   داده‌ها صرفاً نمایشی‌اند؛ در WP با AJAX nonce‌دار جایگزین شوند.
   ============================================================ */
(function(){
	'use strict';
	var root = document.querySelector('[data-screen-label="checkout"]');
	if(!root) return;

	/* --- ابزار اعداد فارسی --- */
	var FA = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
	function toFa(s){ return String(s).replace(/\d/g, function(d){ return FA[+d]; }); }
	function toEn(s){ return String(s).replace(/[۰-۹]/g, function(d){ return FA.indexOf(d); }); }
	function grp(n){ return toFa(String(Math.round(n)).replace(/\B(?=(\d{3})+(?!\d))/g, '٬')); }

	/* ====================== مدیریت مراحل ====================== */
	var state = { step: 1, max: 1, logged: root.getAttribute('data-logged') === '1' };
	var stepEls = {
		1: document.getElementById('dzStep1'),
		2: document.getElementById('dzStep2'),
		3: document.getElementById('dzStep3'),
		4: document.getElementById('dzStep4')
	};
	var stepperItems = root.querySelectorAll('#dzStepper .dz-steps__item');
	var stepperLines = root.querySelectorAll('#dzStepper .dz-steps__line');

	function renderStepper(){
		stepperItems.forEach(function(it){
			var n = +it.getAttribute('data-step');
			it.classList.toggle('is-active', n === state.step);
			it.classList.toggle('is-done', n < state.step || (n <= state.max && n !== state.step));
		});
		stepperLines.forEach(function(ln, i){ ln.classList.toggle('is-done', (i + 1) < state.step); });
	}

	function renderSteps(focus){
		for(var n = 1; n <= 4; n++){
			var el = stepEls[n];
			var body = el.querySelector('.dz-step__b');
			var edit = el.querySelector('.dz-step__edit');
			var active = n === state.step;
			var done = n < state.step;
			el.classList.toggle('is-active', active);
			el.classList.toggle('is-done', done);
			if(body) body.hidden = !active;        // فقط مرحلهٔ فعال باز است
			if(edit) edit.hidden = !done;          // دکمهٔ تغییر فقط برای مراحل کامل‌شده
		}
		renderStepper();
		if(focus){
			var h = stepEls[state.step].querySelector('.dz-step__t');
			if(h) h.focus();
		}
	}

	function goStep(n, focus){
		state.step = n;
		if(n > state.max) state.max = n;
		renderSteps(focus !== false);
	}

	/* دکمه‌های «ادامه» و «تغییر» */
	root.addEventListener('click', function(e){
		var next = e.target.closest('[data-next]');
		if(next){ updateStepSummary(+next.getAttribute('data-next')); goStep(+next.getAttribute('data-next') + 1); return; }
		var edit = e.target.closest('[data-edit]');
		if(edit){ goStep(+edit.getAttribute('data-edit')); return; }
	});

	function updateStepSummary(n){
		var el = stepEls[n];
		var s = el.querySelector('[data-summary]');
		if(!s) return;
		if(n === 2){ s.textContent = 'نبرد شمالی، کوچه خزایی، پلاک ۱، واحد ۶'; }
		if(n === 3){ s.textContent = whenLabel() + ' · ' + shipLabel(); }
	}

	/* ====================== مرحله ۱ — ورود پیامکی ====================== */
	var modal = document.getElementById('dzLoginModal');
	var loginBtn = document.getElementById('dzOpenLogin');
	var lastFocus = null;

	function openModal(){
		lastFocus = document.activeElement;
		modal.hidden = false;
		requestAnimationFrame(function(){ modal.classList.add('is-open'); });
		setOtpStep('phone');
		setTimeout(function(){ document.getElementById('dzPhone').focus(); }, 60);
		document.addEventListener('keydown', onEsc);
	}
	function closeModal(){
		modal.classList.remove('is-open');
		clearInterval(timerId);
		setTimeout(function(){ modal.hidden = true; }, 220);
		document.removeEventListener('keydown', onEsc);
		if(lastFocus) lastFocus.focus();
	}
	function onEsc(e){ if(e.key === 'Escape') closeModal(); }

	if(loginBtn) loginBtn.addEventListener('click', openModal);
	modal.addEventListener('click', function(e){ if(e.target.closest('[data-close]')) closeModal(); });

	function setOtpStep(which){
		modal.querySelectorAll('[data-otp-step]').forEach(function(s){ s.hidden = s.getAttribute('data-otp-step') !== which; });
	}

	/* اعتبارسنجی موبایل: ۱۱ رقم، شروع با ۰۹ */
	function validMobile(v){ return /^09\d{9}$/.test(toEn(v).replace(/\D/g,'')); }

	var phoneInput = document.getElementById('dzPhone');
	var phoneErr = document.getElementById('dzPhoneErr');
	document.getElementById('dzSendOtp').addEventListener('click', function(){
		var raw = toEn(phoneInput.value).replace(/\D/g,'');
		if(!validMobile(raw)){ phoneErr.textContent = 'شماره موبایل باید ۱۱ رقم و با ۰۹ شروع شود.'; phoneInput.setAttribute('aria-invalid','true'); phoneInput.focus(); return; }
		phoneErr.textContent = ''; phoneInput.removeAttribute('aria-invalid');
		document.getElementById('dzPhoneEcho').textContent = toFa(raw.replace(/(\d{4})(\d{3})(\d{4})/, '$1 $2 $3'));
		/* در WP: ارسال AJAX به dz_otp_send با dz_otp_nonce؛ کد در پاسخ برنمی‌گردد. */
		setOtpStep('code');
		startTimer(120);
		setTimeout(function(){ otpInputs[0].focus(); }, 60);
	});

	/* ورودی‌های OTP — جابه‌جایی خودکار */
	var otpInputs = Array.prototype.slice.call(document.querySelectorAll('#dzOtp input'));
	otpInputs.forEach(function(inp, i){
		inp.addEventListener('input', function(){
			inp.value = toEn(inp.value).replace(/\D/g,'').slice(0,1);
			inp.classList.toggle('is-filled', !!inp.value);
			if(inp.value && i < otpInputs.length - 1) otpInputs[i+1].focus();
		});
		inp.addEventListener('keydown', function(e){
			if(e.key === 'Backspace' && !inp.value && i > 0) otpInputs[i-1].focus();
		});
		inp.addEventListener('paste', function(e){
			var t = toEn((e.clipboardData || window.clipboardData).getData('text')).replace(/\D/g,'').slice(0,5);
			if(!t) return; e.preventDefault();
			t.split('').forEach(function(d, k){ if(otpInputs[k]){ otpInputs[k].value = d; otpInputs[k].classList.add('is-filled'); } });
			(otpInputs[t.length] || otpInputs[4]).focus();
		});
	});

	/* تایمر OTP */
	var timerId, timerEl = document.getElementById('dzTimer'), resendBtn = document.getElementById('dzResend');
	function startTimer(sec){
		clearInterval(timerId);
		resendBtn.disabled = true;
		function tick(){
			var m = Math.floor(sec/60), s = sec % 60;
			timerEl.textContent = toFa((m<10?'0':'')+m + ':' + (s<10?'0':'')+s);
			if(sec <= 0){ clearInterval(timerId); resendBtn.disabled = false; timerEl.textContent = ''; return; }
			sec--;
		}
		tick(); timerId = setInterval(tick, 1000);
	}
	resendBtn.addEventListener('click', function(){ if(resendBtn.disabled) return; startTimer(120); document.getElementById('dzOtpErr').textContent = ''; });
	document.getElementById('dzEditPhone').addEventListener('click', function(){ clearInterval(timerId); setOtpStep('phone'); phoneInput.focus(); });

	document.getElementById('dzVerifyOtp').addEventListener('click', function(){
		var code = otpInputs.map(function(x){ return x.value; }).join('');
		var err = document.getElementById('dzOtpErr');
		if(code.length < 5){ err.textContent = 'کد ۵ رقمی را کامل وارد کنید.'; return; }
		err.textContent = '';
		/* در WP: تأیید کد سمت سرور. این‌جا فقط نمایشی. */
		state.logged = true;
		var card = stepEls[1].querySelector('.dz-co-user');
		card.querySelector('.dz-co-user__av').innerHTML = '<i class="fa-solid fa-user-check"></i>';
		card.querySelector('.dz-co-user__info').innerHTML = '<b>خوش آمدید</b><span class="dz-num">' + document.getElementById('dzPhoneEcho').textContent + '</span>';
		loginBtn.parentNode.removeChild(loginBtn);
		stepEls[1].querySelector('[data-summary]').textContent = 'وارد شده با ' + document.getElementById('dzPhoneEcho').textContent;
		closeModal();
		toast('با موفقیت وارد شدید');
		goStep(2);
	});

	/* اگر از قبل وارد شده باشد، مستقیم به مرحلهٔ آدرس */
	if(state.logged){ state.max = 2; goStep(2, false); }

	/* ====================== مرحله ۲ — آدرس ====================== */
	var savedView = stepEls[2].querySelector('[data-view="saved"]');
	var formView = stepEls[2].querySelector('[data-view="form"]');
	var addrNext = stepEls[2].querySelector('[data-when="address-saved"]');

	stepEls[2].addEventListener('click', function(e){
		var act = e.target.closest('[data-act]');
		if(!act) return;
		var a = act.getAttribute('data-act');
		if(a === 'change-address' || a === 'edit-address'){ savedView.hidden = true; formView.hidden = false; addrNext.hidden = true; formView.querySelector('input,select').focus(); }
		if(a === 'cancel-address'){ formView.hidden = true; savedView.hidden = false; addrNext.hidden = false; }
		if(a === 'show-map'){ toast('نمایش آدرس روی نقشه (نمونه)'); }
	});

	/* اعتبارسنجی فرم آدرس */
	formView.addEventListener('submit', function(e){
		e.preventDefault();
		var ok = true;
		function fail(input, msg){ ok = false; var er = input.parentNode.querySelector('[data-err]'); if(er) er.textContent = msg; input.setAttribute('aria-invalid','true'); }
		function clear(input){ var er = input.parentNode.querySelector('[data-err]'); if(er) er.textContent=''; input.removeAttribute('aria-invalid'); }

		var name = formView.querySelector('#dzRecvName');
		var mob = formView.querySelector('#dzRecvMobile');
		var city = formView.querySelector('#dzCity');
		var line = formView.querySelector('#dzAddrLine');
		var post = formView.querySelector('#dzPostcode');
		[name, mob, city, line, post].forEach(clear);

		if(!name.value.trim()) fail(name, 'نام گیرنده را وارد کنید.');
		if(!validMobile(mob.value)) fail(mob, 'موبایل ۱۱ رقمی و با ۰۹.');
		if(!city.value.trim()) fail(city, 'شهر را وارد کنید.');
		if(!line.value.trim()) fail(line, 'آدرس کامل را وارد کنید.');
		if(toEn(post.value).replace(/\D/g,'').length !== 10) fail(post, 'کد پستی باید ۱۰ رقم باشد.');

		if(!ok){ formView.querySelector('[aria-invalid="true"]').focus(); return; }
		formView.hidden = true; savedView.hidden = false; addrNext.hidden = false;
		toast('آدرس ذخیره شد');
	});

	/* ====================== مرحله ۳ — زمان/روش ارسال ====================== */
	function whenLabel(){
		var day = stepEls[3].querySelector('input[name="dz_day"]:checked');
		var slot = stepEls[3].querySelector('input[name="dz_slot"]:checked');
		var dayTxt = day ? day.closest('.dz-day').querySelector('.dz-day__n').textContent + ' ' + day.closest('.dz-day').querySelector('.dz-day__d').textContent : '';
		var slotTxt = slot ? slot.closest('.dz-slot').querySelector('.dz-slot__t').textContent : '';
		return (day ? day.closest('.dz-day').querySelector('.dz-day__d').textContent + ' ' + day.closest('.dz-day').querySelector('.dz-day__n').textContent : '') + (slotTxt ? ' | ' + slotTxt : '');
	}
	function shipLabel(){ var s = stepEls[3].querySelector('input[name="dz_ship"]:checked'); return s ? s.closest('.dz-pay-opt').querySelector('.dz-pay-opt__t').childNodes[0].textContent.trim() : ''; }

	stepEls[3].addEventListener('change', function(){
		document.getElementById('dzWhenSummary').textContent = whenLabel();
	});

	/* ====================== خلاصه پرداخت / تخفیف / قسط ====================== */
	var BASE_GOODS = 1995200, SHIP = 117900;
	var payable = 892900;
	var promoActive = false;

	function renderTotals(){
		var total = payable - (promoActive ? 90000 : 0);
		document.getElementById('dzPayable').innerHTML = grp(total) + ' <span class="dz-toman" role="img" aria-label="تومان"></span>';
		document.getElementById('dzMobileTotal').textContent = grp(total);
		var top = document.querySelector('#dzPaySummary .dz-summary-card__toggle .dz-mobilebar__total');
		if(top) top.innerHTML = grp(total) + ' <span class="dz-toman" role="img" aria-label="تومان"></span>';
		/* محاسبهٔ قسط در لحظه: ۴ قسط بدون کارمزد */
		document.getElementById('dzInstallment').textContent = grp(total / 4);
		/* aria-label دکمه‌های پرداخت */
		document.getElementById('dzPayBtn').setAttribute('aria-label', 'پرداخت ' + grp(total) + ' تومان از طریق درگاه بانکی');
		document.getElementById('dzMobilePay').setAttribute('aria-label', 'پرداخت ' + grp(total) + ' تومان');
	}

	/* جزئیات بیشتر */
	document.getElementById('dzDetailBtn').addEventListener('click', function(){
		var rows = document.getElementById('dzDetailRows');
		var open = rows.classList.toggle('is-open');
		this.setAttribute('aria-expanded', open ? 'true' : 'false');
	});

	/* کد تخفیف */
	var promoToggle = document.getElementById('dzPromoToggle');
	promoToggle.addEventListener('click', function(){
		var wrap = document.getElementById('dzPromoWrap');
		var open = wrap.classList.toggle('is-open');
		this.setAttribute('aria-expanded', open ? 'true' : 'false');
		if(open) document.getElementById('dzPromoInput').focus();
	});
	document.getElementById('dzPromoApply').addEventListener('click', function(){
		var v = toEn(document.getElementById('dzPromoInput').value || '').trim().toUpperCase();
		var msg = document.getElementById('dzPromoMsg');
		if(v === 'DASHT10' || v === 'دشت۱۰'){ promoActive = true; msg.className = 'dz-promo-msg is-ok'; msg.innerHTML = '<i class="fa-solid fa-circle-check"></i> کد تخفیف اعمال شد.'; }
		else { promoActive = false; msg.className = 'dz-promo-msg is-err'; msg.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> کد تخفیف معتبر نیست.'; }
		renderTotals();
	});

	/* پرداخت */
	function pay(){ toast('در حال انتقال به درگاه بانکی…'); }
	document.getElementById('dzPayBtn').addEventListener('click', pay);
	document.getElementById('dzMobilePay').addEventListener('click', function(){ if(state.step < 4){ goStep(4); } else { pay(); } });

	/* آکاردئون خلاصه در موبایل */
	document.querySelector('#dzPaySummary .dz-summary-card__toggle').addEventListener('click', function(){
		var card = document.getElementById('dzPaySummary');
		var open = card.classList.toggle('is-open');
		this.setAttribute('aria-expanded', open ? 'true' : 'false');
	});

	/* ====================== toast ====================== */
	var toastEl = document.getElementById('dzToast'), toastT;
	function toast(msg){
		document.getElementById('dzToastMsg').textContent = msg;
		toastEl.classList.add('is-show');
		clearTimeout(toastT);
		toastT = setTimeout(function(){ toastEl.classList.remove('is-show'); }, 2600);
	}

	/* init */
	renderSteps(false);
	renderTotals();
})();
</script>

<?php
get_footer();
