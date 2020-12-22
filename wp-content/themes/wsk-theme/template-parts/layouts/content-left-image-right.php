<?php
/**
 * Template part for the content left image right layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'content' => get_sub_field( 'content' ),
	'image'   => get_sub_field( 'image' ),
);
?>

<section class="<?php wskt_layout_classes( 'content-left-image-right' ); ?>">
	<div class="container-fluid">
		<div class="row">

			<?php if ( ! empty( $fields['image'] ) ) : ?>
				<div class="col-lg-6 order-lg-last">
					<!-- TODO: Set correct image size -->
					<?php echo wp_get_attachment_image( $fields['image']['id'], 'full' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $fields['content'] ) ) : ?>
				<div class="col-lg-6 order-lg-first">
					<?php echo wp_kses( apply_filters( 'the_content', $fields['content'] ), 'html' ); ?>
				</div>
			<?php endif; ?>

		</div>
	</div>
</section>
