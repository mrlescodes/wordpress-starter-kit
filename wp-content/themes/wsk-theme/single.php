<?php
/**
 * Template for single post
 *
 * @package WSK_Theme
 */

get_header();
?>

	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>

			<?php get_template_part( 'template-parts/layouts/post-hero' ); ?>

			<div class="container-fluid">
				<div class="row">

					<div class="col-lg-8">
						<?php get_template_part( 'template-parts/content/' . get_post_type() ); ?>
					</div>

					<div class="col-lg-4">
						<?php get_sidebar(); ?>
					</div>

				</div>
			</div>

		<?php endwhile; ?>

	</main>

<?php
get_footer();
