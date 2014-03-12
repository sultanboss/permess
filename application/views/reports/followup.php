			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Reports:</h4>
										<div class="row">	
										    <form action="<?php echo base_url(); ?>reports/followup" method="post" id="parsley_addcat">
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
										<h4 class="heading_a">Result:</h4>
										<div class="row">
										&nbsp;
										</div>
									</div>
									<table id="followup_list_table" class="table table-hover">
										<thead>
											<tr>
												<th>Enquiry ID</th>
												<th>Customer Name</th>
												<th>Address</th>
												<th>Phone</th>
												<th>Followup Date</th>
												<th>Followup Time</th>
												<th>Followup Type</th>
												<th>Followup Remarks</th>
												<th>Next Followup Date</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											foreach ($followup as $key => $value) {
												echo "<tr>";
												echo "<td>".$value['enquiry_id']."</td>";
												echo "<td>".$value['enquiry_name']."</td>";
												echo "<td>".$value['enquiry_address']."</td>";
												echo "<td>".$value['enquiry_phone']."</td>";
												echo "<td>".$value['followup_date']."</td>";
												echo "<td>".$value['followup_time']."</td>";
												echo "<td>".$value['parameter_name']."</td>";
												echo "<td>".$value['followup_remarks']."</td>";
												echo "<td>".$value['followup_date_next']."</td>";
												echo "</tr>";
											} 
											?>
										</tbody>				
									</table>									
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>