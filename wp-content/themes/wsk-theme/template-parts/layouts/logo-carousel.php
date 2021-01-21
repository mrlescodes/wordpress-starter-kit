<?php
/**
 * Template part for the logo carousel layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'title' => get_sub_field( 'title' ),
	'logos' => get_sub_field( 'logos' ),
);

if ( empty( $fields['logos'] ) ) {
	return;
}

$layout_classes_args = array(
	'layout_name' => 'logo-carousel',
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<?php if ( $fields['title'] ) : ?>
			<header class="layout__header text-center">
				<?php printf( '<h3 class="layout__title">%s</h3>', esc_attr( $fields['title'] ) ); ?>
			</header>
		<?php endif; ?>

		<div class="logo-carousel">
			<?php foreach ( (array) $fields['logos'] as $logo ) : ?>
				<div>
					<!-- TODO: Correct image size -->
					<?php echo wp_get_attachment_image( $logo, 'full' ); ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
