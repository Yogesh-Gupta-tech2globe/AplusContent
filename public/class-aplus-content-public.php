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

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aplus_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aplus_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aplus-content-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Aplus_Content_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aplus_Content_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aplus-content-public.js', array( 'jquery' ), $this->version, false );

	}
	

	public function register_shortcode() {
        add_shortcode( 'display_apluscontent', array( $this, 'display_apluscontent_callback' ) );
    }

	public function display_apluscontent_callback( $atts ) {
        // Handle your shortcode logic here.
        $product_id = $atts['product_id'];
		$product = wc_get_product($product_id);
		$api_url = 'http://127.0.0.1:8000/api/aplus-content/getProductsById';
	
		$data = array(
			'user_id' => 10,
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
			if($row['status'] == 1){
				$module_id = $row['module_ids'];
				$module_id = explode(",",$module_id);
				$content_id = $row['id'];
				?>
				<div class="apluscontent-content-container">
					<div class="apluscontent-heading">
						<h2><?php echo $product->get_name(); ?></h2>
					</div>
				<?php
				$flag1 = 0;
				$flag2 = 0;

				for($i=0; $i<count($module_id); $i++){
					$u =  explode('.',$module_id[$i]);
					if($u[0] == 1){
						include "partials/module1.php";
						$flag1 = $flag1 + 1;
					}else if($u[0] == 2){
						// include "module2.php";
						$flag2 = $flag2 + 1;
					}
				}
				
				?>
				</div>
				<?php
			}

		}
    }

	public function display_custom_content_below_tabs($tabs) {
		global $product;
		$custom_content = do_shortcode('[display_apluscontent product_id="'.esc_attr($product->get_id()).'"]');
		$tabs['custom_tab'] = array(
			'title'    => __('Custom Content', 'text-domain'),
			'priority' => 50,
			'callback' => function() use ($custom_content) {
				echo $custom_content;
			}
		);
		return $tabs;
	}
	
	
	
}
