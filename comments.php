<?php
/**
 * comments.php — قالب دیدگاه‌ها برای نوشته‌ها و برگه‌ها.
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>
<section class="dz-comments max-w-[72rem] mx-auto mt-[clamp(3.2rem,5vw,5rem)] pt-[clamp(2.4rem,4vw,3.6rem)] border-t border-hair" aria-label="<?php esc_attr_e( 'دیدگاه‌ها', 'dashtzad' ); ?>">

	<?php if ( have_comments() ) : ?>
		<h2 class="font-display font-bold text-[clamp(2rem,3vw,2.6rem)] text-ink mb-[clamp(2rem,3vw,2.6rem)]">
			<?php
			$dz_cc = get_comments_number();
			printf( esc_html( _n( '%s دیدگاه', '%s دیدگاه', (int) $dz_cc, 'dashtzad' ) ), '<span class="num">' . esc_html( number_format_i18n( $dz_cc ) ) . '</span>' );
			?>
		</h2>

		<ol class="dz-comments__list flex flex-col gap-[2rem] list-none m-0 p-0">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'avatar_size' => 52,
					'short_ping'  => true,
				)
			);
			?>
		</ol>

		<?php
		the_comments_pagination(
			array(
				'prev_text' => '<i class="fa-solid fa-angle-right"></i>',
				'next_text' => '<i class="fa-solid fa-angle-left"></i>',
			)
		);
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="text-ink-soft text-[1.5rem] mt-[2rem]"><?php esc_html_e( 'دیدگاه‌ها بسته شده است.', 'dashtzad' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_container'    => 'dz-comment-form mt-[clamp(2.4rem,4vw,3.6rem)]',
			'title_reply_before' => '<h3 class="font-display font-bold text-[clamp(1.9rem,2.6vw,2.4rem)] text-ink mb-[1.6rem]">',
			'title_reply_after'  => '</h3>',
			'class_submit'       => 'dz-btn dz-btn--primary',
		)
	);
	?>
</section>
