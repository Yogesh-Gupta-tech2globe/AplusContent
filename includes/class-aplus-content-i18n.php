<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Aplus_Content
 * @subpackage Aplus_Content/includes
 * @author     Yogesh Gupta <yogesh.tech2globe@gmail.com>
 */
class Aplus_Content_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'aplus-content',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
