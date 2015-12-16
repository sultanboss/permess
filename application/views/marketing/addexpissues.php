			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-4 pull-right top-right-btn">	
								</div>
								<div class="panel panel-default">
									<form action="<?php echo base_url(); ?>commercial/addexp" method="post" id="parsley_addcat">
										<div class="panel_controls">
											<h4 class="heading_a">Add Export Issue:</h4>											
											<div class="row">
												<div class="col-sm-12">	
													<div class="form_sep">
														<div class="col-sm-2">
															<label for="file_no" class="req">File No.</label>
															<input id="file_no" name="file_no" class="form-control" type="text" value="" data-required="true">
															<label for="ip_date" class="double-input-unreq">IP Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="ip_date" name="ip_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>
														<div class="col-sm-2">	
															<label for="exp_no" class="unreq">Exp. No.</label>
															<input id="exp_no" name="exp_no" class="form-control" type="text" value="">
										                    <label for="up_date" class="double-input-unreq">Up Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="up_date" name="up_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>
														<div class="col-sm-2">
															<label for="issue_date" class="unreq">Exp. Issue Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="issue_date" name="issue_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                    <label for="party_name" class="double-input-unreq">Party Name</label>
															<input id="party_name" name="party_name" class="form-control" type="text">
														</div>																
														<div class="col-sm-2">
															<label for="send_date" class="unreq">Exp. Send Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="send_date" name="send_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
															<label for="region" class="double-input-unreq">Region</label>
															<select id="region" name="region" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_division_select_options('');
															?>								
															</select>
														</div>
														<div class="col-sm-2">
															<label for="receive_date" class="unreq">Exp. Receive Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="receive_date" name="receive_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
															<label for="value" class="double-input-unreq">Value</label>
															<input id="value" name="value" class="form-control" type="text">
														</div>
														<div class="col-sm-2 right">
															<label for="remarks" class="unreq">Remarks</label>
															<textarea id="remarks" name="remarks" class="form-control double-text parsley-validated"></textarea>
														</div>	
													</div>
													<div class="form_sep">																
														<div class="col-sm-2">
															<label for="exp_bank_submit_date" class="unreq">Bank Submit Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="exp_bank_submit_date" name="exp_bank_submit_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
														</div>
														<div class="col-sm-2">
															<label for="exp_due_date" class="unreq">Due Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="exp_due_date" name="exp_due_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
										                </div>
														<div class="col-sm-2">
															<label for="payment_collection_date" class="unreq">Payment Collection Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="payment_collection_date" name="payment_collection_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
														</div>													
														<div class="col-sm-2">
															<label for="realize_date" class="unreq">Realize Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="realize_date" name="realize_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
										                </div>
														<div class="col-sm-2">														
															<label for="lc_sale_contact" class="unreq">LC / Sales Contact No.</label>
															<input id="lc_sale_contact" name="lc_sale_contact" class="form-control" type="text" value="">
														</div>
													</div>
													<div class="form_sep">
														<div class="col-sm-12 text-right">													
															<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>commercial/expissues"><span class="icon-double-angle-left"></span> Back</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-sm" id="btn_product_submit" type="submit"><span class="icon-plus"></span> Add Export Issues</button>
															<br><br><br>
														</div>
													</div>
												</div>	
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