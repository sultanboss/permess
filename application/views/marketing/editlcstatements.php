			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-4 pull-right top-right-btn">	
												<div class="btn-group">
													<a href="<?php echo base_url(); ?>factory/editdelivery/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Delivery Details">												
													<?php
													if($status[0]['delivery_status'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-red"></span>
														<?php
													}
													else if($status[0]['delivery_status'] == 2)
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-green"></span>
														<?php
													}
													else
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-orange"></span>
														<?php
													}
													?>
													</a>
													<a href="javascript:void(0)" class="hint--top" data-hint="LC Status">
													<?php
													if($status[0]['delivery_lc_status'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-file largex color-red toolbar-active"></span>
														<?php
													}
													else
													{
														?>
														<span title="LC Status" class="glyphicon glyphicon-file largex color-green toolbar-active"></span>
														<?php
													}
													?>
													</a>
													<a href="<?php echo base_url(); ?>marketing/orderdetails/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Order Details">
													<?php
													if($status[0]['delivery_request'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-red"></span>
														<?php
													}
													else if($status[0]['delivery_request'] == 2)
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-green"></span>
														<?php
													}
													else
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-orange"></span>
														<?php
													}
													?>
													</a>
													<a href="<?php echo base_url(); ?>factory/printchallan/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Challan"><span class="glyphicon glyphicon-list largex color-gray"></span></a>													
													<a href="<?php echo base_url(); ?>factory/printdelivery/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Invoice"><span class="glyphicon glyphicon-print largex color-print"></span></a>						
												</div>
								</div>
								<div class="panel panel-default">
									<form action="<?php echo base_url(); ?>commercial/updatelcstatements" method="post" id="parsley_editcat">
										<div class="panel_controls">
											<h4 class="heading_a">Update LC Statements:</h4>
											<?php
											foreach ($statements as $key => $del) {
											?>
											<div class="row">
												<div class="col-sm-12">	
													<div class="form_sep">
														<div class="col-sm-2">
															<label for="delivery_id" class="req">Delivery ID</label>
															<input id="delivery_id" name="delivery_id" class="form-control" type="hidden" value="<?php echo $del['delivery_id']; ?>">
															<input id="delivery_id_old" name="delivery_id_old" class="form-control" type="text" disabled="true" data-required="true" value="<?php echo $del['delivery_id']; ?>">
										                    <label for="file_no" class="double-input-unreq">File No.</label>
															<input id="file_no" name="file_no" class="form-control" type="text" value="<?php echo $del['file_no']; ?>">
														</div>
														<div class="col-sm-2">
															<label for="lc_no" class="unreq">LC No.</label>
															<input id="lc_no" name="lc_no" class="form-control" type="text" value="<?php echo $del['lc_no']; ?>">
															<div class="col-sm-6 start">
																<label for="value" class="double-input-unreq">Value</label>
																<input id="value" name="value" class="form-control" type="hidden" value="<?php echo $del['value']; ?>">
																<input id="value_old" name="value_old" class="form-control" type="text" disabled="true" value="<?php echo $del['value']; ?>">
															</div>
															<div class="col-sm-6 end">
																<label for="comission" class="double-input-unreq">Comission</label>
																<input id="comission" name="comission" class="form-control" disabled="true" type="text" value="<?php echo $commission; ?>">
															</div>
														</div>
														<div class="col-sm-2">
															<div id="lc_date_value" class="hide"><?php echo $del['lc_date']; ?></div>
															<label for="lc_date" class="unreq">LC Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="lc_date" name="lc_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>															
															<div id="ship_date_value" class="hide"><?php echo $del['ship_date']; ?></div>
															<label for="ship_date" class="double-input-unreq">Shipment Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="ship_date" name="ship_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>																
														<div class="col-sm-2">
															<div id="lc_rdate_value" class="hide"><?php echo $del['lc_rdate']; ?></div>
															<label for="lc_rdate" class="unreq">LC Receive Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="lc_rdate" name="lc_rdate" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
															<div id="exp_date_value" class="hide"><?php echo $del['exp_date']; ?></div>
															<label for="exp_date" class="double-input-unreq">Export Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="exp_date" name="exp_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>
														<div class="col-sm-2 right">
															<label for="lc_status" class="req">LC Status</label>
															<select id="lc_status" name="lc_status" class="form-control">
															<?php 
																$this->tank_auth->load_select_options(array('No', 'Yes'), $status[0]['delivery_lc_status']);
															?>								
															</select>
															<label for="doc_status" class="req double-input">Document Status</label>
															<select id="doc_status" name="doc_status" class="form-control">
															<?php 
																$this->tank_auth->load_select_options(array('No', 'Yes'), $status[0]['delivery_doc_status']);
															?>						
															</select>
														</div>	
													</div>
													<div class="form_sep">																
														<div class="col-sm-2">
															<label for="bank_name" class="unreq">Bank Name</label>
															<input id="bank_name" name="bank_name" class="form-control" type="text" value="<?php echo $del['bank_name']; ?>">
															<label for="bank_submit" class="double-input-unreq">Bank Submit</label>
															<input id="bank_submit" name="bank_submit" class="form-control" type="text" value="<?php echo $del['bank_submit']; ?>">
														</div>
														<div class="col-sm-2">
															<label for="party_name" class="unreq">Party Name</label>
															<input id="party_name" name="party_name" class="form-control" type="text" value="<?php echo $del['party_name']; ?>">
															<div id="bank_submit_date_value" class="hide"><?php echo $del['bank_submit_date']; ?></div>
															<label for="bank_submit_date" class="double-input-unreq">Bank Submit Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="bank_submit_date" name="bank_submit_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                </div>
														<div class="col-sm-2">
															<div id="submit_party_date_value" class="hide"><?php echo $del['submit_party_date']; ?></div>
															<label for="submit_party_date" class="unreq">Submit Party Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="submit_party_date" name="submit_party_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
															<label for="bank_submit_value" class="double-input-unreq">Bank Submit Value</label>
															<input id="bank_submit_value" name="bank_submit_value" class="form-control" type="text" value="<?php echo $del['bank_submit_value']; ?>">
														</div>													
														<div class="col-sm-2">
															<div id="submit_party_rdate_value" class="hide"><?php echo $del['submit_party_rdate']; ?></div>
															<label for="submit_party_date" class="unreq">Submit Party Receive Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="submit_party_rdate" name="submit_party_rdate" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                    <div id="acc_date_value" class="hide"><?php echo $del['acc_date']; ?></div>
															<label for="acc_date" class="double-input-unreq">Acc. Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="acc_date" name="acc_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                </div>
														<div class="col-sm-2 right">															
														</div>
													</div>
													<div class="form_sep">
														<div class="col-sm-2">
															<div id="purchase_date_value" class="hide"><?php echo $del['purchase_date']; ?></div>
															<label for="purchase_date" class="unreq">Purchase Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="purchase_date" name="purchase_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
										                </div>
														<div class="col-sm-2">
															<label for="purchase_tk" class="unreq">Purchase Tk.</label>
															<input id="purchase_tk" name="purchase_tk" class="form-control" type="text" value="<?php echo $del['purchase_tk']; ?>">
														</div>
														<div class="col-sm-2">
															<div id="due_date_value" class="hide"><?php echo $del['due_date']; ?></div>
															<label for="due_date" class="unreq">Due Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="due_date" name="due_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>																
														<div class="col-sm-2">
															<div id="due_rdate_value" class="hide"><?php echo $del['due_rdate']; ?></div>
															<label for="due_rdate" class="unreq">Due Receive Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="due_rdate" name="due_rdate" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
														</div>
														<div class="col-sm-2 right">
														</div>	
													</div>
													<div class="form_sep">
														<div class="col-sm-12 text-right">	
															<?php
															if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Commercial')) 
			            									{
			            									?>		
															<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>commercial/lcstatements"><span class="icon-double-angle-left"></span> Back</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-sm" id="btn_product_submit" type="submit"><span class="icon-refresh"></span> Update LC Statements</button>
															<?php
															}
															?>
															<br><br><br>
														</div>
													</div>
												</div>	
											</div>
											<?php
											}
											?>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>