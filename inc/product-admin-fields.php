<?php
/**
 * Admin product fields for the Dashtzad product-state system.
 *
 * مطابق dashtzad-agent-docs/03-data-commerce/AGENT-ACF-FIELDS-SPEC.md
 *
 * این فیلدها وضعیتِ «نمایشی/رفتاری» محصول را کنترل می‌کنند و توسط
 * dz_resolve_product_state() خوانده می‌شوند. اگر ACF نصب باشد و همین کلیدها را
 * تعریف کرده باشد، resolver ابتدا از ACF می‌خواند؛ این فیلدهای نیتیو تضمین می‌کنند
 * که حتی بدون ACF هم وضعیت‌ها از پیشخوان ووکامرس قابل‌تنظیم باشند.
 *
 *   - قیمت/موجودی هرگز اینجا ذخیره نمی‌شود (مالک: WooCommerce).
 *   - فقط وضعیت نمایشی، تماس‌برای‌قیمت، تاریخ پایان کمپین، و محصول جایگزین.
 *
 * فیلدها (کلیدِ متا):
 *   _dz_product_state          (select)  وضعیت دستی/override
 *   _dz_call_for_price         (yes|'')  قیمت تلفنی / استعلام
 *   _dz_special_end_date       (Y-m-d)   پایان کمپین فروش ویژه
 *   _dz_replacement_product_id (int)     محصول جایگزین برای حالت «متوقف»
 *
 * این فایل فقط در پیشخوان و وقتی WooCommerce فعال است لود می‌شود.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * گزینه‌های فیلد وضعیت دستی محصول.
 *
 * @return array<string,string> value => label
 */
function dz_admin_state_choices() {
	return array(
		''             => __( 'خودکار (بر اساس resolver)', 'dashtzad' ),
		'available'    => __( 'موجود', 'dashtzad' ),
		'unavailable'  => __( 'ناموجود', 'dashtzad' ),
		'special'      => __( 'فروش ویژه', 'dashtzad' ),
		'bestseller'   => __( 'پرفروش', 'dashtzad' ),
		'new-arrival'  => __( 'تازه‌رسید', 'dashtzad' ),
		'discounted'   => __( 'تخفیف‌دار', 'dashtzad' ),
		'contact'      => __( 'قیمت تلفنی', 'dashtzad' ),
		'discontinued' => __( 'تولید متوقف شد', 'dashtzad' ),
	);
}

add_action( 'woocommerce_product_options_general_product_data', 'dz_render_product_state_fields' );
/**
 * رندر فیلدهای وضعیت در تب «عمومیِ» دادهٔ محصول.
 */
function dz_render_product_state_fields() {
	global $post;

	echo '<div class="options_group">';

	// عنوان بخش.
	echo '<p class="form-field"><strong>' . esc_html__( 'وضعیت نمایشی دشت‌زاد', 'dashtzad' ) . '</strong></p>';

	// _dz_product_state — select.
	woocommerce_wp_select(
		array(
			'id'          => '_dz_product_state',
			'label'       => __( 'وضعیت محصول', 'dashtzad' ),
			'description' => __( 'override نمایشی. «خودکار» یعنی resolver بر اساس موجودی/تخفیف/فروش تصمیم می‌گیرد.', 'dashtzad' ),
			'desc_tip'    => true,
			'options'     => dz_admin_state_choices(),
		)
	);

	// _dz_call_for_price — checkbox.
	woocommerce_wp_checkbox(
		array(
			'id'          => '_dz_call_for_price',
			'label'       => __( 'قیمت تلفنی / استعلام', 'dashtzad' ),
			'description' => __( 'محصول بدون قیمت نمایش داده شده و خرید آن مسدود می‌شود (وضعیت «تماس»).', 'dashtzad' ),
			'desc_tip'    => true,
		)
	);

	// _dz_special_end_date — date picker.
	woocommerce_wp_text_input(
		array(
			'id'                => '_dz_special_end_date',
			'label'             => __( 'پایان فروش ویژه', 'dashtzad' ),
			'description'       => __( 'تاریخِ پایانِ کمپینِ «فروش ویژه». پس از این تاریخ، وضعیت ویژه غیرفعال می‌شود. ذخیره به‌صورت میلادی.', 'dashtzad' ),
			'desc_tip'          => true,
			'class'             => 'short',
			'custom_attributes' => array(
				'pattern'     => '[0-9]{4}-[0-9]{2}-[0-9]{2}',
				'placeholder' => 'YYYY-MM-DD',
			),
		)
	);

	// _dz_replacement_product_id — number (product ID).
	woocommerce_wp_text_input(
		array(
			'id'                => '_dz_replacement_product_id',
			'label'             => __( 'شناسهٔ محصول جایگزین', 'dashtzad' ),
			'description'       => __( 'برای حالت «تولید متوقف شد»؛ شناسهٔ محصولی که به‌جای این محصول پیشنهاد می‌شود.', 'dashtzad' ),
			'desc_tip'          => true,
			'type'              => 'number',
			'class'             => 'short',
			'custom_attributes' => array( 'min' => '0', 'step' => '1' ),
		)
	);

	echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'dz_save_product_state_fields' );
/**
 * ذخیرهٔ فیلدهای وضعیت هنگام ذخیرهٔ محصول.
 *
 * @param int $post_id شناسه محصول.
 */
function dz_save_product_state_fields( $post_id ) {
	// nonce ووکامرس در woocommerce_process_product_meta بررسی شده است.

	// _dz_product_state.
	$valid = array_keys( dz_admin_state_choices() );
	$state = isset( $_POST['_dz_product_state'] ) ? sanitize_text_field( wp_unslash( $_POST['_dz_product_state'] ) ) : '';
	if ( in_array( $state, $valid, true ) && '' !== $state ) {
		update_post_meta( $post_id, '_dz_product_state', $state );
	} else {
		delete_post_meta( $post_id, '_dz_product_state' );
	}

	// _dz_call_for_price.
	$call = isset( $_POST['_dz_call_for_price'] ) ? 'yes' : '';
	if ( 'yes' === $call ) {
		update_post_meta( $post_id, '_dz_call_for_price', 'yes' );
	} else {
		delete_post_meta( $post_id, '_dz_call_for_price' );
	}

	// _dz_special_end_date (Y-m-d).
	$end = isset( $_POST['_dz_special_end_date'] ) ? sanitize_text_field( wp_unslash( $_POST['_dz_special_end_date'] ) ) : '';
	if ( $end && preg_match( '/^\d{4}-\d{2}-\d{2}$/', $end ) ) {
		update_post_meta( $post_id, '_dz_special_end_date', $end );
	} else {
		delete_post_meta( $post_id, '_dz_special_end_date' );
	}

	// _dz_replacement_product_id.
	$rep = isset( $_POST['_dz_replacement_product_id'] ) ? absint( wp_unslash( $_POST['_dz_replacement_product_id'] ) ) : 0;
	if ( $rep > 0 ) {
		update_post_meta( $post_id, '_dz_replacement_product_id', $rep );
	} else {
		delete_post_meta( $post_id, '_dz_replacement_product_id' );
	}
}
