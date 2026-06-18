<?php
/**
 * WooCommerce integration — presentation glue only.
 *
 * مطابق dashtzad-agent-docs/03-data-commerce/AGENT-WOOCOMMERCE-RULES.md
 *
 * WooCommerce مالک منطق تجارت است (قیمت، موجودی، سبد، تسویه، سفارش، مشتری، کوپن).
 * قالب فقط نمایش را کنترل می‌کند. هرجا ممکن بود از hook استفاده می‌کنیم، نه override.
 *
 * این فایل فقط وقتی لود می‌شود که WooCommerce فعال باشد (از functions.php).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * اعلام پشتیبانی از WooCommerce و امکانات گالری محصول.
 */
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-zoom' );
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );
	}
);

/**
 * حذف رَپِرهای پیش‌فرض پوسته WooCommerce و گذاشتن رَپِر سازگار با دشت‌زاد.
 * (آرشیو/تک‌محصول داخل کانتینر استاندارد قالب قرار می‌گیرد.)
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action(
	'woocommerce_before_main_content',
	function () {
		echo '<div class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(2.8rem,4vw,4rem)]">';
	},
	10
);
add_action(
	'woocommerce_after_main_content',
	function () {
		echo '</div>';
	},
	10
);

/**
 * تعداد محصول در هر صفحه آرشیو.
 */
add_filter(
	'loop_shop_per_page',
	function () {
		return 12;
	},
	20
);

/**
 * تعداد ستون‌های گرید آرشیو محصول.
 */
add_filter(
	'loop_shop_columns',
	function () {
		return 3;
	}
);

/**
 * افزودن کلاس وضعیت (data-state) به محصول در حلقه آرشیو تا CSS کارت بتواند
 * حالت ناموجود/تخفیف/تماس و… را استایل بدهد. (نمایش‌محور؛ منطق از resolver می‌آید.)
 */
add_filter(
	'woocommerce_post_class',
	function ( $classes, $product ) {
		if ( function_exists( 'dz_resolve_product_state' ) && $product instanceof WC_Product ) {
			$classes[] = 'dz-state-' . dz_resolve_product_state( $product );
		}
		return $classes;
	},
	10,
	2
);

/**
 * نمایش مبلغ صرفه‌جویی (display-only) زیر قیمتِ محصولِ تخفیف‌دار در صفحه تک‌محصول.
 * مبلغ از WooCommerce می‌آید؛ صرفا نمایشی است.
 */
add_action(
	'woocommerce_single_product_summary',
	function () {
		global $product;
		if ( ! $product instanceof WC_Product || ! $product->is_on_sale() ) {
			return;
		}
		$regular = (float) wc_get_price_to_display( $product, array( 'price' => $product->get_regular_price() ) );
		$sale    = (float) wc_get_price_to_display( $product );
		$save    = $regular - $sale;
		if ( $save > 0 ) {
			echo '<p class="dz-save text-green-deep font-bold text-[1.4rem] mt-[.4rem]"><i class="fa-solid fa-tag"></i> ' .
				esc_html__( 'صرفه‌جویی شما:', 'dashtzad' ) . ' ' . wp_kses_post( wc_price( $save ) ) . '</p>';
		}
	},
	11
);
