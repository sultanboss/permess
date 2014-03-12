/* [ ---- Ebro Admin - extended form elements ---- ] */

	$(function() {
		ebro_chained.init();
		ebro_autosize_textarea.init();
	});
	
	
	//* chained selects
	ebro_chained = {
		init: function() {
			//* remote
			if($('#business_city').length && $('#business_area').length) {
				$("#business_area").remoteChained("#business_city", base_url + "admin/business/select");  
			}
		}
	}	

	//* autosize textarea
	ebro_autosize_textarea = {
		init: function() {
			if($('.autosize_textarea').length) {
				$('.autosize_textarea').each(function() {
					if($(this).hasClass('animated')) {
						$(this).autosize({append: "\n"});
					} else {
						$(this).autosize();
					}
				})
			}
		}
	};
