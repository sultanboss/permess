/* [ ---- Ebro Admin - extended form elements ---- ] */

	$(function() {
		//* select2
		ebro_select2.init();
	});
	
	//* select2
	ebro_select2 = {
		init: function() {

			// Alternative Article
			if($('#article_alt').length) {
				$('#article_alt').select2({
					placeholder: "Select..."
				});

				$("#article_alt").on("change", function(e) {
					$("#article_alt_val").val($("#article_alt").select2("val"));
				});
			}

			if($('#edit_article_alt').length) {
				$('#edit_article_alt').select2({
					placeholder: "Select..."
				});
			}

			//* remove default form-controll class
			setTimeout(function() {
				$('.select2-container').each(function() {
					$(this).removeClass('form-control')
				})
			})
		}
	};
	
