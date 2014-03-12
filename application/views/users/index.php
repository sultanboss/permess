			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Groups:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<a href="<?php echo base_url(); ?>auth/register" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add User</a>												
											</div>
										</div>
									</div>
									<table id="users_table" class="table table-hover">
										<thead>
											<tr>
												<th width="10%">User ID</th>
												<th width="20%">Email</th>
												<th width="20%">First Name</th>
												<th width="20%">Last Name</th>
												<th width="20%">Group Name</th>
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_users">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit User</h4>
												</div>
												<form action="<?php echo base_url(); ?>user/edit" method="post" id="parsley_editcat">
												<div class="modal-body">
													<div class="form_sep">
														<label for="parameter_type_name" class="req">Frist Name</label>
														<input id="edit_first_name" name="first_name" class="form-control parsley-validated" data-required="true" type="text">
														<input id="edit_user_id" name="user_id" type="hidden" value="">
													</div>	
													<div class="form_sep">
														<label for="edit_last_name" class="req">Last Name</label>
														<input id="edit_last_name" name="last_name" class="form-control parsley-validated" data-required="true" type="text">
													</div>	
													<div class="form_sep">
														<label for="edit_email" class="req">Email</label>
														<input id="edit_email" name="email" class="form-control parsley-validated" data-required="true" type="text">
													</div>
													<div class="form_sep">
														<label for="edit_group" class="req">Group</label>
														<select id="edit_group" name="edit_group" class="form-control">
															<?php
															foreach ($groups as $key => $value) {							
															?>
															<option value="<?php echo $value['group_id']; ?>"><?php echo $value['group_name']; ?></option>
															<?php						
															}																	
															?>				
									                    </select>
													</div>					
													<div class="form_sep text-right">
														<button class="btn btn-success btn-sm" type="submit"><span class="icon-refresh"></span> Update</button>
													</div>						
												</div>																
												</form>	
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>