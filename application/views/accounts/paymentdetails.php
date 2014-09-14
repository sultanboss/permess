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
													<a href="<?php echo base_url(); ?>accounts/paymentdetails/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Payment Details">
													<?php
													if($payment[0]['bill_payment_status'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-file largex color-red toolbar-active"></span>
														<?php
													}
													else if($payment[0]['bill_payment_status'] == 2)
													{
														?>
														<span title="LC Status" class="glyphicon glyphicon-file largex color-green toolbar-active"></span>
														<?php
													}
													else
													{
														?>
														<span title="LC Status" class="glyphicon glyphicon-file largex color-orange toolbar-active"></span>
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
													<a href="<?php echo base_url(); ?>factory/printdelivery/<?php echo $status[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Invoice"><span class="glyphicon glyphicon-print largex color-print"></span></a>						
												</div>
								</div>
								<div class="panel panel-default noprint">
									<form action="<?php echo base_url(); ?>accounts/editpayment" method="post" id="parsley_editcat">
										<div class="panel_controls">
											<h4 class="heading_a">Update Cash/Cheque/TT Payment:</h4>
											<div class="row">
												<?php
												foreach ($payment as $key => $value) {
												?>
												<div class="col-sm-12">	
													<div class="form_sep">
														<div class="col-sm-2">
															<input type="hidden" name="delivery_id" id="delivery_id" value="<?php echo $value['delivery_id']; ?>" />
															<label for="delivery_pi_no" class="req">P.I. Number</label>
															<input id="delivery_pi_no" name="delivery_pi_no" class="form-control" type="text" disabled="true" value="<?php echo $value['delivery_id']; ?>">
										                    <label for="bill_from" class="req double-input">From</label>
															<select id="bill_from" name="bill_from" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_division_select_options($value['bill_from']);
															?>									
															</select>
														</div>
														<div class="col-sm-2">
															<label for="bill_id" class="unreq">Bill No.</label>
															<input id="bill_id" name="bill_id" class="form-control" type="text" value="<?php echo $value['bill_id']; ?>" disabled="true">			<label for="bill_to" class="req double-input">To</label>
															<select id="bill_to" name="bill_to" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_division_select_options($value['bill_to']);
															?>								
															</select>
														</div>
														<div class="col-sm-2">
															<div id="bill_date_value" class="hide"><?php echo $value['bill_date']; ?></div>
															<label for="bill_date" class="req">Billing Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="bill_date" name="bill_date" class="form-control" type="text" data-required="true">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
															<label for="bill_usd_rate" class="unreq double-input-unreq">USD $1 = ? (BDT)</label>
															<input id="bill_usd_rate" name="bill_usd_rate" class="form-control" type="text" value="<?php echo $value['bill_usd_rate']; ?>">
														</div>																
														<div class="col-sm-2">
															<label for="bill_challan" class="unreq">Challan Info <small>(With Date)</small></label>
															<textarea id="bill_challan" name="bill_challan" class="form-control double-text" type="text"><?php echo $value['bill_challan']; ?></textarea>
														</div>
														<div class="col-sm-2 right">
															<label for="bill_payment_status" class="req">Payment Status</label>
															<select id="bill_payment_status" name="bill_payment_status" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Due', 'Partial', 'Paid'), $value['bill_payment_status']);
															?>									
															</select>
															<label for="bill_payment_method" class="req double-input">Payment Method</label>
															<select id="bill_payment_method" name="bill_payment_method" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Cash', 'Cheque', 'TT'), $value['bill_payment_method']);
															?>						
															</select>
														</div>	
													</div>	
													<div class="form_sep">
														<div class="col-sm-2">
															<label for="bill_mr_no">MR No.</label>
															<input id="bill_mr_no" name="bill_mr_no" class="form-control" type="text" value="<?php echo $value['bill_mr_no']; ?>">
														</div>
														<div class="col-sm-2">
															<div id="bill_mr_date_value" class="hide"><?php echo $value['bill_mr_date']; ?></div>
															<label for="bill_mr_date">MR Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="bill_mr_date" name="bill_mr_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
										                </div>
														<div class="col-sm-2">
															<label for="bill_cheque_no">Cheque No.</label>
															<input id="bill_cheque_no" name="bill_cheque_no" class="form-control" type="text" value="<?php echo $value['bill_cheque_no']; ?>">
														</div>
														<div class="col-sm-2">
															<div id="bill_cheque_date_value" class="hide"><?php echo $value['bill_cheque_date']; ?></div>
															<label for="bill_cheque_date">Cheque Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="bill_cheque_date" name="bill_cheque_date" class="form-control" type="text">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>
										                </div>
													</div>
												<?php
												}
												?>
													<div class="form_sep">
														<div class="col-sm-12 text-right">	
															<?php
															if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Accounts')) 
			            									{
			            									?>		
															<a class="btn btn-warning btn-sm" href="<?php echo base_url();?>accounts/cashpayment"><span class="icon-double-angle-left"></span> Back</a>&nbsp;&nbsp;&nbsp;<button class="btn btn-success btn-sm" id="btn_product_submit"  type="submit"><span class="icon-refresh"></span> Update Payment</button>
															<?php
															}
															?>
															<br><br><br>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
								<div style="margin-top: 50px;">
									<div class="col-sm-4 pull-right top-right-btn">	
										<div class="btn-group">	
											<a id="invoice_print" href="javascript:void(0)" class="hint--top" data-hint="Print Cash Bill"><span class="glyphicon glyphicon-print largex color-blue toolbar-active"></span></a>
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel_controls">
										<div class="print">
											<h4 class="heading_a text-center underline">Cash Bill</h4>
											<div class="row">											
												<div class="col-sm-4">
													<p>PROFORMANCE INVOICE OF INTERLINING</p>
													<p><b>From: </b>
													<?php 
														if($payment[0]['bill_from'] != '') {
															$this->tank_auth->load_division_name($payment[0]['bill_from']);
														}
														else
															echo "-";
													?>
													 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>To: </b>
													<?php 
														if($payment[0]['bill_to'] != '') {
															$this->tank_auth->load_division_name($payment[0]['bill_to']);
														}
														else
															echo "-";
													?>
													  <small>(On or Abroad)</small></p>
													<br>
													<p>Name of Customer:</p>
													<p style="font-size: 13px;"><b><?php echo $delivery[0]['delivery_company_name'];?></b></p>
													<p><?php echo $delivery[0]['delivery_company_address'];?></p>
													<?php
													if($delivery[0]['delivery_address'] != '') {
													?>
													<br>
													<p><b>Delivery Address:</b></p>
													<p><?php echo $delivery[0]['delivery_address'];?></p>
													<?php } ?>
												</div>
												<div class="col-sm-3">&nbsp;</div>
												<div class="col-sm-5">
													<p><b>Bill Date:</b>
													<?php 
														if($payment[0]['bill_date'] != '0000-00-00') {
															echo $payment[0]['bill_date'];
														}
														else
															echo "-";
													?>
													</p>
													<p><b>Purchase Order/Contract By:</b> <?php echo $delivery[0]['delivery_contact_person'];?></p>
													<p><b>P/I #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php echo date('Y');?>, <b>Date:</b> <?php echo $delivery[0]['delivery_date'];?></p>
													<p><b>Bill #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php 
														if($payment[0]['bill_id'] != '') {
															echo $payment[0]['bill_id'];
														}
														else
															echo "-";
													?>/04/<?php echo date('Y');?>, <b>Date:</b>
													<?php 
														if($payment[0]['bill_date'] != '0000-00-00') {
															echo $payment[0]['bill_date'];
														}
														else
															echo "-";
													?>
													</p>
													
													<p><b>By:</b> <?php echo $delivery_user;?></p>												
												</div>
												<div class="clear"></div>											
												<div class="col-sm-12">
													<br>
													<p><b>Payment Method: By 
													<?php 
														$this->tank_auth->load_option_name(array('Cash', 'Cheque', 'TT'), $payment[0]['bill_payment_method']);
													?>
													</b></p>
												</div>
												<div class="col-sm-12">
													<table class="table table-bordered table-print">
														<thead>
															<tr>
																<th class="text-center" width="40%">Description</th>
																<th class="text-center" width="20%">Challan No. <small>(With Date)</small></th>
																<th class="text-right" width="10%">Quantity In Yards</th>
																<th class="text-right" width="10%">Unit Price USD</th>
																<th class="text-right" width="15%">Total Amount</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$total_row = count($delivery_products)-1;															
															$des = '';
															$wid = '';
															foreach ($delivery_products as $key => $value) {
																if($des != $value['description_name'] || $wid != $value['width_name']) {
																	$des = $value['description_name'];
																	$wid = $value['width_name'];
																	$total_row++;
																}
															}

															$x = 1;
															$y = count($delivery_products);
															$qty = 0;
															$total = 0;
															$des = '';
															$wid = '';
															$ttl = 0;
															foreach ($delivery_products as $key => $value) {
															if($des != $value['description_name'] || $wid != $value['width_name']) {
																$des = $value['description_name'];
																$wid = $value['width_name'];
																$ttl = 1;
																$x++;
																$y++;
															}
															else{
																$ttl = 0;
															}

															if($ttl == 1)
															{
															?>
															<tr>
																<td class="text-center"><b><?php echo $des.', Width: '.$wid?></b></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<?php
															}
															?>
															<tr>
																<td class="text-center">
																Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																</td>
																<?php
																if($x == 2)
																{
																?>
																<td style="vertical-align: middle;" class="text-center double" rowspan="<?php echo $total_row; ?>"><b>
																<?php 
																	if($payment[0]['bill_challan'] != '') {
																		echo nl2br($payment[0]['bill_challan']);
																	}
																	else
																		echo "-";
																?>	
																</b></td>
																<?php
																}
																?>
																<td class="text-right"><?php echo number_format((float)$value['order_quantity'], 2, '.', ''); ?></td>
																<td class="text-right">$ <?php echo number_format((float)($value['unit_price']+$value['over_invoice_unit_price']), 2, '.', ''); ?></td>
																<td class="text-right">$ <?php echo number_format((float)($value['order_quantity']*($value['unit_price']+$value['over_invoice_unit_price'])), 2, '.', ''); ?></td>
															</tr>
															<?php
																$qty = $qty + $value['order_quantity'];
																$total = $total + ($value['order_quantity']*($value['unit_price']+$value['over_invoice_unit_price']));
																$x++;
															}
															?>															
														</tbody>
														<tfoot>
															<td class="text-right"><b>Total:</b></td>
															<td></td>
															<td class="text-right"><b><?php echo number_format((float)$qty, 2, '.', ''); ?></b></td>
															<td></td>
															<td class="text-right"><b>$ <?php echo number_format((float)$total, 2, '.', ''); ?></b></td>
														</tfoot>
													</table>													
												</div>
												<div class="col-sm-12">
													<p><p><i><b>Amount in Words:</b></i> <span class="upper">us dollar
													<?php
														echo $this->tank_auth->convertNumber(number_format((float)$total, 2, '.', ''));
													?> only.</span></p></p>
												</div>
												<div class="col-sm-12">
													<br>
													<p><b>Payment will be made by local currency - BDT: 
													<?php 
														if($payment[0]['bill_usd_rate'] != '0.00') {
															echo number_format((float)($payment[0]['bill_usd_rate']*$total), 2, '.', '');
														}
														else
															echo "-";
													?>
													 Taka
													</p>
													<p>In-Words: <span class="upper">
													<?php 
														if($payment[0]['bill_usd_rate'] != '0.00') {
															echo $this->tank_auth->convertNumber(number_format((float)($payment[0]['bill_usd_rate']*$total), 2, '.', ''));
														}
														else
															echo "-";
													?>
													 TAKA ONLY.</span>
													</p>
													<p>Note: USD $1 = 
													<?php 
														if($payment[0]['bill_usd_rate'] != '0.00') {
															echo $payment[0]['bill_usd_rate'];
														}
														else
															echo "-";
													?>
													 Taka</b></p>											
												</div>
												<div class="col-sm-4">
													<br>
													<i>For on behalf of</i><br>
													Permess South East Asia Ltd.
													<br><br><br>
													___________________________
													<p>Authorised Signature</p>
												</div>
												<div class="col-sm-4 text-center">
													<br><br>
													<i>Issued by.</i>
													<br><br><br><br>
													___________________________
													<p>Authorised Signature</p>
												</div>
												<div class="col-sm-4 text-right">
													<br><br>
													<i>Accepted by.</i>
													<br><br><br><br>
													___________________________
													<p>Authorised Signature</p>
												</div>
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