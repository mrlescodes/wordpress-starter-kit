<?php
/**
 * Template part for the call to action layout
 *
 * @package WSK_Theme
 */

$fields = array(
	'background_image' => get_sub_field( 'background_image' ),
	'title'            => get_sub_field( 'title' ),
	'contact_page_url' => get_field( 'contact_page', 'option' ),
);
?>

<section class="<?php wskt_layout_classes( 'call-to-action' ); ?>" <?php wskt_bg_image_styles( $fields['background_image'] ); ?>>
	<div class="container-fluid">

		<?php
		if ( $fields['title'] ) {
			printf( '<h2>%s</h2>', esc_attr( $fields['title'] ) );
		}
		?>

		<?php
		if ( $fields['contact_page_url'] ) {
			printf( '<a href="%s">%s</a>', esc_url( $fields['contact_page_url'] ), esc_attr__( "Let's talk", 'wsk-theme' ) );
		}
		?>

	</div>
</section>
