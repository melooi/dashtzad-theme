<?php
/**
 * Desktop primary navigation (lg and up).
 *
 * Shows the full menu row; the store context adds the categories mega-menu.
 * Items come from dz_nav_items() so the list is shared with mobile-nav.php.
 * Hidden below lg, where mobile-nav.php takes over (responsive, one header).
 *
 * @var array $args { context: 'main'|'blog' }
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$dz_context = ( isset( $args['context'] ) && 'blog' === $args['context'] ) ? 'blog' : 'main';
$dz_items   = dz_nav_items( $dz_context );
?>
<nav class="dz-nav dz-nav--desktop mx-auto max-w-[124rem] items-center gap-[2.4rem] border-t border-hair px-[clamp(1.6rem,4vw,4rem)] overflow-x-auto dz-no-scroll" aria-label="<?php esc_attr_e( 'منوی اصلی', 'dashtzad' ); ?>">
	<?php foreach ( $dz_items as $dz_item ) : ?>
		<?php
		$dz_weight  = ! empty( $dz_item['bold'] ) ? 'font-bold' : 'font-semibold';
		$dz_current = ! empty( $dz_item['current'] );
		$dz_state   = $dz_current ? 'text-ink border-green' : 'text-ink-soft border-transparent hover:text-green hover:border-green';
		$dz_icon    = $dz_current ? 'text-green' : 'text-ink-faint';
		?>
		<?php if ( ! empty( $dz_item['mega'] ) ) : ?>
			<div class="dz-mega relative flex-none">
				<button class="inline-flex items-center gap-[.7rem] font-semibold text-[1.45rem] text-ink-soft py-[1.3rem] border-b-[2.5px] border-transparent whitespace-nowrap cursor-pointer hover:text-green hover:border-green transition-colors" type="button" aria-haspopup="true"><i class="fa-solid <?php echo esc_attr( $dz_item['icon'] ); ?> text-ink-faint"></i> <?php echo esc_html( $dz_item['label'] ); ?> <i class="fa-solid fa-angle-down text-[1rem]"></i></button>
				<div class="dz-mega__panel absolute top-full start-0 z-[90] w-[min(64rem,94vw)] bg-white border border-hair rounded-lg shadow-pop p-[1.4rem] hidden lg:block">
					<a href="<?php echo esc_url( $dz_item['url'] ); ?>" class="flex items-center justify-between font-bold text-[1.45rem] text-green-deep px-[1.3rem] py-[1.1rem] rounded-md bg-green-soft mb-[1rem] hover:bg-green hover:text-white transition-colors"><?php esc_html_e( 'همه محصولات فروشگاه', 'dashtzad' ); ?> <i class="fa-solid fa-arrow-left text-[1.2rem]"></i></a>
					<div class="grid grid-cols-2 gap-[.4rem]">
						<?php foreach ( dz_shop_mega_cats() as $dz_cat ) : ?>
							<a href="<?php echo esc_url( $dz_item['url'] ); ?>" class="flex items-center gap-[1rem] px-[1.2rem] py-[1rem] rounded-md font-semibold text-[1.4rem] text-ink hover:bg-surface-warm hover:text-green-deep transition-colors"><span class="w-[3.6rem] h-[3.6rem] rounded-sm <?php echo esc_attr( $dz_cat['tone'] ); ?> grid place-items-center text-[1.6rem] flex-none"><i class="fa-solid <?php echo esc_attr( $dz_cat['icon'] ); ?>"></i></span> <?php echo esc_html( $dz_cat['label'] ); ?></a>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		<?php elseif ( ! empty( $dz_item['ai'] ) ) : ?>
			<a href="<?php echo esc_url( $dz_item['url'] ); ?>" class="dz-nav__ai inline-flex items-center gap-[.7rem] font-bold text-[1.45rem] text-green-deep py-[1.3rem] border-b-[2.5px] border-transparent whitespace-nowrap hover:text-green transition-colors"><i class="fa-solid <?php echo esc_attr( $dz_item['icon'] ); ?> text-gold"></i> <?php echo esc_html( $dz_item['label'] ); ?></a>
		<?php else : ?>
			<a href="<?php echo esc_url( $dz_item['url'] ); ?>" class="inline-flex items-center gap-[.7rem] <?php echo esc_attr( $dz_weight ); ?> text-[1.45rem] <?php echo esc_attr( $dz_state ); ?> py-[1.3rem] border-b-[2.5px] whitespace-nowrap transition-colors"><i class="fa-solid <?php echo esc_attr( $dz_item['icon'] ); ?> <?php echo esc_attr( $dz_icon ); ?>"></i> <?php echo esc_html( $dz_item['label'] ); ?></a>
		<?php endif; ?>
	<?php endforeach; ?>
</nav>
