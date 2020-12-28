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
?>

<section class="<?php wskt_layout_classes( 'logo-carousel' ); ?>">
	<div class="container-fluid">

		<?php
		if ( $fields['title'] ) {
			printf( '<h2>%s</h2>', esc_attr( $fields['title'] ) );
		}
		?>

		<div class="logo-carousel">
			<?php foreach ( (array) $fields['logos'] as $logo ) : ?>
				<div>
					<!-- TODO: Correct image size -->
					<?php echo wp_get_attachment_image( $logo['id'], 'full' ); ?>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
</section>
