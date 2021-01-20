<?php
/**
 * Template part for the social network links
 *
 * @package WSK_Theme
 */

$facebook_url  = get_field( 'facebook_url', 'option' );
$instagram_url = get_field( 'instagram_url', 'option' );
$linkedin_url  = get_field( 'linkedin_url', 'option' );

if ( $facebook_url || $instagram_url || $linkedin_url ) :
	?>

	<div class="widget widget-social-networks">
		<ul class="list-inline">
			<?php if ( $facebook_url ) : ?>
			<li class="list-inline-item">
				<a href="<?php echo esc_url( $facebook_url ); ?>" class="link-muted" target="blank" rel="noopener noreferrer">
					<?php
					wskt_inline_svg(
						get_template_directory() . '/dist/img/icon-social-facebook.svg',
						array(
							'height' => '15px',
							'width'  => '9px',
							'class'  => 'icon',
						)
					);
					?>
				</a>
			</li>
			<?php endif; ?>

			<?php if ( $instagram_url ) : ?>
			<li class="list-inline-item">
				<a href="<?php echo esc_url( $instagram_url ); ?>" class="link-muted" target="blank" rel="noopener noreferrer">
					<?php
					wskt_inline_svg(
						get_template_directory() . '/dist/img/icon-social-instagram.svg',
						array(
							'height' => '14px',
							'width'  => '14px',
							'class'  => 'icon',
						)
					);
					?>
				</a>
			</li>
			<?php endif; ?>

			<?php if ( $linkedin_url ) : ?>
			<li class="list-inline-item">
				<a href="<?php echo esc_url( $linkedin_url ); ?>" class="link-muted" target="blank" rel="noopener noreferrer">
					<?php
					wskt_inline_svg(
						get_template_directory() . '/dist/img/icon-social-linkedin.svg',
						array(
							'height' => '14px',
							'width'  => '15px',
							'class'  => 'icon',
						)
					);
					?>
				</a>
			</li>
			<?php endif; ?>
		</ul>
	</div>

	<?php
endif;
