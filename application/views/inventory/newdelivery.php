			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<form method="post" id="parsley_addproduct">
										<div class="panel_controls">
											<h4 class="heading_a">New P.I. No.:</h4>
											<div class="row">
												<div class="col-sm-12">	
													<div class="form_sep">
														<div class="col-sm-2">
															<label for="delivery_pi_no" class="req">P.I. Number</label>
															<input id="delivery_pi_no" name="delivery_pi_no" class="form-control" type="text" disabled="true" placeholder="auto">
										                    <label for="delivery_item_no" class="double-input-unreq">Item No</label>
															<input id="delivery_item_no" name="delivery_item_no" class="form-control" type="text">
														</div>
														<div class="col-sm-2">
															<label for="delivery_date" class="req">Issue Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="delivery_date" name="delivery_date" class="form-control" type="text" data-required="true">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
															<label for="delivery_type" class="req double-input">Delivery Type</label>
															<select id="delivery_type" name="delivery_type" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Local', 'Foreign'), '');
															?>								
															</select>
														</div>
														<div class="col-sm-2">
															<label for="delivery_po_no" class="unreq">P/O Number</label>
															<input id="delivery_po_no" name="delivery_po_no" class="form-control" type="text">
															<label for="delivery_buyer" class="unreq double-input">Buyer</label>
															<input id="delivery_buyer" name="delivery_buyer" class="form-control" type="text">
														</div>																
														<div class="col-sm-2">
															<label for="delivery_by" class="req">By</label>
															<select id="delivery_by" name="delivery_by" class="form-control" data-required="true">
															<?php
															foreach ($normal_users as $key => $value) {							
															?>
																<option value="<?php echo $value['id']; ?>"><?php echo $value['fname'].' '.$value['lname']; ?></option>
															<?php						
															}																	
															?>				
											                </select>
															<label for="delivery_payment" class="req double-input">Payment Method</label>
															<select id="delivery_payment" name="delivery_payment" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('LC Payment', 'Cash Payment'), 0);
															?>
															</select>	
														</div>
														<div class="col-sm-2">
															<label for="delivery_pi_name" class="unreq">P.I. Name</label>
															<input id="delivery_pi_name" name="delivery_pi_name" class="form-control" type="text">	
															<label for="delivery_bank" class="req double-input">Bank Name</label>
															<select id="delivery_bank" name="delivery_bank" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('UCBL Bank', 'Islami Bank'), 0);
															?>
															</select>
														</div>
														<div class="col-sm-2 right">
															<label for="delivery_status" class="req">Delivery Status</label>
															<select id="delivery_status" name="delivery_status" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Pending', 'Partial', 'Complete'), '');
															?>								
															</select>
															<label for="delivery_doc_status" class="req double-input">Document Status</label>
															<select id="delivery_doc_status" name="delivery_doc_status" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('No', 'Yes'), '');
															?>						
															</select>
														</div>	
													</div>
													<div class="form_sep">																
														<div class="col-sm-2">
															<label for="delivery_company_name" class="req">Company Name</label>
															<select id="delivery_company_name" name="delivery_company_name" class="form-control" data-required="true">
																<option value="">Select</option>
															<?php
															foreach ($companies as $key => $value) {							
															?>
																<option value="<?php echo $value['company_name']; ?>"><?php echo $value['company_name']; ?></option>
															<?php						
															}																	
															?>				
											                </select>
															<label for="delivery_contact_person" class="req double-input">Contact Person</label>
															<input id="delivery_contact_person" name="delivery_contact_person" class="form-control" type="text" data-required="true">
														</div>
														<div class="col-sm-2">
															<label for="delivery_company_address" class="req">Company Address</label>
															<textarea id="delivery_company_address" name="delivery_company_address" class="form-control double-text" type="text" data-required="true"></textarea>
														</div>
														<div class="col-sm-2">
															<label for="delivery_address" class="unreq">Delivery Address</label>
															<textarea id="delivery_address" name="delivery_address" class="form-control double-text" type="text"></textarea>
														</div>																										
														<div class="col-sm-2">
															<label for="delivery_style" class="unreq">Style</label>
															<textarea id="delivery_style" name="delivery_style" class="form-control double-text" type="text"></textarea>
														</div>
														<div class="col-sm-2">
															<label for="delivery_commission_status" class="unreq">Commission Status</label>
															<select id="delivery_commission_status" name="delivery_commission_status" class="form-control">
															<?php 
																$this->tank_auth->load_select_options(array('Pending', 'Partial', 'Complete'), 0);
															?>								
															</select>
															<label for="delivery_commission" class="unreq double-input-unreq">Commission Amount ($)</label>
															<input id="delivery_commission" name="delivery_commission" class="form-control" type="text" value="">
														</div>	
														<div class="col-sm-2 right">
															<div id="lc_box">
																<label for="delivery_lc_status" class="req">L.C. Status</label>
																<select id="delivery_lc_status" name="delivery_lc_status" class="form-control" data-required="true">
																<?php 
																	$this->tank_auth->load_select_options(array('No', 'Yes'), '');
																?>								
																</select>
																<div id="lc_date_box">													
																<label for="delivery_lc_date"class="req double-input">L.C. Date</label>
																<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
											                        <input id="delivery_lc_date" name="delivery_lc_date" class="form-control" type="text" data-required="true">
																	<span class="input-group-addon"><i class="icon-calendar"></i></span>
											                    </div>
											                    </div>
										                    </div>
														</div>
													</div>
												</div>	
											</div>
											<p class="heading_a">List of Products:</p>
											<div class="row">	
												<div class="col-sm-12">			
													<table id="delivery_product_table" class="table table-hover table-modal table-striped">
													<thead>
														<tr>
															<th width="">Article</th>
															<th width="">Description</th>
															<th width="">Width</th>
															<th width="">Softness</th>
															<th width="">Color</th>
															<th width="8%">Order Quantity</th>										
															<th width="8%">Delivery Quantity</th>		
															<th width="8%">Unit Price</th>										
															<th width="8%">Net Price</th>			
															<th width="8%">Over Invoice</th>										
															<th width="8%">Net Over Invoice</th>								
														</tr>
													</thead>
													<tbody>	
													</tbody>																		
													</table>
													<button class="btn btn-info btn-sm" id="btn_product_add"><span class="icon-plus"></span></button>
													<button class="btn btn-success btn-sm right" id="btn_product_submit" style="margin-top: 10px; margin-right: 10px;" type="submit"><span class="icon-plus"></span> Submit Delivery</button>
												</div>	
											</div>
										</div>
									</form>
												<table id="eq_add_product_form" style="display: none;">
													<tr>
														<td>
																			<select name="article_id" class="article_id form-control" data-required="true">
																				<?php
																				foreach ($articles as $key => $value) {							
																				?>
																				<option class="<?php if(isset($value['class'])) {echo $value['class'];} ?>" value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																				<?php						
																				}																	
																				?>				
											                                </select>
										                </td>
										                <td>					
																			<select name="description_id" class="description_id form-control" data-required="true">
																				<?php
																				foreach ($descriptions as $key => $value) {							
																				?>
																				<option value="<?php echo $value['description_id']; ?>"><?php echo $value['description_name']; ?></option>
																				<?php						
																				}																	
																				?>				
											                                </select>
										                </td>
										                <td>				
																			<select name="width_id" class="width_id form-control" data-required="true">
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
																			<select name="softness_id" class="softness_id form-control" data-required="true">
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
																			<select name="color_id" class="color_id form-control" data-required="true">
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
																			<input name="order_quantity" class="order_quantity form-control" type="text" placeholder="0" data-required="true">
														</td>
														<td>
																			<input name="delivery_quantity" class="delivery_quantity form-control" type="text" placeholder="0" data-required="true">
														</td>
														<td>
																			<input name="unit_price" class="unit_price form-control" type="text" placeholder="0.00" data-required="true">
														</td>
														<td>
																			<input name="net_price" class="net_price form-control" type="text" placeholder="0.00" disabled="true" data-required="true">
														</td>
														<td>
																			<input name="over_invoice_unit_price" class="over_invoice_unit_price form-control" type="text" placeholder="0.00" data-required="true">
														</td>
														<td>
																			<input name="over_invoice_net_price" class="over_invoice_net_price form-control" type="text" placeholder="0.00" disabled="true" data-required="true">
														</td>
														<td>
																			<button class="eq_add_product_form_remove btn btn-danger btn-sm"><span class="icon-remove"></span></button>
														</td>
													</tr>
												</table>
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>