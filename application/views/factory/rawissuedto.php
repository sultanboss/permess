			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Raw Materials: 
										<div class="top-right-header right">
											<a href="<?php echo base_url();?>factory/import" class="btn btn-warning btn-sm hint--top" data-hint="Back to Import"><span class="icon-double-angle-left"></span></a>
											<?php
											if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Factory')) {
											?>
											<a href="<?php echo base_url();?>factory/deleteraw/<?php echo $raw[0]['raw_id'];?>" class="btn btn-danger btn-sm hint--top bootbox_confirm" data-hint="Remove"><span class="icon-trash"></span></a>
											<?php
											}
											?>
										</div>
										</h4>
										<div class="clear"></div>
										<div class="row">
											<div class="col-sm-12 pad5">	
												<?php
												$raw_id = 0;
												foreach ($raw as $key => $value) 
												{
													$raw_id = $value['raw_id'];
													?>										
													<div class="col-sm-1"><strong>Article:</strong></div>
													<div class="col-sm-3"><?php echo $value['article_name']; ?></div>
													<div class="col-sm-1"><strong>Width:</strong> </div>
													<div class="col-sm-3"><?php echo $value['width_name']; ?></div>
													<div class="col-sm-1"><strong>Color:</strong> </div>
													<div class="col-sm-3"><?php echo $value['color_name']; ?></div>
													<div class="col-sm-1"><strong>Construction:</strong> </div>
													<div class="col-sm-3"><?php echo $value['construction_name']; ?></div>
													<div class="col-sm-1"><strong>Softness:</strong> </div>
													<div class="col-sm-3"><?php echo $value['softness_name']; ?></div>
													<div class="col-sm-1"><strong>Source:</strong> </div>
													<div class="col-sm-3"><?php echo $value['source_name']; ?></div>
													<div class="col-sm-1"><strong>Description:</strong> </div>
													<div class="col-sm-3"><?php echo $value['description_name']; ?></div>
													<div class="col-sm-12">&nbsp;</div>
													<div class="col-sm-1"><strong>Date:</strong> </div>
													<div class="col-sm-3"><?php echo $value['raw_date']; ?></div>
													<div class="col-sm-1"><strong>P. I. No:</strong> </div>
													<div class="col-sm-3"><?php echo $value['raw_pi_no']; ?></div>
													<div class="col-sm-1"><strong>Status:</strong> </div>
													<div class="col-sm-3">
													<?php
													if($total_issued == 0)
													{
														?>
														<span class="icon-remove icon-2x icon-border color-red"></span>
														<?php
													}
													else if($total_issued == $value['raw_received_balance'])
													{
														?>
														<span class="icon-ok-circle icon-2x icon-border color-green"></span>
														<?php
													}
													else
													{
														?>
														<span class="icon-exclamation-sign icon-2x icon-border color-orange"></span>
														<?php
													}
													?>	
													</div>
													<div class="col-sm-1"><strong>Received:</strong> </div>
													<div class="col-sm-3"><?php echo $value['raw_received_balance']; ?> Yards.</div>
													<div class="col-sm-1"><strong>L. C. No:</strong> </div>
													<div class="col-sm-3"><?php echo $value['raw_lc_no']; ?></div>
												<?php 
												}
												?>
											</div>	
										</div>
										<p class="heading_a">Issued To:</p>
										<div class="row">				
											<div class="col-sm-12">
												<?php
												if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Factory')) 
            									{
            									?>
												<button data-toggle="modal" href="#add_rawissue_type" class="btn btn-success btn-sm right"><span class="icon-plus"></span> Add New Issue</button>												
												<?php
												}
												else
													echo "&nbsp;";
												?>	
												<div class="modal fade" id="add_rawissue_type">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Add New Issue</h4>
															</div>
															<form action="<?php echo base_url(); ?>factory/addrawissuedto/<?php echo $raw_id; ?>" method="post" id="parsley_addcat">
															<div class="modal-body">
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<input type="hidden" name="raw_id" value="<?php echo $raw_id; ?>" />
																		<label for="issue_date" class="req">Issue Date</label>
																		<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                                        <input id="issue_date" name="issue_date" class="form-control" type="text" data-required="true">
																			<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                                    </div>
																	</div>
									                                <div class="col-sm-6 end">
																		<label for="issue_type" class="req">Issue Type</label>					
																		<select id="issue_type" name="issue_type" class="form-control" data-required="true">
																			<?php
																			foreach ($issue_types as $key => $value) {							
																			?>
																			<option value="<?php echo $value['issue_type_id']; ?>"><?php echo $value['issue_type_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>																	
																<div class="form_sep">																	
																	<div class="col-sm-6 start">
																		<label for="issue_quantity" class="req">Quantity</label>
																		<input id="issue_quantity" id="issue_quantity" name="issue_quantity" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="total_finish_goods" class="req">Total Finished Goods</label>
																		<input id="total_finish_goods" name="total_finish_goods" class="form-control" type="text" data-required="true">
																	</div>
																</div>	
																<div class="form_sep">	
																	<div class="col-sm-12 start">
																		<label for="wastage_detail" class="unreq">Wastage Detail <small id="add_waste">(Enter reason if wastage > 0.5%)</small></label>
																		<textarea id="wastage_detail" name="wastage_detail" class="form-control"></textarea>
																	</div>
																</div>																			
																<div class="form_sep text-right">
																	<button class="btn btn-success btn-sm" type="submit"><span class="icon-plus"></span> Add Issue</button>
																</div>						
															</div>																
															</form>	
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div id="raw_issue_raw_id" style="display: none;"><?php echo $raw_id; ?></div>
									<table id="raw_issue_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="">ID</th>
												<th width="">Issue Date</th>
												<th width="">Issue To</th>
												<th width="">Quantity</th>
												<th width="">Total Finished Goods</th>
												<th width="">Wastage</th>
												<?php
												if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Factory')) 
            									{
            									?>
												<th width="">Change</th>
												<?php
												}
												?>
												<tfoot>
									                <tr>
									                    <th>Total:</th> 
									                    <th></th>
									                    <th></th>
									                    <th></th>
									                    <th></th>
									                    <th></th>
									                    <?php
														if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Factory')) 
		            									{
		            									?>
									                    <th></th>
									                    <?php
														}
														?>
									                </tr>
									            </tfoot>
											</tr>
										</thead>
										<tbody></tbody>				
									</table>
									<div class="modal fade" id="edit_rawissue_type">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Edit Raw</h4>
												</div>
												<form action="<?php echo base_url(); ?>factory/editrawissuedto/<?php echo $raw_id; ?>" method="post" id="parsley_editcat">
												<div class="modal-body">
																<div class="form_sep">
																	<div class="col-sm-6 start">
																		<input type="hidden" id="edit_issue_id" name="edit_issue_id" />
																		<label for="edit_issue_date" class="req">Issue Date</label>
																		<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
									                                        <input id="edit_issue_date" name="edit_issue_date" class="form-control" type="text" data-required="true">
																			<span class="input-group-addon"><i class="icon-calendar"></i></span>
									                                    </div>
																	</div>
									                                <div class="col-sm-6 end">
																		<label for="edit_issue_type" class="req">Issue Type</label>					
																		<select id="edit_issue_type" name="edit_issue_type" class="form-control" data-required="true">
																			<?php
																			foreach ($issue_types as $key => $value) {							
																			?>
																			<option value="<?php echo $value['issue_type_id']; ?>"><?php echo $value['issue_type_name']; ?></option>
																			<?php						
																			}																	
																			?>				
										                                </select>
									                                </div>												
																</div>																	
																<div class="form_sep">																
																	<div class="col-sm-6 start">
																		<label for="edit_issue_quantity" class="req">Quantity</label>
																		<input id="edit_issue_quantity" name="edit_issue_quantity" class="form-control" type="text" data-required="true">
																	</div>
																	<div class="col-sm-6 end">
																		<label for="edit_total_finish_goods" class="req">Total Finished Goods</label>
																		<input id="edit_total_finish_goods" name="edit_total_finish_goods" class="form-control" type="text" data-required="true">
																	</div>
																</div>	
																<div class="form_sep">	
																	<div class="col-sm-12 start">
																		<label for="edit_wastage_detail" class="unreq">Wastage Detail <small id="edit_waste">(Enter reason if wastage > 0.5%)</small></label>
																		<textarea id="edit_wastage_detail" name="edit_wastage_detail" class="form-control"></textarea>
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