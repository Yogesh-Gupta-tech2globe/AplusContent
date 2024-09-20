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
		wp_enqueue_style( $this->plugin_name.'-datatables', plugin_dir_url( __FILE__ ) . 'css/datatables.min.css', array(), $this->version, 'all' );
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
		wp_enqueue_script( $this->plugin_name.'-datatables', plugin_dir_url( __FILE__ ) . 'js/datatables.min.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name.'-admin', "myAjax", array(
			"ajaxurl" => admin_url("admin-ajax.php")
		));
	}
	
	
	public function apluscontent_admin_menu(){
		add_menu_page('A+ Content', 'A+ Content', 'edit_others_posts','a-plus-content', array($this, 'apluscontent_dashboard'),'dashicons-images-alt2',6);
		add_submenu_page('a-plus-content','Dashboard','Dashboard','edit_others_posts','a-plus-content', array($this, 'apluscontent_dashboard'));
		add_submenu_page('a-plus-content','Create A+','Create A+','edit_others_posts','create-a-plus-content',array($this, 'apluscontent_create'));
		add_submenu_page('a-plus-content','Upgrade Now','Upgrade Now','edit_others_posts','upgrade-a-plus-content',array($this, 'apluscontent_upgrade'));
	}

	public function apluscontent_dashboard(){

		$api_url = $GLOBALS['authorSite'].'/getProducts';
	
		$data = array(
			'public_key' => get_option('aplus_plugin_public_key'),
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
			$productData = json_decode( $body, true );
			if(!empty($productData['data'])){
				$productData = json_decode($productData['data'], true);
			}else{
				$productData = [];
			}
		}

		$api_url2 = $GLOBALS['authorSite'].'/getDelProducts';

		$response2 = wp_remote_post($api_url2, array(
			'method'    => 'POST',
			'body'      => json_encode($data),
			'headers'   => array(
				'Content-Type' => 'application/json',
			),
		));

		if ( is_wp_error( $response2 ) ) {
			$error_message = $response2->get_error_message();
			echo "Something went wrong: $error_message";
			return;
		}else{
			$body2 = wp_remote_retrieve_body( $response2 );
			$delProductData = json_decode( $body2, true );
			if(!empty($delProductData['data'])){
				$delProductData = json_decode($delProductData['data'], true);
			}else{
				$delProductData = [];
			}
		}

		global $wpdb;
		$table_name = $wpdb->prefix . 'aplus_logs';

		$logs = $wpdb->get_results("SELECT * FROM $table_name ORDER BY log_time DESC");
		
		include('partials/aplus-content-admin-dashboard.php');
	}

	public function apluscontent_create(){
		include('partials/aplus-content-admin-create.php');
	}

	public function apluscontent_upgrade(){
		include('partials/aplus-content-admin-upgrade.php');
	}

	public function customTemplateFormSubmit_ajax_handler() {

		$product_id = isset($_REQUEST['product_id']) ? sanitize_text_field($_REQUEST['product_id']) : "";
		if (!empty($product_id) && !empty($_REQUEST['module_id'])) {
			$api_url = $GLOBALS['authorSite'].'/addProduct';
	
			$data = array(
				'public_key' => get_option('aplus_plugin_public_key'),
				'product_id' => $product_id,
				'module_id' => implode(',', array_map('sanitize_text_field', $_REQUEST['module_id'])),
				'module1Image' => $_REQUEST['module1Image'],
				'module2Image1' => $_REQUEST['module2Image1'],
				'module2Image2' => $_REQUEST['module2Image2'],
				'module2Image3' => $_REQUEST['module2Image3'],
				'module2heading1' =>  $_REQUEST['module2heading1'],
				'module2heading2' =>  $_REQUEST['module2heading2'],
				'module2heading3' =>  $_REQUEST['module2heading3'],
				'module2description1' => $_REQUEST['module2description1'],
				'module2description2' => $_REQUEST['module2description2'],
				'module2description3' => $_REQUEST['module2description3'],
				'module3Image' => $_REQUEST['module3Image'],
				'module3heading' => $_REQUEST['module3heading'],
				'module3description' => $_REQUEST['module3description'],
				'module4Image' => $_REQUEST['module4Image'],
				'module4heading' => $_REQUEST['module4heading'],
				'module4description' => $_REQUEST['module4description'],
				'module5Image1' => $_REQUEST['module5Image1'],
				'module5Image2' => $_REQUEST['module5Image2'],
				'module5Image3' => $_REQUEST['module5Image3'],
				'module6Image' => $_REQUEST['module6Image'],
				'module6ThumbImage' => $_REQUEST['module6ThumbImage'],
				'module6video' => $_REQUEST['module6video'],
				'module7Image' => $_REQUEST['module7Image'],
				'module7heading' => $_REQUEST['module7heading'],
				'module7description' => $_REQUEST['module7description'],
				'module8logo' => $_REQUEST['module8logo'],
				'module9Image1' => $_REQUEST['module9Image1'],
				'module9heading1' => $_REQUEST['module9heading1'],
				'module9description1' => $_REQUEST['module9description1'],
				'module9Image2' => $_REQUEST['module9Image2'],
				'module9heading2' => $_REQUEST['module9heading2'],
				'module9description2' => $_REQUEST['module9description2'],
				
				'module10product1id' => $_REQUEST['module10product1id'],
				'module10product2id' => $_REQUEST['module10product2id'],
				'module10product3id' => $_REQUEST['module10product3id'],
				'module10product4id' => $_REQUEST['module10product4id'],
				'module10product1image' => $_REQUEST['module10product1image'],
				'module10product2image' => $_REQUEST['module10product2image'],
				'module10product3image' => $_REQUEST['module10product3image'],
				'module10product4image' => $_REQUEST['module10product4image'],
				'module10product1name' => $_REQUEST['module10product1name'],
				'module10product2name' => $_REQUEST['module10product2name'],
				'module10product3name' => $_REQUEST['module10product3name'],
				'module10product4name' => $_REQUEST['module10product4name'],
				'module10product1price' => $_REQUEST['module10product1price'],
				'module10product2price' => $_REQUEST['module10product2price'],
				'module10product3price' => $_REQUEST['module10product3price'],
				'module10product4price' => $_REQUEST['module10product4price'],
				'module10product1review' => $_REQUEST['module10product1review'],
				'module10product2review' => $_REQUEST['module10product2review'],
				'module10product3review' => $_REQUEST['module10product3review'],
				'module10product4review' => $_REQUEST['module10product4review'],
				'module10heading1' => $_REQUEST['module10heading1'],
				'module10product1content1' => $_REQUEST['module10product1content1'],
				'module10product2content1' => $_REQUEST['module10product2content1'],
				'module10product3content1' => $_REQUEST['module10product3content1'],
				'module10product4content1' => $_REQUEST['module10product4content1'],
				'module10heading2' => $_REQUEST['module10heading2'],
				'module10product1content2' => $_REQUEST['module10product1content2'],
				'module10product2content2' => $_REQUEST['module10product2content2'],
				'module10product3content2' => $_REQUEST['module10product3content2'],
				'module10product4content2' => $_REQUEST['module10product4content2'],
				'module10heading3' => $_REQUEST['module10heading3'],
				'module10product1content3' => $_REQUEST['module10product1content3'],
				'module10product2content3' => $_REQUEST['module10product2content3'],
				'module10product3content3' => $_REQUEST['module10product3content3'],
				'module10product4content3' => $_REQUEST['module10product4content3'],
				'module10heading4' => $_REQUEST['module10heading4'],
				'module10product1content4' => $_REQUEST['module10product1content4'],
				'module10product2content4' => $_REQUEST['module10product2content4'],
				'module10product3content4' => $_REQUEST['module10product3content4'],
				'module10product4content4' => $_REQUEST['module10product4content4'],
				'module10heading5' => $_REQUEST['module10heading5'],
				'module10product1content5' => $_REQUEST['module10product1content5'],
				'module10product2content5' => $_REQUEST['module10product2content5'],
				'module10product3content5' => $_REQUEST['module10product3content5'],
				'module10product4content5' => $_REQUEST['module10product4content5'],
				'status' => sanitize_text_field($_REQUEST['status']),
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
				$this->log_plugin_operation('Create', $product_id);			
				wp_send_json_success($response);
			}
		} else {
			wp_send_json_error('Product is missing.');
		}
	
		wp_die();
	}

	public function aplus_status_ajax_handler() {

		$product_id = isset($_REQUEST['product_id']) ? sanitize_text_field($_REQUEST['product_id']) : "";
		$content_id = isset($_REQUEST['content_id']) ? sanitize_text_field($_REQUEST['content_id']) : "";

		if($_REQUEST['status']==1){
			$status = "Inactive";
		}else{
			$status = "Active";
		}

		if (!empty($content_id)) {
			$api_url = $GLOBALS['authorSite'].'/updateProductStatus';
	
			$data = array(
				'public_key' => get_option('aplus_plugin_public_key'),
				'content_id' => $content_id,
				'status' => sanitize_text_field($_REQUEST['status'])
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
				$this->log_plugin_operation($status, $product_id);			
				wp_send_json_success($response);
			}
		} else {
			wp_send_json_error('Content ID is missing.');
		}
	
		wp_die();
	}

	public function aplus_delete_ajax_handler() {

		$product_id = isset($_REQUEST['product_id']) ? sanitize_text_field($_REQUEST['product_id']) : "";
		$content_id = isset($_REQUEST['content_id']) ? sanitize_text_field($_REQUEST['content_id']) : "";
		if (!empty($content_id)) {
			$api_url = $GLOBALS['authorSite'].'/deleteProduct';
	
			$data = array(
				'public_key' => get_option('aplus_plugin_public_key'),
				'content_id' => $content_id,
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
				$this->log_plugin_operation('Delete', $product_id);			
				wp_send_json_success($response);
			}
		} else {
			wp_send_json_error('Content ID is missing.');
		}
	
		wp_die();
	}

	public function updateContentFormSubmit_ajax_handler() {

		$product_id = isset($_REQUEST['product_id']) ? sanitize_text_field($_REQUEST['product_id']) : "";
		$content_id = isset($_REQUEST['content_id']) ? sanitize_text_field($_REQUEST['content_id']) : "";

		if (!empty($content_id) && !empty($_REQUEST['module_id'])) {
			$api_url = $GLOBALS['authorSite'].'/updateProduct';
	
			$data = array(
				'public_key' => get_option('aplus_plugin_public_key'),
				'content_id' => $content_id,
				'module_id' => implode(',', array_map('sanitize_text_field', $_REQUEST['module_id'])),
				'module1Image' => $_REQUEST['module1Image'],
				'module2Image1' => $_REQUEST['module2Image1'],
				'module2Image2' => $_REQUEST['module2Image2'],
				'module2Image3' => $_REQUEST['module2Image3'],
				'module2heading1' =>  $_REQUEST['module2heading1'],
				'module2heading2' =>  $_REQUEST['module2heading2'],
				'module2heading3' =>  $_REQUEST['module2heading3'],
				'module2description1' => $_REQUEST['module2description1'],
				'module2description2' => $_REQUEST['module2description2'],
				'module2description3' => $_REQUEST['module2description3'],
				'module3Image' => $_REQUEST['module3Image'],
				'module3heading' => $_REQUEST['module3heading'],
				'module3description' => $_REQUEST['module3description'],
				'module4Image' => $_REQUEST['module4Image'],
				'module4heading' => $_REQUEST['module4heading'],
				'module4description' => $_REQUEST['module4description'],
				'module5Image1' => $_REQUEST['module5Image1'],
				'module5Image2' => $_REQUEST['module5Image2'],
				'module5Image3' => $_REQUEST['module5Image3'],
				'module6Image' => $_REQUEST['module6Image'],
				'module6ThumbImage' => $_REQUEST['module6ThumbImage'],
				'module6video' => $_REQUEST['module6video'],
				'module7Image' => $_REQUEST['module7Image'],
				'module7heading' => $_REQUEST['module7heading'],
				'module7description' => $_REQUEST['module7description'],
				'module8logo' => $_REQUEST['module8logo'],
				'module9Image1' => $_REQUEST['module9Image1'],
				'module9heading1' => $_REQUEST['module9heading1'],
				'module9description1' => $_REQUEST['module9description1'],
				'module9Image2' => $_REQUEST['module9Image2'],
				'module9heading2' => $_REQUEST['module9heading2'],
				'module9description2' => $_REQUEST['module9description2'],

				'module10product1id' => $_REQUEST['module10product1id'],
				'module10product2id' => $_REQUEST['module10product2id'],
				'module10product3id' => $_REQUEST['module10product3id'],
				'module10product4id' => $_REQUEST['module10product4id'],
				'module10product1image' => $_REQUEST['module10product1image'],
				'module10product2image' => $_REQUEST['module10product2image'],
				'module10product3image' => $_REQUEST['module10product3image'],
				'module10product4image' => $_REQUEST['module10product4image'],
				'module10product1name' => $_REQUEST['module10product1name'],
				'module10product2name' => $_REQUEST['module10product2name'],
				'module10product3name' => $_REQUEST['module10product3name'],
				'module10product4name' => $_REQUEST['module10product4name'],
				'module10product1price' => $_REQUEST['module10product1price'],
				'module10product2price' => $_REQUEST['module10product2price'],
				'module10product3price' => $_REQUEST['module10product3price'],
				'module10product4price' => $_REQUEST['module10product4price'],
				'module10product1review' => $_REQUEST['module10product1review'],
				'module10product2review' => $_REQUEST['module10product2review'],
				'module10product3review' => $_REQUEST['module10product3review'],
				'module10product4review' => $_REQUEST['module10product4review'],
				'module10heading1' => $_REQUEST['module10heading1'],
				'module10product1content1' => $_REQUEST['module10product1content1'],
				'module10product2content1' => $_REQUEST['module10product2content1'],
				'module10product3content1' => $_REQUEST['module10product3content1'],
				'module10product4content1' => $_REQUEST['module10product4content1'],
				'module10heading2' => $_REQUEST['module10heading2'],
				'module10product1content2' => $_REQUEST['module10product1content2'],
				'module10product2content2' => $_REQUEST['module10product2content2'],
				'module10product3content2' => $_REQUEST['module10product3content2'],
				'module10product4content2' => $_REQUEST['module10product4content2'],
				'module10heading3' => $_REQUEST['module10heading3'],
				'module10product1content3' => $_REQUEST['module10product1content3'],
				'module10product2content3' => $_REQUEST['module10product2content3'],
				'module10product3content3' => $_REQUEST['module10product3content3'],
				'module10product4content3' => $_REQUEST['module10product4content3'],
				'module10heading4' => $_REQUEST['module10heading4'],
				'module10product1content4' => $_REQUEST['module10product1content4'],
				'module10product2content4' => $_REQUEST['module10product2content4'],
				'module10product3content4' => $_REQUEST['module10product3content4'],
				'module10product4content4' => $_REQUEST['module10product4content4'],
				'module10heading5' => $_REQUEST['module10heading5'],
				'module10product1content5' => $_REQUEST['module10product1content5'],
				'module10product2content5' => $_REQUEST['module10product2content5'],
				'module10product3content5' => $_REQUEST['module10product3content5'],
				'module10product4content5' => $_REQUEST['module10product4content5'],
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
				$this->log_plugin_operation('Update', $product_id);			
				wp_send_json_success($response);
			}
		} else {
			wp_send_json_error('Content ID is missing.');
		}
	
		wp_die();
	}

	public function paymentFormSubmit_ajax_handler() {

		$public_key = isset($_REQUEST['public_key']) ? sanitize_text_field($_REQUEST['public_key']) : "";
	
		if (!empty($public_key)) {
			$api_url = $GLOBALS['authorSite'].'/submitPayment';
	
			$data = array(
				'public_key' => $public_key,
				'plan' => sanitize_text_field($_REQUEST['plan']),
				'userName' => sanitize_text_field($_REQUEST['userName']),
				'userEmail' => sanitize_email($_REQUEST['userEmail']), // Use sanitize_email for email
				'payAmount' => floatval(str_replace('$', '', $_REQUEST['payAmount'])), // Convert amount to float
				'action' => 'payOrder',
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
				$body = wp_remote_retrieve_body($response);
				$json = json_decode($body, true);
	
				if (!empty($json)) {
					wp_send_json_success($json);
				} else {
					wp_send_json_error('Invalid response from the server.');
				}
			}
		} else {
			wp_send_json_error('Public key is missing.');
		}
	
		wp_die();
	}
	
	public function paymentStatus_ajax_handler() {

		$api_url = $GLOBALS['authorSite'].'/paymentStatus';
	
		$data = array(
			'public_key' => get_option('aplus_plugin_public_key'),
			'oid' => $_REQUEST['oid'],
			'rp_payment_id' => $_REQUEST['rp_payment_id'],
			'reason' => $_REQUEST['reason'],
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
			$body = wp_remote_retrieve_body($response);
			$json = json_decode($body, true);

			if (!empty($json)) {
				if(isset($json['plan']) && isset($json['payment_status'])){
				    if($json['payment_status'] == 1){
    					$plan = $json['plan'];
    					$timestamp = current_time('mysql');
    
    					if($plan == "basic"){
    						update_option('aplus_plugin_plan', 'Basic');
    					}else if($plan == "premium"){
    						update_option('aplus_plugin_plan', 'Premium');
    					}else if($plan == "pro"){
    						update_option('aplus_plugin_plan', 'Pro');
    					}else if($plan == "proPlus"){
    						update_option('aplus_plugin_plan', 'Pro Plus');
    					}else{
    						update_option('aplus_plugin_plan', 'Free');
    					}
    
    					update_option('aplus_plugin_plan_updated_date', $timestamp);
    					wp_send_json_success($json);
				    }else{
				        wp_send_json_error($json);
				    }
				}else{
				    wp_send_json_error($json);
				}
				
			} else {
				wp_send_json_error('Invalid response from the server.');
			}
		}

		wp_die();
	}

	public function getProducts(){
		$api_url = $GLOBALS['authorSite'].'/getProducts';

		$data = array(
			'public_key' => get_option('aplus_plugin_public_key'),
		);

		$response = wp_remote_post($api_url, array(
			'method'    => 'POST',
			'body'      => json_encode($data),
			'headers'   => array(
				'Content-Type' => 'application/json',
			),
		));

		if (is_wp_error($response)) {
			$error_message = $response->get_error_message();
			echo "Something went wrong: $error_message";
			return;
		} else {
			$body = wp_remote_retrieve_body($response);
			$decodedData = json_decode($body, true);

			if (isset($decodedData['data']) && !empty($decodedData['data'])) {
				$data = json_decode($decodedData['data'], true);
			} else {
				$data = [];
			}
		}

		$aplusProduct = array();
		foreach ($data as $key => $row) {
			$productID = $row['product_id'];
			array_push($aplusProduct, $productID);
		}

		$args = array(
			'limit' => -1,
			'exclude' => $aplusProduct,
		);

		$products = wc_get_products($args);

		$planAllowProduct = $decodedData['allowProducts']['allow_product_num'];
		$allowProduct = $planAllowProduct - count($aplusProduct);

		$totalProducts = wc_get_products( array(
			'limit' => -1,
			'status' => 'publish',
		) );

		$productAttributes = array();

		foreach ($totalProducts as $product) {
			$productAttributes[] = array(
				'id' => $product->get_id(),
				'name' => $product->get_name(),
				'price' => $product->get_price(),
				'sku' => $product->get_sku(),
				'stock' => $product->get_stock_quantity(),
				'permalink' => $product->get_permalink(),
				'image' => wp_get_attachment_url($product->get_image_id()), // Get the URL of the product image
				'short_description' => $product->get_short_description(), // Get the short description
				'reviews' => array(
					'rating' => $product->get_average_rating(), // Get the average rating
					'total_reviews' => $product->get_review_count() // Get the total number of reviews
				)
			);
		}		

		return  array($products, $allowProduct, $productAttributes);
	}

	public function log_plugin_operation($operation, $product_id) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'aplus_logs';
		$user_id = get_current_user_id();
	
		$wpdb->insert(
			$table_name,
			[
				'operation' => $operation,
				'product_id' => $product_id,
				'user_id' => $user_id,
				'log_time' => current_time('mysql'),
			]
		);
	}	
	
}
