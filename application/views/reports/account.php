			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Account Report:</h4>
										<div class="row">	
											<form action="<?php echo base_url(); ?>reports/account" method="post" id="parsley_addcat">
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
												<th width="20%">P.I. Value</th>
												<th width="20%">Conversion Rate</th>
												<th width="20%">Total Amount</th>
												<th width="20%">Received Amount</th>
												<th width="13%">Delivery Status</th>												
												<th width="13%">Delivery Request</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$pival = 0;
											$total = 0;
											$receive = 0;
											foreach ($account as $key => $value) {

												$pival+= floatval($value['pi_value']);
												$total+= floatval($value['total']);
												$receive+= floatval($value['total_received']);

												if($value['delivery_status'] == '0') {
													$value['delivery_status'] = 'Pending';
												}
												else if($value['delivery_status'] == '2') {
													$value['delivery_status'] = 'Complete';
												}
												else {
													$value['delivery_status'] = 'Partial';
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
												echo "<td>".$value['pi_value']."</td>";
												echo "<td>".$value['usd']."</td>";
												echo "<td>".$value['total']."</td>";
												echo "<td>".$value['total_received']."</td>";
												echo "<td>".$value['delivery_status']."</td>";
												echo "<td>".$value['delivery_request']."</td>";									} 
											?>
										</tbody>	
										<tfoot>
											<tr>
												<th colspan="2" class="text-right">Total P.I. Value :</th>
												<th>$ <?php echo number_format((float)$pival, 2, '.', '');?></th>
												<th colspan="2" class="text-right">Total Amount :</th>
												<th>$ <?php echo number_format((float)$total, 2, '.', '');?></th>
												<th colspan="2" class="text-right">Total Received :</th>
												<th>$ <?php echo number_format((float)$receive, 2, '.', '');?></th>
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