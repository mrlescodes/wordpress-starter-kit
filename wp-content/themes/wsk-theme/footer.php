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

				<?php wskt_footer_menu(); ?>

			</div>
		</div>

		<div id="sub-footer">
			<div class="container-fluid">

				<span class="copyright">
					&copy; <?php printf( '%s %s', esc_html__( 'WordPress Starter Kit', 'wsk-theme' ), esc_html( gmdate( 'Y' ) ) ); ?>
				</span>

				<?php wskt_sub_footer_menu(); ?>

			</div>
		</div>

	</footer>

	<?php wp_footer(); ?>

</body>
</html>
