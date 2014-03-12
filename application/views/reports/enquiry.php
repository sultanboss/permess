			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls bottom-border-no">
										<h4 class="heading_a">Reports:</h4>
										<div class="row">	
										    <form action="<?php echo base_url(); ?>reports/enquiry" method="post" id="parsley_addcat">
											<div class="form_sep">														
												<div class="col-sm-4">
													<div class="input-group date" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                    <input class="form-control" type="text" placeholder="Start date" name="start_date" id="dpStart" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
														<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                </div>													
												</div>
                                                <div class="col-sm-4">
                                                	<div class="input-group date" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
														<input class="form-control" type="text" placeholder="End date" name="end_date" id="dpEnd" data-date-format="dd-mm-yyyy" data-date-autoclose="true">
														<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                </div>	
												</div>									
												<div class="col-sm-3">
													<button class="btn btn-success" type="submit">Submit</button>										
												</div>
											</div>
											</form>
										</div>
										<br/>
									</div>
									<ul class="nav nav-tabs">
										<li class="active"><a data-toggle="tab" href="#tbb_a">List Report</a></li>
										<li><a data-toggle="tab" href="#tbb_b">Product Wise</a></li>
									</ul>
									<div class="tab-content">
										<div id="tbb_a" class="tab-pane active report-tab">
											<table id="report_list_table" class="table table-hover">
												<thead>
													<tr>
														<th>ID</th>
														<th>Date</th>
														<th>Name</th>
														<th>Contact Person</th>
														<th>Source</th>
														<th>Address</th>
														<th>Phone</th>
														<th>Email</th>
														<th>Remarks</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($enquiry as $key => $value) {
														echo "<tr>";
														echo "<td>".$value['enquiry_id']."</td>";
														echo "<td>".$value['enquiry_date']."</td>";
														echo "<td>".$value['enquiry_name']."</td>";
														echo "<td>".$value['enquiry_contact']."</td>";
														echo "<td>".$value['parameter_name']."</td>";
														echo "<td>".$value['enquiry_address']."</td>";
														echo "<td>".$value['enquiry_phone']."</td>";
														echo "<td>".$value['enquiry_email']."</td>";
														echo "<td>".$value['enquiry_remarks']."</td>";
														echo "<td>".$value['amount']." Tk.</td>";
														echo "</tr>";
													} 
													?>
												</tbody>				
											</table>
										</div>
										<div id="tbb_b" class="tab-pane report-tab">
											<table id="report_product_table" class="table table-hover">
												<thead>
													<tr>
														<th>Enquiry ID</th>
														<th>Date</th>
														<th>Name</th>
														<th>Product Name</th>
														<th>Product Category</th>
														<th>Rate</th>
														<th>Qty</th>
														<th>Source</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													foreach ($enquiry_product as $key => $value) {
														echo "<tr>";
														echo "<td>".$value['enquiry_id']."</td>";
														echo "<td>".$value['enquiry_date']."</td>";
														echo "<td>".$value['enquiry_name']."</td>";
														echo "<td>".$value['product_code']."</td>";
														echo "<td>".$value['product_category_name']."</td>";
														echo "<td>".$value['product_rate']."</td>";
														echo "<td>".$value['product_quantity']."</td>";
														echo "<td>".$value['parameter_name']."</td>";
														echo "<td>".$value['product_amount']." Tk.</td>";
														echo "</tr>";
													} 
													?>
												</tbody>				
											</table>										
										</div>
									</div>									
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>