<?php
/**
 * Template Name: Contact
 *
 * Template for the contact page.
 *
 * @package WSK_Theme
 */

get_header();
?>

	<main id="main" class="site-main">

		<?php get_template_part( 'template-parts/layouts/contact-map' ); ?>

		<?php get_template_part( 'template-parts/layouts/contact-form' ); ?>

		<?php get_template_part( 'template-parts/layouts/contact-details' ); ?>

	</main>

<?php
get_footer();
