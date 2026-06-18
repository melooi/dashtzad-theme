<?php
/**
 * Product State Resolver — single source of truth for product display state.
 *
 * مطابق dashtzad-agent-docs/03-data-commerce/AGENT-PRODUCT-STATE-RESOLVER.md
 *
 * همه کارت‌ها، صفحه محصول، CTAها، بج‌ها و قیمت‌ها باید از این resolver وضعیت بگیرند.
 * تمپلیت هیچ‌وقت وضعیت را دستی محاسبه نمی‌کند.
 *   - WooCommerce مالک داده پایه است (stock_status, on_sale, price).
 *   - فیلد ACF «_dz_product_state» فقط وضعیت نمایشی را تعیین/override می‌کند.
 *   - قیمت همیشه از WooCommerce؛ هرگز از ACF.
 *   - وضعیت‌های غیرقابل‌خرید سمت سرور مسدود می‌شوند.
 *
 * این فایل فقط وقتی لود می‌شود که WooCommerce فعال باشد (از functions.php).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * هشت وضعیت معتبر محصول.
 *
 * @return string[]
 */
function dz_product_states() {
	return array(
		'available',     // خرید عادی
		'unavailable',   // خاکستری + لایه + فرم «خبرم کن»
		'special',       // شمارش معکوس + قیمت ویژه
		'bestseller',    // بج پرفروش
		'new-arrival',   // بج جدید
		'discounted',    // قیمت قبلی خط‌خورده + مبلغ صرفه‌جویی
		'contact',       // بدون قیمت + CTA تماس، خرید مسدود
		'discontinued',  // خاکستری + لایه + لینک جایگزین، خرید مسدود
	);
}

/**
 * خواندن یک متافیلد محصول؛ ابتدا از ACF (در صورت وجود) و سپس از متای پست.
 * این کمک‌تابع باعث می‌شود resolver بدون افزونه ACF هم بدون خطا کار کند.
 *
 * @param string $key        کلید فیلد.
 * @param int    $product_id شناسه محصول.
 * @return mixed
 */
function dz_product_field( $key, $product_id ) {
	if ( function_exists( 'get_field' ) ) {
		$val = get_field( $key, $product_id );
		if ( null !== $val && '' !== $val ) {
			return $val;
		}
	}
	return get_post_meta( $product_id, $key, true );
}

/**
 * آیا کمپین ویژه هنوز فعال است (تاریخ پایان نگذشته).
 *
 * @param WC_Product $product
 * @return bool
 */
function dz_special_campaign_active( $product ) {
	$end = dz_product_field( '_dz_special_end_date', $product->get_id() );
	if ( ! $end ) {
		return true;
	}
	return strtotime( $end ) > current_time( 'timestamp' );
}

/**
 * آستانهٔ «پرفروش» بر اساس مجموع فروش ووکامرس (قابل‌تنظیم).
 *
 * @return int
 */
function dz_bestseller_threshold() {
	return (int) apply_filters( 'dz_bestseller_threshold', 30 );
}

/**
 * آیا محصول بر اساس مجموع فروشِ ووکامرس «پرفروش» است.
 * (مرجعِ فروش همیشه ووکامرس است؛ این فقط وضعیتِ نمایشی را تعیین می‌کند.)
 *
 * @param WC_Product $product
 * @return bool
 */
function dz_product_is_bestseller( $product ) {
	$threshold = dz_bestseller_threshold();
	if ( $threshold <= 0 ) {
		return false;
	}
	return (int) $product->get_total_sales() >= $threshold;
}

/**
 * بازهٔ «تازه‌رسید» بر حسب روز از تاریخ انتشار (قابل‌تنظیم).
 *
 * @return int
 */
function dz_new_arrival_days() {
	return (int) apply_filters( 'dz_new_arrival_days', 30 );
}

/**
 * آیا محصول در بازهٔ «تازه‌رسید» منتشر شده است.
 *
 * @param WC_Product $product
 * @return bool
 */
function dz_product_is_new_arrival( $product ) {
	$days = dz_new_arrival_days();
	if ( $days <= 0 ) {
		return false;
	}
	$created = $product->get_date_created();
	if ( ! $created ) {
		return false;
	}
	$age_days = ( current_time( 'timestamp' ) - $created->getTimestamp() ) / DAY_IN_SECONDS;
	return $age_days >= 0 && $age_days <= $days;
}

/**
 * وضعیت نمایشی نهایی یک محصول.
 *
 * اولویت: رفتاری (مؤثر بر قابلیت خرید) بر تبلیغاتی مقدم است:
 *   discontinued > unavailable > contact > special > discounted > bestseller > new-arrival > available
 *
 * @param WC_Product|int|null $product شیء محصول یا شناسه.
 * @return string یکی از هشت وضعیت.
 */
