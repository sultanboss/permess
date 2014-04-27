/* [ ---- Ebro Admin - invoices ---- ] */

	$(function() {
		ebro_invoice.init();
	})
	
	ebro_invoice = {
		init: function() {
			if($('#invoice_print').length) {
				$('#invoice_print').click(function(e) {
					e.preventDefault();
					$('body').addClass('printable');
					setTimeout(function() {
						window.print()
					},1000)
				})
			}
		}
	}