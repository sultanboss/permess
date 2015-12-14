			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="col-sm-4 pull-right top-right-btn">
												<div class="btn-group">
													<a href="<?php echo base_url(); ?>factory/editdelivery/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="Delivery Details">												
													<?php
													if($delivery[0]['delivery_status'] == 0)
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-red"></span>
														<?php
													}
													else if($delivery[0]['delivery_status'] == 2)
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-green"></span>
														<?php
													}
													else
													{
														?>
														<span class="glyphicon glyphicon-th-large largex color-orange"></span>
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
													<a href="javascript:void(0)" class="hint--top" data-hint="Print Invoice"><span class="glyphicon glyphicon-print largex color-green toolbar-active"></span></a>
													<button id="invoice_print" class="btn btn-success btn-sm"><span class="icon-print"></span> Print Invoice</button>
												</div>	
								</div>
								<div class="panel panel-default">
									<div class="panel_controls" style="border-bottom: none;">
										<div class="print">											
											<h4 class="heading_a text-center underline"><strong>Proforma Invoice</strong><?php if($delivery[0]['delivery_revised'] == 1) { echo "- <b>Revised</b>"; } ?></h4>
											<div class="row">											
												<div class="col-sm-4">
													<p>To</p>
													<p style="font-size: 13px;"><b><?php echo $delivery[0]['delivery_company_name'];?></b></p>
													<p><?php echo $delivery[0]['delivery_company_address'];?></p>
													<?php
													if($delivery[0]['delivery_address'] != '') {
													?>
													<br>
													<p><b>Delivery Address:</b></p>
													<p><?php echo $delivery[0]['delivery_address'];?></p>
													<?php } ?>
												</div>
												<div class="col-sm-3">&nbsp;</div>
												<div class="col-sm-5">
													<p><b>P/I #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php echo date('Y');?></p>
													<p><b>Date:</b> <?php echo $delivery[0]['delivery_date'];?></p>
													<p><b>Contact Person:</b> <?php echo $delivery[0]['delivery_contact_person'];?></p>
													<p><b>Buyer</b> - <?php echo $delivery[0]['delivery_buyer'];?></p>
													<p><b>By:</b> <?php echo $delivery_user;?></p>
													<p><b>Payment</b> - 
													<?php 
													if($delivery[0]['delivery_payment']=='0')
														echo "90 Days LC Payment";
													else
														echo "Cash/Cheque/TT Payment";
													?>
												</div>
												<div class="clear text-center"><p>Style:- <?php echo $delivery[0]['delivery_style'];?></p></div>
												<div class="col-sm-12">
													<table class="table table-bordered table-print">
														<thead>
															<tr>
																<th class="text-center">Description</th>
																<th class="text-right">Quantity In (Yards/Meter)</th>
																<th class="text-right">Unit Price USD</th>
																<th class="text-right">Total Amount</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$x = 1;
															$y = count($delivery_products);
															$qty = 0;
															$total = 0;
															$des = '';
															$wid = '';
															$ttl = 0;
															foreach ($delivery_products as $key => $value) {															
															if($des != $value['description_name'] || $wid != $value['width_name']) {
																$des = $value['description_name'];
																$wid = $value['width_name'];
																$ttl = 1;
															}
															else{
																$ttl = 0;
															}

															if($ttl == 1)
															{
															?>
															<tr>
																<td class="text-center"><b><?php echo $des.', Width: '.$wid?></b></td>
																<td></td>
																<td></td>
																<td></td>
															</tr>
															<?php
															}
															?>
															<tr>
																<td class="text-center">
																Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																</td>
																<td class="text-right"><?php echo number_format((float)$value['order_quantity'], 4, '.', ''); ?> (<?php echo $value['mtype']==2?'Meter':'Yards'; ?>)</td>
																<td class="text-right">$ <?php echo number_format((float)($value['unit_price']+$value['over_invoice_unit_price']), 4, '.', ''); ?></td>
																<td class="text-right">$ <?php echo number_format((float)($value['order_quantity']*($value['unit_price']+$value['over_invoice_unit_price'])), 4, '.', ''); ?></td>
															</tr>
															<?php
																$qty = $qty + $value['order_quantity'];
																$total = $total + ($value['order_quantity']*($value['unit_price']+$value['over_invoice_unit_price']));
																$x++;
															}
															?>															
														</tbody>
														<tfoot>
															<tr>
																<td class="text-right"><b>Total:</b></td>
																<td class="text-right"><b><?php echo number_format((float)$qty, 4, '.', ''); ?></b></td>
																<td></td>
																<td class="text-right"><b>$ <?php echo number_format((float)$total, 4, '.', ''); ?></b></td>
															</tr>
														</tfoot>
													</table>
													<p><i><b>Amount in words:</b></i> <span class="upper">us dollar <?php echo $this->tank_auth->convertNumber(number_format((float)$total, 4, '.', '')); ?> only.</span></p>												
												</div>										
												<div class="col-sm-12">													
													<p><strong class="underline">Terms & Conditions:</strong></p>
													<p>* Delivery will be started after 20 days of receiving of the irrevocable of letter of credit.</p>
													<p>* Letter of credit will be opened as per address: Permess South East Asia Ltd. Gorai Industrail Area, Mirzapur, Tangail.</p>
													<br>
													<?php 
													$bank = array('UCBL Principal Branch Motijheel', 'Islami Bank Local Office Branch Motijheel');
													$bank_account = array('000111100092334', '20501020101105016');
													echo '<p><b>Advisin Bank: '.$bank[$delivery[0]['delivery_bank']].'</b></p><p><b>A/C # '.$bank_account[$delivery[0]['delivery_bank']].'</b></p>';
													?>													
													<p class="underline">** L/C Shipment date s/b 15 days plus from the last delivery date.</p>
													<p><b>a)</b> Matutity date to be counted from the date of receipt of goods.</p>
													<p class="double"><b>b) The invoice value must be paid at 90 days sight in US($) by confirmed irrevocable letter of credit on UCBL Principal Branch, Motijheel, Dhaka. Through FDD drawn on Bangladesh Bank in favour of Permess South East Asia LTd.</b></p>
													<p><b>c)</b> Partial delivery / payment allowed.</p>
													<p><b>d)</b> All charges outside of beneficiary's bank are on opener's account.</p>
													<p><b>e)</b> Please insert VAT Registration Certificate Number in the Letter of Credit.</p>
													<p><b>f) UD MUST BE REQUIRED FOR DOCUMENTATION.</b></p>
													<p><b>g) H.S.Code No: <?=$delivery[0]['hs_code'];?></b></p> 
													<p><b>&nbsp;&nbsp;&nbsp;&nbsp;TIN NO: 150-200-5020/Circle-50, Dhaka.</b></p>
													<p><b>&nbsp;&nbsp;&nbsp;&nbsp;Swift # UCBLBDDHPRB</b></p>												
												</div>
												<div class="col-sm-6">
													<i>For Permess South East Asia Ltd.</i>
													<br><br>
													___________________________
													<p>Authorised Signature</p>
													</div>
													<div class="col-sm-6 text-right">
													<i>Accepted by Buyer.</i>
													<br><br>
													___________________________
													<p>Authorised Signature</p>
												</div>
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