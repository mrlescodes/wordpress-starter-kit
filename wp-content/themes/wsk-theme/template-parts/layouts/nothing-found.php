<?php
/**
 * Template part for nothing found layout
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WSK_Theme
 */

$layout_classes_args = array(
	'layout_name' => 'nothing-found',
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<?php
		if ( is_search() ) :
			printf( '<p class="lead">%s</p>', esc_html__( 'Sorry, but nothing matched your search term.', 'wsk-theme' ) );
		else :
			printf( '<p class="lead">%s</p>', esc_html__( 'It looks like nothing was found at this location.', 'wsk-theme' ) );
		endif;

		printf( '<a href="%s" class="btn btn-primary">%s</a>', esc_url( get_site_url() ), esc_html__( 'Return home', 'wsk-theme' ) );
		?>

	</div>
</section>
