<?php
/**
 * Template part for the contact form layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'contact_form' => get_field( 'contact_form' ),
);

$layout_classes_args = array(
	'layout_name'   => 'contact-form',
	'colour_scheme' => 'light',
);

if ( ! $fields['contact_form'] ) {
	return;
}
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<header class="layout__header">
			<h1 class="layout__title">
				<?php esc_attr_e( "Let's talk", 'wsk-theme' ); ?>
			</h1>
		</header>

		<?php echo do_shortcode( $fields['contact_form'] ); ?>

	</div>
</section>
