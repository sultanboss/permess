			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Cash / Cheque / TT Payments:</h4>
										<div class="row">											
											<div class="col-sm-12">
												&nbsp;
											</div>
										</div>
									</div>
									<table id="cashpayment_table" class="table table-hover table-striped">
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
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>