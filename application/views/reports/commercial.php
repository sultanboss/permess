			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Commercial Report:</h4>
										<div class="row">	
											<form action="<?php echo base_url(); ?>reports/commercial" method="post" id="parsley_addcat">
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
												<th width="20%">L.C. No.</th>
												<th width="20%">L.C. Date</th>
												<th width="20%">Exp. Date.</th>
												<th width="20%">Bank Name</th>
												<th width="20%">Party Name</th>
												<th width="20%">Bank Submit</th>
												<th width="20%">Pur. Date</th>
												<th width="20%">Pur. Tk.</th>
												<th width="15%">Delivery Status</th>
												<th width="15%">L.C. Status</th>
												<th width="15%">Doc. Status</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$lcval = 0;
											$bnval = 0;
											foreach ($commercial as $key => $value) {

												$lcval+= floatval($value['total']);
												$bnval+= floatval($value['bank_submit_value']);

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

												if($value['delivery_doc_status'] == '0') {
													$value['delivery_doc_status'] = 'No';
												}
												else {
													$value['delivery_doc_status'] = 'Yes';
												}

												echo "<tr>";
												echo "<td>".$value['delivery_id']."</td>";
												echo "<td>".$value['delivery_date']."</td>";
												echo "<td>".$value['delivery_company_name']."</td>";
												echo "<td>".$value['lc_no']."</td>";
												echo "<td>".$value['lc_date']."</td>";
												echo "<td>".$value['exp_date']."</td>";
												echo "<td>".$value['bank_name']."</td>";
												echo "<td>".$value['party_name']."</td>";
												echo "<td>".$value['bank_submit_value']."</td>";	
												echo "<td>".$value['purchase_date']."</td>";
												echo "<td>".$value['purchase_tk']."</td>";
												echo "<td>".$value['delivery_status']."</td>";	
												echo "<td>".$value['delivery_lc_status']."</td>";
												echo "<td>".$value['delivery_doc_status']."</td>";									} 
											?>
										</tbody>	
										<tfoot>
											<tr>
												<th colspan="6" class="text-right">Total Bank Submit :</th>
												<th>$ <?php echo number_format((float)$bnval, 2, '.', '');?></th>
												<th colspan="6" class="text-right">Total L.C. Value :</th>
												<th>$ <?php echo number_format((float)$lcval, 2, '.', '');?></th>
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