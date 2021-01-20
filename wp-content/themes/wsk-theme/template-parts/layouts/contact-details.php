<?php
/**
 * Template part for the contact details layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'contact_address' => get_field( 'contact_address' ),
	'contact_number'  => get_field( 'contact_number' ),
	'contact_email'   => get_field( 'contact_email' ),
);

$layout_classes_args = array(
	'layout_name' => 'contact-details',
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<div class="row">

			<?php if ( $fields['contact_address'] ) : ?>
				<div class="col-md-4">
					<h4><?php esc_attr_e( 'Head Office', 'wsk-theme' ); ?></h4>

					<?php echo wp_kses( apply_filters( 'the_content', $fields['contact_address'] ), 'html' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $fields['contact_number'] || $fields['contact_email'] ) : ?>
				<div class="col-md-4">
					<h4><?php esc_attr_e( 'Contact', 'wsk-theme' ); ?></h4>

					<?php
					if ( $fields['contact_number'] ) :
						printf(
							'<a href="tel:%s" class="link-muted">%s</a>',
							esc_attr( str_replace( ' ', '', $fields['contact_number'] ) ),
							esc_attr( $fields['contact_number'] )
						);

						echo '<br />';
					endif;

					if ( $fields['contact_email'] ) :
						printf( '<a href="mailto:%1$s" class="link-muted">%1$s</a>', esc_attr( $fields['contact_email'] ) );
					endif;
					?>
				</div>
			<?php endif; ?>

			<div class="col-md-4">
				<?php get_template_part( 'template-parts/widgets/social-networks' ); ?>
			</div>

		</div>

	</div>
</section>
