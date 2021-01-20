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

$layout_classes_args = array(
	'layout_name'   => 'call-to-action',
	'colour_scheme' => 'dark',
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>" <?php wskt_bg_image_styles( $fields['background_image']['image'] ); ?>>
	<div class="container-fluid">

		<div class="layout__content">
			<?php
			if ( $fields['title'] ) {
				printf( '<h2>%s</h2>', esc_attr( $fields['title'] ) );
			}
			?>

			<?php
			if ( $fields['contact_page_url'] ) {
				printf( '<h1><a href="%s">%s</a></h1>', esc_url( $fields['contact_page_url'] ), esc_attr__( "Let's talk", 'wsk-theme' ) );
			}
			?>
		</div>

	</div>
</section>
