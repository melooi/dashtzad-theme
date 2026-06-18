<?php
/**
 * page.php — تمپلیت پیش‌فرض برگه‌ها.
 * هر برگه‌ای که تمپلیت اختصاصی (page-{slug}.php) ندارد با این رندر می‌شود.
 * فقط عنوان + محتوای ادیتور؛ هدر/فوتر از قالب.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>
<main data-screen-label="page" class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(4rem,8vw,9rem)]">
	<div class="max-w-[72rem] mx-auto">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<header class="mb-[clamp(2.4rem,4vw,3.6rem)]">
				<h1 class="font-display font-bold text-[clamp(2.8rem,5vw,4.4rem)] leading-[1.12] tracking-[-.02em] text-ink"><?php the_title(); ?></h1>
			</header>
			<div class="dz-prose"><?php the_content(); ?></div>
			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
</main>

<?php
get_footer();
