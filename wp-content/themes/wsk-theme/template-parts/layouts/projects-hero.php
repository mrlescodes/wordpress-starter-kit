<?php
/**
 * Template part for the projects hero layout
 *
 * @package WSK_Theme
 */

// Set the title based on calling template.
if ( is_tax() ) {
	$hero_title = get_the_archive_title();
} else {
	$hero_title = get_the_title();
}

$layout_classes_args = array(
	'layout_name'     => 'projects-hero',
	'padding_variant' => 'tight',
	'colour_scheme'   => 'light',
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>">
	<div class="container-fluid">

		<header class="layout__header">
			<h1 class="layout__title">
				<?php echo esc_attr( $hero_title ); ?>
			</h1>
		</header>

		<?php wskt_projects_filter(); ?>

	</div>
</section>
