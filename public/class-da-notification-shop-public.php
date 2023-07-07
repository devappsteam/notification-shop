<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/public
 * @author     DevApps Consultoria e Desenvolvimento <contato@devapps.com.br>
 */
class Da_Notification_Shop_Public
{

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
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Da_Notification_Shop_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Da_Notification_Shop_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style('toast', plugin_dir_url(__FILE__) . 'css/toastify.css', array(), $this->version, 'all');
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/da-notification-shop-public.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Da_Notification_Shop_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Da_Notification_Shop_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script('toast', plugin_dir_url(__FILE__) . 'js/toastify.js', array(), $this->version, false);
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/da-notification-shop-public.js', array('jquery', 'toast'), time(), false);
		wp_localize_script($this->plugin_name, 'da_notification_shop', array('ajaxurl' => admin_url('admin-ajax.php')));
	}

	public function get_customers_products()
	{
		if (wp_doing_ajax()) {
			$response = array(
				'status' => true,
				'data' => array(
					'customers' => $this->get_customers(),
					'products' => $this->get_products(),
				)
			);
			wp_send_json($response);
		} else {
			$response = array('status' => false);
			wp_send_json($response);
		}
	}

	private function get_customers()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'customers_notifications';
		return $wpdb->get_results("SELECT * FROM `{$table_name}` ORDER BY `name` ASC;", ARRAY_A);
	}

	private function get_products()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'product_notifications';
		return $wpdb->get_results("SELECT * FROM `{$table_name}` ORDER BY `name` ASC;", ARRAY_A);
	}
}
