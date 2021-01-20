<?php
/**
 * Template tags
 *
 * @package WSK_Theme
 */

/**
 * Output the layout classes.
 *
 * @param array $attrs Array of layout attributes.
 */
function wskt_layout_classes( $attrs = array() ) {
	$default_attrs = array(
		'layout_name'     => '',
		'colour_scheme'   => 'default',
		'padding_variant' => 'default',
	);

	$attrs = wp_parse_args( $attrs, $default_attrs );

	$layout_classes = array(
		'layout',
	);

	// Add layout name class.
	if ( $attrs['layout_name'] ) {
		$layout_classes[] = "layout--{$attrs['layout_name']}";
	}

	// Add colour scheme class.
	if ( $attrs['colour_scheme'] ) {
		$layout_classes[] = "colour-scheme--{$attrs['colour_scheme']}";
	}

	// Add padding variant class.
	if ( 'default' === $attrs['padding_variant'] ) {
		$layout_classes[] = 'layout--padding-y';
	} else {
		$layout_classes[] = "layout--padding-y-{$attrs['padding_variant']}";
	}

	echo esc_attr( implode( ' ', $layout_classes ) );
}

/**
 * Output background image style string.
 *
 * @param int|false $attachment_id Image attachment ID.
 */
function wskt_bg_image_styles( $attachment_id = false ) {
	if ( ! $attachment_id ) {
		return;
	}

	$bg_image_styles = array();

	// TODO: Set correct image size.
	$bg_image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
	$bg_image_src = array_shift( $bg_image_src );

	$bg_image_styles[] = sprintf( 'background-image: url(%s);', esc_url( $bg_image_src ) );

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo sprintf( 'style="%s"', implode( ' ', $bg_image_styles ) );
}

/**
 * Posts Pagination
 *
 * Customise the pagination function to use Bootstrap styles.
 *
 * @param WP_Query|null $wp_query The query object for the posts.
 */
function wskt_posts_pagination( $wp_query = null ) {
	// Use global $wp_query if custom query not given.
	if ( null === $wp_query ) {
		global $wp_query;
	}

	$bignum = 999999999;

	$page_links = paginate_links(
		array(
			'type'      => 'array',
			'base'      => str_replace( $bignum, '%#%', esc_url( get_pagenum_link( $bignum ) ) ),
			'current'   => max( 1, get_query_var( 'paged' ) ),
			'total'     => $wp_query->max_num_pages,
			'end_size'  => 1,
			'mid_size'  => 1,
			'prev_next' => true,
			'prev_text' => esc_html__( 'Prev', 'wsk-theme' ),
			'next_text' => esc_html__( 'Next', 'wsk-theme' ),
		)
	);

	if ( is_array( $page_links ) ) {
		$pagination  = sprintf( '<nav aria-label="%s">', esc_attr__( 'Posts pagination', 'wsk-theme' ) );
		$pagination .= '<ul class="pagination">';

		foreach ( $page_links as $page_link ) {
			// Prepare list item class.
			$li_classes = array( 'page-item' );
			if ( strpos( $page_link, 'current' ) ) {
				$li_classes[] = 'active';
			}
			if ( strpos( $page_link, 'prev' ) ) {
				$li_classes[] = 'prev';
			}
			if ( strpos( $page_link, 'next' ) ) {
				$li_classes[] = 'next';
			}

			// Clean up the link classes.
			$page_link = str_replace( 'prev ', '', $page_link );
			$page_link = str_replace( 'next ', '', $page_link );
			$page_link = str_replace( ' current', '', $page_link );
			$page_link = str_replace( 'page-numbers', 'page-link', $page_link );

			$pagination .= sprintf( '<li class="%s">%s</li>', implode( ' ', $li_classes ), $page_link );
		}

		$pagination .= '</ul>';
		$pagination .= '</nav>';

		echo wp_kses( $pagination, 'html' );
	}
}

/**
 * Output the post thumbnail
 *
 * @param array $attrs Array of thumbnail attributes.
 */
