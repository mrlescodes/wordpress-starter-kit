<?php
/**
 * Template part for the posts listing layout
 *
 * @package WSK_Theme
 */

$layout_classes_args = array(
	'layout_name' => 'posts-listing',
);

if ( have_posts() ) :
	?>

	<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">

		<div class="container-fluid">

			<div class="posts-loop">
				<div class="row">

					<?php while ( have_posts() ) : ?>

						<?php the_post(); ?>

						<?php
						$loop_item_classes = array(
							'posts_loop__item',
							'col-12',
							'col-md-6',
							'col-lg-4',
						);
						?>

						<div class="<?php echo esc_attr( implode( ' ', $loop_item_classes ) ); ?>">
							<?php get_template_part( 'template-parts/cards/' . get_post_type() ); ?>
						</div>

					<?php endwhile; ?>

				</div>
			</div>

			<?php wskt_posts_pagination(); ?>

		</div>

	</section>

	<?php
else :

	get_template_part( 'template-parts/layouts/nothing-found' );

endif;
