<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    CRS_Post_Title_Shortener
 * @subpackage CRS_Post_Title_Shortener/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    CRS_Post_Title_Shortener
 * @subpackage CRS_Post_Title_Shortener/includes
 * @author     Stefan Bergfeldt <stefan@crswebb.se>
 */
class CRS_Post_Title_Shortener_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'crs-post-title-shortener',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
