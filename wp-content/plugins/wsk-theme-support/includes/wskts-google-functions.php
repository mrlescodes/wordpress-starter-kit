<?php
/**
 * WSK Theme Support - Google Functions
 *
 * @package WSK_Theme_Support/Functions
 * @version 1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Returns the Google API Key
 *
 * @return string google api key
 */
function wskts_get_google_api_key() {
	return WSKTS()->google()->get_api_key();
}