function dz_resolve_product_state( $product ) {
	if ( is_numeric( $product ) ) {
		$product = wc_get_product( $product );
	}
	if ( ! $product instanceof WC_Product ) {
		return 'available';
	}

	$id      = $product->get_id();
	$manual  = dz_product_field( '_dz_product_state', $id );
	$call    = dz_product_field( '_dz_call_for_price', $id ); // 'yes' | '' (نمایش/رفتارِ تماس)
	$stock   = $product->get_stock_status(); // instock | outofstock | onbackorder
	$on_sale = $product->is_on_sale();

	// رفتاری (مؤثر بر قابلیت خرید) مقدم بر تبلیغاتی.
	if ( 'discontinued' === $manual ) {
		return 'discontinued';
	}
	if ( 'outofstock' === $stock ) {
		return 'unavailable';
	}
	if ( 'contact' === $manual || 'yes' === $call ) {
		return 'contact';
	}
	if ( 'special' === $manual && dz_special_campaign_active( $product ) ) {
		return 'special';
	}
	if ( $on_sale ) {
		return 'discounted';
	}
	// پرفروش: متای دستی یا عبور از آستانهٔ فروشِ ووکامرس.
	if ( 'bestseller' === $manual || dz_product_is_bestseller( $product ) ) {
		return 'bestseller';
	}
	// تازه‌رسید: متای دستی یا انتشار در بازهٔ اخیر.
	if ( 'new-arrival' === $manual || dz_product_is_new_arrival( $product ) ) {
		return 'new-arrival';
	}
	return 'available';
}

/**
 * آیا این وضعیت قابل‌خرید است؟ (برای استفاده در تمپلیت‌ها — مرجع نهایی همان فیلتر سرور است.)
 *
 * @param string $state
 * @return bool
 */
function dz_state_is_purchasable( $state ) {
	return ! in_array( $state, array( 'contact', 'discontinued', 'unavailable' ), true );
}

/**
 * پیکربندی نمایشیِ هر وضعیت (بَج، آیکن، رنگ‌مایه) — منبع واحد برای کارت و صفحه محصول.
 * فقط نمایشی است؛ منطقِ وضعیت همچنان از dz_resolve_product_state() می‌آید.
 *
 * tone: clay | gold | green | ink  (برای کلاس‌های badge--*)
 *
 * @param string $state یکی از هشت وضعیت.
 * @return array{label:string,icon:string,tone:string,purchasable:bool}
 */
function dz_state_display( $state ) {
	$map = array(
		'available'    => array( 'label' => '',             'icon' => '',                         'tone' => 'green', 'purchasable' => true ),
		'unavailable'  => array( 'label' => 'ناموجود',      'icon' => 'fa-box',                   'tone' => 'clay',  'purchasable' => false ),
		'special'      => array( 'label' => 'فروش ویژه',    'icon' => 'fa-bolt',                  'tone' => 'clay',  'purchasable' => true ),
		'bestseller'   => array( 'label' => 'پرفروش',       'icon' => 'fa-trophy',                'tone' => 'gold',  'purchasable' => true ),
		'new-arrival'  => array( 'label' => 'جدید',         'icon' => 'fa-wand-magic-sparkles',   'tone' => 'green', 'purchasable' => true ),
		'discounted'   => array( 'label' => 'تخفیف‌دار',     'icon' => 'fa-percent',               'tone' => 'clay',  'purchasable' => true ),
		'contact'      => array( 'label' => 'قیمت تلفنی',   'icon' => 'fa-headset',               'tone' => 'ink',   'purchasable' => false ),
		'discontinued' => array( 'label' => 'تولید متوقف شد', 'icon' => 'fa-ban',                 'tone' => 'ink',   'purchasable' => false ),
	);
	return isset( $map[ $state ] ) ? $map[ $state ] : $map['available'];
}

/**
 * مسدودسازی خرید سمت سرور برای وضعیت‌های غیرقابل‌خرید.
 * (نمایش‌ندادن دکمه کافی نیست؛ باید سمت سرور هم مسدود شود.)
 */
add_filter(
	'woocommerce_is_purchasable',
	function ( $purchasable, $product ) {
		$state = dz_resolve_product_state( $product );
		if ( in_array( $state, array( 'contact', 'discontinued', 'unavailable' ), true ) ) {
			return false;
		}
		return $purchasable;
	},
	10,
	2
);

/**
 * لایه دفاعی دوم: جلوگیری از افزودن به سبد برای وضعیت‌های مسدود.
 */
add_filter(
	'woocommerce_add_to_cart_validation',
	function ( $passed, $product_id ) {
		$state = dz_resolve_product_state( $product_id );
		if ( in_array( $state, array( 'contact', 'discontinued', 'unavailable' ), true ) ) {
			wc_add_notice( __( 'این محصول در حال حاضر قابل خرید نیست.', 'dashtzad' ), 'error' );
			return false;
		}
		return $passed;
	},
	10,
	2
);
