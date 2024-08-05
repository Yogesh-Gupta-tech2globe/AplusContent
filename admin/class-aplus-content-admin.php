<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/admin
 * @author     Yogesh Gupta <yogesh.tech2globe@gmail.com>
 */
class Aplus_Content_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name.'aplus-content-admin', plugin_dir_url( __FILE__ ) . 'css/aplus-content-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'bootstrap-admin', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name.'aplus-content-admin', plugin_dir_url( __FILE__ ) . 'js/aplus-content-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'bootstrap-admin', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}

	public function apluscontent_admin_menu(){
		add_menu_page('A+ Content', 'A+ Content', 'edit_others_posts','a-plus-content', array($this, 'apluscontent_dashboard'),'dashicons-images-alt2',6);
		add_submenu_page('a-plus-content','Dashboard','Dashboard','edit_others_posts','a-plus-content', array($this, 'apluscontent_dashboard'));
		add_submenu_page('a-plus-content','Create A+','Create A+','edit_others_posts','create-a-plus-content',array($this, 'apluscontent_create'));
		// add_submenu_page('a-plus-content','Edit A+','Edit A+','manage_options','edit-a-plus-content','edit_apluscontent_func');
	}

	public function apluscontent_dashboard(){
		include('partials/aplus-content-admin-dashboard.php');
	}

	public function apluscontent_create(){
		include('partials/aplus-content-admin-create.php');
	}
}
