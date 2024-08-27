<?php

/**
 * Fired during plugin activation
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Aplus_Content
 * @subpackage Aplus_Content/includes
 * @author     Yogesh Gupta <yogesh.tech2globe@gmail.com>
 */
class Aplus_Content_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate() {

        // Gather site information
        $site_info = array(
            'site_name' => get_bloginfo('name'),
            'site_url' => get_bloginfo('url'),
            'admin_email' => get_bloginfo('admin_email'),
            'php_version' => phpversion(),
            'wp_version' => get_bloginfo('version'),
            'site_charset' => get_bloginfo('charset'),
            'public_key' => get_option('aplus_plugin_public_key'),
        );

        // API endpoint to send the data
        $api_url = $GLOBALS['authorSite'].'/register';

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

    public static function create_log_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'aplus_logs';
    
        $charset_collate = $wpdb->get_charset_collate();
    
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            operation varchar(255) NOT NULL,
            product_id mediumint(9) NOT NULL,
            user_id mediumint(9) NOT NULL,
            log_time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
    
        $wpdb->query($sql);
    }    

}
