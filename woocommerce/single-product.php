<?php
/**
 * single-product.php — صفحهٔ تک‌محصول ووکامرس (override، وضعیت‌محور).
 *
 * طراحیِ تأییدشدهٔ «۸ حالتِ کارت محصول» (مرجع: wp/pages/product-states.php) را به
 * رندرِ واقعیِ ووکامرس تبدیل می‌کند:
 *   - وضعیت از dz_resolve_product_state() (سمت سرور، تک‌حالت — بدون سوییچِ زنده).
 *   - قیمت/موجودی/فرمِ سبد همیشه از WooCommerce.
 *   - حالت‌های مسدود (contact/unavailable/discontinued) فرمِ خرید ندارند؛
 *     مسدودسازیِ نهایی سمت سرور با فیلترهای resolver انجام می‌شود.
 *
 * @see https://woocommerce.com/document/template-structure/  (نسخهٔ مرجع: 3.6.0)
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();
	global $product;
	if ( ! $product instanceof WC_Product ) {
		$product = wc_get_product( get_the_ID() );
	}

	$dz_state = dz_resolve_product_state( $product );
	$dz_disp  = dz_state_display( $dz_state );

	/* قیمت — همیشه از WooCommerce. */
	$dz_now   = (float) wc_get_price_to_display( $product );
	$dz_regp  = $product->get_regular_price();
	$dz_reg   = ( '' !== $dz_regp ) ? (float) wc_get_price_to_display( $product, array( 'price' => $dz_regp ) ) : 0.0;
	$dz_has_disc = in_array( $dz_state, array( 'discounted', 'special' ), true ) && $dz_reg > $dz_now;
	$dz_save  = $dz_has_disc ? ( $dz_reg - $dz_now ) : 0;
	$dz_off   = ( $dz_has_disc && $dz_reg > 0 ) ? round( ( 1 - $dz_now / $dz_reg ) * 100 ) : 0;

	/* گالری. */
	$dz_gallery = $product->get_gallery_image_ids();

	/* تاریخ پایان کمپین (special) → timestamp برای شمارش معکوس. */
	$dz_end     = dz_product_field( '_dz_special_end_date', $product->get_id() );
	$dz_end_ts  = $dz_end ? strtotime( $dz_end . ' 23:59:59' ) : 0;
	?>

	<?php do_action( 'woocommerce_before_single_product' ); ?>

	<main class="dz-sp" data-screen-label="single-product">
		<div class="dz-sp__container">

			<!-- breadcrumb -->
			<nav class="dz-sp__crumb" aria-label="<?php esc_attr_e( 'مسیر صفحه', 'dashtzad' ); ?>">
				<?php woocommerce_breadcrumb(); ?>
			</nav>

			<article class="pcard" data-state="<?php echo esc_attr( $dz_state ); ?>" data-end="<?php echo esc_attr( $dz_end_ts ); ?>">

				<!-- ===================== STATE BANNER ===================== -->
				<?php if ( 'special' === $dz_state && $dz_end_ts > current_time( 'timestamp' ) ) : ?>
					<div class="countdown" style="display:flex">
						<div class="countdown__lead">
							<span class="countdown__ic"><i class="fa-solid fa-bolt"></i></span>
							<div style="min-width:0">
								<b class="countdown__title"><?php esc_html_e( 'فروش ویژه', 'dashtzad' ); ?></b>
								<p class="countdown__sub"><?php esc_html_e( 'تا پایان شمارش معکوس، با این قیمت بخرید.', 'dashtzad' ); ?></p>
							</div>
						</div>
						<div class="countdown__clock" data-countdown>
							<div class="countdown__unit"><span class="countdown__digit" data-cd="h">۰۰</span><span class="countdown__lbl"><?php esc_html_e( 'ساعت', 'dashtzad' ); ?></span></div>
							<span class="countdown__sep">:</span>
							<div class="countdown__unit"><span class="countdown__digit" data-cd="m">۰۰</span><span class="countdown__lbl"><?php esc_html_e( 'دقیقه', 'dashtzad' ); ?></span></div>
							<span class="countdown__sep">:</span>
							<div class="countdown__unit"><span class="countdown__digit" data-cd="s">۰۰</span><span class="countdown__lbl"><?php esc_html_e( 'ثانیه', 'dashtzad' ); ?></span></div>
						</div>
					</div>
				<?php elseif ( '' !== $dz_disp['label'] ) :
					$dz_sb = array(
						'unavailable'  => array( 'sb' => 'sb--clay',    'title' => 'متأسفیم، فعلاً تمام کردیم!', 'text' => 'این محصول در حال حاضر موجود نیست. شماره‌ات را ثبت کن تا به‌محض شارژ مجدد خبرت کنیم.' ),
						'special'      => array( 'sb' => 'sb--clay',    'title' => 'فروش ویژه', 'text' => 'این محصول هم‌اکنون با قیمت ویژه عرضه می‌شود.' ),
						'bestseller'   => array( 'sb' => 'sb--gold',    'title' => 'پرفروش‌ترین این فصل', 'text' => 'انتخابِ محبوبِ مشتریان دشت‌زاد در روزهای اخیر.' ),
						'new-arrival'  => array( 'sb' => 'sb--green',   'title' => 'تازه به دشت‌زاد اضافه شد!', 'text' => 'جدیدترین محصول باغ ما؛ اولین نفری باش که می‌چشد.' ),
						'discounted'   => array( 'sb' => 'sb--clay',    'title' => 'هم‌اکنون با تخفیف', 'text' => 'فرصت خرید با قیمت ویژه تا پایان موجودی انبار.' ),
						'contact'      => array( 'sb' => 'sb--neutral', 'title' => 'به‌صورت سفارشی و عمده عرضه می‌شود', 'text' => 'برای استعلام قیمت و ثبت سفارش با کارشناس فروش تماس بگیرید.' ),
						'discontinued' => array( 'sb' => 'sb--neutral', 'title' => 'این محصول دیگر تولید نمی‌شود', 'text' => 'عرضهٔ این محصول متوقف شده است؛ می‌توانید گزینهٔ جایگزین را ببینید.' ),
					);
					if ( isset( $dz_sb[ $dz_state ] ) ) :
						$dz_b = $dz_sb[ $dz_state ];
						?>
						<div class="state-banner <?php echo esc_attr( $dz_b['sb'] ); ?>" style="display:flex">
							<span class="state-banner__ic"><i class="fa-solid <?php echo esc_attr( $dz_disp['icon'] ); ?>"></i></span>
							<div style="min-width:0">
								<b class="state-banner__title"><?php echo esc_html( $dz_b['title'] ); ?></b>
								<p class="state-banner__text"><?php echo esc_html( $dz_b['text'] ); ?></p>
							</div>
							<span class="badge badge--<?php echo esc_attr( $dz_disp['tone'] ); ?> state-banner__chip"><i class="fa-solid <?php echo esc_attr( $dz_disp['icon'] ); ?>"></i> <?php echo esc_html( $dz_disp['label'] ); ?></span>
						</div>
						<?php
					endif;
				endif;
				?>

				<!-- ===================== HERO GRID ===================== -->
				<div class="pcard__grid">
					<div class="pcard__main">
						<div class="infocard">
							<!-- info body -->
							<div class="infocard__body">
								<div class="phead">
									<div style="min-width:0">
										<h1 class="phead__title display"><?php the_title(); ?></h1>
										<?php if ( $product->get_sku() ) : ?>
											<div class="phead__latin"><?php esc_html_e( 'کد کالا:', 'dashtzad' ); ?> <span class="num latin-sub"><?php echo esc_html( dz_fa_digits( $product->get_sku() ) ); ?></span></div>
										<?php endif; ?>
									</div>
								</div>

								<?php if ( (float) $product->get_average_rating() > 0 ) : ?>
									<div class="meta">
										<span class="meta__item"><i class="fa-solid fa-star meta__star"></i> <span class="num"><?php echo esc_html( dz_fa_digits( number_format( (float) $product->get_average_rating(), 1 ) ) ); ?></span> <?php esc_html_e( 'امتیاز', 'dashtzad' ); ?></span>
										<span class="meta__sep"></span>
										<span class="meta__item"><span class="num"><?php echo esc_html( dz_fa_digits( (int) $product->get_review_count() ) ); ?></span> <?php esc_html_e( 'دیدگاه', 'dashtzad' ); ?></span>
									</div>
								<?php endif; ?>

								<?php if ( $product->get_short_description() ) : ?>
									<div class="infocard__sect">
										<div class="dz-sp__short"><?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?></div>
									</div>
								<?php endif; ?>

								<?php
								$dz_attrs = $product->get_attributes();
								if ( ! empty( $dz_attrs ) ) :
									?>
									<div class="infocard__sect">
										<h4 class="infocard__sect-h"><?php esc_html_e( 'ویژگی‌های اصلی', 'dashtzad' ); ?></h4>
										<div class="feat-grid">
											<?php
											foreach ( $dz_attrs as $dz_attr ) :
												if ( ! $dz_attr->get_visible() ) {
													continue;
												}
												$dz_label = wc_attribute_label( $dz_attr->get_name() );
												$dz_vals  = $product->get_attribute( $dz_attr->get_name() );
												if ( ! $dz_vals ) {
													continue;
												}
												?>
												<span class="chip"><span class="faint"><?php echo esc_html( $dz_label ); ?>:</span> <b><?php echo esc_html( $dz_vals ); ?></b></span>
											<?php endforeach; ?>
										</div>
									</div>
								<?php endif; ?>
							</div>

							<!-- gallery -->
							<div class="pcard__gallery">
								<div class="gallery__frame">
									<div class="ph gallery__img">
										<?php
										if ( has_post_thumbnail() ) {
											echo get_the_post_thumbnail( $product->get_id(), 'woocommerce_single' );
										} else {
											echo '<span class="ph__label">' . esc_html__( 'عکس محصول', 'dashtzad' ) . '</span>';
										}
										?>
									</div>
								</div>
								<?php if ( ! empty( $dz_gallery ) ) : ?>
									<div class="gallery__thumbs">
										<?php foreach ( array_slice( $dz_gallery, 0, 5 ) as $dz_gid ) : ?>
											<span class="thumb"><?php echo wp_get_attachment_image( $dz_gid, 'woocommerce_gallery_thumbnail' ); ?></span>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>

						<!-- ===================== DESCRIPTION ===================== -->
						<?php if ( get_the_content() ) : ?>
							<section class="sec" id="sec-desc" data-screen-label="توضیح محصول">
								<div class="sec__head"><span class="sec__kicker"><?php esc_html_e( 'درباره محصول', 'dashtzad' ); ?></span><h2 class="sec__title"><?php esc_html_e( 'توضیح محصول', 'dashtzad' ); ?></h2></div>
								<div class="pdesc dz-sp__content"><?php the_content(); ?></div>
							</section>
						<?php endif; ?>

						<!-- ===================== REVIEWS (WooCommerce) ===================== -->
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<section class="sec" id="sec-reviews" data-screen-label="دیدگاه خریداران">
								<div class="sec__head"><span class="sec__kicker"><?php esc_html_e( 'نظرِ خریداران', 'dashtzad' ); ?></span><h2 class="sec__title"><?php esc_html_e( 'دیدگاه خریداران', 'dashtzad' ); ?></h2></div>
								<div class="dz-sp__reviews"><?php comments_template(); ?></div>
							</section>
						<?php endif; ?>
					</div>

					<!-- ===================== BUY SIDEBAR ===================== -->
					<aside class="buybox">
						<!-- status -->
						<div class="buybox__row">
							<span class="buybox__label"><?php esc_html_e( 'وضعیت محصول:', 'dashtzad' ); ?></span>
							<span class="buybox__value">
								<?php
								if ( 'unavailable' === $dz_state ) {
									echo '<span style="color:var(--clay)">' . esc_html__( 'ناموجود', 'dashtzad' ) . '</span>';
								} elseif ( 'contact' === $dz_state ) {
									echo '<span style="color:var(--green)">' . esc_html__( 'موجود — قیمت تلفنی', 'dashtzad' ) . '</span>';
								} elseif ( 'discontinued' === $dz_state ) {
									echo '<span style="color:var(--ink-soft)">' . esc_html__( 'تولید متوقف شده', 'dashtzad' ) . '</span>';
								} else {
									echo esc_html__( 'موجود در انبار', 'dashtzad' );
								}
								?>
							</span>
						</div>

						<?php if ( dz_state_is_purchasable( $dz_state ) ) : ?>
							<!-- price -->
							<?php if ( $dz_has_disc ) : ?>
								<div class="price--discount buybox__sect" style="display:block">
									<div class="buybox__row" style="padding-block:.7rem">
										<span class="buybox__label"><?php esc_html_e( 'قیمت:', 'dashtzad' ); ?></span>
										<span class="num price__old"><?php echo esc_html( dz_format_number_fa( $dz_reg ) ); ?> <span class="toman-mark"></span></span>
									</div>
									<div class="buybox__row" style="padding-block:.7rem">
										<span class="buybox__label"><?php esc_html_e( 'سود شما:', 'dashtzad' ); ?></span>
										<span class="buybox__value" style="color:var(--green)">
											<span class="discount-chip num">٪<?php echo esc_html( dz_fa_digits( $dz_off ) ); ?></span>
											<span class="num"><?php echo esc_html( dz_format_number_fa( $dz_save ) ); ?></span> <span class="toman-mark"></span>
										</span>
									</div>
									<div class="buybox__row price__total" style="border-top:1px solid var(--hair); padding-top:1.1rem; margin-top:.4rem">
										<span class="buybox__label"><?php esc_html_e( 'قیمت نهایی:', 'dashtzad' ); ?></span>
										<span class="buybox__value"><span class="num price__final"><?php echo esc_html( dz_format_number_fa( $dz_now ) ); ?></span> <span class="toman-mark"></span></span>
									</div>
								</div>
							<?php else : ?>
								<div class="buybox__row buybox__sect price price--simple" style="display:flex">
									<span class="buybox__label"><?php esc_html_e( 'قیمت:', 'dashtzad' ); ?></span>
									<span class="buybox__value"><span class="num price__final"><?php echo esc_html( dz_format_number_fa( $dz_now ) ); ?></span> <span class="toman-mark"></span></span>
								</div>
							<?php endif; ?>

							<!-- add to cart (WooCommerce real form) -->
							<div class="buybox__sect dz-sp__cart">
								<?php woocommerce_template_single_add_to_cart(); ?>
							</div>

						<?php elseif ( 'unavailable' === $dz_state ) : ?>
							<!-- notify-me -->
							<div class="buybox__sect col-gap" style="display:flex">
								<div class="ibox">
									<span class="ibox__ic ibox__ic--clay"><i class="fa-solid fa-box"></i></span>
									<div>
										<b class="ibox__title"><?php esc_html_e( 'فعلاً تمام شد', 'dashtzad' ); ?></b>
										<p class="ibox__text"><?php esc_html_e( 'این محصول پرطرفدار به‌زودی دوباره شارژ می‌شود.', 'dashtzad' ); ?></p>
									</div>
								</div>
								<div class="form-ok" data-on="false" data-dz-ok="notify"><i class="fa-solid fa-check"></i> <?php esc_html_e( 'ثبت شد ✓ به‌محض موجود شدن با پیامک خبرت می‌دهیم.', 'dashtzad' ); ?></div>
								<div class="form-fields col-gap">
									<input class="field" type="tel" inputmode="numeric" placeholder="۰۹۱۲ ۰۰۰ ۰۰۰۰" data-dz-input="notify" />
									<button class="btn btn--primary btn--block" type="button" data-dz-submit="notify"><i class="fa-solid fa-bell"></i> <?php esc_html_e( 'به من اطلاع بده', 'dashtzad' ); ?></button>
								</div>
							</div>

						<?php elseif ( 'contact' === $dz_state ) :
							$dz_phone = dz_product_field( '_dz_contact_phone', $product->get_id() );
							$dz_phone = $dz_phone ? $dz_phone : '02191300576';
							?>
							<!-- contact -->
							<div class="buybox__sect col-gap" style="display:flex">
								<div class="ibox">
									<span class="ibox__ic ibox__ic--green"><i class="fa-solid fa-headset"></i></span>
									<div>
										<b class="ibox__title"><?php esc_html_e( 'قیمت تلفنی / فروش عمده', 'dashtzad' ); ?></b>
										<p class="ibox__text"><?php esc_html_e( 'برای استعلام قیمت و ثبت سفارش، با کارشناس فروش تماس بگیرید.', 'dashtzad' ); ?></p>
									</div>
								</div>
								<a class="btn btn--primary btn--block" href="tel:<?php echo esc_attr( preg_replace( '/\D/', '', $dz_phone ) ); ?>"><i class="fa-solid fa-phone"></i> <?php esc_html_e( 'تماس با کارشناس', 'dashtzad' ); ?></a>
								<div class="dz-sp__phone num"><?php echo esc_html( dz_fa_digits( $dz_phone ) ); ?></div>
							</div>

						<?php elseif ( 'discontinued' === $dz_state ) :
							$dz_rep_id  = (int) dz_product_field( '_dz_replacement_product_id', $product->get_id() );
							$dz_rep_id  = $dz_rep_id ? $dz_rep_id : (int) dz_product_field( '_dz_replacement_product', $product->get_id() );
							?>
							<!-- discontinued -->
							<div class="buybox__sect col-gap" style="display:flex">
								<div class="ibox">
									<span class="ibox__ic ibox__ic--neutral"><i class="fa-solid fa-ban"></i></span>
									<div>
										<b class="ibox__title"><?php esc_html_e( 'به‌دنبال جایگزین هستید؟', 'dashtzad' ); ?></b>
										<p class="ibox__text"><?php esc_html_e( 'عرضهٔ این محصول متوقف شده است.', 'dashtzad' ); ?></p>
									</div>
								</div>
								<?php if ( $dz_rep_id ) : ?>
									<a class="btn btn--primary btn--block" href="<?php echo esc_url( get_permalink( $dz_rep_id ) ); ?>"><i class="fa-solid fa-arrow-right-arrow-left"></i> <?php esc_html_e( 'مشاهدهٔ محصول جایگزین', 'dashtzad' ); ?></a>
								<?php else : ?>
									<a class="btn btn--primary btn--block" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><i class="fa-solid fa-boxes-stacked"></i> <?php esc_html_e( 'محصولات مشابه', 'dashtzad' ); ?></a>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<!-- trust -->
						<div class="buybox__sect dz-sp__trust">
							<span><i class="fa-solid fa-shield-halved"></i> <?php esc_html_e( 'ضمانت اصالت و کیفیت دشت‌زاد', 'dashtzad' ); ?></span>
							<span><i class="fa-solid fa-rotate-left"></i> <?php esc_html_e( 'بازگشت ۷ روزه', 'dashtzad' ); ?></span>
						</div>
					</aside>
				</div>

				<!-- ===================== RELATED (WooCommerce) ===================== -->
				<div class="dz-sp__related">
					<?php woocommerce_output_related_products(); ?>
				</div>
			</article>
		</div>
	</main>

	<?php
