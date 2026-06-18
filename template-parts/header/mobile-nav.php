<?php
/**
 * Mobile primary navigation (below lg) — horizontal scroll strip.
 *
 * Same items as desktop-nav.php (shared dz_nav_items()), flattened to plain
 * links — the mega-menu is desktop-only. Shown below lg; hidden at lg+ where
 * desktop-nav.php takes over. One header, two responsive nav partials.
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
<nav class="dz-nav dz-nav--mobile mx-auto max-w-[124rem] items-center gap-[2.4rem] border-t border-hair px-[clamp(1.6rem,4vw,4rem)] overflow-x-auto dz-no-scroll" aria-label="<?php esc_attr_e( 'منوی اصلی', 'dashtzad' ); ?>">
	<?php foreach ( $dz_items as $dz_item ) : ?>
		<?php
		$dz_weight  = ( ! empty( $dz_item['bold'] ) || ! empty( $dz_item['ai'] ) ) ? 'font-bold' : 'font-semibold';
		$dz_current = ! empty( $dz_item['current'] );
		$dz_state   = $dz_current ? 'text-ink border-green' : 'text-ink-soft border-transparent hover:text-green hover:border-green';
		$dz_icon    = ! empty( $dz_item['ai'] ) ? 'text-gold' : ( $dz_current ? 'text-green' : 'text-ink-faint' );
		?>
		<a href="<?php echo esc_url( $dz_item['url'] ); ?>" class="inline-flex items-center gap-[.7rem] <?php echo esc_attr( $dz_weight ); ?> text-[1.45rem] <?php echo esc_attr( $dz_state ); ?> py-[1.3rem] border-b-[2.5px] whitespace-nowrap transition-colors"><i class="fa-solid <?php echo esc_attr( $dz_item['icon'] ); ?> <?php echo esc_attr( $dz_icon ); ?>"></i> <?php echo esc_html( $dz_item['label'] ); ?></a>
	<?php endforeach; ?>
</nav>
