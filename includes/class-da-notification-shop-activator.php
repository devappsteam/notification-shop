<?php

/**
 * Fired during plugin activation
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/includes
 * @author     DevApps Consultoria e Desenvolvimento <contato@devapps.com.br>
 */
class Da_Notification_Shop_Activator
{

	/**
	 * Method called when the plugin is activated.
	 * It creates the necessary database tables if the plugin version is equal to or greater than 1.0.0.
	 */
	public static function activate()
	{
		if (version_compare(DA_NOTIFICATION_SHOP_VERSION, '1.0.0', '>=')) {
			self::create_product_notifications_table();
			self::create_customers_notifications_table();
		}
	}

	/**
	 * Creates the 'prefix_product_notifications' table in the WordPress database if it doesn't already exist.
	 */
	public static function create_product_notifications_table()
	{
		global $wpdb;

		// Name of the table with the prefix of the WordPress database
		$table_name = $wpdb->prefix . 'product_notifications';

		// Check if the table already exists
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			// SQL statement to create the table
			$sql = "CREATE TABLE $table_name (
            `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `image` VARCHAR(255) NOT NULL
        );";

			// Execute the SQL statement to create the table
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}

	/**
	 * Creates the 'prefix_customers_notifications' table in the WordPress database if it doesn't already exist.
	 */
	public static function create_customers_notifications_table()
	{
		global $wpdb;

		// Name of the table with the prefix of the WordPress database
		$table_name = $wpdb->prefix . 'customers_notifications';

		// Check if the table already exists
		if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
			// SQL statement to create the table
			$sql = "CREATE TABLE $table_name (
            `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL
        );";

			// Execute the SQL statement to create the table
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}
}
