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
													<?php 
													if($status[0]['delivery_payment'] == 0)
													{
													?>
														<a href="<?php echo base_url(); ?>commercial/editlcstatements/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="LC Statements">
														<?php
														if($status[0]['delivery_lc_status'] == 0)
														{
															?>
															<span class="glyphicon glyphicon-file largex color-red"></span>
															<?php
														}						
														else
														{
															?>
															<span class="glyphicon glyphicon-file largex color-green"></span>
															<?php
														}
														?>
														</a>
													<?php
													}
													else
													{
													?>
														<a href="<?php echo base_url(); ?>accounts/paymentdetails/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Payment Details">
														<?php
														if($payment == 0)
														{
															?>
															<span class="glyphicon glyphicon-file largex color-red"></span>
															<?php
														}
														else if($payment == 2)
														{
															?>
															<span class="glyphicon glyphicon-file largex color-green"></span>
															<?php
														}						
														else
														{
															?>
															<span class="glyphicon glyphicon-file largex color-orange"></span>
															<?php
														}
														?>
														</a>
													<?php
													}
													?>
													<a href="<?php echo base_url(); ?>marketing/orderdetails/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Order Details">
													<?php
													if($status[0]['delivery_request'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-red toolbar-active"></span>
														<?php
													}
													else if($status[0]['delivery_request'] == 2)
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-green toolbar-active"></span>
														<?php
													}
													else
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-orange toolbar-active"></span>
														<?php
													}
													?>
													</a>													
													<a href="<?php echo base_url(); ?>factory/printdelivery/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Invoice"><span class="glyphicon glyphicon-print largex color-print"></span></a>						
												</div>
								</div>
								<div class="panel panel-default">
									<form action="<?php echo base_url(); ?>marketing/editorder" method="post" id="parsley_editcat">
										<div class="panel_controls">
											<h4 class="heading_a">Update Order:</h4>
											<?php
											foreach ($order as $key => $val) {
											?>
											<div class="row">
												<div class="col-sm-12">	
													<div class="form_sep">														
														<div class="col-sm-4">
															<label for="buyer_order_reference" class="unreq">Buyer Order Reference</label>
															<textarea id="buyer_order_reference" name="buyer_order_reference" class="form-control double-text parsley-validated"><?php echo $val['buyer_order_reference']; ?></textarea>
														</div>
														<div class="col-sm-4">
															<label for="delivery_details" class="unreq">Order Details</label>
															<textarea id="delivery_details" name="delivery_details" class="form-control double-text parsley-validated"><?php echo $val['delivery_details']; ?></textarea>
														</div>
														<div class="col-sm-2 right">
															<label for="delivery_id_old" class="req">P.I. Issue</label>
															<input id="delivery_id_old" name="delivery_id_old" class="form-control parsley-validated" disabled="true" data-required="true" type="text" value="<?php echo $val['delivery_id']; ?>">
															<input id="delivery_id" name="delivery_id" type="hidden" value="<?php echo $val['delivery_id']; ?>">
															<label for="delivery_request" class="req double-input">Delivery Request</label>
															<select id="delivery_request" name="delivery_request" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Pending', 'Partial', 'Complete'), $val['delivery_request']);
															?>								
															</select>
														</div>
													</div>													
													<div class="form_sep">
														<div class="col-sm-12 text-right">	
															<?php
															if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Users')) 
			            									{
			            									?>	
			            									<br>	
															<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>marketing/order"><span class="icon-double-angle-left"></span> Back</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-sm" id="btn_product_submit" type="submit"><span class="icon-refresh"></span> Update Order</button>
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