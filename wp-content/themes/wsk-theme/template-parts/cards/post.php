<?php
/**
 * Template part for a post card
 *
 * @package WSK_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="card-body">
		<?php sprintf( '<h2 class="card-title"><a href="%s">%s</a></h2>', get_the_title(), esc_url( get_permalink() ) ); ?>
	</div>

</article>
