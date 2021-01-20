<?php
/**
 * Template part for the content left image right layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'content'       => get_sub_field( 'content' ),
	'image'         => get_sub_field( 'image' ),
	'colour_scheme' => get_sub_field( 'colour_scheme' ),
);

$layout_classes_args = array(
	'layout_name'   => 'content-left-image-right',
	'colour_scheme' => $fields['colour_scheme'],
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<div class="row">

			<?php if ( ! empty( $fields['content'] ) ) : ?>
				<div class="layout__content col-md-5">
					<?php echo wp_kses( apply_filters( 'the_content', $fields['content'] ), 'html' ); ?>
				</div>
			<?php endif; ?>

			<?php if ( ! empty( $fields['image'] ) ) : ?>
				<div class="layout__image col-md-6 offset-md-1">
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
