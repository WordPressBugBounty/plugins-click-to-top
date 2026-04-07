<?php
/*
 * @link              http://wpthemespace.com
 * @since             1.0.0
 * @package           click to top
 *
 * @wordpress-plugin
 * Plugin Name:       Click to top
 * Plugin URI:        http://wpthemespace.com
 * Description:       A Click to top tool kit that helps your visitor go top smoothly. Now with SVG icons, responsive controls, scroll progress indicator, and mobile/tablet visibility options!
 * Version:           1.3.4
 * Author:            Noor alam
 * Author URI:        http://wpthemespace.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       click-to-top
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// Define plugin version
define('CLICK_TO_TOP_VERSION', '1.3.4');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
if (is_admin()) {
	// We are in admin mode
	require_once(dirname(__FILE__) . '/admin/click_top_options.php');
	require_once(dirname(__FILE__) . '/admin/nt-class.php');
}

// Include SVG icons
require_once(dirname(__FILE__) . '/includes/svg-icons.php');
require_once(dirname(__FILE__) . '/includes/click_top_options_set.php');

require __DIR__ . '/vendor/autoload.php';

if (!function_exists('click_to_top_script')) :
	function click_to_top_script()
	{
		// SVG icons CSS (replaces Font Awesome)
		wp_enqueue_style('click-to-top-icons', plugins_url('/assets/css/click-top-icons.css', __FILE__), array(), CLICK_TO_TOP_VERSION, 'all');
		wp_enqueue_style('click-to-top-hover', plugins_url('/assets/css/hover.css', __FILE__), array(), '1.0', 'all');
		wp_enqueue_style('click-to-top-style', plugins_url('/assets/css/click-top-style.css', __FILE__), array(), CLICK_TO_TOP_VERSION, 'all');

		wp_enqueue_script('jquery');
		wp_enqueue_script('click-to-top-easing', plugins_url('/assets/js/jquery.easing.js', __FILE__), array('jquery'), '1.0', true);
		wp_enqueue_script('click-to-top-scrollUp', plugins_url('/assets/js/jquery.scrollUp.js', __FILE__), array('jquery', 'click-to-top-easing'), '1.0', true);
	}
	add_action('wp_enqueue_scripts', 'click_to_top_script');
endif;

/**
 * Load the plugin text domain for translation.
 *
 * @since    1.0.0
 */
if (!function_exists('click_to_top_textdomain')) :
	function click_to_top_textdomain()
	{

		load_plugin_textdomain(
			'click-to-top',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages'
		);
	}
	add_action('plugins_loaded', 'click_to_top_textdomain');
endif;

function click_top_admin_script()
{
	wp_enqueue_script('click-top-admin-js', plugins_url('/assets/js/admin.js', __FILE__), array('jquery'), CLICK_TO_TOP_VERSION, true);
}
add_action('admin_enqueue_scripts', 'click_top_admin_script');

/**
 * Initialize PluginPulse tracking (config lives inside the SDK).
 */
require_once __DIR__ . '/vendor/wpspace/pulse-sdk/autostart.php';

/**
 * Add Settings link on the Plugins page.
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), function ( $links ) {
	$settings_link = '<a href="' . esc_url( admin_url( 'options-general.php?page=click-to-top.php' ) ) . '">' . esc_html__( 'Settings', 'click-to-top' ) . '</a>';
	array_unshift( $links, $settings_link );
	return $links;
} );
