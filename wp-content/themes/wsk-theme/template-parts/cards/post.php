<?php
/**
 * Template part for a post card
 *
 * @package WSK_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>

	<?php
	wskt_post_thumbnail(
		array(
			'class'     => 'card-img-top',
			'fallback'  => true,
			'permalink' => true,
		)
	);
	?>

	<div class="card-body">
		<div class="card-meta">
			<?php wskt_post_date(); ?>
		</div>

		<?php printf( '<h3 class="card-title"><a href="%s" class="link-muted">%s</a></h3>', esc_url( get_permalink() ), esc_attr( get_the_title() ) ); ?>
	</div>

</article>
