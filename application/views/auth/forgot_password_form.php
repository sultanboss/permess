<?php
if ($this->config->item('use_username', 'tank_auth')) {
	$login_label = $this->lang->line('auth_email_or_login');
} else {
	$login_label = $this->lang->line('auth_email');
}

$login = array(
	'name'	=> 'login',
	'id'	=> 'login',
	'value' => set_value('login'),
	'placeholder'	=> 'Enter '.$login_label,
	'type'	=> 'email',
	'required' => 'required',
	'class' => 'form-control input-lg'
);
?>
<?php 
	$attributes = array('id' => 'myform'); 
	echo form_open($this->uri->uri_string(), $attributes); ?>

	<div class="login_wrapper">
		<div class="login_panel log_section">
			<div class="login_head text-center">
				<img src="<?php echo $this->config->item('admin_img_url'); ?>logo.jpg">
			</div>
				<div class="form-group">
					<label for="login_username">Email</label>
					<?php echo form_input($login); ?>
					<div class="error">
						<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>	
					</div>	
				</div>
				<div class="login_submit">
					<button class="btn btn-success btn-block btn-lg" type="submit">Get New Password</button>
				</div>
				<div class="text-center">
					<small>Never mind, <?php echo anchor('/auth/login', 'Send me back to the sign-in screen'); ?></small>
				</div>
		</div>
	</div>

<?php echo form_close(); ?>
