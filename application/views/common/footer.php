				<nav id="sidebar">
					<ul id="icon_nav_v" class="side_ico_nav">
						<li>
							<a href="#" title="Dashboard"><i class="icon-home"></i></a>
						</li>
						<li>             
							<a href="#" title="Content"><i class="icon-edit"></i></a>
						</li>
						<li>             
							<a href="#" title="Users"><i class="icon-group"></i></a>
						</li>
						<li>             
							<a href="#"><i class="icon-tasks"></i></a>
						</li>
						<li>             
							<a href="#"><i class="icon-beaker"></i></a>
						</li>
						<li>             
							<a href="#"><i class="icon-book"></i></a>
						</li>
						<li>             
							<a href="#"><i class="icon-tag"></i></a>
						</li>
						<li>             
							<a href="#"><i class="icon-wrench"></i></a>
						</li>
					</ul>
				</nav>
			</section>
			<div id="footer_space"></div>
		</div>
	
        <footer id="footer">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <small class="text-muted">&copy; <?php echo date('Y');?> <a href="<?php echo base_url();?>"><?php echo $this->config->item('app_name'); ?></a></small>
                    </div>
                    <div class="col-sm-6 text-center">
                        <ul>
                            <li><a href="#">Terms of Service</a></li>
                            <li>&middot;</li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-3 text-right">
                        <small class="text-muted">All Rights Reserved.</small>
                    </div>
                </div>
            </div>
        </footer>
        	


	<!--[[ common plugins ]]-->

		<script>var base_url = '<?php echo base_url(); ?>';</script>
	
	<!-- jQuery -->
		<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/jquery.min.js"></script>
	<!-- bootstrap framework -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>bootstrap/js/bootstrap.min.js"></script>
	<!-- jQuery resize event -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/jquery.ba-resize.min.js"></script>
	<!-- jquery cookie -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/jquery_cookie.min.js"></script>
	<!-- retina ready -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/retina.min.js"></script>
	<!-- tinyNav -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/tinynav.js"></script>
	<!-- sticky sidebar -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/jquery.sticky.js"></script>
		
	
	<!-- jMenu -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/lib/jMenu/js/jMenu.jquery.js"></script>
		
	<!-- ebro common scripts/functions -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/ebro_common.js"></script>
	
	
	<!--[[ page specific plugins ]]-->

			<?php echo (isset($js)) ? $js:''; ?>


	<!--[if lte IE 9]>
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/ie/jquery.placeholder.js"></script>
		<script>
			$(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	
	<script type="text/javascript">

	</script>
	</body>
</html>