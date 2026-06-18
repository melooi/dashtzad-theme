<?php
/**
 * Footer bootstrap.
 *
 * Closes #dz-content, decides which footer chrome to load, then fires
 * wp_footer() and closes the document. Markup lives in template-parts/footer/*.
 * Routing only:
 *   store views → footer-main
 *   blog views  → footer-blog
 *
 * @package Dashtzad
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
</div><!-- #dz-content -->

<?php
// فوتر یکسان برای فروشگاه و بلاگ — همان فوتر اصلی.
get_template_part( 'template-parts/footer/footer-main' );
?>

<?php wp_footer(); ?>
</body>
</html>
