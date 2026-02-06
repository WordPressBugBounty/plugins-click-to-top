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
 * Version:           1.3.0
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
define('CLICK_TO_TOP_VERSION', '1.3.0');

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
	wp_enqueue_script('click-top-admin-js', plugins_url('/assets/js/admin.js', __FILE__), array('jquery'), '1.2.19', true);
}
add_action('admin_enqueue_scripts', 'click_top_admin_script');

/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function appsero_init_tracker_click_to_top()
{

	if (!class_exists('Appsero\Client')) {
		require_once __DIR__ . '/vendor/appsero/client/src/Client.php';
	}

	$client = new Appsero\Client('cdf405c8-d3c4-432c-9124-1eb5b775bb94', 'Click to top', __FILE__);

	// Active insights
	$client->insights()->init();
}

appsero_init_tracker_click_to_top();

/**
 * Show admin notice after plugin update with new features
 * 
 * @since 1.3.0
 */
function click_to_top_admin_notice() {
	// Only show to users who can manage options
	if (!current_user_can('manage_options')) {
		return;
	}
	
	// Check if notice was dismissed
	$dismissed = get_option('click_to_top_notice_dismissed_130', false);
	if ($dismissed) {
		return;
	}
	
	// Check if this is an update (user had previous version)
	$previous_version = get_option('click_to_top_previous_version', '');
	if ($previous_version === '' || version_compare($previous_version, '1.3.0', '>=')) {
		// First install or already seen this version
		update_option('click_to_top_previous_version', CLICK_TO_TOP_VERSION);
		return;
	}
	
	?>
	<div class="notice notice-info is-dismissible click-to-top-update-notice" style="border-left-color: #3498db;">
		<h3 style="margin: 0.5em 0; color: #1e3a5f;">
			<span class="dashicons dashicons-arrow-up-alt" style="color: #3498db;"></span>
			<?php esc_html_e('Click to Top - What\'s New in Version 1.3.0!', 'click-to-top'); ?>
		</h3>
		<p style="font-size: 14px; margin-bottom: 5px;"><?php esc_html_e('Thank you for updating! Here are the exciting new features:', 'click-to-top'); ?></p>
		<ul style="list-style: disc; margin-left: 20px; margin-bottom: 10px;">
			<li><strong><?php esc_html_e('Responsive Button Sizes', 'click-to-top'); ?></strong> - <?php esc_html_e('Set custom button sizes for desktop, tablet, and mobile devices', 'click-to-top'); ?></li>
			<li><strong><?php esc_html_e('Tablet Visibility Control', 'click-to-top'); ?></strong> - <?php esc_html_e('Show or hide the button on tablet devices (768px - 1024px)', 'click-to-top'); ?></li>
			<li><strong><?php esc_html_e('Touch-Friendly Tap Area', 'click-to-top'); ?></strong> - <?php esc_html_e('Larger invisible tap area for easier touch interaction', 'click-to-top'); ?></li>
			<li><strong><?php esc_html_e('Progress Indicator Enhancement', 'click-to-top'); ?></strong> - <?php esc_html_e('Responsive sizing now works with progress indicator enabled', 'click-to-top'); ?></li>
			<li><strong><?php esc_html_e('Recommended Plugins Tab', 'click-to-top'); ?></strong> - <?php esc_html_e('Discover useful plugins with one-click install', 'click-to-top'); ?></li>
		</ul>
		<p>
			<a href="<?php echo esc_url(admin_url('admin.php?page=click-to-top')); ?>" class="button button-primary">
				<?php esc_html_e('Configure Settings', 'click-to-top'); ?>
			</a>
			<a href="#" class="button click-to-top-dismiss-notice" style="margin-left: 10px;">
				<?php esc_html_e('Dismiss', 'click-to-top'); ?>
			</a>
		</p>
	</div>
	<script>
	jQuery(document).ready(function($) {
		$('.click-to-top-update-notice').on('click', '.notice-dismiss, .click-to-top-dismiss-notice', function(e) {
			e.preventDefault();
			$.post(ajaxurl, {
				action: 'click_to_top_dismiss_notice',
				nonce: '<?php echo esc_js(wp_create_nonce('click_to_top_dismiss_nonce')); ?>'
			});
			$('.click-to-top-update-notice').fadeOut();
		});
	});
	</script>
	<?php
}
add_action('admin_notices', 'click_to_top_admin_notice');

/**
 * AJAX handler to dismiss the admin notice
 * 
 * @since 1.3.0
 */
function click_to_top_dismiss_notice_ajax() {
	check_ajax_referer('click_to_top_dismiss_nonce', 'nonce');
	
	if (!current_user_can('manage_options')) {
		wp_die();
	}
	
	update_option('click_to_top_notice_dismissed_130', true);
	update_option('click_to_top_previous_version', CLICK_TO_TOP_VERSION);
	
	wp_die();
}
add_action('wp_ajax_click_to_top_dismiss_notice', 'click_to_top_dismiss_notice_ajax');

/**
 * Store previous version on plugin activation/update
 * 
 * @since 1.3.0
 */
function click_to_top_set_previous_version() {
	$current_stored = get_option('click_to_top_previous_version', '');
	if ($current_stored === '') {
		// First time - check if settings exist (means update, not fresh install)
		$existing_settings = get_option('click_top_basic', array());
		if (!empty($existing_settings)) {
			// This is an update from a previous version
			update_option('click_to_top_previous_version', '1.2.29');
		} else {
			// Fresh install
			update_option('click_to_top_previous_version', CLICK_TO_TOP_VERSION);
		}
	}
}
add_action('admin_init', 'click_to_top_set_previous_version');
