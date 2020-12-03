<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://joetower.com
 * @since             1.0.0
 * @package           Picture_It
 *
 * @wordpress-plugin
 * Plugin Name:       Picture It
 * Plugin URI:        https://joetower.com
 * Description:       Better responsive images in WordPress - manage breakpoint groups of responsive image sizes and serve responsive images using the Picture element. 
 * Version:           1.0.0
 * Author:            Joe Tower
 * Author URI:        https://joetower.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       picture-it
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PICTURE_IT_VERSION', '1.0.0' );

// plugin name
define( 'PICTURE_IT_NAME', 'picture-it' );

// Plugin Directly Path
define('PICTURE_IT_BASE_DIR', plugin_dir_path(__FILE__));

// Plugin Base File
define('PICTURE_IT_BASE_FILE', __FILE__ );


// Plugin Directly URL
define('PICTURE_IT_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-picture-it-activator.php
 */
function activate_picture_it() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-picture-it-activator.php';
	Picture_It_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-picture-it-deactivator.php
 */
function deactivate_picture_it() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-picture-it-deactivator.php';
	Picture_It_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_picture_it' );
register_deactivation_hook( __FILE__, 'deactivate_picture_it' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-picture-it.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_picture_it() {

	$plugin = new Picture_It();
	$plugin->run();

}
run_picture_it();
