<?php
/**
 * Template part for the site footer
 *
 * @package WSK_Theme
 */

?>

		<footer id="colophon" class="site-footer" role="contentinfo">

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

			<div id="sub-footer">
				<div class="container-fluid">

					<span class="copyright">
						&copy; <?php printf( '%s %s', esc_html__( 'WordPress Starter Kit', 'wsk-theme' ), esc_html( gmdate( 'Y' ) ) ); ?>
					</span>

				</div>
			</div>

		</footer>

	</div><!-- .site -->

	<?php wp_footer(); ?>

</body>
</html>
