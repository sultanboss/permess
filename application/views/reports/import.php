			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Imports Report:</h4>
										<div class="row">	
										    <form action="<?php echo base_url(); ?>reports/import" method="post" id="parsley_addcat">
												<div class="form_sep">														
													<div class="col-sm-2">
														<div class="input-group date" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
										                    <input class="form-control" type="text" placeholder="Start date" name="start_date" id="dpStart" data-date-format="yyyy-mm-dd" data-date-autoclose="true" value="<?php echo $start_date; ?>">
															<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                </div>													
													</div>
	                                                <div class="col-sm-2">
	                                                	<div class="input-group date" data-date-format="yyyy-mm-dd" data-date-autoclose="true">
															<input class="form-control" type="text" placeholder="End date" name="end_date" id="dpEnd" data-date-format="yyyy-mm-dd" data-date-autoclose="true" value="<?php echo $end_date; ?>">
															<span class="input-group-addon"><i class="icon-calendar"></i></span>
										                </div>	
													</div>	
													<div class="col-sm-2">
	                                                	<select id="type" name="type" class="form-control" data-required="true">
															<?php 
																$this->tank_auth->load_select_options(array('All Products', 'Single Product'), $type);
															?>						
														</select>	
													</div>													
													<div class="clear"><br/></div>	
													<div id="single">
														<div class="col-sm-2">				
															<select id="article_name" name="article_name" class="form-control" data-required="true">
															<?php
																foreach ($articles as $key => $value) {	
																if($value['article_id'] == $article_name) {					
																?>
																	<option selected="true" value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																<?php
																}
																else {
																	?>
																	<option value="<?php echo $value['article_id']; ?>"><?php echo $value['article_name']; ?></option>
																	<?php
																}						
																}																	
															?>
															</select>
										                </div>
										                <div class="col-sm-2">				
															<select id="construction_name" name="construction_name" class="form-control" data-required="true">
															<?php
																foreach ($constructions as $key => $value) {
																if($value['construction_id'] == $construction_name) {					
																?>
																	<option selected="true" value="<?php echo $value['construction_id']; ?>"><?php echo $value['construction_name']; ?></option>
																<?php
																}
																else {
																	?>
																	<option value="<?php echo $value['construction_id']; ?>"><?php echo $value['construction_name']; ?></option>
																	<?php
																}							
																}																	
															?>				
											                </select>
										                </div>	
										                <div class="col-sm-2">				
															<select id="width_name" name="width_name" class="form-control" data-required="true">
															<?php
																foreach ($widths as $key => $value) {							
																if($value['width_id'] == $width_name) {					
																?>
																	<option selected="true" value="<?php echo $value['width_id']; ?>"><?php echo $value['width_name']; ?></option>
																<?php
																}
																else {
																	?>
																	<option value="<?php echo $value['width_id']; ?>"><?php echo $value['width_name']; ?></option>
																	<?php
																}							
																}																
															?>				
											                </select>
										                </div>
										                <div class="col-sm-2">				
															<select id="softness_name" name="softness_name" class="form-control" data-required="true">
															<?php
																foreach ($softnesses as $key => $value) {					
																if($value['softness_id'] == $softness_name) {					
																?>
																	<option selected="true" value="<?php echo $value['softness_id']; ?>"><?php echo $value['softness_name']; ?></option>
																<?php
																}
																else {
																	?>
																	<option value="<?php echo $value['softness_id']; ?>"><?php echo $value['softness_name']; ?></option>
																	<?php
																}							
																}																
															?>				
											                </select>
										                </div>
										                <div class="col-sm-2">				
															<select id="color_name" name="color_name" class="form-control" data-required="true">
															<?php
																foreach ($colors as $key => $value) {							
																if($value['color_id'] == $color_name) {					
																?>
																	<option selected="true" value="<?php echo $value['color_id']; ?>"><?php echo $value['color_name']; ?></option>
																<?php
																}
																else {
																	?>
																	<option value="<?php echo $value['color_id']; ?>"><?php echo $value['color_name']; ?></option>
																	<?php
																}							
																}																
															?>				
											                </select>
										                </div>
										                <div class="col-sm-2">				
															<select id="source_name" name="source_name" class="form-control" data-required="true">
															<?php
																foreach ($sources as $key => $value) {							
																if($value['source_id'] == $source_name) {					
																?>
																	<option selected="true" value="<?php echo $value['source_id']; ?>"><?php echo $value['source_name']; ?></option>
																<?php
																}
																else {
																	?>
																	<option value="<?php echo $value['source_id']; ?>"><?php echo $value['source_name']; ?></option>
																	<?php
																}							
																}																
														    ?>				
											                </select>
										                </div>	
														<div class="clear"><br/></div>	
													</div>						
													<div class="col-sm-12">
														<button class="btn btn-success btn-sm" type="submit"><span class="icon-search"></span> Search Report</button>										
													</div>
												</div>
											</form>
										</div>
										<h4 class="heading_a">Result:</h4>
										<div class="row">
										&nbsp;
										</div>
									</div>
									<table id="report_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th>Article</th>
												<th>Construction</th>
												<th>Width</th>
												<th>Softness</th>
												<th>Color</th>
												<th>Source</th>
												<th>Raw ID</th>
												<th>Date</th>
												<th>P.I.</th>
												<th>L.C.</th>
												<th>Previous</th>
												<th>Received</th>
												<th>Total</th>
												<th>Production</th>
												<th>Finished</th>
												<th>Total Finished</th>
												<th>Wastage</th>
												<th>Unfinished</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											foreach ($import as $key => $value) {
												echo "<tr>";
												echo "<td>".$value['article_name']."</td>";
												echo "<td>".$value['construction_name']."</td>";
												echo "<td>".$value['width_name']."</td>";
												echo "<td>".$value['softness_name']."</td>";
												echo "<td>".$value['color_name']."</td>";
												echo "<td>".$value['source_name']."</td>";
												echo "<td>".$value['raw_id']."</td>";
												echo "<td>".$value['raw_date']."</td>";
												echo "<td>".$value['raw_pi_no']."</td>";
												echo "<td>".$value['raw_lc_no']."</td>";
												if($value['prev_balance'] == NULL) {
									                $value['prev_balance'] = '-';
									                $value['total'] = $value['raw_received_balance'];
									            }
									            else 
									                $value['total'] = $value['prev_balance'] + $value['raw_received_balance'];
												echo "<td>".$value['prev_balance']."</td>";										
												echo "<td>".$value['raw_received_balance']."</td>";
												echo "<td>".$value['total']."</td>";
												if($value['production'] == NULL) {
													$production = '0 (0)';
													$value['production'] = 0;
												}
												else {
													$production = $value['production'].' ('.$value['pfinish'].')';
												}
												if($value['finished'] == NULL) {
													$finished = '0 (0)';
													$value['finished'] = 0;
												}
												else {
													$finished = $value['finished'].' ('.$value['ffinish'].')';
												}
												echo "<td>".$production."</td>";
												echo "<td>".$finished."</td>";	
												echo "<td>".($value['pfinish'] + $value['ffinish'])."</td>";
												echo "<td>".(($value['production'] - $value['pfinish']) + ($value['finished'] - $value['ffinish']))."</td>";	
												echo "<td>".($value['raw_received_balance'] - ($value['production'] + $value['finished']))."</td>";
												echo "</tr>";
											} 
											?>
										</tbody>				
									</table>									
								</div>
							</div>
						</div>

						<div class="msg"><?php echo $this->session->flashdata('msg'); ?></div>
						<div class="msg_type"><?php echo $this->session->flashdata('msg_type'); ?></div>

					</div>
				</div>