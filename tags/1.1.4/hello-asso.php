<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://helloasso.com
 * @since             1.0.0
 * @package           Hello_Asso
 *
 * @wordpress-plugin
 * Plugin Name:       HelloAsso
 * Plugin URI:        https://centredaide.helloasso.com/s/article/paiement-en-ligne-wordpress-integrer-vos-campagnes-helloasso
 * Description:       HelloAsso est la solution gratuite des associations pour collecter des paiements et des dons sur internet.
 * Version:           1.1.4
 * Author:            HelloAsso
 * Author URI:        https://helloasso.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       hello-asso
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
define('HELLO_ASSO_VERSION', '1.1.4');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hello-asso-activator.php
 */
function activate_hello_asso()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-hello-asso-activator.php';
	Hello_Asso_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hello-asso-deactivator.php
 */
function deactivate_hello_asso()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-hello-asso-deactivator.php';
	Hello_Asso_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_hello_asso');
register_deactivation_hook(__FILE__, 'deactivate_hello_asso');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-hello-asso.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_hello_asso()
{

	$plugin = new Hello_Asso();
	$plugin->run();
}
run_hello_asso();
