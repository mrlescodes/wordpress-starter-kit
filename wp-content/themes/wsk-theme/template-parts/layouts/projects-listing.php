<?php
/**
 * Template part for the projects listing layout
 *
 * @package WSK_Theme
 */

// Depending on the calling template set the query.
if ( is_tax() ) {
	$project_query = $wp_query;
} else {
	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

	$project_query_args = array(
		'post_type' => 'project',
		'paged'     => $paged,
	);

	$project_query = new WP_Query( $project_query_args );
}

$layout_classes_args = array(
	'layout_name' => 'projects-listing',
);

if ( $project_query->have_posts() ) :
	?>

	<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
		<div class="container-fluid">

			<div class="projects-loop">
				<div class="row">

					<?php while ( $project_query->have_posts() ) : ?>

						<?php $project_query->the_post(); ?>

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

			<?php wskt_posts_pagination( $project_query ); ?>

		</div>
	</section>

	<?php

else :

	get_template_part( 'template-parts/layouts/nothing-found' );

endif;

wp_reset_postdata();
