			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Orders:</h4>
										<div class="row">											
											<div class="col-sm-12">
												&nbsp;
											</div>
										</div>
									</div>
									<table id="order_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="10%">P.I. Issue</th>
												<th width="15%">Date</th>
												<th width="20%">Company</th>
												<th width="20%">Buyer Order Reference</th>
												<th width="13%">L/C Status</th>
												<th width="13%">Delivery Status</th>
												<th width="12%">Delivery Request</th>												
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_order">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Update Order</h4>
												</div>
												<form action="<?php echo base_url(); ?>marketing/editorder" method="post" id="parsley_editcat">
												<div class="modal-body">
													<div class="form_sep">
														<div class="col-sm-6 start">
															<label for="delivery_id_old" class="req">P.I. Issue</label>
															<input id="delivery_id_old" name="delivery_id_old" class="form-control parsley-validated" disabled="true" data-required="true" type="text">
															<input id="delivery_id" name="delivery_id" type="hidden">
														</div>
														<div class="col-sm-6 end">
															<label for="delivery_request" class="req">Delivery Request</label>
															<select id="delivery_request" name="delivery_request" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('No', 'Yes'), '');
															?>								
															</select>
														</div>
													</div>	
													<div class="form_sep">
														<label for="buyer_order_reference" class="req">Buyer Order Reference</label>
														<textarea id="buyer_order_reference" name="buyer_order_reference" class="form-control parsley-validated"></textarea>
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