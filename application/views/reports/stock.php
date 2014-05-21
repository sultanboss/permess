			<section class="container clearfix main_section">
				<div id="main_content_outer" class="clearfix">
					<div id="main_content">
						
						<!-- main content -->			
						<div class="row">
							<div class="col-sm-12">
								<div class="panel panel-default">
									<div class="panel_controls">
										<h4 class="heading_a">Current Stocks</h4>
										<div class="row">											
											<div class="col-sm-12">
												&nbsp;
											</div>
										</div>
									</div>
									<table id="report_table" class="table table-hover table-striped">
										<thead>
											<tr>
												<th width="">No.</th>												
												<th width="">Article</th>
												<th width="">Width</th>
												<th width="">Softness</th>
												<th width="">Color</th>
												<th width="">Construction</th>
												<th width="">Balance (Yards)</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i = 1;
											foreach ($stock as $key => $value) {											
												echo "<tr>";
												echo "<td>".$i."</td>";
												echo "<td>".$value['article_name']."</td>";
												echo "<td>".$value['width_name']."</td>";
												echo "<td>".$value['softness_name']."</td>";
												echo "<td>".$value['color_name']."</td>";
												echo "<td>".$value['construction_name']."</td>";
												if($value['sold'] == null)
        											$value['sold'] = 0;
       											$value['total'] = $value['total'] - $value['sold'];
       											if($value['total'] <= $this->config->item('stock_reorder'))
       												$class = 'stock-reorder';
       											else
       												$class = '';
												echo "<td class='".$class."'>".$value['total']."</td>";
												echo "</tr>";
												$i++;
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