<?php
/*
Plugin Name: My Simple feedback form
Plugin URI: http://wordpress.org/plugins/my-simple-feedback/
Description: Simple feedback form on your page
Version: 1.0
Author: Pavel
Author URI: http://plance.in.ua/
*/

defined('ABSPATH') or die('No script kiddies please!');

if(class_exists('Plance_Flash') == FALSE)
{
	require_once(plugin_dir_path(__FILE__).'library/wp-plance/flash.php');
}
if(class_exists('Plance_Validate') == FALSE)
{
	require_once(plugin_dir_path(__FILE__).'library/plance/validate.php');
}
if(class_exists('Plance_View') == FALSE)
{
	require_once(plugin_dir_path(__FILE__).'library/plance/view.php');
}
if(class_exists('Plance_Request') == FALSE)
{
	require_once(plugin_dir_path(__FILE__).'library/plance/request.php');
}

//Include language
load_plugin_textdomain('plance', false, basename(__DIR__).'/languages/');

if(is_admin() == TRUE)
{
	require_once(plugin_dir_path(__FILE__).'app/class.db.php');
	require_once(plugin_dir_path(__FILE__).'app/class.admin.init.php');
	
	register_activation_hook(__FILE__, 'Plance_SFB_DB::activate');
	register_uninstall_hook(__FILE__, 'Plance_SFB_DB::uninstall');
//	register_deactivation_hook(__FILE__, 'Plance_SFB_DB::uninstall');
	
    new Plance_SFB_Admin_INIT();
}
else
{
	require_once(plugin_dir_path(__FILE__).'app/class.index.init.php');

	new Plance_SFB_Index_INIT();
}