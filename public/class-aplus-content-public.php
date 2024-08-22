<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://github.com/Yogesh-Gupta-tech2globe
 * @since      1.0.0
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aplus_Content
 * @subpackage Aplus_Content/public
 * @author     Yogesh Gupta <yogesh.tech2globe@gmail.com>
 */
class Aplus_Content_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name.'-custom', plugin_dir_url( __FILE__ ) . 'css/aplus-content-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( $this->plugin_name.'-custom', plugin_dir_url( __FILE__ ) . 'js/aplus-content-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'-bootstrap', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}
	

	public function register_shortcode() {
        add_shortcode( 'display_apluscontent', array( $this, 'display_apluscontent_callback' ) );
    }

	public function display_apluscontent_callback( $atts ) {
        // Handle your shortcode logic here.
        $product_id = $atts['product_id'];
		$product = wc_get_product($product_id);
		$api_url = $GLOBALS['authorSite'].'/getProductsById';
	
		$data = array(
			'public_key' => get_option('aplus_plugin_public_key'),
			'product_id' => $product_id,
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
			$result = json_decode($data['data'], true);
		}

		foreach($result as $row){
			if($row['status'] == 1 || isset($_GET['preview']) == "true"){
				$module_id = $row['module_ids'];
				$module_id = explode(",",$module_id);
				$content_id = $row['id'];
				?>
				<link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.6.0/css/all.css">
				<div class="apluscontent-content-container">
				<?php
				$flag1 = 0;
				$flag2 = 0;
				$flag3 = 0;
				$flag4 = 0;
				$flag5 = 0;
				$flag6 = 0;

				for($i=0; $i<count($module_id); $i++){
					$u =  explode('.',$module_id[$i]);
					if($u[0] == 1){
						include "partials/module1.php";
						$flag1 = $flag1 + 1;
					}else if($u[0] == 2){
						include "partials/module2.php";
						$flag2 = $flag2 + 1;
					}else if($u[0] == 3){
						include "partials/module3.php";
						$flag3 = $flag3 + 1;
					}else if($u[0] == 4){
						include "partials/module4.php";
						$flag4 = $flag4 + 1;
					}else if($u[0] == 5){
						include "partials/module5.php";
						$flag5 = $flag5 + 1;
					}else if($u[0] == 6){
						include "partials/module6.php";
						$flag6 = $flag6 + 1;
					}
				}
				
				?>
				</div>
				<?php
			}

		}
    }

	public function display_custom_content_below_tabs() {
		global $product;
		// Generate the content using the shortcode
		echo do_shortcode('[display_apluscontent product_id="'.esc_attr($product->get_id()).'"]');
	}	
	
}
