<?php
/**
 * Template part for the posts hero layout
 *
 * @package WSK_Theme
 */

$page_for_posts_id = get_option( 'page_for_posts' );

// Set the title based on calling template.
if ( is_home() ) {
	$hero_title = get_the_title( $page_for_posts_id );
} elseif ( is_search() ) {
	$hero_title = get_search_query();
} else {
	$hero_title = get_the_archive_title();
}

$layout_classes_args = array(
	'layout_name'     => 'posts-hero',
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

	</div>
</section>