function wskt_post_thumbnail( $attrs = array() ) {
	$default_attrs = array(
		'class'     => '',
		'ratios'    => array( 'ratio-4x3' ),
		'fallback'  => false,
		'permalink' => false,
	);

	$attrs = wp_parse_args( $attrs, $default_attrs );

	if ( post_password_required() || is_attachment() || ( ! has_post_thumbnail() && false === $attrs['fallback'] ) ) {
		return;
	}

	if ( has_post_thumbnail() ) {
		// TODO: Set correct size.
		$thumbnail_url = get_the_post_thumbnail_url( null, 'full' );
	} else {
		$thumbnail_url = get_template_directory_uri() . '/dist/img/thumbnail-fallback.svg';
	}

	// Prepare inline style string.
	$inline_style = sprintf( 'style="background-image: url(%1$s);"', $thumbnail_url );

	if ( $attrs['permalink'] ) {
		$thumbnail_html = sprintf( '<a href="%1$s" title="%2$s" class="thumbnail" %3$s></a>', get_the_permalink(), get_the_title(), $inline_style );
	} else {
		$thumbnail_html = sprintf( '<div class="thumbnail" %1$s></div>', $inline_style );
	}

	// Prepare the wrapper classes array.
	$wrapper_classes = array();
	if ( $attrs['class'] ) {
		$wrapper_classes[] = $attrs['class'];
	}
	$wrapper_classes[] = 'ratio';
	$wrapper_classes   = array_merge( $wrapper_classes, $attrs['ratios'] );

	printf( '<div class="%1$s">%2$s</div>', esc_attr( implode( ' ', $wrapper_classes ) ), wp_kses( $thumbnail_html, 'html' ) );
}

/**
 * Output the post date
 */
function wskt_post_date() {
	$time_string = '<time class="updated" datetime="%1$s">%2$s</time> ';

	$time_string = sprintf(
		$time_string,
		get_the_time( 'Y-m-j' ),
		get_the_time( get_option( 'date_format' ) )
	);

	echo '<span class="posted-on">' . wp_kses_post( $time_string ) . '</span>';
}

/**
 * Output the image
 *
 * @param array $attrs Array of image attributes.
 */
function wskt_image( $attrs = array() ) {
	$default_attrs = array(
		'image_id' => '',
		'class'    => '',
		'ratios'   => array( 'ratio-4x3' ),
	);

	$attrs = wp_parse_args( $attrs, $default_attrs );

	if ( ! $attrs['image_id'] ) {
		return;
	}

	// TODO: Set correct image size.
	$image = wp_get_attachment_image_src( $attrs['image_id'], 'full' );

	// Prepare inline style string.
	$inline_style = sprintf( 'style="background-image: url(%1$s);"', $image[0] );
	$image_html   = sprintf( '<div class="thumbnail" %1$s></div>', $inline_style );

	// Prepare the wrapper classes array.
	$wrapper_classes = array();
	if ( $attrs['class'] ) {
		$wrapper_classes[] = $attrs['class'];
	}
	$wrapper_classes[] = 'ratio';
	$wrapper_classes   = array_merge( $wrapper_classes, $attrs['ratios'] );

	printf( '<div class="%1$s">%2$s</div>', esc_attr( implode( ' ', $wrapper_classes ) ), wp_kses( $image_html, 'html' ) );
}

/**
 * Return SVG file contents.
 *
 * @param string $path  The path to the SVG file.
 * @param array  $attrs Array of SVG attributes.
 */
function wskt_get_inline_svg( $path, $attrs = array() ) {
	if ( ! file_exists( $path ) || ! is_readable( $path ) ) {
		return;
	}

	$default_attrs = array(
		'height' => 16,
		'width'  => 16,
		'class'  => '',
	);

	$attrs = wp_parse_args( $attrs, $default_attrs );

	// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	$content = file_get_contents( $path );

	// Instantiate DOMDocument Object with file content.
	$doc = new DOMDocument();
	$doc->loadXML( $content );

	// Set/change the SVG attributes.
	foreach ( $attrs as $attr => $value ) {
		if ( ! empty( $value ) ) {
			$doc->documentElement->setAttribute( $attr, $value );
		}
	}

	return $doc->saveXML( $doc->documentElement );
}

