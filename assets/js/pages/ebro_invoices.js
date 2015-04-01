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
			if($('#chalan_print').length) {
				$('#chalan_print').click(function(e) {
					e.preventDefault();
					$('#c_print').addClass('print');
					$('#c_ret_print').removeClass('print');
					$('body').addClass('printable');
					setTimeout(function() {
						window.print()
					},1000)
				})
			}

			if($('#chalan_print_return').length) {
				$('#chalan_print_return').click(function(e) {
					e.preventDefault();
					$('#c_print').removeClass('print');
					$('#c_ret_print').addClass('print');
					$('body').addClass('printable');
					setTimeout(function() {
						window.print()
					},1000)
				})
			}
		}
	}