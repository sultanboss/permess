/* [ ---- Ebro Admin - form validate ---- ] */

	$(function() {
		//* parsley validate
		ebro_validate.init();
		ebro_validate.extended();
	});
	
	//* parsley validate
	ebro_validate = {
		init: function() {
			if($('#parsley_addcat').length) {
				$('#parsley_addcat').parsley({
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
			}
			if($('#parsley_editcat').length) {
				$('#parsley_editcat').parsley({
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
			}
		},
		extended: function() {

		}
	}
