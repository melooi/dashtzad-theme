<?php
/**
 * Template part: ProductCard (کارت محصول «سریع») — نسخهٔ ووکامرسِ وضعیت‌محور.
 *
 * منبع واحدِ وضعیت: dz_resolve_product_state(). همهٔ داده‌های تجاری (قیمت، موجودی،
 * سبد) از WooCommerce می‌آید؛ این تمپلیت فقط نمایش را می‌چیند.
 *
 * خروجی همیشه روی ریشهٔ کارت:  data-state="<state>"  (esc_attr)
 *
 * Usage:
 *   get_template_part( 'template-parts/woocommerce/product-card', null, array( 'product' => $product ) );
 *   یا داخل حلقهٔ ووکامرس بدون آرگومان (از $product سراسری می‌خوانَد).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_product = ( isset( $args['product'] ) && $args['product'] instanceof WC_Product )
	? $args['product']
	: ( isset( $GLOBALS['product'] ) ? $GLOBALS['product'] : wc_get_product( get_the_ID() ) );

if ( ! $dz_product instanceof WC_Product ) {
	return;
}

$dz_state   = dz_resolve_product_state( $dz_product );
$dz_disp    = dz_state_display( $dz_state );
$dz_buyable = dz_state_is_purchasable( $dz_state ) && $dz_product->is_purchasable() && $dz_product->is_in_stock();
$dz_is_oos  = in_array( $dz_state, array( 'unavailable', 'discontinued' ), true );
$dz_href    = get_permalink( $dz_product->get_id() );
$dz_name    = $dz_product->get_name();

/* قیمت — همیشه از WooCommerce. نمایش به تومان با ارقام فارسی. */
$dz_now_disp = (float) wc_get_price_to_display( $dz_product );
$dz_reg_raw  = $dz_product->get_regular_price();
$dz_reg_disp = ( '' !== $dz_reg_raw ) ? (float) wc_get_price_to_display( $dz_product, array( 'price' => $dz_reg_raw ) ) : 0.0;
$dz_has_old  = in_array( $dz_state, array( 'discounted', 'special' ), true ) && $dz_reg_disp > $dz_now_disp;

/* موجودیِ کمِ نمایشی (فقط وقتی قابل‌خرید و مدیریت موجودی فعال است). */
$dz_stock_qty = $dz_product->managing_stock() ? (int) $dz_product->get_stock_quantity() : 0;
$dz_low_stock = $dz_buyable && $dz_stock_qty > 0 && $dz_stock_qty <= 5;

/* امتیاز. */
$dz_rate    = (float) $dz_product->get_average_rating();
$dz_reviews = (int) $dz_product->get_review_count();

