<?php
/**
 * Template part for post content
 *
 * @package WSK_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="post-header">
		<?php wskt_post_date(); ?>

		<?php printf( '<h2 class="post-title">%s</h2>', esc_attr( get_the_title() ) ); ?>
	</header>

	<div class="post-content">
		<?php the_content(); ?>
	</div>

</article>
