			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Sales Report:</h4>
										<div class="row">	
										    <form action="<?php echo base_url(); ?>reports/sales" method="post" id="parsley_addcat">
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
												<th>Name</th>
												<th>P. I. No.</th>
												<th>Issue Date</th>
												<th>LC Date</th>
												<th class="text-right">Amount</th>
												<th class="text-right">Qty</th>
												<th class="text-right">Com.</th>
												<th class="text-right">T. Commi.</th>
												<th>By</th>
												<th class="text-right">Goods Deli.</th>
												<th class="text-right">Yrd/Mtr</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$amount = 0;
											$qty = 0;
											$tcom = 0;
											$done = 0;
											$left = 0;

											foreach ($sales as $key => $value) {
												echo "<tr>";
												echo "<td>".$value['delivery_company_name']."</td>";
												echo "<td>".$value['delivery_id']."</td>";
												echo "<td>".$value['delivery_date']."</td>";
												echo "<td>".$value['delivery_lc_date']."</td>";
												echo "<td align='right'>$ ".$value['delivery_amount']."</td>";
												echo "<td align='right'>".$value['delivery_qty']."</td>";
												echo "<td align='right' style='max-width: 100px;'>".$value['delivery_com']."</td>";
												echo "<td align='right'>$ ".$value['delivery_tcom']."</td>";
												echo "<td>".$value['delivery_by']."</td>";
												echo "<td align='right'>".$value['delivery_done']."</td>";
												echo "<td align='right'>".$value['delivery_left']."</td>";												

												$amount = $amount + $value['delivery_amount'];
												$qty 	= $qty + $value['delivery_qty'];
												$tcom 	= $tcom + $value['delivery_tcom'];
												$done 	= $done + $value['delivery_done'];
												$left 	= $left + $value['delivery_left'];
											} 
											?>
										</tbody>
										<tfoot>
											<tr>
												<th class="text-right">Total sales :</th>
												<th colspan="3"><?php echo count($sales); ?></th>
												<th class="text-right">$ <?php echo number_format((float)$amount, 2, '.', '');?></th>
												<th class="text-right"><?php echo number_format((float)$qty, 2, '.', '');?></th>
												<th class="text-right" colspan="2">$ <?php echo number_format((float)$tcom, 2, '.', '');?></th>
												<th class="text-right" colspan="2"><?php echo number_format((float)$done, 2, '.', '');?></th>
												<th class="text-right"><?php echo number_format((float)$left, 2, '.', '');?></th>
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