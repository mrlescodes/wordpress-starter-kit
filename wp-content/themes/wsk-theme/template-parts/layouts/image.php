<?php
/**
 * Template part for the image layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'image' => get_sub_field( 'image' ),
);

if ( empty( $fields['image'] ) ) {
	return;
}
?>

<section class="<?php wskt_layout_classes( 'image' ); ?>">
	<div class="container-fluid">
		<div class="row">

			<div class="col-lg-10 offset-lg-1">
				<!-- TODO: Set correct image size -->
				<?php echo wp_get_attachment_image( $fields['image']['id'], 'full' ); ?>
			</div>

		</div>
	</div>
</section>
