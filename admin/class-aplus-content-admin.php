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

		wp_enqueue_style( $this->plugin_name.'-bootstrap-admin', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-admin', plugin_dir_url( __FILE__ ) . 'css/aplus-content-admin.css', array(), $this->version, 'all' );
		// wp_enqueue_style( $this->plugin_name.'-datatables', plugin_dir_url( __FILE__ ) . 'css/datatables.min.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		if (function_exists('wp_enqueue_media')) {
			wp_enqueue_media();
		}
		wp_enqueue_script( $this->plugin_name.'-admin', plugin_dir_url( __FILE__ ) . 'js/aplus-content-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-bootstrap-admin', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name.'-admin', "myAjax", array(
			"ajaxurl" => admin_url("admin-ajax.php")
		));
		// wp_enqueue_script( $this->plugin_name.'-datatables', plugin_dir_url( __FILE__ ) . 'js/datatables.min.js', array( 'jquery' ), $this->version, false );
	}

	public function apluscontent_admin_menu(){
		add_menu_page('A+ Content', 'A+ Content', 'edit_others_posts','a-plus-content', array($this, 'apluscontent_dashboard'),'dashicons-images-alt2',6);
		add_submenu_page('a-plus-content','Dashboard','Dashboard','edit_others_posts','a-plus-content', array($this, 'apluscontent_dashboard'));
		add_submenu_page('a-plus-content','Create A+','Create A+','edit_others_posts','create-a-plus-content',array($this, 'apluscontent_create'));
	}

	public function apluscontent_dashboard(){

		$api_url = 'http://127.0.0.1:8000/api/aplus-content/getProducts';
	
		$data = array(
			'user_id' => 10,
		);

		$response = wp_remote_post($api_url, array(
			'method'    => 'POST',
			'body'      => json_encode($data),
			'headers'   => array(
				'Content-Type' => 'application/json',
			),
		));

		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			return;
		}else{
			$body = wp_remote_retrieve_body( $response );
			$data = json_decode( $body, true );
			$data = json_decode($data['data'], true);
		}
		
		include('partials/aplus-content-admin-dashboard.php');
	}

	public function apluscontent_create(){
		include('partials/aplus-content-admin-create.php');
	}

	public function customTemplateFormSubmit_ajax_handler() {

		$product_id = isset($_REQUEST['product_id']) ? sanitize_text_field($_REQUEST['product_id']) : "";
		if (!empty($product_id)) {
			$api_url = 'http://127.0.0.1:8000/api/aplus-content/addProduct';
	
			$data = array(
				'user_id' => 10,
				'product_id' => $product_id,
				'module_id' => implode(',', array_map('sanitize_text_field', $_REQUEST['module_id'])),
				'status' => 1
			);
	
			$response = wp_remote_post($api_url, array(
				'method'    => 'POST',
				'body'      => json_encode($data),
				'headers'   => array(
					'Content-Type' => 'application/json',
				),
			));
	
			// Check for errors
			if (is_wp_error($response)) {
				wp_send_json_error($response->get_error_message());
			} else {
				$resp = json_decode(wp_remote_retrieve_body($response), true);
				$id = $resp['id'];
				$api_url = 'http://127.0.0.1:8000/api/aplus-content/addModule1';
	
				$data = array(
					'content_id' => $id,
					'module1Image' => $_REQUEST['module1Image'],
					'status' => 1
				);
		
				$response = wp_remote_post($api_url, array(
					'method'    => 'POST',
					'body'      => json_encode($data),
					'headers'   => array(
						'Content-Type' => 'application/json',
					),
				));

				if(is_wp_error($response)){
					wp_send_json_error($response->get_error_message());
				}else{
					wp_send_json_success($response);
				}
			}
		} else {
			wp_send_json_error('Product ID is missing.');
		}
	
		wp_die();
	}
	
}
