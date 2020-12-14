<?php
/**
 * Russell Brown Wordpress Plugin
 * 
 * Plugin Name: Russell Brown WP Plugin
 * Plugin URI: https://github.com/cmonkey03/russell-brown-wp-plugin
 * Description: A plugin to Articles Post Type with Metabox
 * Version: 1.0.0
 * Author URI: https://github.com/cmonkey03
 * 
 * @category Development
 * @package  Wpplugin
 * @author   Russell Brown <russellpbrown@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     link(https://github.com/cmonkey03/russell-brown-wp-plugin)
 */
define('RB_PLUGIN_DIR', plugin_dir_path(__FILE__));

require_once RB_PLUGIN_DIR . '/inc/register-post-type-hooks.php';
require_once RB_PLUGIN_DIR . '/inc/short-description-hooks.php';
