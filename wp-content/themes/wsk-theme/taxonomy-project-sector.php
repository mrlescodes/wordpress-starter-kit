<?php
/**
 * The template for displaying project sector taxonomy pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 * @package WSK_Theme
 */

get_header();
?>

	<main id="main" class="site-main">

		<?php get_template_part( 'template-parts/layouts/projects-hero' ); ?>

		<?php get_template_part( 'template-parts/layouts/projects-listing' ); ?>

	</main>

<?php
get_footer();
