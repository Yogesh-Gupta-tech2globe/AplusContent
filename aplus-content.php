<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/Yogesh-Gupta-tech2globe
 * @since             1.0.0
 * @package           Aplus_Content
 *
 * @wordpress-plugin
 * Plugin Name:       A+ Content
 * Plugin URI:        https://https://tech2globe.com/
 * Description:       This plugin is useful for managing A+ Content of your Site.
 * Version:           1.0.0
 * Author:            Yogesh Gupta
 * Author URI:        https://https://github.com/Yogesh-Gupta-tech2globe/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       aplus-content
 * Domain Path:       /languages
 * Requires Plugins:    woocommerce
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'APLUS_CONTENT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-aplus-content-activator.php
 */
function activate_aplus_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aplus-content-activator.php';
	Aplus_Content_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-aplus-content-deactivator.php
 */
function deactivate_aplus_content() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-aplus-content-deactivator.php';
	Aplus_Content_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_aplus_content' );
register_deactivation_hook( __FILE__, 'deactivate_aplus_content' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-aplus-content.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_aplus_content() {

	$plugin = new Aplus_Content();
	$plugin->run();

}
run_aplus_content();
