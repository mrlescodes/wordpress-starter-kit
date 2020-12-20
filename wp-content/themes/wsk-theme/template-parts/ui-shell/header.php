<?php
/**
 * Template part for the site header
 *
 * @package WSK_Theme
 */

?>

<header id="masthead" class="site-header" role="banner">
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="container-fluid">

			<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>">
				<?php bloginfo( 'name' ); ?>
			</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_( 'Toggle navigation', 'wsk-theme' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<?php wskt_main_menu(); ?>
			</div>

		</div>
	</nav>
</header>
