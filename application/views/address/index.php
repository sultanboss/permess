			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Address:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<button data-toggle="modal" href="#add_address_type" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Address</button>												
												<div class="modal fade" id="add_address_type">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add Address</h4>
															</div>
															<form action="<?php echo base_url(); ?>address/add" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																	<label for="company_name" class="req">Company Name</label>
																	<input id="company_name" name="company_name" class="form-control parsley-validated" data-required="true" type="text">
																</div>	
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="contact_person" class="req">Contact Person</label>
																		<input id="contact_person" name="contact_person" class="form-control parsley-validated" data-required="true" type="text">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="buyer" class="unreq">Buyer Name</label>
																		<input id="buyer" name="buyer" class="form-control parsley-validated" type="text">
																	</div>
																</div>		
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="company_address" class="req">Company Address</label>
																		<textarea id="company_address" name="company_address" class="form-control double-text" type="text" data-required="true"></textarea>
																	</div>
																	<div class="col-sm-6 end">
																		<label for="delivery_address" class="unreq">Delivery Address</label>
																		<textarea id="delivery_address" name="delivery_address" class="form-control double-text" type="text"></textarea>
																	</div>
																</div>				
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Address</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<table id="address_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="10%">ID</th>
												<th width="30%">Company Name</th>
												<th width="25%">Contact Person</th>
												<th width="25%">Buyer</th>
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_address">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Address</h4>
												</div>
												<form action="<?php echo base_url(); ?>address/edit" method="post" id="parsley_editcat">
												<div class="modal-body">
													<div class="form_sep">
														<input id="edit_address_id" name="edit_address_id" type="hidden" value="">
														<label for="edit_company_name" class="req">Company Name</label>
														<input id="edit_company_name" name="edit_company_name" class="form-control parsley-validated" data-required="true" type="text">
													</div>	
													<div class="form_sep">
														<div class="col-sm-6 start">
															<label for="edit_contact_person" class="req">Contact Person</label>
															<input id="edit_contact_person" name="edit_contact_person" class="form-control parsley-validated" data-required="true" type="text">
														</div>
														<div class="col-sm-6 end">
															<label for="edit_buyer" class="unreq">Buyer Name</label>
															<input id="edit_buyer" name="edit_buyer" class="form-control parsley-validated" type="text">
														</div>
													</div>		
													<div class="form_sep">
														<div class="col-sm-6 start">
															<label for="edit_company_address" class="req">Company Address</label>
															<textarea id="edit_company_address" name="edit_company_address" class="form-control double-text" type="text" data-required="true"></textarea>
														</div>
														<div class="col-sm-6 end">
															<label for="edit_delivery_address" class="unreq">Delivery Address</label>
															<textarea id="edit_delivery_address" name="edit_delivery_address" class="form-control double-text" type="text"></textarea>
														</div>
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