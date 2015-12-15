			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Address Price:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<button data-toggle="modal" href="#add_address_pricetype" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Address Price</button>												
												<div class="modal fade" id="add_address_pricetype">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add Address Price</h4>
															</div>
															<form action="<?php echo base_url(); ?>addressprice/add" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																	<label for="address_id" class="req">Company Name</label>
																	<select id="address_id" name="address_id" class="form-control" data-required="true">
																		<option value="">Select</option>
																	<?php
																	foreach ($companies as $key => $value) {							
																	?>
																		<option value="<?php echo $value['address_id']; ?>"><?php echo $value['company_name']; ?></option>
																	<?php						
																	}																	
																	?>				
													                </select>
																</div>	
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="article_id" class="req">Article Name</label>
																		<select id="article_id" name="article_id" class="form-control" data-required="true">
																			<option value="">Select</option>
																			<?php
																			foreach ($articles as $key => $value) {							
																			?>
																				<option value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																			<?php						
																			}																	
																			?>				
														                </select>
																	</div>
																	<div class="col-sm-6 end">
																		<label for="price" class="req">Price</label>
																		<input id="price" name="price" class="form-control parsley-validated" type="text" data-required="true">
																	</div>
																</div>				
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Address Price</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<table id="address_pricetable" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="10%">ID</th>
												<th width="30%">Company Name</th>
												<th width="25%">Article Name</th>
												<th width="25%">Price</th>
												<th width="10%">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_address_price">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Address Price</h4>
												</div>
												<form action="<?php echo base_url(); ?>addressprice/edit" method="post" id="parsley_editcat">
												<div class="modal-body">
													<div class="form_sep">
														<input id="edit_address_price_id" name="edit_address_price_id" type="hidden" value="">
														<label for="edit_address_id" class="req">Company Name</label>
														<select id="edit_address_id" name="edit_address_id" class="form-control" data-required="true">
															<option value="">Select</option>
														<?php
														foreach ($companies as $key => $value) {							
														?>
															<option value="<?php echo $value['address_id']; ?>"><?php echo $value['company_name']; ?></option>
														<?php						
														}																	
														?>				
										                </select>
													</div>	
													<div class="form_sep">
														<div class="col-sm-6 start">
															<label for="edit_article_id" class="req">Article Name</label>
															<select id="edit_article_id" name="edit_article_id" class="form-control" data-required="true">
																<option value="">Select</option>
																<?php
																foreach ($articles as $key => $value) {							
																?>
																	<option value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																<?php						
																}																	
																?>				
											                </select>
														</div>
														<div class="col-sm-6 end">
															<label for="edit_price" class="unreq">Price</label>
															<input id="edit_price" name="edit_price" class="form-control parsley-validated" type="text">
														</div>
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