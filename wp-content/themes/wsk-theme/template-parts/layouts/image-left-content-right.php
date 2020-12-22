<?php
/**
 * Template part for the image left content right layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'image'   => get_sub_field( 'image' ),
	'content' => get_sub_field( 'content' ),
);
?>

<section class="<?php wskt_layout_classes( 'image-left-content-right' ); ?>">
	<div class="container-fluid">
		<div class="row">

			<?php if ( ! empty( $fields['image'] ) ) : ?>
				<div class="col-lg-6">
					<!-- TODO: Set correct image size -->
					<?php echo wp_get_attachment_image( $fields['image']['id'], 'full' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $fields['content'] ) ) : ?>
				<div class="col-lg-6">
					<?php echo wp_kses( apply_filters( 'the_content', $fields['content'] ), 'html' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
