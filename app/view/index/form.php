<?php
	$data_ar = $Validate -> getData();
	if(isset($_POST['__plance_simple_feedback']) && $Validate -> isErrors())
	{
		Plance_Flash::instance() -> show('error', $Validate -> getErrors());
	}
	Plance_Flash::instance() -> showMessage();
	$_SESSION['plance_sfb_code'] = rand(10000, 99999);
?>
<form method="post" class="plance-sfb-form" action="//<?php echo Plance_Request::currentURL(); ?>">
	<input type="hidden" name="__plance_simple_feedback" value="true">
	<p>
		<label><?php echo __('Your Name:', 'plance') ?></label><br>
		<input type="text" class="r-name" name="sfb_name" value="<?php echo esc_attr($data_ar['sfb_name']) ?>" />
	</p>
	<p>
		<label><?php echo __('Your Email:', 'plance') ?></label><br>
		<input type="text" class="r-email" name="sfb_email" value="<?php echo esc_attr($data_ar['sfb_email']) ?>" />
	</p>
	<p>
		<label><?php echo __('Message:', 'plance') ?></label><br>
		<textarea class="r-message" name="sfb_message"><?php echo esc_textarea($data_ar['sfb_message']); ?></textarea>
	</p>
	<p>
		<input type="text" class="r-is" name="sfb_is" />
		<?php printf(__('Write in this field number "%1$s"', 'plance'), $_SESSION['plance_sfb_code']); ?>
	</p>
	<p>
		<input name="submit" type="submit" class="submit" value="<?php echo __('Send message', 'plance') ?>">
	</p>
</form>