<div class="wrap">
	<h2><?php echo __('Feedback form options', 'plance') ?></h2>
	<form method="post" action="?page=<?php echo Plance_SFB_Admin_INIT::PAGE ?>">
		<?php wp_nonce_field(Plance_SFB_Admin_INIT::PAGE); ?>
		<table class="form-table">
			<tr>
				<th scope="row"><?php echo __('Admin Email', 'plance') ?></th>
				<td>
					<input type="text" name="admin_email" value="<?php echo esc_attr($data_ar['admin_email']) ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Admin Name', 'plance') ?></th>
				<td>
					<input type="text" name="admin_name" value="<?php echo esc_attr($data_ar['admin_name']) ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Noreply Email', 'plance') ?></th>
				<td>
					<input type="text" name="noreply_email" value="<?php echo esc_attr($data_ar['noreply_email']) ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Noreply Name', 'plance') ?></th>
				<td>
					<input type="text" name="noreply_name" value="<?php echo esc_attr($data_ar['noreply_name']) ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Shortcode Name', 'plance') ?></th>
				<td>
					<input type="text" name="shortcode_name" value="<?php echo esc_attr($data_ar['shortcode_name']) ?>" /><br>
					<em>
						<small><?php echo __('Use this shortcode in your posts or pages', 'plance') ?></small>
					</em>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Message subject', 'plance') ?></th>
				<td>
					<input type="text" name="message_subject" value="<?php echo esc_attr($data_ar['message_subject']) ?>" />
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Message template', 'plance') ?></th>
				<td>
					<textarea style="width: 500px; height: 100px;" name="message_template"><?php echo esc_textarea($data_ar['message_template']); ?></textarea>
					<p>
						<em>
							<small>
							<?php echo __('Use next pseudotag in above message:', 'plance') ?><br>
							<?php echo __('{name} - user name', 'plance') ?><br>
							<?php echo __('{email} - user email', 'plance') ?><br>
							<?php echo __('{message} - text message', 'plance') ?>
							</small>
						</em>
					</p>
				</td>
			</tr>
			<tr>
				<th scope="row"><?php echo __('Flash Message', 'plance') ?></th>
				<td>
					<textarea style="width: 500px; height: 50px;" name="flash_message"><?php echo esc_textarea($data_ar['flash_message']); ?></textarea>
				</td>
			</tr>
		</table>
		<?php submit_button(); ?>
	</form>
</div>