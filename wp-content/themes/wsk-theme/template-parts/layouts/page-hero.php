<?php
/**
 * Template part for the page hero layout
 *
 * @package WSK_Theme
 */

if ( ! has_post_thumbnail() ) {
	return;
}

$post_thumbnail_id = get_post_thumbnail_id();

$layout_classes_args = array(
	'layout_name'     => 'page-hero',
	'padding_variant' => 'none',
);
?>

<section class="<?php wskt_layout_classes( $layout_classes_args ); ?>" <?php wskt_bg_image_styles( $post_thumbnail_id ); ?>></section>
