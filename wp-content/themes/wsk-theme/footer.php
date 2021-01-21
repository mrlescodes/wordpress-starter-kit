<?php
/**
 * Template part for the site footer
 *
 * @package WSK_Theme
 */

$newsletter_form_shortcode = get_field( 'newsletter_form', 'option' );
?>

		<footer id="colophon" class="site-footer colour-scheme--dark" role="contentinfo">

			<div id="main-footer">
				<div class="container-fluid">
					<div class="row">

						<div class="col-lg-2">
							<?php bloginfo( 'name' ); ?>
						</div>

						<?php
						for ( $index = 1; $index <= 3; $index++ ) {
							if ( is_active_sidebar( 'footer-' . $index ) ) {
								echo '<div class="col-lg-3">';
								dynamic_sidebar( 'footer-' . $index );
								echo '</div>';
							}
						}
						?>

						<div class="col-lg-1">
							<?php get_template_part( 'template-parts/widgets/social-networks' ); ?>
						</div>

					</div>
				</div>
			</div>

			<?php if ( $newsletter_form_shortcode ) : ?>
			<div id="sub-footer">
				<div class="container-fluid">

					<?php echo do_shortcode( $newsletter_form_shortcode ); ?>

				</div>
			</div>
			<?php endif; ?>

		</footer>

	</div><!-- .site -->

	<?php wp_footer(); ?>

</body>
</html>
