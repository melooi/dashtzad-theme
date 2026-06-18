<?php
/**
 * Component: ProductCard (کارت محصول «سریع»).
 *
 * نسخه رسمی فروشگاه — تصویر کلیک‌پذیر → صفحه محصول، دسته روی عکس،
 * تگ‌های لیکویید گلس، امتیاز چپ، ردیف وزن، قیمت چپ/دکمه راست،
 * دکمه افزودن که با JS به استپر تعداد تبدیل می‌شود.
 *
 * Usage:
 *   get_template_part( 'components/product/product-card', null, array( ... ) );
 *
 * Args:
 *   cat (string), cat_icon (fa class), cat_tone ('green'|'clay'|'gold'),
 *   name (string), href (url),
 *   rate (fa-digit string), reviews (fa-digit string),
 *   weight (string e.g. «۲۵۰ گرم»), installment (bool),
 *   price (int Toman), old_price (int Toman|0),
 *   badges (array of [ 'label'=>, 'icon'=>fa, 'type'=>'hot'|'off'|'vip' ]),
 *   img (url|''), img_label (string).
 *
 * NOTE: داده نمونه؛ در مرحله ووکامرس با WC_Product جایگزین شود.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$p = wp_parse_args( $args ?? array(), array(
	'cat'         => '',
	'cat_icon'    => 'fa-bowl-food',
	'cat_tone'    => 'green',
	'name'        => '',
	'href'        => '#',
	'rate'        => '',
	'reviews'     => '',
	'weight'      => '',
	'grams'       => 0,
	'stock'       => 0,
	'oos'         => false,
	'btn'         => 'add',
	'timer'       => 0,
	'installment' => true,
	'price'       => 0,
	'old_price'   => 0,
	'badges'      => array(),
	'img'         => '',
	'img_label'   => 'عکس محصول',
) );

/* پشتیبانی از فرمت قدیمی cat_tone مثل text-green / text-gold-deep */
$tone_raw = str_replace( array( 'text-', '-deep' ), '', (string) $p['cat_tone'] );
$tone     = in_array( $tone_raw, array( 'green', 'clay', 'gold' ), true ) ? $tone_raw : 'green';
?>
<article class="dz-pc<?php echo $p['oos'] ? ' dz-pc--oos' : ''; ?>" data-base-price="<?php echo esc_attr( (int) $p['price'] ); ?>"<?php echo $p['old_price'] ? ' data-old-price="' . esc_attr( (int) $p['old_price'] ) . '"' : ''; ?><?php echo $p['grams'] ? ' data-grams="' . esc_attr( (int) $p['grams'] ) . '"' : ''; ?><?php echo $p['timer'] ? ' data-timer="' . esc_attr( (int) $p['timer'] ) . '"' : ''; ?>>
	<div class="dz-pc__media">
		<a class="dz-pc__img" href="<?php echo esc_url( $p['href'] ); ?>" aria-label="<?php echo esc_attr( $p['name'] ); ?>">
			<?php if ( $p['img'] ) : ?>
				<img src="<?php echo esc_url( $p['img'] ); ?>" alt="<?php echo esc_attr( $p['name'] ); ?>">
			<?php else : ?>
				<span class="dz-placeholder"><span class="dz-placeholder__label"><?php echo esc_html( $p['img_label'] ); ?></span></span>
			<?php endif; ?>
		</a>

		<?php if ( $p['oos'] ) : ?>
			<div class="dz-pc__oos-veil"><span class="dz-pc__oos-tag"><i class="fa-solid fa-circle-xmark"></i> <?php esc_html_e( 'ناموجود', 'dashtzad' ); ?></span></div>
		<?php endif; ?>

		<?php if ( ! empty( $p['badges'] ) ) : ?>
			<div class="dz-pc__badges">
				<?php
				foreach ( $p['badges'] as $b ) :
					$type = $b['type'] ?? '';
					if ( ! in_array( $type, array( 'hot', 'off', 'vip' ), true ) ) {
						$cls  = (string) ( $b['classes'] ?? '' );
						if ( false !== strpos( $cls, 'green' ) ) {
							$type = 'vip';
						} elseif ( false !== strpos( $cls, 'amber' ) || false !== strpos( $cls, 'gold' ) ) {
							$type = 'off';
						} else {
							$type = 'hot';
						}
					}
					?>
					<span class="dz-glass dz-pc__badge dz-pc__badge--<?php echo esc_attr( $type ); ?>"><i class="fa-solid <?php echo esc_attr( $b['icon'] ?? 'fa-tag' ); ?>"></i> <?php echo esc_html( $b['label'] ?? '' ); ?></span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<button class="dz-pc__fav" type="button" aria-label="<?php esc_attr_e( 'افزودن به علاقه‌مندی‌ها', 'dashtzad' ); ?>"><i class="fa-regular fa-heart"></i></button>

		<?php if ( $p['cat'] ) : ?>
			<span class="dz-pc__cat dz-pc__cat--<?php echo esc_attr( $tone ); ?>"><i class="fa-solid <?php echo esc_attr( $p['cat_icon'] ); ?>"></i> <?php echo esc_html( $p['cat'] ); ?></span>
		<?php endif; ?>
	</div>

	<div class="dz-pc__body">
		<h3 class="dz-pc__title"><a href="<?php echo esc_url( $p['href'] ); ?>"><?php echo esc_html( $p['name'] ); ?></a></h3>

		<?php if ( $p['installment'] || $p['rate'] ) : ?>
			<div class="dz-pc__meta">
				<?php if ( $p['installment'] ) : ?>
					<span class="dz-glass dz-pc__inst"><i class="fa-solid fa-credit-card"></i> <?php esc_html_e( 'خرید قسطی', 'dashtzad' ); ?></span>
				<?php endif; ?>
				<?php if ( $p['rate'] ) : ?>
					<span class="dz-pc__rate"><i class="fa-solid fa-star"></i> <?php echo esc_html( $p['rate'] ); ?> <small>(<?php echo esc_html( $p['reviews'] ); ?>)</small></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<?php if ( $p['weight'] || ( $p['stock'] && (int) $p['stock'] <= 5 ) ) : ?>
			<div class="dz-pc__wrow">
				<?php if ( $p['weight'] ) : ?>
					<span class="dz-pc__weight"><i class="fa-solid fa-weight-hanging"></i> <?php echo esc_html( $p['weight'] ); ?></span>
				<?php endif; ?>
				<?php if ( $p['stock'] && (int) $p['stock'] <= 5 ) : ?>
					<span class="dz-pc__stock"><i class="fa-solid fa-fire-flame-curved"></i> <?php printf( esc_html__( '%s تا مونده', 'dashtzad' ), esc_html( dz_format_number_fa( (int) $p['stock'] ) ) ); ?></span>
				<?php endif; ?>
			</div>
		<?php endif; ?>

		<div class="dz-pc__foot">
			<div class="dz-pc__prices">
				<?php if ( $p['oos'] ) : ?>
					<span class="dz-pc__soon"><?php esc_html_e( 'فعلا موجود نیست', 'dashtzad' ); ?></span>
				<?php else : ?>
					<?php if ( $p['old_price'] ) : ?>
						<span class="dz-pc__price-old num"><?php echo esc_html( dz_format_number_fa( $p['old_price'] ) ); ?></span>
					<?php endif; ?>
					<span class="dz-pc__price num"><?php echo esc_html( dz_format_number_fa( $p['price'] ) ); ?> <span class="toman-mark" role="img" aria-label="<?php esc_attr_e( 'تومان', 'dashtzad' ); ?>"></span></span>
				<?php endif; ?>
			</div>
			<?php if ( $p['oos'] ) : ?>
				<button class="dz-pc__notify" type="button" aria-label="<?php esc_attr_e( 'اطلاع موجودی', 'dashtzad' ); ?>"><i class="fa-regular fa-bell"></i></button>
			<?php elseif ( 'view' === $p['btn'] ) : ?>
				<a class="dz-pc__view" href="<?php echo esc_url( $p['href'] ); ?>" aria-label="<?php esc_attr_e( 'مشاهده محصول', 'dashtzad' ); ?>"><i class="fa-solid fa-eye"></i> <?php esc_html_e( 'مشاهده', 'dashtzad' ); ?></a>
			<?php elseif ( 'cart' === $p['btn'] ) : ?>
				<button class="dz-pc__add dz-pc__add--cart" type="button" aria-label="<?php esc_attr_e( 'افزودن به سبد', 'dashtzad' ); ?>"><i class="fa-solid fa-cart-shopping"></i> <?php esc_html_e( 'افزودن', 'dashtzad' ); ?></button>
			<?php else : ?>
				<button class="dz-pc__add" type="button" aria-label="<?php esc_attr_e( 'افزودن به سبد', 'dashtzad' ); ?>"><i class="fa-solid fa-plus"></i></button>
			<?php endif; ?>
		</div>
	</div>
</article>
