<?php

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Работа с БД
 */
class Plance_SFB_DB
{
    /**
	 * Активация плагина
	 */
    public static function activate()
    {
		add_option('plance_simple_feedback', array(
			'admin_email' => get_bloginfo('admin_email'),
			'admin_name' => 'Administrator',
			'noreply_email' => get_bloginfo('admin_email'),
			'noreply_name' => get_bloginfo('blogname'),
			'shortcode_name' => 'plance-simple-feedback',
			'message_subject' => 'Email from Your Site',
			'message_template' => '{message}',
			'flash_message' => '',
		));
		
        return TRUE;
    }
	
    /**
	 * Удаление плагина
	 */
    public static function uninstall()
    {
		
		delete_option('plance_simple_feedback');
		
		return TRUE;
    }
}