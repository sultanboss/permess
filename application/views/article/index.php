			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Articles:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<button data-toggle="modal" href="#add_article_type" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Article</button>												
												<div class="modal fade" id="add_article_type">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add Article</h4>
															</div>
															<form action="<?php echo base_url(); ?>article/add" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																<label for="article_name" class="req">Article Name</label>
																	<input id="article_name" name="article_name" class="form-control parsley-validated" data-required="true" type="text">
																</div>						
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Article</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<table id="article_table" class="table table-hover">
										<thead>
											<tr>
												<th width="10%">ID</th>
												<th width="40%">Article Name</th>
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_article">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Article</h4>
												</div>
												<form action="<?php echo base_url(); ?>article/edit" method="post" id="parsley_editcat">
												<div class="modal-body">
													<div class="form_sep">
													<label for="article_name" class="req">Article Name</label>
														<input id="edit_article_name" name="article_name" class="form-control parsley-validated" data-required="true" type="text">
														<input id="edit_article_id" name="article_id" type="hidden" value="">
													</div>							
													<div class="form_sep text-right">
														<button class="btn btn-success btn-sm" type="submit"><span class="icon-refresh"></span> Update</button>
													</div>						
												</div>																
												</form>	
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