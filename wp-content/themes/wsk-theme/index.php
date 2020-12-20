<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 *
 * @package WSK_Theme
 */

get_header();
?>

	<main id="main" class="site-main" role="main">

		<?php get_template_part( 'template-parts/loops/posts' ); ?>

	</main>

<?php
get_footer();
