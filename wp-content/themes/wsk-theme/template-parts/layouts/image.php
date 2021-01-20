<?php
/**
 * Template part for the image layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'image'         => get_sub_field( 'image' ),
	'colour_scheme' => get_sub_field( 'colour_scheme' ),
);

if ( empty( $fields['image'] ) ) {
	return;
}

$layout_classes_args = array(
	'layout_name'   => 'image',
	'colour_scheme' => $fields['colour_scheme'],
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<div class="row">

			<div class="layout_image col-lg-10 offset-lg-1">
				<!-- TODO: Set correct image size -->
				<?php echo wp_get_attachment_image( $fields['image'], 'full' ); ?>
			</div>

		</div>

	</div>
</section>
