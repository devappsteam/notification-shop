<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/admin
 * @author     DevApps Consultoria e Desenvolvimento <contato@devapps.com.br>
 */
class Da_Notification_Shop_Admin
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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/da-notification-shop-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/da-notification-shop-admin.js', array('jquery'), time(), false);

		wp_localize_script($this->plugin_name, 'da_notification_shop', array('ajaxurl' => admin_url('admin-ajax.php')));
	}

	/**
	 * Register the "Notifications" menu in the WordPress admin area.
	 *
	 * @return void
	 */
	public function register_notifications_menu()
	{
		/**
		 * Add a new menu page to the WordPress admin menu.
		 *
		 * @param string $page_title      The title of the page that will be displayed in the browser's title bar when the menu item is clicked.
		 * @param string $menu_title      The title of the menu item that will be displayed in the admin menu.
		 * @param string $capability      The capability required to access the menu item. Only users with this capability will be able to see the menu item.
		 * @param string $menu_slug       A unique slug for the menu item. This slug is used as the URL for the menu item's page and should be lowercase alphanumeric with underscores.
		 * @param string $callback        The callback function that is called to display the content of the menu item's page.
		 * @param string $icon            The URL of a custom icon image or a Dashicons class for the menu item.
		 * @param int    $position        The position of the menu item in the admin menu.
		 */
		add_menu_page(
			'Notifications',        // Page title
			'Notifications',        // Menu title
			'manage_options',       // Capability required
			'notifications',        // Menu slug
			array($this, 'notifications_page'),   // Callback function
			'dashicons-megaphone',  // Icon
			30                      // Menu position
		);
	}

	/**
	 * Callback function for the "Notifications" menu page.
	 */
	public function notifications_page()
	{
		$view = $_GET['tab'] ?? "customers";
		switch ($view) {
			case 'customers':
			default:
				$customers = $this->get_customers();
				echo dans_get_view('customers', true, compact('customers'));
				break;
			case 'products':
				$products = $this->get_products();
				echo dans_get_view('products', true, compact('products'));
				break;
		}
	}


	// Callback function to handle the AJAX request
	public function add_new_customer()
	{
		// Get the customer name from the AJAX request
		$customer_name = sanitize_text_field($_POST['customer']);

		// Insert the customer into the database
		global $wpdb;
		$table_name = $wpdb->prefix . 'customers_notifications';
		$wpdb->insert($table_name, array('name' => $customer_name));

		// Send the response back
		$response = array('status' => true);
		wp_send_json($response);
	}

	// Callback function to handle the AJAX request
	public function delete_customer()
	{
		global $wpdb;

		if (wp_doing_ajax()) {
			$customer_id = isset($_POST['customer']) ? intval($_POST['customer']) : 0;
			if ($customer_id > 0) {
				$table_name = $wpdb->prefix . 'customers_notifications';
				$result = $wpdb->delete($table_name, array('id' => $customer_id));
				if ($result !== false) {
					$response = array('status' => true);
				} else {
					$response = array('status' => false);
				}
			} else {
				$response = array('status' => false);
			}
			wp_send_json($response);
		} else {
			$response = array('status' => false);
			wp_send_json($response);
		}
	}

	// Callback function to handle the AJAX request
	public function add_new_product()
	{
		$product_name = sanitize_text_field($_POST['product']);
		$product_image = sanitize_text_field($_POST['image']);

		// Insert the customer into the database
		global $wpdb;
		$table_name = $wpdb->prefix . 'product_notifications';
		$wpdb->insert($table_name, array('name' => $product_name, 'image' => $product_image));

		// Send the response back
		$response = array('status' => true);
		wp_send_json($response);
	}

	// Callback function to handle the AJAX request
	public function delete_product()
	{
		global $wpdb;

		if (wp_doing_ajax()) {
			$product_id = isset($_POST['product']) ? intval($_POST['product']) : 0;
			if ($product_id > 0) {
				$table_name = $wpdb->prefix . 'product_notifications';
				$result = $wpdb->delete($table_name, array('id' => $product_id));
				if ($result !== false) {
					$response = array('status' => true);
				} else {
					$response = array('status' => false);
				}
			} else {
				$response = array('status' => false);
			}
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
