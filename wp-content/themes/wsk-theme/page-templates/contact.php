<?php
/**
 * Template Name: Contact
 *
 * Template for the contact page.
 *
 * @package WSK_Theme
 */

get_header();

$fields = array(
	'location_map'    => get_field( 'location_map' ),
	'contact_form'    => get_field( 'contact_form' ),
	'contact_address' => get_field( 'contact_address' ),
	'contact_number'  => get_field( 'contact_number' ),
	'contact_email'   => get_field( 'contact_email' ),
);
?>

	<main id="main" class="site-main">
		<div class="container-fluid">

			<?php while ( have_posts() ) : ?>

				<?php the_post(); ?>

				<!-- Google Map -->
				<?php if ( $fields['location_map'] ) : ?>
				<div class="map">
					<div class="marker" data-lat="<?php echo esc_attr( $fields['location_map']['lat'] ); ?>" data-lng="<?php echo esc_attr( $fields['location_map']['lng'] ); ?>"></div>
				</div>
				<?php endif; ?>

				<!-- Contact Form -->
				<?php if ( $fields['contact_form'] ) : ?>
					<?php echo do_shortcode( $fields['contact_form'] ); ?>
				<?php endif; ?>

				<div class="row">

					<!-- Contact Address -->
					<?php if ( $fields['contact_address'] ) : ?>
						<div class="col-lg-4">
							<?php echo wp_kses( apply_filters( 'the_content', $fields['contact_address'] ), 'html' ); ?>
						</div>
					<?php endif; ?>

					<!-- Contact Details -->
					<?php if ( $fields['contact_number'] || $fields['contact_email'] ) : ?>
						<div class="col-lg-4">
							<?php
							if ( $fields['contact_number'] ) :
								printf(
									'<a href="tel:%s">%s</a>',
									esc_attr( str_replace( ' ', '', $fields['contact_number'] ) ),
									esc_attr( $fields['contact_number'] )
								);

								echo '<br />';
							endif;

							if ( $fields['contact_email'] ) :
								printf( '<a href="mailto:%1$s">%1$s</a>', esc_attr( $fields['contact_email'] ) );
							endif;
							?>
						</div>
					<?php endif; ?>

					<!-- Social Networks -->
					<div class="col-lg-4">
						<?php get_template_part( 'template-parts/widgets/social-networks' ); ?>
					</div>

				</div>

			<?php endwhile; ?>

		</div>
	</main>

<?php
get_footer();
