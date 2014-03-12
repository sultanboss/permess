			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Raw Materials:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<button data-toggle="modal" href="#add_raw_type" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Raw Material</button>												
												<div class="modal fade" id="add_raw_type">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add Raw Material</h4>
															</div>
															<form action="<?php echo base_url(); ?>raw/add" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																<label for="raw_name" class="req">Raw Material Name</label>
																	<input id="raw_name" name="raw_name" class="form-control parsley-validated" data-required="true" type="text">
																</div>						
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Raw Material</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<table id="raw_table" class="table table-hover">
										<thead>
											<tr>
												<th width="10%">ID</th>
												<th width="40%">Raw Material Name</th>
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_raw">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Raw Material</h4>
												</div>
												<form action="<?php echo base_url(); ?>raw/edit" method="post" id="parsley_editcat">
												<div class="modal-body">
													<div class="form_sep">
													<label for="raw_name" class="req">Raw Material Name</label>
														<input id="edit_raw_name" name="raw_name" class="form-control parsley-validated" data-required="true" type="text">
														<input id="edit_raw_id" name="raw_id" type="hidden" value="">
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