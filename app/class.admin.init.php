<?php

/**
 * InIt form
 */
class Plance_SFB_Admin_INIT
{
	const PAGE = __CLASS__;
	
	/**
	 *
	 * @var Plance_Validate
	 */
	private $_FormValidate;
	
    /**
     * Create
     */
    public function __construct()
    {
		Plance_Flash::instance() -> init();
		
        add_action('admin_menu', array($this, 'adminMenu'));
    }
 
    /**
     * Create menu
     */
    public function adminMenu()
    {
		/* Create menu item */
        $hook_form = add_menu_page(
			__('Feedback options', 'plance'), 
			__('Feedback options', 'plance'), 
			'manage_options', 
			Plance_SFB_Admin_INIT::PAGE, 
			array($this, 'form')
		);

		add_action('load-'.$hook_form, array($this, 'screenOptions'));
    }
	
	/**
	 * Создаем опции для странцы с формой создания/редактирования шорткода
	 */
	public function screenOptions()
	{
		$this -> _FormValidate = Plance_Validate::factory(wp_unslash($_POST))
		-> setLabels(array(
			'admin_email'		=> '"'.__('Admin Email', 'plance').'"',
			'admin_name'		=> '"'.__('Admin Name', 'plance').'"',
			'noreply_email'		=> '"'.__('Noreply Email', 'plance').'"',
			'noreply_name'		=> '"'.__('Noreply Name', 'plance').'"',
			'shortcode_name'	=> '"'.__('Shortcode Name', 'plance').'"',
			'message_subject'	=> '"'.__('Message subject', 'plance').'"',
			'message_template'	=> '"'.__('Message template', 'plance').'"',
			'flash_message'		=> '"'.__('Flash Message', 'plance').'"',
		))
				
		-> setFilters('*', array(
			'trim' => array(),
		))
				
		-> setRules('admin_email', array(
			'required' => array(),
		))
		-> setRules('admin_name', array(
			'required' => array(),
		))
		-> setRules('noreply_email', array(
			'required' => array(),
		))
		-> setRules('noreply_name', array(
			'required' => array(),
		))
		-> setRules('message_subject', array(
			'required' => array(),
		))
		-> setRules('message_template', array(
			'required' => array(),
		))
		-> setRules('shortcode_name', array(
			'required' => array(),
			'regex' => array('/^[a-z]+[a-z0-9\-_]+[a-z]$/i'),
		))
		-> setRules('admin_email', array(
			'email' => array(),
		))
		-> setRules('noreply_email', array(
			'email' => array(),
		))
						
		-> setMessages(array(
			'required'	=> __('{field} must not be empty', 'plance'),
			'email'		=> __('{field} must be a email', 'plance'),
			'regex'		=> __('{field} does not match the required format', 'plance'),
		));
		
		if(Plance_Request::isPost() && $this -> _FormValidate -> validate())
		{
			$data_ar = $this -> _FormValidate -> getData();
			
			update_option('plance_simple_feedback', $data_ar);
			
			Plance_Flash::instance() -> redirect('?page='.Plance_SFB_Admin_INIT::PAGE, __('Options updated', 'plance'));
		}
		else if(Plance_Request::isPost() == false)
		{
			$this -> _FormValidate -> setData(
				get_option('plance_simple_feedback')
			);
		}
		
		if($this -> _FormValidate -> isErrors())
		{
			Plance_Flash::instance() -> show('error', $this -> _FormValidate -> getErrors());
		}
	}
	
	/**
	 * Show Feedback form
	 */
    public function form()
    {
		echo Plance_View::get(plugin_dir_path(__FILE__).'view/admin/form', array(
			'data_ar' => $this -> _FormValidate -> getData()
		));
	}
}