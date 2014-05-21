			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-4 pull-right top-right-btn">	
								</div>
								<div class="panel panel-default">
									<form action="<?php echo base_url(); ?>commercial/updateexpissues" method="post" id="parsley_editcat">
										<div class="panel_controls">
											<h4 class="heading_a">Update Export Issue:
											<div class="top-right-header right">
												<a href="<?php echo base_url();?>commercial/deleteexpissues/<?php echo $export[0]['export_id'];?>" class="btn btn-danger btn-sm hint--top bootbox_confirm" data-hint="Remove"><span class="icon-trash"></span></a>
											</div>
											</h4>											
											<div class="row">
												<?php
												foreach ($export as $key => $value) {
												?>
												<div class="col-sm-12">	
													<div class="form_sep">
														<div class="col-sm-2">
															<label for="export_id" class="req">Export No.</label>
															<input type="hidden" name="export_id" id="export_id" value="<?php echo $value['export_id'] ?>">
															<input id="export_id_old" name="export_id_old" class="form-control" type="text" disabled="true" data-required="true" value="<?php echo $value['export_id'] ?>">
															<label for="ip_date" class="double-input-unreq">IP Date</label>
															<div id="ip_date_value" class="hide"><?php echo $value['ip_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="ip_date" name="ip_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>
														<div class="col-sm-2">
															<label for="issue_date" class="unreq">Exp. Issue Date</label>
															<div id="issue_date_value" class="hide"><?php echo $value['issue_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="issue_date" name="issue_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                    <label for="up_date" class="double-input-unreq">Up Date</label>
															<div id="up_date_value" class="hide"><?php echo $value['up_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="up_date" name="up_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>
														<div class="col-sm-2">
															<label for="send_date" class="unreq">Exp. Send Date</label>
															<div id="send_date_value" class="hide"><?php echo $value['send_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="send_date" name="send_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                    <label for="party_name" class="double-input-unreq">Party Name</label>
															<input id="party_name" name="party_name" class="form-control" type="text" value="<?php echo $value['party_name'] ?>">
														</div>																
														<div class="col-sm-2">
															<label for="receive_date" class="unreq">Exp. Receive Date</label>
															<div id="receive_date_value" class="hide"><?php echo $value['receive_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="receive_date" name="receive_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
															<label for="region" class="double-input-unreq">Region</label>
															<select id="region" name="region" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_division_select_options($value['region']);
															?>								
															</select>
														</div>
														<div class="col-sm-2">
															<label for="value" class="unreq">Value</label>
															<input id="value" name="value" class="form-control" type="text" value="<?php echo $value['value'] ?>">
														</div>
														<div class="col-sm-2 right">
															<label for="remarks" class="unreq">Remarks</label>
															<textarea id="remarks" name="remarks" class="form-control double-text parsley-validated"><?php echo $value['remarks'] ?></textarea>
														</div>	
													</div>
													<div class="form_sep">																
														<div class="col-sm-2">
															<label for="exp_bank_submit_date" class="unreq">Bank Submit Date</label>
															<div id="exp_bank_submit_date_value" class="hide"><?php echo $value['bank_submit_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="exp_bank_submit_date" name="exp_bank_submit_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
														</div>
														<div class="col-sm-2">
															<label for="exp_due_date" class="unreq">Due Date</label>
															<div id="exp_due_date_value" class="hide"><?php echo $value['due_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="exp_due_date" name="exp_due_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
										                </div>
														<div class="col-sm-2">
															<label for="payment_collection_date" class="unreq">Payment Collection Date</label>
															<div id="payment_collection_date_value" class="hide"><?php echo $value['payment_collection_date']; ?></div>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="payment_collection_date" name="payment_collection_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
														</div>													
														<div class="col-sm-2">
															<label for="status" class="unreq">Used / Unused</label>
															<select id="status" name="status" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Used', 'Unused'), $value['status']);
															?>						
															</select>
										                </div>
														<div class="col-sm-2 right">														
															<label for="charge" class="unreq">Disc / Any Charge</label>
															<select id="charge" name="charge" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Dollar', 'Taka'), $value['charge']);
															?>						
															</select>
														</div>
													</div>
													<div class="form_sep">
														<div class="col-sm-12 text-right">													
															<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>commercial/expissues"><span class="icon-double-angle-left"></span> Back</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-sm" id="btn_product_submit" type="submit"><span class="icon-refresh"></span> Update Export Issues</button>
															<br><br><br>
														</div>
													</div>
												</div>
												<?php
												}
												?>	
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>