/* تصویر. */
$dz_img_id = $dz_product->get_image_id();
?>
<article class="dz-pc<?php echo $dz_is_oos ? ' dz-pc--oos' : ''; ?> dz-pc--<?php echo esc_attr( $dz_state ); ?>" data-state="<?php echo esc_attr( $dz_state ); ?>">
	<div class="dz-pc__media">
		<a class="dz-pc__img" href="<?php echo esc_url( $dz_href ); ?>" aria-label="<?php echo esc_attr( $dz_name ); ?>">
			<?php if ( $dz_img_id ) : ?>
				<?php echo wp_get_attachment_image( $dz_img_id, 'woocommerce_thumbnail', false, array( 'alt' => esc_attr( $dz_name ) ) ); ?>
			<?php else : ?>
				<span class="dz-placeholder"><span class="dz-placeholder__label"><?php esc_html_e( 'عکس محصول', 'dashtzad' ); ?></span></span>
			<?php endif; ?>
		</a>

		<?php if ( $dz_is_oos ) : ?>
			<div class="dz-pc__oos-veil"><span class="dz-pc__oos-tag"><i class="fa-solid <?php echo esc_attr( $dz_disp['icon'] ); ?>"></i> <?php echo esc_html( $dz_disp['label'] ); ?></span></div>
		<?php endif; ?>

		<?php if ( '' !== $dz_disp['label'] && ! $dz_is_oos ) : ?>
			<div class="dz-pc__badges">
				<span class="dz-glass dz-pc__badge dz-pc__badge--<?php echo 'gold' === $dz_disp['tone'] ? 'off' : ( 'green' === $dz_disp['tone'] ? 'vip' : 'hot' ); ?>"><i class="fa-solid <?php echo esc_attr( $dz_disp['icon'] ); ?>"></i> <?php echo esc_html( $dz_disp['label'] ); ?></span>
			</div>
		<?php endif; ?>

		<button class="dz-pc__fav" type="button" aria-label="<?php esc_attr_e( 'افزودن به علاقه‌مندی‌ها', 'dashtzad' ); ?>"><i class="fa-regular fa-heart"></i></button>
	</div>

	<div class="dz-pc__body">
		<h3 class="dz-pc__title"><a href="<?php echo esc_url( $dz_href ); ?>"><?php echo esc_html( $dz_name ); ?></a></h3>

		<?php if ( $dz_rate > 0 ) : ?>
			<div class="dz-pc__meta">
				<span class="dz-pc__rate"><i class="fa-solid fa-star"></i> <?php echo esc_html( dz_fa_digits( number_format( $dz_rate, 1 ) ) ); ?> <small>(<?php echo esc_html( dz_fa_digits( $dz_reviews ) ); ?>)</small></span>
			</div>
		<?php endif; ?>

		<?php if ( $dz_low_stock ) : ?>
			<div class="dz-pc__wrow">
				<span class="dz-pc__stock"><i class="fa-solid fa-fire-flame-curved"></i> <?php printf( esc_html__( '%s تا مونده', 'dashtzad' ), esc_html( dz_format_number_fa( $dz_stock_qty ) ) ); ?></span>
			</div>
		<?php endif; ?>

		<div class="dz-pc__foot">
			<div class="dz-pc__prices">
				<?php if ( 'contact' === $dz_state ) : ?>
					<span class="dz-pc__price-contact"><i class="fa-solid fa-headset"></i> <?php esc_html_e( 'استعلام قیمت', 'dashtzad' ); ?></span>
				<?php elseif ( $dz_is_oos ) : ?>
					<span class="dz-pc__soon"><?php echo 'discontinued' === $dz_state ? esc_html__( 'تولید متوقف شد', 'dashtzad' ) : esc_html__( 'فعلا موجود نیست', 'dashtzad' ); ?></span>
				<?php else : ?>
					<?php if ( $dz_has_old ) : ?>
						<span class="dz-pc__price-old num"><?php echo esc_html( dz_format_number_fa( $dz_reg_disp ) ); ?></span>
					<?php endif; ?>
					<span class="dz-pc__price num"><?php echo esc_html( dz_format_number_fa( $dz_now_disp ) ); ?> <span class="toman-mark" role="img" aria-label="<?php esc_attr_e( 'تومان', 'dashtzad' ); ?>"></span></span>
				<?php endif; ?>
			</div>

			<?php
			if ( 'unavailable' === $dz_state ) :
				?>
				<button class="dz-pc__notify" type="button" aria-label="<?php esc_attr_e( 'اطلاع موجودی', 'dashtzad' ); ?>"><i class="fa-regular fa-bell"></i></button>
				<?php
			elseif ( 'discontinued' === $dz_state ) :
				$dz_rep_id = (int) dz_product_field( '_dz_replacement_product_id', $dz_product->get_id() );
				$dz_rep_url = $dz_rep_id ? get_permalink( $dz_rep_id ) : $dz_href;
				?>
				<a class="dz-pc__view" href="<?php echo esc_url( $dz_rep_url ); ?>"><i class="fa-solid fa-arrow-right-arrow-left"></i> <?php esc_html_e( 'جایگزین', 'dashtzad' ); ?></a>
				<?php
			elseif ( 'contact' === $dz_state ) :
				?>
				<a class="dz-pc__view" href="<?php echo esc_url( $dz_href ); ?>"><i class="fa-solid fa-phone"></i> <?php esc_html_e( 'تماس', 'dashtzad' ); ?></a>
				<?php
			elseif ( $dz_buyable ) :
				$dz_add_class = implode(
					' ',
					array_filter(
						array(
							'dz-pc__cartbtn',
							'button',
							'product_type_' . $dz_product->get_type(),
							'add_to_cart_button',
							$dz_product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
						)
					)
				);
				echo apply_filters(
					'woocommerce_loop_add_to_cart_link',
					sprintf(
						'<a href="%s" data-quantity="1" class="%s" %s aria-label="%s"><i class="fa-solid fa-cart-shopping"></i></a>',
						esc_url( $dz_product->add_to_cart_url() ),
						esc_attr( $dz_add_class ),
						wc_implode_html_attributes(
							array(
								'data-product_id'  => $dz_product->get_id(),
								'data-product_sku' => $dz_product->get_sku(),
								'rel'              => 'nofollow',
							)
						),
						esc_attr( $dz_product->add_to_cart_description() )
					),
					$dz_product,
					array()
				);
			else :
				?>
				<a class="dz-pc__view" href="<?php echo esc_url( $dz_href ); ?>"><i class="fa-solid fa-eye"></i> <?php esc_html_e( 'مشاهده', 'dashtzad' ); ?></a>
			<?php endif; ?>
		</div>
	</div>
</article>
