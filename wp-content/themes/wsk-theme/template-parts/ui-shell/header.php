<?php
/**
 * Template part for the site header
 *
 * @package WSK_Theme
 */

$fields = array(
	'contact_page_url' => get_field( 'contact_page', 'option' ),
);
?>

<header id="masthead" class="site-header" role="banner">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">

			<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
				<?php bloginfo( 'name' ); ?>
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'wsk-theme' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<?php wskt_main_menu(); ?>

			<?php
			if ( $fields['contact_page_url'] ) :
				printf( '<a href="%s" class="btn btn-primary">%s</a>', esc_url( $fields['contact_page_url'] ), esc_attr__( 'Contact', 'wsk-theme' ) );
			endif;
			?>

		</div>
	</nav>
</header>
