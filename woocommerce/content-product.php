<?php
/**
 * content-product.php — تک‌آیتمِ حلقهٔ آرشیو ووکامرس (override).
 *
 * بازنویسیِ مینیمالِ تمپلیتِ هستهٔ ووکامرس تا هر آیتمِ حلقه با کارتِ
 * وضعیت‌محورِ دشت‌زاد (template-parts/woocommerce/product-card.php) رندر شود.
 * وضعیت از dz_resolve_product_state() می‌آید و کلاسِ dz-state-* را فیلترِ
 * woocommerce_post_class (در inc/woocommerce.php) به <li> اضافه می‌کند.
 *
 * @see https://woocommerce.com/document/template-structure/  (نسخهٔ مرجع: 3.6.0)
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'dz-pc-cell', $product ); ?>>
	<?php get_template_part( 'template-parts/woocommerce/product-card', null, array( 'product' => $product ) ); ?>
</li>
