<?php
/**
 * Generic fallback template.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main id="main" class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(4rem,6vw,7rem)]">
	<?php if ( have_posts() ) : ?>
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-[clamp(1.8rem,2.4vw,2.6rem)]">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article <?php post_class( 'bg-white border border-hair rounded-lg overflow-hidden hover:border-green hover:shadow-card transition-all' ); ?>>
					<a href="<?php the_permalink(); ?>" class="block">
						<?php if ( has_post_thumbnail() ) : ?>
							<?php the_post_thumbnail( 'dz-card', array( 'class' => 'w-full h-[20rem] object-cover' ) ); ?>
						<?php else : ?>
							<?php dz_placeholder( esc_html__( 'تصویر نوشته', 'dashtzad' ), 'h-[20rem]' ); ?>
						<?php endif; ?>
					</a>
					<div class="p-[1.8rem] flex flex-col gap-[1rem]">
						<h2 class="font-display font-bold text-[1.8rem] leading-[1.45]"><a href="<?php the_permalink(); ?>" class="hover:text-green-deep transition-colors"><?php the_title(); ?></a></h2>
						<p class="text-ink-soft text-[1.4rem] leading-[1.8]"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
						<span class="text-ink-faint text-[1.25rem]"><?php echo esc_html( dz_format_jalali_date( get_the_time( 'U' ) ) ); ?></span>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
		<div class="mt-[clamp(3rem,4vw,4.4rem)] flex justify-center">
			<?php
			the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => '<i class="fa-solid fa-chevron-right"></i>',
				'next_text' => '<i class="fa-solid fa-chevron-left"></i>',
			) );
			?>
		</div>
	<?php else : ?>
		<div class="text-center py-[clamp(4rem,6vw,8rem)]">
			<div class="w-[7rem] h-[7rem] rounded-full bg-green-soft text-green-deep grid place-items-center text-[2.6rem] mx-auto mb-[2rem]"><i class="fa-solid fa-leaf"></i></div>
			<h1 class="font-display font-bold text-[2.4rem]"><?php esc_html_e( 'چیزی یافت نشد', 'dashtzad' ); ?></h1>
			<p class="text-ink-soft text-[1.5rem] mt-[1rem]"><?php esc_html_e( 'متأسفانه محتوایی برای نمایش وجود ندارد.', 'dashtzad' ); ?></p>
		</div>
	<?php endif; ?>
</main>
<?php
get_footer();