endwhile;

if ( isset( $dz_state, $dz_end_ts ) && 'special' === $dz_state && $dz_end_ts > current_time( 'timestamp' ) ) :
	?>
	<script>
	(function () {
		var FA = '۰۱۲۳۴۵۶۷۸۹';
		function pad2(n){ return String(n).padStart(2,'0').replace(/[0-9]/g,function(d){return FA[d];}); }
		var end = <?php echo (int) ( $dz_end_ts * 1000 ); ?>;
		var h = document.querySelector('[data-cd="h"]'), m = document.querySelector('[data-cd="m"]'), s = document.querySelector('[data-cd="s"]');
		function tick(){ var d = end - Date.now(); if (d < 0) d = 0; if(h) h.textContent = pad2(Math.floor(d/3600000)); if(m) m.textContent = pad2(Math.floor((d%3600000)/60000)); if(s) s.textContent = pad2(Math.floor((d%60000)/1000)); }
		tick(); setInterval(tick, 1000);
	})();
	</script>
<?php endif; ?>

<script>
/* فرم «خبرم کن» — اعتبارسنجی سادهٔ سمت کلاینت (ثبت واقعی در مرحلهٔ بعد). */
(function () {
	var btn = document.querySelector('[data-dz-submit="notify"]');
	if (!btn) return;
	var input = document.querySelector('[data-dz-input="notify"]');
	var ok = document.querySelector('[data-dz-ok="notify"]');
	btn.addEventListener('click', function () {
		var digits = (input.value.match(/[0-9۰-۹]/g) || []).length;
		if (digits >= 10 && ok) { ok.setAttribute('data-on', 'true'); }
	});
})();
</script>

<?php
get_footer();
