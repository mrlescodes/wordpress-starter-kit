<?php
/**
 * Template part for a post card
 *
 * @package WSK_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="card-body">
		<?php printf( '<h2 class="card-title"><a href="%s">%s</a></h2>', esc_url( get_permalink() ), esc_attr( get_the_title() ) ); ?>
	</div>

</article>
