<?php
/**
 * Template part for posts loops
 *
 * @package WSK_Theme
 */

if ( have_posts() ) :
	?>

	<section class="layout layout--posts">
		<div class="container-fluid">
			<div class="row">

				<?php while ( have_posts() ) : ?>

					<?php the_post(); ?>

					<div class="col-xs-12 col-md-6 col-lg-4">
						<?php get_template_part( 'template-parts/cards/' . get_post_type() ); ?>
					</div>

				<?php endwhile; ?>

			</div>
		</div>
	</section>

	<!-- TODO: Posts Pagination -->

	<?php
else :

	get_template_part( 'template-parts/layouts/nothing-found' );

endif;
