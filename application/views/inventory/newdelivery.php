			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">New Delivery:</h4>
										<div class="row">
											<div class="col-sm-12">	
												<div class="form_sep">
													<div class="col-sm-3">
														<input type="hidden" id="edit_issue_id" name="edit_issue_id" />
														<label for="edit_issue_date" class="req">Delivery Date</label>
														<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                        <input id="edit_issue_date" name="edit_issue_date" class="form-control" type="text" data-required="true">
															<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                    </div>
													</div>
													<div class="col-sm-3">
														<label for="issue_quantity" class="req">P/I Number</label>
														<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
													</div>																
													<div class="col-sm-3">
														<label for="issue_quantity" class="req">By</label>
														<select id="edit_issue_type" name="edit_issue_type" class="form-control" data-required="true">
														<?php
														foreach ($normal_users as $key => $value) {							
														?>
															<option value="<?php echo $value['id']; ?>"><?php echo $value['fname'].' '.$value['lname']; ?></option>
														<?php						
														}																	
														?>				
										                </select>
													</div>
													<div class="col-sm-3 end">
													</div>
												</div>
												<div class="form_sep">																<div class="col-sm-3">
														<label for="issue_quantity" class="req">Company Name</label>
														<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
														<label for="issue_quantity" class="req double-input">Contact Person</label>
														<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
													</div>
													<div class="col-sm-3">
														<label for="issue_quantity" class="req">Company Address</label>
														<textarea id="issue_quantity" name="issue_quantity" class="form-control double-text" type="text" data-required="true"></textarea>
													</div>
													<div class="col-sm-3">
														<label for="issue_quantity" class="req">Buyer</label>
														<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
														<label for="issue_quantity" class="req double-input">Payment</label>
														<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
													</div>
													<div class="col-sm-2 right">
														<label for="issue_quantity" class="req">L.C. Status</label>
														<select id="edit_issue_type" name="edit_issue_type" class="form-control" data-required="true">
															<option value="">No</option>
															<option value="">Yes</option>							
														</select>
														<label for="issue_quantity" class="req double-input">Delivery Status</label>
														<select id="edit_issue_type" name="edit_issue_type" class="form-control" data-required="true">
															<option value="">Pending</option>
															<option value="">Complete</option>							
														</select>
													</div>
												</div>
											</div>	
										</div>
										<p class="heading_a">List of Products:</p>
										<div class="row">	
											<div class="col-sm-12">			
												<table id="delivery_product_table" class="table table-striped table-hover table-modal">
												<thead>
													<tr>
														<th width="">Article</th>
														<th width="">Construction</th>
														<th width="">Width</th>
														<th width="">Softness</th>
														<th width="">Color</th>
														<th width="">Source</th>
														<th width="">Order Quantity</th>										
														<th width="">Delivery Quantity</th>		
														<th width="">Balance</th>								
													</tr>
												</thead>
												<tbody>	
												</tbody>																		
												</table>
												<button class="btn btn-success btn-sm" id="btn_product_add"><span class="icon-plus"></span> Add Products</button>
												<table id="eq_add_product_form" style="display: none;">
												<tr>
													<td>
																		<select id="article_name" name="article_name" class="form-control" data-required="true">
																			<?php
																			foreach ($articles as $key => $value) {							
																			?>
																			<option value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                </td>
									                <td>					
																		<select id="construction_name" name="construction_name" class="form-control" data-required="true">
																			<?php
																			foreach ($constructions as $key => $value) {							
																			?>
																			<option value="<?php echo $value['construction_id']; ?>"><?php echo $value['construction_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                </td>
									                <td>				
																		<select id="width_name" name="width_name" class="form-control" data-required="true">
																			<?php
																			foreach ($widths as $key => $value) {							
																			?>
																			<option value="<?php echo $value['width_id']; ?>"><?php echo $value['width_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                </td>
									                <td>				
																		<select id="softness_name" name="softness_name" class="form-control" data-required="true">
																			<?php
																			foreach ($softnesses as $key => $value) {							
																			?>
																			<option value="<?php echo $value['softness_id']; ?>"><?php echo $value['softness_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
													</td>
													<td>				
																		<select id="color_name" name="color_name" class="form-control" data-required="true">
																			<?php
																			foreach ($colors as $key => $value) {							
																			?>
																			<option value="<?php echo $value['color_id']; ?>"><?php echo $value['color_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                </td>
									                <td>				
																		<select id="source_name" name="source_name" class="form-control" data-required="true">
																			<?php
																			foreach ($sources as $key => $value) {							
																			?>
																			<option value="<?php echo $value['source_id']; ?>"><?php echo $value['source_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
													</td>
													<td>
																		<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
													</td>
													<td>
																		<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
													</td>
													<td>
																		<input id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
													</td>
													<td>
																		<button class="eq_add_product_form_remove btn btn-danger btn-sm"><span class="icon-remove"></span></button>
													</td>
												</tr>
												</table>
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