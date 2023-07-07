<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://devapps.com.br
 * @since      1.0.0
 *
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Da_Notification_Shop
 * @subpackage Da_Notification_Shop/includes
 * @author     DevApps Consultoria e Desenvolvimento <contato@devapps.com.br>
 */
class Da_Notification_Shop_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'da-notification-shop',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