/**
 * Output SVG file contents.
 *
 * @param mixed ...$args See wskt_get_inline_svg() for description of the arguments.
 */
function wskt_inline_svg( ...$args ) {
	echo wp_kses( wskt_get_inline_svg( ...$args ), 'svg' );
}

/**
 * Determine whether the current view is a minimal ui page.
 */
function wskt_is_minimal_ui() {
	// Only set as minimal UI if the view has a post thumbnail.
	if ( ! has_post_thumbnail() ) {
		return false;
	}

	$is_minimal_ui = false;

	// If is a specific post type.
	if ( is_singular( 'post' ) || is_singular( 'project' ) ) {
		$is_minimal_ui = true;
	}

	// If is a page.
	if ( is_page() ) {
		$is_minimal_ui = true;
	}

	return $is_minimal_ui;
}

/**
 * Outputs the navbar classes.
 */
function wskt_navbar_class() {
	$navbar_classes = apply_filters( 'wskt_navbar_classes', array( 'navbar', 'navbar-expand-lg', 'navbar-light' ) );
	$navbar_class   = implode( ' ', $navbar_classes );
	echo esc_attr( $navbar_class );
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 */
function wskt_add_body_classes( $classes ) {
	if ( wskt_is_minimal_ui() ) {
		$classes[] = 'is-minimal-ui';
	}

	return $classes;
}
add_filter( 'body_class', 'wskt_add_body_classes' );

/**
 * Adds custom classes to the array of navbar classes.
 *
 * @param array $classes Classes for the navbar element.
 */
function wskt_add_navbar_class( $classes ) {
	if ( wskt_is_minimal_ui() ) {
		$classes[] = 'navbar-transparent';
	}

	return $classes;
}
add_filter( 'wskt_navbar_classes', 'wskt_add_navbar_class' );

/**
 * Outputs the Sharer.
 */
function wskt_sharer() {
	// TODO: Test the links work as expected.
	$facebook_share_url = add_query_arg(
		array(
			'fbrefresh' => true,
			'u'         => rawurlencode( get_permalink() ),
		),
		'https://www.facebook.com/sharer/sharer.php'
	);

	$twitter_share_url = add_query_arg(
		array(
			'status' => get_the_title() . ' ' . rawurlencode( get_permalink() ),
		),
		'https://twitter.com/home'
	);

	$email_share_url = add_query_arg(
		array(
			'subject' => get_the_title(),
		),
		'mailto:'
	);
	?>

	<div class="sharer">
		<?php printf( '<h6 class="sharer__title">%s</h6>', esc_attr__( 'Share', 'wsk-theme' ) ); ?>

		<ul class="list-inline sharer__items">
			<li class="list-inline-item">
				<a href="<?php echo esc_url( $facebook_share_url ); ?>" class="link-muted" target="_blank" rel="noopener noreferrer">
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

			<li class="list-inline-item">
				<a href="<?php echo esc_url( $twitter_share_url ); ?>" class="link-muted" target="_blank" rel="noopener noreferrer">
					<?php
					wskt_inline_svg(
						get_template_directory() . '/dist/img/icon-social-twitter.svg',
						array(
							'height' => '14px',
							'width'  => '17px',
							'class'  => 'icon',
						)
					);
					?>
				</a>
			</li>

			<li class="list-inline-item">
				<a href="<?php echo esc_url( $email_share_url ); ?>" class="link-muted" target="_blank" rel="noopener noreferrer">
					<?php
					wskt_inline_svg(
						get_template_directory() . '/dist/img/icon-email.svg',
						array(
							'height' => '13px',
							'width'  => '16px',
							'class'  => 'icon',
						)
					);
					?>
				</a>
			</li>
		</ul>
	</div>

	<?php
}
