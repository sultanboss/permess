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
													<a href="javascript:void(0)" class="hint--top" data-hint="Print Challan"><span class="glyphicon glyphicon-list largex color-green toolbar-active"></span></a>
													<a href="<?php echo base_url(); ?>factory/printdelivery/<?php echo $delivery[0]['delivery_id']; ?>" class="hint--top" data-hint="Print Invoice"><span class="glyphicon glyphicon-print largex color-gray"></span></a>
												</div>	
								</div>
								<div class="panel panel-default">
									<div class="panel_controls" style="border-bottom: none;">
										<h4 class="heading_a">Delivery Challans: </h4>
										<div class="clear"></div>
										<div class="row">
											<div class="col-sm-12 pad5">
											Challan list will goes here. Work on progress.
											</div>
										</div>
										<h4 class="heading_a">Print Challan: </h4>
										<div class="clear"></div>
										<button id="chalan_print" class="btn btn-success btn-sm"><span class="icon-print"></span> Print Challan</button>
										<div class="print">											
											<h4 class="heading_a text-center underline">Delivery Challan</h4>
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
													<p><b>Challan No #</b><?php echo 100+$delivery[0]['delivery_id'];?></p>
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
																<th class="text-right">Quantity Ordered</th>
																<th class="text-right">Quantity Delivered</th>
																<th class="text-right">Quantity Pending</th>
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
															$dqty = 0;
															$qtyp = 0;
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
															</tr>
															<?php
															}
															?>
															<tr>
																<td class="text-center">
																Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																</td>
																<td class="text-right"><?php $qo = number_format((float)$value['order_quantity'], 2, '.', ''); echo $qo; ?></td>
																<td class="text-right"><?php $qd = number_format((float)($value['delivery_quantity']), 2, '.', ''); echo $qd; ?></td>
																<td class="text-right"><?php $qp = number_format((float)($qo-$qd), 2, '.', ''); echo $qp; $qtyp = $qtyp + $qp; ?></td>
															</tr>
															<?php
																$qty = $qty + $value['order_quantity'];
																$dqty = $dqty + $value['delivery_quantity'];
																$x++;
															}
															?>															
														</tbody>
														<tfoot>
															<tr>
																<td class="text-right"><b>Total:</b></td>
																<td class="text-right"><b><?php echo number_format((float)$qty, 2, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$dqty, 2, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$qtyp, 2, '.', ''); ?></b></td>
															</tr>
														</tfoot>
													</table>
												</div>										
												<div class="col-sm-12">	
													<br>											
													<p><strong class="underline">Terms & Conditions:</strong></p>
													<p>* Delivery will be started after 20 days of receiving of the irrevocable of letter of credit.</p>
													<p>* Letter of credit will be opened as per address: Permess South East Asia Ltd. Gorai Industrail Area, Mirzapur, Tangail.</p>
													<br>
												</div>
												<div class="col-sm-6">
													<i>For Permess South East Asia Ltd.</i>
													<br><br>
													___________________________
													<p>Store Officer/Deliver In-charge</p>
												</div>
												<div class="col-sm-6 text-right">
													<i>Authorised by.</i>
													<br><br>
													___________________________
													<p>Authorised Signature</p>
												</div>
												<br><br>
												<div class="col-sm-12 challan-print-table">	
													<table width="100%">
														<tr>
															<td colspan="3" align="center" style="font-weight: bold; text-decoration: underline;">Received the above interlinings in good condition</td>
														</tr>
														<tr>
															<td colspan="2" width="50%">Receipent Name:</td>
															<td rowspan="3">Signature<br>and<br>Seal</td>
														</tr>
														<tr>
															<td colspan="2">Receipent Title:</td>
														</tr>
														<tr>
															<td>Receive Date:</td>
															<td>Receive Time:</td>
														</tr>
													</table>
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