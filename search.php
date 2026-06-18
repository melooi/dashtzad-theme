<?php
/**
 * search.php — نتایج جستجو (در بافت مجله/بلاگ نمایش داده می‌شود).
 * هدر/فوتر از قالب (header-blog از طریق dz_is_blog_context).
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main data-screen-label="search" class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(4rem,7vw,8rem)]">

	<header class="mb-[clamp(2.4rem,4vw,3.6rem)]">
		<span class="inline-flex items-center gap-[.9rem] font-bold text-clay text-[1.3rem] tracking-[.04em] before:content-[''] before:w-[2.2rem] before:h-[.25rem] before:bg-gold before:rounded-[.2rem]"><i class="fa-solid fa-magnifying-glass"></i> <?php esc_html_e( 'نتایج جستجو', 'dashtzad' ); ?></span>
		<h1 class="font-display font-bold text-[clamp(2.4rem,4vw,3.6rem)] mt-[1.1rem] tracking-[-.01em] text-ink">
			<?php
			/* translators: %s: search query. */
			printf( esc_html__( 'جستجو برای: «%s»', 'dashtzad' ), '<span class="text-green-deep">' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
		<p class="text-ink-soft text-[1.5rem] mt-[.8rem]">
			<?php
			global $wp_query;
			printf( esc_html( _n( '%s نتیجه یافت شد', '%s نتیجه یافت شد', (int) $wp_query->found_posts, 'dashtzad' ) ), '<b class="num">' . esc_html( number_format_i18n( $wp_query->found_posts ) ) . '</b>' );
			?>
		</p>
	</header>

	<?php if ( have_posts() ) : ?>
		<div class="dz-post-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article class="dz-post">
					<a class="dz-post__media dz-placeholder" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'large', array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) ); else : ?>
							<span class="dz-placeholder__label absolute start-[1.2rem] bottom-[1.2rem] mx-auto w-fit"><?php esc_html_e( 'عکس نوشته', 'dashtzad' ); ?></span>
						<?php endif; ?>
					</a>
					<div class="dz-post__body">
						<h3 class="dz-post__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p class="dz-post__excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?></p>
						<div class="dz-post__meta">
							<span class="dz-byline"><span class="dz-byline__av"><?php echo esc_html( mb_substr( get_the_author(), 0, 1, 'UTF-8' ) ); ?></span> <?php the_author(); ?></span>
							<span class="dz-post__meta-r"><i class="fa-regular fa-clock"></i> <?php echo esc_html( get_the_date() ); ?></span>
						</div>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<div class="dz-blog-more">
			<?php
			the_posts_pagination(
				array(
					'mid_size'  => 1,
					'prev_text' => '<i class="fa-solid fa-angle-right"></i>',
					'next_text' => '<i class="fa-solid fa-angle-left"></i>',
				)
			);
			?>
		</div>

	<?php else : ?>
		<div class="max-w-[52rem] py-[clamp(3rem,6vw,6rem)]">
			<p class="font-display font-bold text-[clamp(2rem,3vw,2.6rem)] text-ink"><?php esc_html_e( 'چیزی پیدا نشد.', 'dashtzad' ); ?></p>
			<p class="text-ink-soft text-[1.6rem] leading-[1.9] mt-[1.2rem]"><?php esc_html_e( 'با کلمات دیگری جستجو کنید یا به خانه برگردید.', 'dashtzad' ); ?></p>
			<div class="mt-[2.4rem] max-w-[42rem]"><?php get_search_form(); ?></div>
		</div>
	<?php endif; ?>

</main>

<?php
get_footer();
