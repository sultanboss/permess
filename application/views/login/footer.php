	
	<!-- jQuery -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<!-- bootstrap framework -->
		<script src="<?php echo $this->config->item('admin_js_url'); ?>js/lib/parsley/parsley.min.js"></script>
		<script>
		$(function() {
			
			//* validation
			$('#login_form').parsley({
				errors: {
					classHandler: function ( elem, isRadioOrCheckbox ) {
						if(isRadioOrCheckbox) {
							return $(elem).closest('.form_sep');
						}
					},
					container: function (element, isRadioOrCheckbox) {
						if(isRadioOrCheckbox) {
							return element.closest('.form_sep');
						}
					}
				}
			});
		});
		</script>	
</body>
</html>