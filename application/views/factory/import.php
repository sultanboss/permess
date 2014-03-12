			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Imports:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<button data-toggle="modal" href="#add_import_type" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Import</button>												
												<div class="modal fade" id="add_import_type">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add Import</h4>
															</div>
															<form action="<?php echo base_url(); ?>factory/addimport" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																	<label for="raw_name" class="req">Raw Material</label>					
																	<select id="raw_name" name="raw_name" class="form-control" data-required="true">
																		<?php
																		foreach ($raw_materials as $key => $value) {							
																		?>
																		<option value="<?php echo $value['raw_id']; ?>"><?php echo $value['raw_name']; ?></option>
																		<?php						
																		}																	
																		?>				
									                                </select>											
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="import_date" class="req">Import Date</label>
																		<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                                        <input id="import_date" name="import_date" class="form-control" type="text" data-required="true">
																			<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                                    </div>
																	</div>
																	<div class="col-sm-6 end">
																		<label for="import_received_balance" class="req">Received Balance (yards)</label>
																		<input id="import_received_balance" name="import_received_balance" class="form-control" type="text" data-required="true">
																	</div>
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="import_invoice_challan" class="req">Invoice / Challan</label>
																		<input id="import_invoice_challan" name="import_invoice_challan" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="import_lc_no" class="req">L/C No.</label>
																		<input id="import_lc_no" name="import_lc_no" class="form-control" type="text" data-required="true">
																		
																	</div>
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="import_issue_to" class="req">Issue To</label>
																		<input id="import_issue_to" name="import_issue_to" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="import_inv_req_challan" class="req">Inv. / Req. / Challan</label>
																		<input id="import_inv_req_challan" name="import_inv_req_challan" class="form-control" type="text" data-required="true">
																	</div>
																</div>				
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Import</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<table id="import_table" class="table table-hover">
										<thead>
											<tr>
												<th width="5%">ID</th>
												<th width="10%">Raw Materials</th>
												<th width="10%">Date</th>
												<th width="5%">Previous</th>
												<th width="5%">Received</th>
												<th width="10%">Challan</th>
												<th width="7%">L/C No.</th>
												<th width="7%">Total</th>
												<th width="19%">Issue To</th>
												<th width="10%">Inv / Req</th>
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_import">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Import</h4>
												</div>
												<form action="<?php echo base_url(); ?>factory/editimport" method="post" id="parsley_editcat">
												<div class="modal-body">
																<div class="form_sep">
																	<input type="hidden" id="edit_import_id" name="edit_import_id" value="" />
																	<input type="hidden" id="current_raw_id" name="current_raw_id" value="" />
																	<label for="edit_raw_name" class="req">Raw Material</label>					
																	<select id="edit_raw_name" name="edit_raw_name" class="form-control" data-required="true">
																		<?php
																		foreach ($raw_materials as $key => $value) {							
																		?>
																		<option value="<?php echo $value['raw_id']; ?>"><?php echo $value['raw_name']; ?></option>
																		<?php						
																		}																	
																		?>				
									                                </select>											
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="edit_import_date" class="req">Import Date</label>
																		<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                                        <input id="edit_import_date" name="edit_import_date" class="form-control" type="text" data-required="true">
																			<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                                    </div>
																	</div>
																	<div class="col-sm-6 end">
																		<label for="edit_import_received_balance" class="req">Received Balance (yards)</label>
																		<input id="edit_import_received_balance" name="edit_import_received_balance" class="form-control" type="text" data-required="true">
																	</div>
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="edit_import_invoice_challan" class="req">Invoice / Challan</label>
																		<input id="edit_import_invoice_challan" name="edit_import_invoice_challan" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="edit_import_lc_no" class="req">L/C No.</label>
																		<input id="edit_import_lc_no" name="edit_import_lc_no" class="form-control" type="text" data-required="true">
																		
																	</div>
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="edit_import_issue_to" class="req">Issue To</label>
																		<input id="edit_import_issue_to" name="edit_import_issue_to" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="edit_import_inv_req_challan" class="req">Inv. / Req. / Challan</label>
																		<input id="edit_import_inv_req_challan" name="edit_import_inv_req_challan" class="form-control" type="text" data-required="true">
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