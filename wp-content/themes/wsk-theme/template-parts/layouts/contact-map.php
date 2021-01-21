<?php
/**
 * Template part for the contact map layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'location_map' => get_field( 'location_map' ),
);

$layout_classes_args = array(
	'layout_name'     => 'contact-map',
	'padding_variant' => 'none',
);

if ( ! $fields['location_map'] ) {
	return;
}
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">

	<div class="map-wrapper">
		<div class="map">
			<div class="marker" data-lat="<?php echo esc_attr( $fields['location_map']['lat'] ); ?>" data-lng="<?php echo esc_attr( $fields['location_map']['lng'] ); ?>"></div>
		</div>
	</div>

</section>
