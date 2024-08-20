<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Aplus_Content
 * @subpackage Aplus_Content/includes
 * @author     Yogesh Gupta <yogesh.tech2globe@gmail.com>
 */
class Aplus_Content_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// Gather site information
		$site_info = array(
			'site_name' => get_bloginfo('name'),
			'site_url' => get_bloginfo('url'),
			'admin_email' => get_bloginfo('admin_email'),
            'public_key' => get_option('aplus_plugin_public_key'),
		);

		 // API endpoint to send the data
		 $api_url = 'http://127.0.0.1:8000/api/aplus-content/deactivate';

		 // Send the data to the server
		 $response = wp_remote_post($api_url, array(
			 'method'    => 'POST',
			 'body'      => json_encode($site_info),
			 'headers'   => array(
				 'Content-Type' => 'application/json',
			 ),
		 ));
 
		 // Check for errors
		 if (is_wp_error($response)) {
			 error_log('Site Info Sender: Failed to send site information.');
		 } else {
			 error_log('Site Info Sender: Site information sent successfully.');
		 }
	}

}
