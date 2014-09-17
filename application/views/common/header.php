<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title><?php echo (isset($title)) ? $title: ''; ?><?php echo ' - '.$this->config->item('app_name'); ?></title>    
		
		<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		<link rel="icon" type="image/png" href="<?php echo $this->config->item('admin_img_url'); ?>favicon.ico">
		
	<!-- bootstrap framework-->
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>bootstrap/css/bootstrap.min.css">
	<!-- todc-bootstrap -->
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>css/todc-bootstrap.min.css">
	<!-- font awesome -->        
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>css/font-awesome/css/font-awesome.min.css">
	<!-- flag icon set -->        
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>img/flags/flags.css">
	<!-- retina ready -->
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>css/retina.css">
	
	<!-- aditional stylesheets -->
		<?php echo (isset($css)) ? $css:''; ?>

	<!-- ebro styles -->
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>css/style.css">
	<!-- ebro theme -->
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>css/theme/color_1.css" id="theme">
		
	<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?php echo $this->config->item('admin_css_url'); ?>css/ie.css">
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/ie/html5shiv.js"></script>
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/ie/respond.min.js"></script>
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/ie/excanvas.min.js"></script>
	<![endif]-->

	<!-- custom fonts -->
		<link href='http://fonts.googleapis.com/css?family=Roboto:300,700&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css'>
			
	</head>
	<body class="sidebar_narrow full_width">
		<div id="wrapper_all">
			<header id="top_header">
				<div class="container">
					<div class="row">
						<div class="col-xs-6 col-sm-2">
							<a href="<?php echo base_url(); ?>" class="logo_main" title=""><img src="<?php echo $this->config->item('admin_img_url'); ?>logo.png" alt=""></a>
						</div>
						<div class="col-sm-push-4 col-sm-3 text-right hidden-xs">
							<div class="notification_dropdown dropdown">
								<a href="#" class="notification_icon dropdown-toggle" data-toggle="dropdown">
									<span class="label label-success">0</span>
									<i class="icon-comment-alt icon-2x"></i>
								</a>
								<ul class="dropdown-menu">
									<li>
										<div class="dropdown_heading">Notification</div>
										<div class="dropdown_content">
											<ul class="dropdown_items">
												<li><h3>No Activity...</h3></li>
												<!--
												<li>
													<h3><span class="small_info">12:43</span><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet&hellip;</p>
												</li>
												<li>
													<h3><span class="small_info">Today</span><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet&hellip;</p>
												</li>
												<li>
													<h3><span class="small_info">14 Aug</span><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet&hellip;</p>
												</li>
												-->
											</ul>
										</div>
										<div class="dropdown_footer"><a href="#" class="btn btn-sm btn-default">Show all</a></div>
									</li>
								</ul>
							</div>
							<!-- <div class="notification_separator"></div> -->
							<div class="notification_dropdown dropdown">
								<!-- <a href="#" class="notification_icon dropdown-toggle" data-toggle="dropdown">
									<span class="label label-danger">12</span>
									<i class="icon-envelope-alt icon-2x"></i>
								</a>
								<ul class="dropdown-menu dropdown-menu-wide">
									<li>
										<div class="dropdown_heading">Messages</div>
										<div class="dropdown_content">
											<ul class="dropdown_items">
												<li>
													<h3><a href="#">Lorem ipsum dolor sit amet</a></h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
													<p class="large_info">Sean Walter, 24.05.2014</p>
													<i class="icon-exclamation-sign indicator"></i>
												</li>
												<li>
													<h3><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi aliquam assumenda&hellip;</p>
													<p class="large_info">Sean Walter, 24.05.2014</p>
												</li>
												<li>
													<h3><a href="#">Lorem ipsum dolor&hellip;</a></h3>
													<p>Lorem ipsum dolor sit amet, consectetur&hellip;</p>
													<p class="large_info">Sean Walter, 24.05.2014</p>
													<i class="icon-exclamation-sign indicator"></i>
												</li>
											</ul>
										</div>
										<div class="dropdown_footer">
											<a href="#" class="btn btn-sm btn-default">Show all</a>
											<div class="pull-right dropdown_actions">
												<a href="#"><i class="icon-refresh"></i></a>
												<a href="#"><i class="icon-cog"></i></a>
											</div>
										</div>
									</li>
								</ul> -->
							</div>
						</div>
						<div class="col-xs-6 col-sm-push-4 col-sm-3">
							<div class="pull-right dropdown profile">
								<a href="#" class="user_info dropdown-toggle" title="Mangorate Admin" data-toggle="dropdown">
									<img src="<?php echo $this->config->item('admin_img_url'); ?>no_img_50.png" alt="">
									<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#"><i class="icon-user"></i> <?php echo $this->session->userdata('fullname'); ?></a></li>
									<li><a href="<?php echo base_url(); ?>auth/logout"><i class="icon-signout"></i> Log Out</a></li>
								</ul>
							</div>
						</div>
						<div class="col-xs-12 col-sm-pull-6 col-sm-4">
							<form class="main_search">
								<input type="text" id="search_query" name="search_query" class="typeahead form-control">
								<button type="submit" class="btn btn-success btn-xs"><i class="icon-search icon-white"></i></button>
							</form> 
						</div>
					</div>
				</div>
			</header>						
			<nav id="top_navigation" class="text_nav">
				<div class="container">
					<ul id="text_nav_h" class="clearfix j_menu top_text_nav">
					<li>
						<a href="<?php echo base_url();?>"><span class="icon-reorder"></span> Dashboard</a>
					</li>
					<?php
					if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users')) {
					?>
					<li>
						<a href="<?php echo base_url();?>newdelivery">+ New P.I.</a>
					</li>
					<?php
					}
					?>
					<li>
						<a href="javascript:void(0)">Factory</a>
						<ul>
							<?php
							if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Commercial') || $this->tank_auth->is_group_member('Factory')) {
							?>
							<li><a href="<?php echo base_url();?>factory/import">Import</a></li>
							<?php
							}
							?>
							<li><a href="<?php echo base_url();?>factory/stock">Stock</a></li>
							<li><a href="<?php echo base_url();?>factory/delivery">Delivery</a></li>		
						</ul>
					</li>
					<?php
					if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Users')) {
					?>
					<li>
						<a href="javascript:void(0)">Marketing</a>
						<ul>
							<li><a href="<?php echo base_url();?>marketing/order">Orders</a></li>							
						</ul>
					</li>
					<?php
					}
					if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Accounts')) {
					?>
					<li>
						<a href="javascript:void(0)">Accounts</a>
						<ul>
							<li><a href="<?php echo base_url();?>accounts/cashpayment">Cash Payment</a></li>							
						</ul>
					</li>
					<?php
					}
					if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users') || $this->tank_auth->is_group_member('Commercial')) {
					?>
					<li>
						<a href="javascript:void(0)">Commercial</a>		
						<ul>						
							<li><a href="<?php echo base_url();?>commercial/lcstatements">LC Statements</a></li>
							<li><a href="<?php echo base_url();?>commercial/expissues">Export Issues</a></li>
						</ul>
					</li>
					<?php
					}
					if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users')) {
					?>
					<li>
						<a href="javascript:void(0)">Reports</a>
						<ul>						
							<li><a href="<?php echo base_url();?>reports/import">Imports</a></li>
							<li><a href="<?php echo base_url();?>reports/sales">Sales</a></li>
							<li><a href="<?php echo base_url();?>reports/stock">Stock</a></li>
						</ul>
					</li>					
					<li>
						<a href="javascript:void(0)">Settings</a>
						<ul>
							<li>
								<a class="isParent" href="javascript:void(0)">Products</a>
								<ul>
									<li><a href="<?php echo base_url();?>settings/products/article">Article</a></li>
									<li><a href="<?php echo base_url();?>settings/products/construction">Construction</a></li>
									<li><a href="<?php echo base_url();?>settings/products/width">Width</a></li>
									<li><a href="<?php echo base_url();?>settings/products/softness">Softness</a></li>
									<li><a href="<?php echo base_url();?>settings/products/color">Color</a></li>
									<li><a href="<?php echo base_url();?>settings/products/source">Source</a></li>
									<li><a href="<?php echo base_url();?>settings/products/description">Description</a></li>
								</ul>
							</li>
							<li><a href="<?php echo base_url();?>settings/price">Price</a></li>
							<li><a href="<?php echo base_url();?>settings/issuetype">Issue Type</a></li>
						</ul>
					</li>
					<?php
					}
					if($this->tank_auth->is_admin() || $this->tank_auth->is_group_member('Super Users')) {
					?>
					<li>
						<a href="javascript:void(0)">Admin</a>
						<ul>							
							<li><a href="<?php echo base_url();?>admin/users">Users</a></li>
							<li><a href="<?php echo base_url();?>admin/groups">Groups</a></li>							
						</ul>
					</li>
					<?php
					}
					?>					
					</ul>
				</div>
			</nav>
			<!-- mobile navigation -->
			<nav id="mobile_navigation"></nav>

			<section id="breadcrumbs">
				<div class="container">
					<?php echo $breadcrumbs; ?>
				</div>
			</section>