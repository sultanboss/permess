			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-4 pull-right top-right-btn">
												<div class="btn-group">
													<a href="javascript:void(0)" class="hint--top" data-hint="Delivery Details">							
													<?php
													if($delivery[0]['delivery_status'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-red toolbar-active"></span>
														<?php
													}
													else if($delivery[0]['delivery_status'] == 2)
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-green toolbar-active"></span>
														<?php
													}
													else
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-orange toolbar-active"></span>
														<?php
													}
													?>
													</a>
													<?php 
													if($delivery[0]['delivery_payment'] == 0)
													{
													?>
														<a href="<?php echo base_url(); ?>commercial/editlcstatements/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="LC Statements">
														<?php
														if($delivery[0]['delivery_lc_status'] == 0)
														{
															?>
															<span class="glyphicon glyphicon-file largex color-red"></span>
															<?php
														}						
														else
														{
															?>
															<span class="glyphicon glyphicon-file largex color-green"></span>
															<?php
														}
														?>
														</a>
													<?php
													}
													else
													{
													?>
														<a href="<?php echo base_url(); ?>accounts/paymentdetails/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="Payment Details">
														<?php
														if($payment == 0)
														{
															?>
															<span class="glyphicon glyphicon-file largex color-red"></span>
															<?php
														}
														else if($payment == 2)
														{
															?>
															<span class="glyphicon glyphicon-file largex color-green"></span>
															<?php
														}						
														else
														{
															?>
															<span class="glyphicon glyphicon-file largex color-orange"></span>
															<?php
														}
														?>
														</a>
													<?php
													}
													?>
													<a href="<?php echo base_url(); ?>marketing/orderdetails/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="Order Details">
													<?php
													if($delivery[0]['delivery_request'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-red"></span>
														<?php
													}
													else if($delivery[0]['delivery_request'] == 2)
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-green"></span>
														<?php
													}
													else
													{
														?>
														<span class="glyphicon glyphicon-list-alt largex color-orange"></span>
														<?php
													}
													?>
													</a>
													<a href="<?php echo base_url(); ?>factory/printchallan/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Challan"><span class="glyphicon glyphicon-list largex color-gray"></span></a>
													<a href="<?php echo base_url(); ?>factory/printdelivery/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Invoice"><span class="glyphicon glyphicon-print largex color-print"></span></a>
												</div>	
								</div>
								<div class="panel panel-default">
									<form method="post" id="parsley_editproduct">
										<div class="panel_controls">
											<h4 class="heading_a">Update P.I. No.: 
												
											</h4>
											<?php
											foreach ($delivery as $key => $del) {
											?>
											<div class="row">
												<div class="col-sm-12">	
													<div class="form_sep">
														<div class="col-sm-2">
															<label for="delivery_pi_no" class="req">P.I. Number</label>
															<input id="delivery_pi_no" name="delivery_pi_no" class="form-control" type="text" disabled="true" value="<?php echo $del['delivery_id']; ?>">
										                    <label for="delivery_item_no" class="double-input-unreq">Item No</label>
															<input id="delivery_item_no" name="delivery_item_no" class="form-control" type="text" value="<?php echo $del['delivery_item_no']; ?>">
														</div>
														<div class="col-sm-2">
															<div id="delivery_date_value" class="hide"><?php echo $del['delivery_date']; ?></div>
															<label for="delivery_date" class="req">Issue Date</label>
															<div class="input-group date ebro_datepicker" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                        <input id="delivery_date" name="delivery_date" class="form-control" type="text" data-required="true">
																<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                    </div>	
															<label for="delivery_type" class="req double-input">Delivery Type</label>
															<select id="delivery_type" name="delivery_type" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Local', 'Foreign'), $del['delivery_type']);
															?>								
															</select>
														</div>
														<div class="col-sm-2">
															<label for="delivery_po_no" class="unreq">P/O Number</label>
															<input id="delivery_po_no" name="delivery_po_no" class="form-control" type="text" value="<?php echo $del['delivery_po_no']; ?>">
															<label for="delivery_buyer" class="unreq double-input">Buyer</label>
															<input id="delivery_buyer" name="delivery_buyer" class="form-control" type="text" value="<?php echo $del['delivery_buyer']; ?>">
														</div>																
														<div class="col-sm-2">
															<label for="delivery_by" class="req">By</label>
															<select id="delivery_by" name="delivery_by" class="form-control" data-required="true">
															<?php
															foreach ($normal_users as $key => $value) {
																if($value['id'] == $del['delivery_by'])	
																{						
																?>
																<option value="<?php echo $value['id']; ?>" selected><?php echo $value['fname'].' '.$value['lname']; ?></option>
																<?php	
																}
																else
																{
																?>
																<option value="<?php echo $value['id']; ?>"><?php echo $value['fname'].' '.$value['lname']; ?></option>
																<?php	
																}					
															}																	
															?>				
											                </select>
															<label for="delivery_payment" class="req double-input">Payment</label>
															<select id="delivery_payment" name="delivery_payment" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('LC Payment', 'Cash Payment'), $del['delivery_payment']);
															?>
															</select>	
														</div>														
														<div class="col-sm-2">
															<label for="delivery_pi_name" class="unreq">P.I. Name</label>
															<input id="delivery_pi_name" name="delivery_pi_name" class="form-control" type="text" value="<?php echo $del['delivery_pi_name']; ?>">	
															<label for="delivery_bank" class="req double-input">Bank Name</label>
															<select id="delivery_bank" name="delivery_bank" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('UCBL Bank', 'Islami Bank'), $del['delivery_bank']);
															?>
															</select>
														</div>
														<div class="col-sm-2 right">
															<label for="delivery_status" class="req">Delivery Status</label>
															<select id="delivery_status" name="delivery_status" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('Pending', 'Partial', 'Complete'), $del['delivery_status']);
															?>								
															</select>
															<label for="delivery_doc_status" class="req double-input">Document Status</label>
															<select id="delivery_doc_status" name="delivery_doc_status" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('No', 'Yes'), $del['delivery_doc_status']);
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
																if($del['delivery_company_name'] == $value['company_name']) {
																	$cselected = "selected";
																}	
																else {
																	$cselected = "";
																}				
															?>
																<option value="<?php echo $value['company_name']; ?>" <?php echo $cselected; ?>><?php echo $value['company_name']; ?></option>
															<?php						
															}																	
															?>				
											                </select>

															<label for="delivery_contact_person" class="req double-input">Contact Person</label>
															<input id="delivery_contact_person" name="delivery_contact_person" class="form-control" type="text" data-required="true" value="<?php echo $del['delivery_contact_person']; ?>">
														</div>
														<div class="col-sm-2">
															<label for="delivery_company_address" class="req">Company Address</label>
															<textarea id="delivery_company_address" name="delivery_company_address" class="form-control double-text" type="text" data-required="true"><?php echo $del['delivery_company_address']; ?></textarea>
														</div>
														<div class="col-sm-2">
															<label for="delivery_address" class="unreq">Delivery Address</label>
															<textarea id="delivery_address" name="delivery_address" class="form-control double-text" type="text"><?php echo $del['delivery_address']; ?></textarea>
														</div>													
														<div class="col-sm-2">
															<label for="delivery_style" class="unreq">Style</label>
															<input id="delivery_style" name="delivery_style" class="form-control" type="text" value="<?php echo $del['delivery_style']; ?>">
															<label for="delivery_revised" class="unreq double-input-unreq">Revised</label>
															<select id="delivery_revised" name="delivery_revised" class="form-control">
															<?php 
																$this->tank_auth->load_select_options(array('No', 'Yes'), $del['delivery_revised']);
															?>
															</select>	
														</div>		
														<?php
														if(!$this->tank_auth->is_group_member('Commercial')) {
														?>												
														<div class="col-sm-2">
															<label for="delivery_commission_status" class="unreq">Commission Status</label>
															<select id="delivery_commission_status" name="delivery_commission_status" class="form-control">
															<?php 
																$this->tank_auth->load_select_options(array('Pending', 'Partial', 'Complete'), $del['delivery_commission_status']);
															?>								
															</select>
															<label for="delivery_commission" class="unreq double-input-unreq">Commission Amount ($)</label>
															<input id="delivery_commission" name="delivery_commission" class="form-control" type="text" value="<?php echo $del['delivery_commission']; ?>">
														</div>
														<?php
														}
														?>
														<div class="col-sm-2 right">
															<div id="lc_box">
																<label for="delivery_lc_status" class="req">L.C. Status</label>
																<select id="delivery_lc_status" name="delivery_lc_status" class="form-control" data-required="true">
																<?php 
																	$this->tank_auth->load_select_options(array('No', 'Yes'), $del['delivery_lc_status']);
																?>								
																</select>
																<div id="lc_date_box">												
																<div id="delivery_lc_date_value" class="hide"><?php echo $del['delivery_lc_date']; ?></div>
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
											<?php
											}
											?>
											<p class="heading_a">List of Products:</p>
											<div class="row">	
												<div class="col-sm-12">			
													<table id="delivery_product_table" class="table table-striped table-hover table-modal">
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
													<?php
													foreach ($delivery_products as $key => $dp) {
													?>
													<tr>
														<td>
																			<input type="hidden" name="delivery_product_id" id="delivery_product_id" value="<?php echo $dp['delivery_product_id']; ?>">
																			<select name="article_id" class="article_id form-control" data-required="true">
																				<?php
																				foreach ($articles as $key => $value) {	
																					if($value['article_id'] == $dp['article_alt'])
																					{					
																					?>
																					<option class="<?php if(isset($value['class'])) {echo $value['class'];} ?>" value="<?php echo $value['article_id']; ?>" selected><?php echo $value['article_name']; ?></option>
																					<?php
																					}
																					else
																					{
																					?>
																					<option class="<?php if(isset($value['class'])) {echo $value['class'];} ?>" value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																					<?php	
																					}						
																				}																	
																				?>				
											                                </select>
										                </td>
										                <td>					
																			<select name="description_id" class="description_id form-control" data-required="true">
																				<?php
																				foreach ($descriptions as $key => $value) {							
																					if($value['description_id'] == $dp['description_id'])
																					{					
																					?>
																					<option value="<?php echo $value['description_id']; ?>" selected><?php echo $value['description_name']; ?></option>
																					<?php
																					}
																					else
																					{
																					?>
																					<option value="<?php echo $value['description_id']; ?>"><?php echo $value['description_name']; ?></option>
																					<?php	
																					}	
																				}																
																				?>				
											                                </select>
										                </td>
										                <td>				
																			<select name="width_id" class="width_id form-control" data-required="true">
																				<?php
																				foreach ($widths as $key => $value) {							
																					if($value['width_id'] == $dp['width_id'])
																					{					
																					?>
																					<option value="<?php echo $value['width_id']; ?>" selected><?php echo $value['width_name']; ?></option>
																					<?php
																					}
																					else
																					{
																					?>
																					<option value="<?php echo $value['width_id']; ?>"><?php echo $value['width_name']; ?></option>
																					<?php	
																					}							
																				}																	
																				?>				
											                                </select>
										                </td>
										                <td>				
																			<select name="softness_id" class="softness_id form-control" data-required="true">
																				<?php
																				foreach ($softnesses as $key => $value) {							
																					if($value['softness_id'] == $dp['softness_id'])
																					{					
																					?>
																					<option value="<?php echo $value['softness_id']; ?>" selected><?php echo $value['softness_name']; ?></option>
																					<?php
																					}
																					else
																					{
																					?>
																					<option value="<?php echo $value['softness_id']; ?>"><?php echo $value['softness_name']; ?></option>
																					<?php	
																					}
																				}																		
																				?>				
											                                </select>
										                                </div>												
														</td>
														<td>				
																			<select name="color_id" class="color_id form-control" data-required="true">
																				<?php
																				foreach ($colors as $key => $value) {							
																					if($value['color_id'] == $dp['color_id'])
																					{					
																					?>
																					<option value="<?php echo $value['color_id']; ?>" selected><?php echo $value['color_name']; ?></option>
																					<?php
																					}
																					else
																					{
																					?>
																					<option value="<?php echo $value['color_id']; ?>"><?php echo $value['color_name']; ?></option>
																					<?php	
																					}							
																				}																	
																				?>				
											                                </select>
										                </td>
														<td>
																			<input name="order_quantity" value="<?php echo $dp['order_quantity']; ?>" class="order_quantity form-control" type="text" placeholder="0" data-required="true">
														</td>
														<td>
																			<input name="delivery_quantity" value="<?php echo $dp['delivery_quantity']; ?>" class="delivery_quantity form-control" type="text" placeholder="0" data-required="true">
														</td>
														<td>
																			<input name="unit_price" value="<?php echo $dp['unit_price']; ?>" class="unit_price form-control" type="text" placeholder="0.00" data-required="true">
														</td>
														<td>
																			<input name="net_price" value="<?php echo number_format((float)$dp['unit_price'] * $dp['order_quantity'], 2, '.', ''); ?>" class="net_price form-control" type="text" placeholder="0.00" disabled="true" data-required="true">
														</td>
														<td>
																			<input name="over_invoice_unit_price" value="<?php echo $dp['over_invoice_unit_price']; ?>" class="over_invoice_unit_price form-control" type="text" placeholder="0.00" data-required="true">
														</td>
														<td>
																			<input name="over_invoice_net_price" value="<?php echo number_format((float)$dp['over_invoice_unit_price'] * $dp['order_quantity'], 2, '.', ''); ?>" class="over_invoice_net_price form-control" type="text" placeholder="0.00" disabled="true" data-required="true">
														</td>
														<?php
														if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users')) 
		            									{
		            									?>
														<td>
																			<button class="eq_add_product_form_remove btn btn-danger btn-sm"><span class="icon-remove"></span></button>
														</td>
														<?php
														}
														?>
													</tr>
													<?php
													}
													?>
													</tbody>																	
													</table>
													<?php
													if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users')) 
	            									{
	            									?>
													<button class="btn btn-info btn-sm" id="btn_product_add"><span class="icon-plus"></span></button>
													<?php
	            									}
													if(!$this->tank_auth->is_group_member('Users')) 
	            									{
	            									?>
													<button class="btn btn-success btn-sm right" id="btn_product_submit" style="margin-top: 10px; margin-right: 9px;" type="submit"><span class="icon-refresh"></span> Update Delivery</button><a class="btn btn-warning btn-sm right" style="margin-top: 10px; margin-right: 10px;" href="<?php echo base_url();?>factory/delivery"><span class="icon-double-angle-left"></span></a>
													<?php
													}
													?>
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