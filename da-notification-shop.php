<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://devapps.com.br
 * @since             1.0.0
 * @package           Da_Notification_Shop
 *
 * @wordpress-plugin
 * Plugin Name:       Notificações de Compra
 * Plugin URI:        https://devapps.com.br/plugins/da-notification-shop
 * Description:       Exibe notificações de compra na página do site, de acordo com os nomes e produtos cadastrados.
 * Version:           1.0.0
 * Author:            DevApps Consultoria e Desenvolvimento
 * Author URI:        https://devapps.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       da-notification-shop
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('DA_NOTIFICATION_SHOP_VERSION', '1.0.0');


/**
 * Admin Path.
 */
define('DA_NOTIFICATION_SHOP_ADMIN_VIEWS_PATH', plugin_dir_path(__FILE__) . 'admin/views/');

/**
 * Public Path.
 */
define('DA_NOTIFICATION_SHOP_PUBLIC_VIEWS_PATH', plugin_dir_path(__FILE__) . 'public/views/');


/**
 * URL by plugin
 */
define('DA_NOTIFICATION_SHOP_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-da-notification-shop-activator.php
 */
function activate_da_notification_shop()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-da-notification-shop-activator.php';
	Da_Notification_Shop_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-da-notification-shop-deactivator.php
 */
function deactivate_da_notification_shop()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-da-notification-shop-deactivator.php';
	Da_Notification_Shop_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_da_notification_shop');
register_deactivation_hook(__FILE__, 'deactivate_da_notification_shop');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-da-notification-shop.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_da_notification_shop()
{

	$plugin = new Da_Notification_Shop();
	$plugin->run();
}
run_da_notification_shop();
