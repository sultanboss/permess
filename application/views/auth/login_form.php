<?php
if ($login_by_username AND $login_by_email) {
	$login_label = $this->lang->line('auth_email_or_login');
} else if ($login_by_username) {
	$login_label = $this->lang->line('auth_login');
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
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'placeholder'	=> 'Enter Password',
	'required' => 'required',
	'class' => 'form-control input-lg'
);
$remember = array(
	'name'	=> 'remember',
	'id'	=> 'remember',
	'value'	=> 1,
	'checked'	=> set_value('remember'),
);
$captcha = array(
	'name'	=> 'captcha',
	'id'	=> 'captcha',
	'placeholder'	=> 'Enter Code',
	'required' => 'required'
);
$attributes = array('id' => 'myform'); 
echo form_open($this->uri->uri_string(), $attributes); ?>

	<div class="login_wrapper">
		<div class="login_panel log_section">
			<div class="login_head text-center">
				<img src="<?php echo $this->config->item('admin_img_url'); ?>logo.png">
			</div>
				<div class="form-group">
					<label for="login_username">Email</label>
					<?php echo form_input($login); ?>	
					<div class="error">
						<?php echo form_error($login['name']); ?><?php echo isset($errors[$login['name']])?$errors[$login['name']]:''; ?>	
					</div>
				</div>
				<div class="form-group">
					<label for="login_password">Password</label>
					<?php echo form_password($password); ?>	
					<div class="error">
						<?php echo form_error($password['name']); ?><?php echo isset($errors[$password['name']])?$errors[$password['name']]:''; ?>	
					</div>	
					<label class="checkbox">
					<?php echo form_checkbox($remember); ?><?php echo $this->lang->line('auth_remember_me'); ?>
					</label>
						
				</div>
				<div class="login_submit">
					<button class="btn btn-success btn-block btn-lg" type="submit">Log In</button>
				</div>
				<div class="text-center">
					<small>Forgot Passowrd? <?php echo anchor('/auth/forgot_password/', 'Click here'); ?></small>
				</div>
		</div>
	</div>

<?php echo form_close(); ?>