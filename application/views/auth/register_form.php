<?php
if ($use_username) {
	$username = array(
		'name'	=> 'username',
		'id'	=> 'username',
		'value' => set_value('username'),
		'maxlength'	=> $this->config->item('username_max_length', 'tank_auth'),
		'placeholder'	=> 'Enter Username',
		'required' => 'required'
	);
}
$fname = array(
	'name'	=> 'fname',
	'id'	=> 'fname',
	'value'	=> set_value('fname'),
	'placeholder'	=> 'Enter First Name',
	'required' => 'required',
	'class'=> 'form-control parsley-validated'

);
$lname = array(
	'name'	=> 'lname',
	'id'	=> 'lname',
	'value'	=> set_value('lname'),
	'placeholder'	=> 'Enter Last Name',
	'required' => 'required',
	'class'=> 'form-control parsley-validated'
);
$email = array(
	'name'	=> 'email',
	'id'	=> 'email',
	'value'	=> set_value('email'),
	'type' => 'email',
	'placeholder'	=> 'Enter Email Address',
	'required' => 'required',
	'class'=> 'form-control parsley-validated'
);
$password = array(
	'name'	=> 'password',
	'id'	=> 'password',
	'type' => 'password',
	'value' => set_value('password'),
	'maxlength'	=> $this->config->item('password_max_length', 'tank_auth'),
	'placeholder'	=> 'Enter Password',
	'required' => 'required',
	'class'=> 'form-control parsley-validated'
);

?>

<?php 
	$attributes = array('id' => 'myform', 'class' => 'form-horizontal'); 
	echo form_open($this->uri->uri_string(), $attributes); ?>

				<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Add New User:</h4>
										<div class="form_sep">
											<div class="col-sm-6 start">
												<label for="group_name" class="req"><?php echo $this->lang->line('auth_fname'); ?></label>
												<?php echo form_input($fname); ?>
												<div class="error">
													<?php echo form_error($fname['name']); ?>
												</div>
											</div>
											<div class="col-sm-6 end">
												<label for="group_name" class="req"><?php echo $this->lang->line('auth_lname'); ?></label>
												<?php echo form_input($lname); ?>
												<div class="error">
													<?php echo form_error($lname['name']); ?>
												</div>	
											</div>
										</div>

										<div class="form_sep">
											<div class="col-sm-6 start">
												<label for="group_name" class="req"><?php echo $this->lang->line('auth_email'); ?></label>
												<?php echo form_input($email); ?>
												<div class="error">
													<?php echo form_error($email['name']); ?><?php echo isset($errors[$email['name']])?$errors[$email['name']]:''; ?>
												</div>
											</div>
											<div class="col-sm-6 end">
												<label for="group_name" class="req"><?php echo $this->lang->line('auth_password'); ?></label>
												<?php echo form_input($password); ?>
												<div class="error">
													<?php echo form_error($password['name']); ?>
												</div>	
											</div>
										</div>
										<div class="form_sep text-right">
											<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add User</button>
										</div>
									</div>
								</div>
							</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

						</div>
					</div>
				</div>