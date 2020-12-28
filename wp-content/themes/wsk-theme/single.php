<?php
/**
 * Template for posts
 *
 * @package WSK_Theme
 */

get_header();
?>

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/content/' . get_post_type() ); ?>

		<?php endwhile; ?>

	</main>

<?php
get_footer();
