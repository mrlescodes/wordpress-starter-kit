<?php
/**
 * Template for pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WSK_Theme
 */

get_header();
?>

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/layouts/page-hero' ); ?>

			<?php get_template_part( 'template-parts/content/page' ); ?>

		<?php endwhile; ?>

	</main>

<?php
get_footer();
