<?php
/**
 * Template Name: درباره ما (Dashtzad)
 *
 * Clean page template — no hardcoded content. Renders whatever the page editor
 * holds (title + content). Build the About layout here when ready.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main data-screen-label="درباره ما" class="mx-auto max-w-[124rem] px-[clamp(1.6rem,4vw,4rem)] py-[clamp(6rem,10vw,12rem)]">

	<div class="max-w-[68rem]">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<h1><?php the_title(); ?></h1>
			<div class="mt-[1.8rem] [&_p]:mt-[1.4rem]"><?php the_content(); ?></div>
			<?php
		endwhile;
		?>
	</div>

</main>

<?php
get_footer();
