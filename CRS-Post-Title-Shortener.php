<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @category This_Plugin_Checks_The_Title_Length_When_A_Post_Is_Saved.
 * @package  CRS-Post-Title-Shortener
 * @author   Stefan Bergfeldt <stefan@crswebb.se>
 * @license  GLP-2.0+ http://www.gnu.org/licenses/gpl-2.0.txt
 * @link     http://crswebb.se
 * @since    1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:       CRS Post Title Shortener
 * Plugin URI:        http://crswebb.se/CRS-Post-Title-Shortener/
 * Description:       This plugin checks the title when a post is saved,
 * and makes sure it's not too long.
 * Version:           1.0.0
 * Author:            CRS Webbproduktion AB
 * Author URI:        http://crswebb.se
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       crswebb
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-crs-post-title-shortener-activator.php
 */
function activate_crs_post_title_shortener()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-crs-post-title-shortener-activator.php';
    crs_post_title_shortener_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-crs-post-title-shortener-deactivator.php
 */
function deactivate_crs_post_title_shortener()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-crs-post-title-shortener-deactivator.php';
    crs_post_title_shortener_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_crs_post_title_shortener');
register_deactivation_hook(__FILE__, 'deactivate_crs_post_title_shortener');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-crs-post-title-shortener.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_crs_post_title_shortener()
{

    $plugin = new CRS_Post_Title_Shortener();
    $plugin->run();

}
run_crs_post_title_shortener();
