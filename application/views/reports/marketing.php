			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Marketing Report:</h4>
										<div class="row">	
											<form action="<?php echo base_url(); ?>reports/marketing" method="post" id="parsley_addcat">
												<div class="form_sep">														
													<div class="col-sm-2">
														<div class="input-group date" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
															<input class="form-control" type="text" placeholder="Start date" name="start_date" id="dpStart" data-date-format="yyyy-mm-dd" data-date-autoclose="true" value="<?php echo $start_date; ?>">
															<span class="input-group-addon"><i class="icon-calendar"></i></span>
														</div>													
													</div>
													<div class="col-sm-2">
														<div class="input-group date" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
															<input class="form-control" type="text" placeholder="End date" name="end_date" id="dpEnd" data-date-format="yyyy-mm-dd" data-date-autoclose="true" value="<?php echo $end_date; ?>">
															<span class="input-group-addon"><i class="icon-calendar"></i></span>
														</div>	
													</div>
													<div class="col-sm-2">				
														<select id="delivery_by" name="delivery_by" class="form-control">
														<option value="">All Users</option>
														<?php
														foreach ($normal_users as $key => $value) {
															if($value['id'] == $delivery_by)	
															{						
															?>
															<option value="<?php echo $value['id']; ?>" selected><?php echo $value['fname'].' '.$value['lname']; ?></option>
															<?php	
															}
															else
															{
															?>
															<option value="<?php echo $value['id']; ?>"><?php echo $value['fname'].' '.$value['lname']; ?></option>
															<?php	
															}					
														}																	
														?>				
										                </select>
									                </div>
													<div class="clear"><br></div>						
													<div class="col-sm-12">
														<button class="btn btn-success btn-sm" type="submit"><span class="icon-search"></span> Search Report</button>										
													</div>
												</div>
											</form>
										</div>
										<h4 class="heading_a">Result:</h4>
										<div class="row">
										&nbsp;
										</div>
									</div>
									<table id="report_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="10%">P.I. No.</th>
												<th width="15%">Date</th>
												<th width="20%">Company</th>
												<th width="20%">Order Quantity</th>
												<th width="20%">P.I. Value</th>
												<th width="20%">Over Invoice</th>
												<th width="20%">Total Amount</th>
												<th width="20%">Buyer Order Reference</th>
												<th width="13%">L/C Status</th>
												<th width="13%">Delivery Status</th>
												<th width="12%">Delivery Request</th>	
											</tr>
										</thead>
										<tbody>
											<?php 
											$over = 0;
											$total = 0;
											$qty = 0;
											foreach ($marketing as $key => $value) {

												$over+= floatval($value['over_invoice']);
												$total+= floatval($value['pi_value']);
												$qty+= floatval($value['order_quantity']);

												if($value['delivery_status'] == '0') {
													$value['delivery_status'] = 'Pending';
												}
												else if($value['delivery_status'] == '2') {
													$value['delivery_status'] = 'Complete';
												}
												else {
													$value['delivery_status'] = 'Partial';
												}

												if($value['delivery_lc_status'] == '0') {
													$value['delivery_lc_status'] = 'No';
												}
												else {
													$value['delivery_lc_status'] = 'Yes';
												}

												if($value['delivery_request'] == '0') {
													$value['delivery_request'] = 'Pending';
												}
												else if($value['delivery_request'] == '2') {
													$value['delivery_request'] = 'Complete';
												}
												else {
													$value['delivery_request'] = 'Partial';
												}

												echo "<tr>";
												echo "<td>".$value['delivery_id']."</td>";
												echo "<td>".$value['delivery_date']."</td>";
												echo "<td>".$value['delivery_company_name']."</td>";
												echo "<td>".$value['order_quantity']."</td>";
												echo "<td>".$value['pi_value']."</td>";
												echo "<td>".$value['over_invoice']."</td>";
												echo "<td>".$value['total']."</td>";
												echo "<td>".$value['buyer_order_reference']."</td>";
												echo "<td>".$value['delivery_status']."</td>";	
												echo "<td>".$value['delivery_lc_status']."</td>";
												echo "<td>".$value['delivery_request']."</td>";									} 
											?>
										</tbody>	
										<tfoot>
											<tr>
												<th colspan="2" class="text-right">Total Order Quantity :</th>
												<th><?php echo number_format((float)$qty, 2, '.', '');?></th>
												<th colspan="2" class="text-right">Total Over Invoice :</th>
												<th>$ <?php echo number_format((float)$over, 2, '.', '');?></th>
												<th colspan="4" class="text-right">Total P.I. Value :</th>
												<th>$ <?php echo number_format((float)$total, 2, '.', '');?></th>
											</tr>											
										</tfoot>			
									</table>									
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>