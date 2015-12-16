			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Export Issues:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<a href="<?php echo base_url(); ?>commercial/addexpissues" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Export Issue</a>												
											</div>
										</div>
									</div>
									<table id="expissues_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="10%">File. No.</th>
												<th width="10%">Exp. No.</th>
												<th width="15%">Exp. Issue Date</th>
												<th width="20%">Company Name</th>												
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