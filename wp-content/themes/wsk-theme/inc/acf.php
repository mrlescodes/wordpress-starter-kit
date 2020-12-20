<?php
/**
 * ACF
 *
 * @package WSK_Theme
 */

/**
 * Template function that checks if we have content builder layouts,
 * if we do then loop over them and output each layout
 */
function wskt_content_builder() {
	if ( have_rows( 'layouts' ) ) :
		while ( have_rows( 'layouts' ) ) :

			the_row();

			get_template_part( 'template-parts/layouts/' . get_row_layout() );

		endwhile;
	endif;
}
