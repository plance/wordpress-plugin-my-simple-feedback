<?php

/**
 * InIt form
 */
class Plance_SFB_Index_INIT
{
	const PAGE = __CLASS__;
	
	/**
	 *
	 * @var Plance_Validate
	 */
	private $_Validate;
	
	/**
	 * Config form
	 * @var array
	 */
	private $_data_ar;
	
    /**
     * Create
     */
    public function __construct()
    {
		Plance_Flash::instance() -> init();
		
		//Sets
		$this -> _data_ar = get_option('plance_simple_feedback');
		
		$this -> _Validate = Plance_Validate::factory($_POST)
		-> setLabels(array(
			'sfb_name'		=> '"'.__('Your Name', 'plance').'"',
			'sfb_email'		=> '"'.__('Your Email', 'plance').'"',
			'sfb_message'	=> '"'.__('Message', 'plance').'"',
			'sfb_is'		=> '"'.__('Bot', 'plance').'"',
		))

		-> setFilters('*', array(
			'trim' => array(),
			'strip_tags' => array(),
		))
		-> setFilters('sfb_is', array(
			'intval' => array(),
		))

		-> setRules('*', array(
			'required' => array(),
		))
		-> setRules('sfb_email', array(
			'email' => array(),
		))
		-> setRules('sfb_is', array(
			'Plance_SFB_Index_INIT::validateSfbIs' => array(),
		))

		-> setMessages(array(
			'required'	=> __('{field} must not be empty', 'plance'),
			'email'		=> __('{field} must be a email', 'plance'),
			'Plance_SFB_Index_INIT::validateSfbIs'=> __('Fill verification field correctly', 'plance'),
		));

		if(isset($_POST['__plance_simple_feedback']) &&  $this -> _Validate -> validate())
		{
			add_action('plugins_loaded', function()
			{
				$data_ar = $this -> _Validate -> getData();
				
				wp_mail(
					array(
						$this -> _data_ar['admin_name'].' <'.$this -> _data_ar['admin_email'].'>',
					),
					$this -> _data_ar['message_subject'],
					strtr($this -> _data_ar['message_template'],array(
						'{name}' => $data_ar['sfb_name'],
						'{email}' => $data_ar['sfb_email'],
						'{message}' => wordwrap($data_ar['sfb_message'], 80, "\n"),
					)),
					array(
					'From: '.$data_ar['sfb_name'].' <'.$data_ar['sfb_email'].'>',
				));
				
				if($this -> _data_ar['flash_message'])
				{
					Plance_Flash::instance() -> redirect('//'.Plance_Request::currentURL(), $this -> _data_ar['flash_message']);
				}
			});
		}

		//Create Shortcode
		if(isset($this -> _data_ar['shortcode_name']) && $this -> _data_ar['shortcode_name'])
		{
			add_shortcode($this -> _data_ar['shortcode_name'], function() {
				return Plance_View::get(plugin_dir_path(__FILE__).'view/index/form', array(
					'Validate'  => $this -> _Validate,
				));
			});
		}
		
		add_action('wp_head', function()
		{
			echo '<style>';
			echo '.plance-sfb-form .r-name, .plance-sfb-form .r-email{width:50%}';
			echo '.plance-sfb-form .r-subject{width:100%}';
			echo '.plance-sfb-form .r-message{width:100%;height:100px;}';
			echo '.plance-sfb-form .r-is{width:10%;text-align:center}';
			echo '</style>';
		});
    }
	
	/**
	 * Check field "sfb_is"
	 * @param int $sfb_is
	 * @return bool
	 */
	public static function validateSfbIs($sfb_is)
	{
		return $sfb_is == $_SESSION['plance_sfb_code'];
	}
}