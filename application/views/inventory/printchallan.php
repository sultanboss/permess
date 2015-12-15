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
                                                            <?php
                                                            $bs_plist=array();
                                                            foreach($challan_list as $c)
                                                                {
                                                                $s= $c['challan_info'];
                                                                $pp=unserialize($s);
                                                                foreach($pp as $p){
                                                                    array_push($bs_plist,$p);
                                                                    }
                                                                }
                                                            
                                                            ?>
                                                            
								<div class="panel panel-default">
									<div class="panel_controls" style="border-bottom: none; min-height: 350px;">
										<h4 class="heading_a challan_header">Delivery Challans: </h4>
										<div class="clear challan_header"></div>
										<div class="row challan_header">
											<div class="col-sm-12 pad5">
												<table class="table table-hover table-striped table-challan">
													<thead>
														<tr>
															<th>Challan ID</th>
															<th>Challan Date</th>
															<th>Created By</th>
															<th>Change</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$actvar = false;
														foreach ($challan_list as $key => $value) {
														$act = '';
														if($cid == 0 && $actvar == false) {
															$act = 'active';
															$actvar = true;
														}
														else {
															if($cid == $value['challan_id'] &&  $actvar == false) {																
																$act = 'active';
																$actvar = true;
															}
														}
                                                                                                                
                                                                                                                $bs_getvalue=$this->db->get_where('ak_challan',array('challan_id'=>$value['challan_id'],'delivery_id'=>$value['delivery_id']))->result_array();
                                                                                                                $bs_xxx=array();
                                                                                                                foreach($bs_getvalue as $c)
                                                                                                                    {
                                                                                                                    $s= $c['challan_info'];
                                                                                                                    $pp=unserialize($s);
                                                                                                                    $bs_sum=0;
                                                                                                                    foreach($pp as $p){
                                                                                                                                    $bs_sum=$bs_sum+$p['delivery_quantity'];
                                                                                                                                    }
                                                                                                                    }

                                                                                                               ?>
														<tr class="<?php echo $act; ?>">
															<td><?php echo $value['challan_id']; ?><?=($bs_sum<0)?' (Return Challan)':'';?></td>
															<td><?php echo $value['created']; ?></td>
															<td><?php echo $this->factory_model->get_delivery_user($value['editor_id']); ?></td>
															<td><a href="<?php echo base_url(); ?>factory/printchallan/<?php echo $value['delivery_id']; ?>/<?php echo $value['challan_id']; ?>/<?=($bs_sum<0)?'R':'C';?>"><span class="icon-edit"></span></a></td>
														</tr>
														<?php
														$act = '';
														}                                                                                                             
                                                                                                                
                                                                                                                             
														if(count($challan_list) <= 0) {
														?>
														<tr class="active">
															<td class="text-center" colspan="4">No challan records found</td>
														</tr>
														<?php
														}
														?>
													</tbody>
												</table>											
											</div>
										</div>
										<?php 
                                                                                if($report_type=='R')
                                                                                {
 /*----------------------------------------------------------------------------------------*/
											$main_array = array();
											$return_array = array();
										?>
										<h4 class="heading_a challan_header">Return Challan: </h4>
										<div class="clear challan_header"></div>
										<button id="chalan_print" class="btn btn-success btn-sm"><span class="icon-print"></span> Print Return Challan</button>
										<div id="c_print" class="print" style="padding-top:60px;">											
											<h4 class="heading_a text-center underline"><strong>Return Challan</strong></h4>
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
													<p><b>Challan No #</b><?php echo $cid;?></p>
													<p><b>P/I #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php echo date('Y');?></p>
													<p><b>Date:</b> <?php echo date('Y-m-d');?></p>
													<p><b>Contact Person:</b> <?php echo $delivery[0]['delivery_contact_person'];?></p>
													<p><b>Buyer</b> - <?php echo $delivery[0]['delivery_buyer'];?></p>
													<p><b>P/O Number</b> # <?php echo $delivery[0]['delivery_po_no'];?></p>
													<p><b>By:</b> <?php echo $delivery_user;?></p>
													<p><b>Payment</b> - 
													<?php 
													if($delivery[0]['delivery_payment']=='0')
														echo "90 Days LC Payment";
													else
														echo "Cash/Cheque/TT Payment";
													?>
												</div>
												<div class="col-sm-12">
													<p>Style:- <?php echo $delivery[0]['delivery_style'];?></p>
													<p>Remarks:- <?php echo $delivery[0]['delivery_remarks'];?></p>
												</div>
												<div class="col-sm-12">
													<table class="table table-bordered table-print">
														<thead>
															<tr>
																<th class="text-center">Description</th>
																<th class="text-right">Quantity Ordered</th>
																<th class="text-right">Quantity Return</th>
																<th class="text-right">Quantity Pending</th>
															</tr>
														</thead>
														<tbody>
															<?php
                                                                                                                        $psum=0;
															$x = 1;
															$y = count($delivery_products);
															$qty = 0;
															$total = 0;
															$des = '';
															$wid = '';
															$ttl = 0;
															$dqty = 0;
															$qtyp = 0;
															$rc_return=0;
															foreach ($delivery_products as $key => $value) {
															
															if(($des != $value['description_name'] || $wid != $value['width_name']) && ($value['type'] != 'returned')) {
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
															if($value['type'] != 'returned') {																  
															$main_array[] = $value['article_id'].$value['article_alt'].$value['width_id'].$value['softness_id'].$value['color_id'].$value['description_id'];
															?>
															<tr>
																<td class="text-center">
																	Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																</td>
																<td class="text-right">
																<?php 
																	$qo = number_format((float)$value['order_quantity'], 4, '.', ''); 
																	echo $qo;
																?>
																</td>
																<td class="text-right">
																<?php 
																	$qd = number_format((float)(abs($value['delivery_quantity'])), 4, '.', ''); 																	
																	echo $qd;
																	$rc_return=$rc_return+abs($qd);
																?>
																</td>
																<td class="text-right">
																<?php 
                                                                                                                                /*
																	$qd = number_format((float)($value['delivery_quantity']), 4, '.', '');
																	$qp = number_format((float)($qo-$qd), 4, '.', ''); 		
																	echo $qp; 
																	$qtyp = $qtyp + $qp; 
                                                                                                                                 * 
                                                                                                                                 */
                                                                                                                               
                                                                                                                                $deliver=0;
																																
                                                                                                                                $qpd=$this->bs->search($bs_plist,'delivery_product_id',$value['delivery_product_id']);
                                                                                                                                foreach ($qpd as $qpds)
                                                                                                                                {
                                                                                                                                $deliver=$deliver+$qpds['delivery_quantity'];
																																}
                                                                                                                                $sum= ($qo-$deliver);
                                                                                                                                echo number_format($sum, 4, '.', '');
                                                                                                                                $psum=$psum+$sum;
																?>
                                                                                                                                
																</td>
															</tr>
															<?php
															}
															else {
																$return_array[] = $value['article_id'].$value['article_alt'].$value['width_id'].$value['softness_id'].$value['color_id'].$value['description_id'];
															}
																if($value['type'] != 'returned') {
																	$qty = $qty + $value['order_quantity'];
																	$dqty = $dqty + $value['cur_delivery_quantity'];
																}
																$x++;
															}
															?>															
														</tbody>
														<tfoot>
															<tr>
																<td class="text-right"><b>Total:</b></td>
																<td class="text-right"><b><?php echo number_format((float)$qty, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)abs($rc_return), 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$psum, 4, '.', ''); ?></b></td>
															</tr>
														</tfoot>
													</table>
												</div>										
												<div class="col-sm-12">	
													<br>											
													<p><strong class="underline">Notes:</strong></p>
													<br><br><br><br>
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
										<br>
										<br>
										<br>
                                                                                
										<?php
                                                                          
										//$rem_array = array_diff($return_array, $main_array);
                                                                                $rem_array=array();
										if(count($rem_array) > 0) 
                                                                                { 
										?>
										<h4 class="heading_a challan_header">Return Challan: </h4>
										<div class="clear challan_header"></div>
										<button id="chalan_print_return" class="btn btn-success btn-sm"><span class="icon-print"></span> Print Return Challan</button>
										<div id="c_ret_print" class="print">											
											<h4 class="heading_a text-center underline"><strong>Return Challan</strong></h4>
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
													<p><b>Challan No #</b><?php echo $cid;?></p>
													<p><b>P/I #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php echo date('Y');?></p>
													<p><b>Date:</b> <?php echo date('Y-m-d');?></p>
													<p><b>Contact Person:</b> <?php echo $delivery[0]['delivery_contact_person'];?></p>
													<p><b>Buyer</b> - <?php echo $delivery[0]['delivery_buyer'];?></p>
													<p><b>P/O Number</b> # <?php echo $delivery[0]['delivery_po_no'];?></p>
													<p><b>By:</b> <?php echo $delivery_user;?></p>
													<p><b>Payment</b> - 
													<?php 
													if($delivery[0]['delivery_payment']=='0')
														echo "90 Days LC Payment";
													else
														echo "Cash/Cheque/TT Payment";
													?>
												</div>
												<div class="col-sm-12">
													<p>Style:- <?php echo $delivery[0]['delivery_style'];?></p>
													<p>Remarks:- <?php echo $delivery[0]['delivery_remarks'];?></p>
												</div>
												<div class="col-sm-12">
													<table class="table table-bordered table-print">
														<thead>
															<tr>
																<th class="text-center">Description</th>
																<th class="text-right">Quantity Ordered</th>
																<th class="text-right">Quantity Delivered</th>
																<th class="text-right">Quantity Returned</th>
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

															$retAry = $value['article_id'].$value['article_alt'].$value['width_id'].$value['softness_id'].$value['color_id'].$value['description_id'];
															if(in_array($retAry, $rem_array)) {

																if(($des != $value['description_name'] || $wid != $value['width_name']) && ($value['type'] == 'returned')) {
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
																if($value['type'] == 'returned') {
																?>
																<tr>
																	<td class="text-center">
																		Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																	</td>
																	<td class="text-right">
																	<?php 
																		$qo = number_format((float)$value['order_quantity'], 4, '.', ''); 
																		echo $qo;
                                                                                                                                                
																	?>
																	</td>
																	<td class="text-right">
																	<?php 
																		$qd = number_format((float)($value['cur_delivery_quantity']), 4, '.', ''); 																	
																		echo $qd;
																	?>
																	</td>
																	<td class="text-right">
																	<?php 
																		$qd = number_format((float)($value['delivery_quantity']), 4, '.', '');
																		$qp = number_format((float)($qo-$qd), 4, '.', ''); 																	
																		echo $qp;
																	?>
																	</td>
																</tr>
																<?php
																}
																$x++;
																$qty = $qty + $value['order_quantity'];
																$dqty = $dqty + $value['delivery_quantity'];
																$qtyp = $qtyp + ($value['order_quantity'] - $value['delivery_quantity']);
															}
															}
															?>															
														</tbody>
														<tfoot>
															<tr>
																<td class="text-right"><b>Total:</b></td>
																<td class="text-right"><b><?php echo number_format((float)$qty, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$dqty, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$qtyp, 4, '.', ''); ?></b></td>
															</tr>
														</tfoot>
													</table>
												</div>										
												<div class="col-sm-12">	
													<br>											
													<p><strong class="underline">Notes:</strong></p>
													<br><br><br><br>
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
										<?php
										} 
/*-----------------------------------------------------------------------------------------------------------------------------------*/                                                                                
                                                                                    
                                                                                }
                                                                                else{
										if(count($challan_details) > 0)
										{
											$main_array = array();
											$return_array = array();
										?>
										<h4 class="heading_a challan_header">Delivery Challan: </h4>
										<div class="clear challan_header"></div>
										<button id="chalan_print" class="btn btn-success btn-sm"><span class="icon-print"></span> Print Delivery Challan</button>
										<div id="c_print" class="print" style="padding-top:60px;">											
											<h4 class="heading_a text-center underline"><strong>Delivery Challan</strong></h4>
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
													<p><b>Challan No #</b><?php echo $cid;?></p>
													<p><b>P/I #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php echo date('Y');?></p>
													<p><b>Date:</b> <?php echo date('Y-m-d');?></p>
													<p><b>Contact Person:</b> <?php echo $delivery[0]['delivery_contact_person'];?></p>
													<p><b>Buyer</b> - <?php echo $delivery[0]['delivery_buyer'];?></p>
													<p><b>P/O Number</b> # <?php echo $delivery[0]['delivery_po_no'];?></p>
													<p><b>By:</b> <?php echo $delivery_user;?></p>
													<p><b>Payment</b> - 
													<?php 
													if($delivery[0]['delivery_payment']=='0')
														echo "90 Days LC Payment";
													else
														echo "Cash/Cheque/TT Payment";
													?>
												</div>
												<div class="col-sm-12">
													<p>Style:- <?php echo $delivery[0]['delivery_style'];?></p>
													<p>Remarks:- <?php echo $delivery[0]['delivery_remarks'];?></p>
												</div>
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
                                                                                                                        $psum=0;
															$x = 1;
															$y = count($delivery_products);
															$qty = 0;
															$total = 0;
															$des = '';
															$wid = '';
															$ttl = 0;
															$dqty = 0;
															$qtyp = 0;
                                                                                                                        $qdt_deliver=0;
															foreach ($delivery_products as $key => $value) {
															
															if(($des != $value['description_name'] || $wid != $value['width_name']) && ($value['type'] != 'returned')) {
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
															if($value['type'] != 'returned') {																  
															$main_array[] = $value['article_id'].$value['article_alt'].$value['width_id'].$value['softness_id'].$value['color_id'].$value['description_id'];
															?>
															<tr>
																<td class="text-center">
																	Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																</td>
																<td class="text-right">
																<?php 
																	$qo = number_format((float)$value['order_quantity'], 4, '.', ''); 
																	echo $qo;
                                                                                                                                      //  $qdt_deliver=$qdt_deliver+$qo;
																?>
																</td>
																<td class="text-right">
																<?php 
																	$qd = number_format((float)($value['delivery_quantity']), 4, '.', ''); 																	
																	echo $qd;
																?>
																</td>
																<td class="text-right">
																<?php 
                                                                                                                                /*
																	$qd = number_format((float)($value['delivery_quantity']), 4, '.', '');
																	$qp = number_format((float)($qo-$qd), 4, '.', ''); 		
																	echo $qp; 
																	$qtyp = $qtyp + $qp; 
                                                                                                                                 * 
                                                                                                                                 */
                                                                                                                               
                                                                                                                                $deliver=0;
                                                                                                                                $qpd=$this->bs->search($bs_plist,'delivery_product_id',$value['delivery_product_id']);
                                                                                                                                foreach ($qpd as $qpds)
                                                                                                                                {
                                                                                                                                $deliver=$deliver+$qpds['delivery_quantity'];
                                                                                                                                }
                                                                                                                                $sum= ($qo-$deliver);
                                                                                                                                
                                                                                                                                echo number_format($sum, 4, '.', '');
                                                                                                                                $psum=$psum+$sum;
																?>
                                                                                                                                
																</td>
															</tr>
															<?php
															}
															else {
																$return_array[] = $value['article_id'].$value['article_alt'].$value['width_id'].$value['softness_id'].$value['color_id'].$value['description_id'];
															}
																if($value['type'] != 'returned') {
																	$qty = $qty + $value['order_quantity'];
																	$dqty = $dqty + $value['cur_delivery_quantity'];
                                                                                                                                        $qdt_deliver=$qdt_deliver+$value['delivery_quantity'];
																}
																$x++;
															}
															?>															
														</tbody>
														<tfoot>
															<tr>
																<td class="text-right"><b>Total:</b></td>
																<td class="text-right"><b><?php echo number_format((float)$qty, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$qdt_deliver, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$psum, 4, '.', ''); ?></b></td>
															</tr>
														</tfoot>
													</table>
												</div>										
												<div class="col-sm-12">	
													<br>											
													<p><strong class="underline">Notes:</strong></p>
													<br><br><br><br>
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
										<br>
										<br>
										<br>
                                                                                
										<?php
                                                                          
										//$rem_array = array_diff($return_array, $main_array);
                                                                                $rem_array=array();
										if(count($rem_array) > 0) 
                                                                                { 
										?>
										<h4 class="heading_a challan_header">Return Challan: </h4>
										<div class="clear challan_header"></div>
										<button id="chalan_print_return" class="btn btn-success btn-sm"><span class="icon-print"></span> Print Return Challan</button>
										<div id="c_ret_print" class="print">											
											<h4 class="heading_a text-center underline"><strong>Return Challan</strong></h4>
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
													<p><b>Challan No #</b><?php echo $cid;?></p>
													<p><b>P/I #</b> PSEAL/<?php	if($delivery[0]['delivery_pi_name'] != '') { echo $delivery[0]['delivery_pi_name'].'/'; } ?><?php echo $delivery[0]['delivery_id'];?>/<?php echo date('Y');?></p>
													<p><b>Date:</b> <?php echo date('Y-m-d');?></p>
													<p><b>Contact Person:</b> <?php echo $delivery[0]['delivery_contact_person'];?></p>
													<p><b>Buyer</b> - <?php echo $delivery[0]['delivery_buyer'];?></p>
													<p><b>P/O Number</b> # <?php echo $delivery[0]['delivery_po_no'];?></p>
													<p><b>By:</b> <?php echo $delivery_user;?></p>
													<p><b>Payment</b> - 
													<?php 
													if($delivery[0]['delivery_payment']=='0')
														echo "90 Days LC Payment";
													else
														echo "Cash/Cheque/TT Payment";
													?>
												</div>
												<div class="col-sm-12">
													<p>Style:- <?php echo $delivery[0]['delivery_style'];?></p>
													<p>Remarks:- <?php echo $delivery[0]['delivery_remarks'];?></p>
												</div>
												<div class="col-sm-12">
													<table class="table table-bordered table-print">
														<thead>
															<tr>
																<th class="text-center">Description</th>
																<th class="text-right">Quantity Ordered</th>
																<th class="text-right">Quantity Delivered</th>
																<th class="text-right">Quantity Returned</th>
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

															$retAry = $value['article_id'].$value['article_alt'].$value['width_id'].$value['softness_id'].$value['color_id'].$value['description_id'];
															if(in_array($retAry, $rem_array)) {

																if(($des != $value['description_name'] || $wid != $value['width_name']) && ($value['type'] == 'returned')) {
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
																if($value['type'] == 'returned') {
																?>
																<tr>
																	<td class="text-center">
																		Article: <?php echo $value['article_name']; ?>, Color: <?php echo $value['color_name']; ?>, Softness: <?php echo $value['softness_name']; ?>
																	</td>
																	<td class="text-right">
																	<?php 
																		$qo = number_format((float)$value['order_quantity'], 4, '.', ''); 
																		echo $qo;
																	?>
																	</td>
																	<td class="text-right">
																	<?php 
																		$qd = number_format((float)($value['cur_delivery_quantity']), 4, '.', ''); 																	
																		echo $qd;
																	?>
																	</td>
																	<td class="text-right">
																	<?php 
																		$qd = number_format((float)($value['delivery_quantity']), 4, '.', '');
																		$qp = number_format((float)($qo-$qd), 4, '.', ''); 																	
																		echo $qp;
																	?>
																	</td>
																</tr>
																<?php
																}
																$x++;
																$qty = $qty + $value['order_quantity'];
																$dqty = $dqty + $value['delivery_quantity'];
																$qtyp = $qtyp + ($value['order_quantity'] - $value['delivery_quantity']);
															}
															}
															?>															
														</tbody>
														<tfoot>
															<tr>
																<td class="text-right"><b>Total:</b></td>
																<td class="text-right"><b><?php echo number_format((float)$qty, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$dqty, 4, '.', ''); ?></b></td>
																<td class="text-right"><b><?php echo number_format((float)$qtyp, 4, '.', ''); ?></b></td>
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
										<?php
										} 
										}
                                                                                }
										?>
									</div>
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>