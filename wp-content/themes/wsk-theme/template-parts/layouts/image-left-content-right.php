<?php
/**
 * Template part for the image left content right layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'image'         => get_sub_field( 'image' ),
	'content'       => get_sub_field( 'content' ),
	'colour_scheme' => get_sub_field( 'colour_scheme' ),
);

$layout_classes_args = array(
	'layout_name'   => 'image-left-content-right',
	'colour_scheme' => $fields['colour_scheme'],
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<div class="row">

			<?php if ( ! empty( $fields['content'] ) ) : ?>
				<div class="layout__content col-md-5 offset-md-1 order-md-last">
					<?php echo wp_kses( apply_filters( 'the_content', $fields['content'] ), 'html' ); ?>
				</div>
			<?php endif; ?>


			<?php if ( ! empty( $fields['image'] ) ) : ?>
				<div class="layout__image col-md-6 order-md-first">
					<?php
					wskt_image(
						array(
							'image_id' => $fields['image'],
						)
					);
					?>
				</div>
			<?php endif; ?>

		</div>

	</div>
</section>
