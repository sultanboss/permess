			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">LC Statements:</h4>
										<div class="row">											
											<div class="col-sm-12">
												&nbsp;
											</div>
										</div>
									</div>
									<table id="lcstatements_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="10%">P.I. Issue</th>
												<th width="15%">Date</th>
												<th width="20%">Company</th>
												<th width="15%">Delivery Status</th>
												<th width="15%">L.C. Status</th>
												<th width="15%">Document Status</th>												
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