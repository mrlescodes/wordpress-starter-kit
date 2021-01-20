<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WSK_Theme
 */

$contact_page_url = get_field( 'contact_page', 'option' );
?>

<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="profile" href="https://gmpg.org/xfn/11">

		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
		<div class="site">

			<header id="masthead" class="site-header" role="banner">
				<nav class="<?php wskt_navbar_class(); ?>">
					<div class="container-fluid">

						<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>

						<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'wsk-theme' ); ?>" type="button">
							<span class="navbar-toggler-icon"></span>
						</button>

						<?php wskt_main_menu(); ?>

						<?php
						if ( $contact_page_url ) :
							printf( '<a href="%s" class="btn btn-sm btn-primary d-none d-lg-inline-block">%s</a>', esc_url( $contact_page_url ), esc_attr__( 'Contact', 'wsk-theme' ) );
						endif;
						?>

					</div>
				</nav>
			</header>
