			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Raw Materials:</h4>
										<div class="row">											
											<div class="col-sm-12">
												<?php
												if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Factory')) 
            									{
            									?>
												<button data-toggle="modal" href="#add_raw_type" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add Raw Material</button>				
												<?php
												}
												else
													echo "&nbsp;";
												?>								
												<div class="modal fade" id="add_raw_type">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add Raw Material</h4>
															</div>
															<form action="<?php echo base_url(); ?>factory/addraw" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="article_name" class="req">Article</label>					
																		<select id="article_name" name="article_name" class="form-control" data-required="true">
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
																		<label for="construction_name" class="req">Construction</label>					
																		<select id="construction_name" name="construction_name" class="form-control" data-required="true">
																			<?php
																			foreach ($constructions as $key => $value) {							
																			?>
																			<option value="<?php echo $value['construction_id']; ?>"><?php echo $value['construction_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>	
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="width_name" class="req">Width</label>					
																		<select id="width_name" name="width_name" class="form-control" data-required="true">
																			<?php
																			foreach ($widths as $key => $value) {							
																			?>
																			<option value="<?php echo $value['width_id']; ?>"><?php echo $value['width_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>
									                                <div class="col-sm-6 end">
																		<label for="softness_name" class="req">Softness</label>					
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
																</div>	
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="color_name" class="req">Color</label>					
																		<select id="color_name" name="color_name" class="form-control" data-required="true">
																			<?php
																			foreach ($colors as $key => $value) {							
																			?>
																			<option value="<?php echo $value['color_id']; ?>"><?php echo $value['color_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>
									                                <div class="col-sm-6 end">
																		<label for="source_name" class="req">Source</label>					
																		<select id="source_name" name="source_name" class="form-control" data-required="true">
																			<?php
																			foreach ($sources as $key => $value) {							
																			?>
																			<option value="<?php echo $value['source_id']; ?>"><?php echo $value['source_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>	
																<div class="form_sep">
																	<div class="col-sm-12 start">
																		<label for="description_name" class="req">Description</label>					
																		<select id="description_name" name="description_name" class="form-control" data-required="true">
																			<?php
																			foreach ($descriptions as $key => $value) {							
																			?>
																			<option value="<?php echo $value['description_id']; ?>"><?php echo $value['description_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>																		
																</div>
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="raw_date" class="req">Import Date</label>
																		<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                                        <input id="raw_date" name="raw_date" class="form-control" type="text" data-required="true">
																			<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                                    </div>
																	</div>
																	<div class="col-sm-6 end">
																		<label for="raw_received_balance" class="req">Received Balance (Yards)</label>
																		<input id="raw_received_balance" name="raw_received_balance" class="form-control" type="text" data-required="true">
																	</div>
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="raw_pi_no" class="req">P.I. No.</label>
																		<input id="raw_pi_no" name="raw_pi_no" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="raw_lc_no" class="req">L.C. No.</label>
																		<input id="raw_lc_no" name="raw_lc_no" class="form-control" type="text" data-required="true">
																		
																	</div>
																</div>																				
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Raw</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<table id="raw_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="">ID</th>
												<th width="">Date</th>
												<th width="">P. I.</th>
												<th width="">L. C.</th>
												<th width="">Article</th>
												<th width="">Construction</th>
												<th width="">Width</th>
												<th width="">Softness</th>
												<th width="">Color</th>
												<th width="">Source</th>
												<th width="">Previous</th>
												<th width="">Received</th>
												<th width="">Total</th>
												<th width="">Change</th>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_raw">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Raw</h4>
												</div>
												<form action="<?php echo base_url(); ?>factory/editraw" method="post" id="parsley_editcat">
												<div class="modal-body">
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<input id="edit_raw_id" name="edit_raw_id" class="form-control" type="hidden" data-required="true">
																		<label for="edit_article_name" class="req">Article</label>					
																		<select id="edit_article_name" name="edit_article_name" class="form-control" data-required="true">
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
																		<label for="edit_construction_name" class="req">Construction</label>					
																		<select id="edit_construction_name" name="edit_construction_name" class="form-control" data-required="true">
																			<?php
																			foreach ($constructions as $key => $value) {							
																			?>
																			<option value="<?php echo $value['construction_id']; ?>"><?php echo $value['construction_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>	
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="edit_width_name" class="req">Width</label>					
																		<select id="edit_width_name" name="edit_width_name" class="form-control" data-required="true">
																			<?php
																			foreach ($widths as $key => $value) {							
																			?>
																			<option value="<?php echo $value['width_id']; ?>"><?php echo $value['width_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>
									                                <div class="col-sm-6 end">
																		<label for="edit_softness_name" class="req">Softness</label>					
																		<select id="edit_softness_name" name="edit_softness_name" class="form-control" data-required="true">
																			<?php
																			foreach ($softnesses as $key => $value) {							
																			?>
																			<option value="<?php echo $value['softness_id']; ?>"><?php echo $value['softness_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>	
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<label for="edit_color_name" class="req">Color</label>					
																		<select id="edit_color_name" name="edit_color_name" class="form-control" data-required="true">
																			<?php
																			foreach ($colors as $key => $value) {							
																			?>
																			<option value="<?php echo $value['color_id']; ?>"><?php echo $value['color_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>
									                                <div class="col-sm-6 end">
																		<label for="edit_source_name" class="req">Source</label>					
																		<select id="edit_source_name" name="edit_source_name" class="form-control" data-required="true">
																			<?php
																			foreach ($sources as $key => $value) {							
																			?>
																			<option value="<?php echo $value['source_id']; ?>"><?php echo $value['source_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>	
																<div class="form_sep">
																	<div class="col-sm-12 start">
																		<label for="edit_description_name" class="req">Description</label>					
																		<select id="edit_description_name" name="edit_description_name" class="form-control" data-required="true">
																			<?php
																			foreach ($descriptions as $key => $value) {							
																			?>
																			<option value="<?php echo $value['description_id']; ?>"><?php echo $value['description_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>																		
																</div>
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="edit_raw_date" class="req">Import Date</label>
																		<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                                        <input id="edit_raw_date" name="edit_raw_date" class="form-control" type="text" data-required="true">
																			<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                                    </div>
																	</div>
																	<div class="col-sm-6 end">
																		<label for="edit_raw_received_balance" class="req">Received Balance (Yards)</label>
																		<input id="edit_raw_received_balance" name="edit_raw_received_balance" class="form-control" type="text" data-required="true">
																	</div>
																</div>	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="edit_raw_pi_no" class="req">P.I. No.</label>
																		<input id="edit_raw_pi_no" name="edit_raw_pi_no" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="edit_raw_lc_no" class="req">L.C. No.</label>
																		<input id="edit_raw_lc_no" name="edit_raw_lc_no" class="form-control" type="text" data-required="true">
																		
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