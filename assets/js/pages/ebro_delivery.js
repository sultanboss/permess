	
	$(function() {
		ebro_custom_function.delivery();  
	})

	ebro_custom_function = {
		
		delivery: function() {

			$('#btn_product_add').on('click', function(e){
				e.preventDefault();
				$('#delivery_product_table > tbody').append('<tr>' + $('#eq_add_product_form tr').html() + '</tr>');

			});

			$('#delivery_product_table').on('click','tr .eq_add_product_form_remove',function(e){
				e.preventDefault();
				var result = confirm("Are you sure?");
				if (result == true) {
					$(this).closest('tr').remove();
				}              
			});

			$('#delivery_product_table').on('change keyup paste mouseup','tr .order_quantity',function(e){
				e.preventDefault();
				var qty = $(this).closest('tr').find('input.order_quantity').val();
				var rate = $(this).closest('tr').find('input.unit_price').val();
				$(this).closest('tr').find('input.net_price').val(parseFloat(Math.round(qty*rate * 100) / 100).toFixed(4));

				var over = $(this).closest('tr').find('input.over_invoice_unit_price').val();
				$(this).closest('tr').find('input.over_invoice_net_price').val(parseFloat(Math.round(qty*over * 100) / 100).toFixed(4));
			});

			$('#delivery_product_table').on('change keyup paste mouseup','tr .unit_price',function(e){
				e.preventDefault();
				var qty = $(this).closest('tr').find('input.order_quantity').val();
				var rate = $(this).closest('tr').find('input.unit_price').val();
				$(this).closest('tr').find('input.net_price').val(parseFloat(Math.round(qty*rate * 100) / 100).toFixed(4));
			});

			$('#delivery_product_table').on('change keyup paste mouseup','tr .over_invoice_unit_price',function(e){
				e.preventDefault();
				var qty = $(this).closest('tr').find('input.order_quantity').val();
				var over = $(this).closest('tr').find('input.over_invoice_unit_price').val();
				$(this).closest('tr').find('input.over_invoice_net_price').val(parseFloat(Math.round(qty*over * 100) / 100).toFixed(4));
			});
			

			var lcval = $('#delivery_lc_status').find(':selected')[0].value;
			if(lcval == '1')
				$('#lc_date_box').show(200);
			else
				$('#lc_date_box').hide(200);


			$('#delivery_payment').change(function(){
				var value = $(this).find(':selected')[0].value;
				if(value == '0')
					$('#lc_box').show(200);
				else
					$('#lc_box').hide(200);
			});

			var paymenttype = $('#delivery_payment').find(':selected')[0].value;
			if(paymenttype == '0')
				$('#lc_box').show(200);
			else
				$('#lc_box').hide(200);


			$('#delivery_lc_status').change(function(){
				var value = $(this).find(':selected')[0].value;
				if(value == '1')
					$('#lc_date_box').show(200);
				else
					$('#lc_date_box').hide(200);
			});

			$('#parsley_addproduct').parsley({
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
				},
				listeners: {
					onFormSubmit: function ( isFormValid, event, ParsleyForm ) {
						if(isFormValid){
							$('#btn_product_submit span').removeClass('icon-plus');
							$('#btn_product_submit span').addClass('icon-spinner icon-spin icon-large');
						
							var ar = {};
							ar['delivery_pi_no']            = $('#delivery_pi_no').val();
							ar['delivery_date']             = $('#delivery_date').val();
							ar['delivery_pi_name']          = $('#delivery_pi_name').val();
							ar['delivery_po_no']            = $('#delivery_po_no').val();
							ar['delivery_by']               = $('#delivery_by').val();
							ar['delivery_status']           = $('#delivery_status').val();
							ar['delivery_doc_status']       = $('#delivery_doc_status').val();
							ar['delivery_lc_status']        = $('#delivery_lc_status').val();
							if(ar['delivery_lc_status'] == 0)
							   ar['delivery_lc_date']          = '';
							else
							   ar['delivery_lc_date']          = $('#delivery_lc_date').val();                                
							ar['delivery_item_no']          = $('#delivery_item_no').val();
							ar['delivery_type']             = $('#delivery_type').val();
							ar['delivery_company_name']     = $('#delivery_company_name').val();
							ar['delivery_company_address']  = $('#delivery_company_address').val();
							ar['delivery_address']          = $('#delivery_address').val();
							ar['delivery_contact_person']   = $('#delivery_contact_person').val();
							ar['delivery_buyer']            = $('#delivery_buyer').val();
							ar['delivery_bank']             = $('#delivery_bank').val();
							ar['delivery_payment']          = $('#delivery_payment').val();
							ar['delivery_style']            = $('#delivery_style').val();
							ar['delivery_commission_status']= $('#delivery_commission_status').val();
							ar['delivery_commission']       = $('#delivery_commission').val();
							ar['delivery_remarks']       	= $('#delivery_remarks').val();
							ar['editor_id']                 = $('#editor_id').val();
                            ar['delivery_hs_code']          = $('#delivery_hs_code').val();

							var i = 0;
							$('#delivery_product_table > tbody > tr').each(function() {  
								ar['article_id_' + i]               = $(this).find('select.article_id').val();
								ar['description_id_' + i]           = $(this).find('select.description_id').val();
								ar['softness_id_' + i]              = $(this).find('select.softness_id').val();
								ar['width_id_' + i]                 = $(this).find('select.width_id').val();
								ar['color_id_' + i]                 = $(this).find('select.color_id').val();
                                                                ar['mtype_' + i]                 = $(this).find('select.mtype').val();
								ar['order_quantity_' + i]           = $(this).find('input.order_quantity').val();
								ar['delivery_quantity_' + i]        = $(this).find('input.delivery_quantity').val();
								ar['unit_price_' + i]               = $(this).find('input.unit_price').val();
								ar['over_invoice_unit_price_' + i]  = $(this).find('input.over_invoice_unit_price').val();
								i++;
							});

							$.ajax({
								url: base_url + 'inventory/adddelivery',
								data : JSON.stringify(ar),
								contentType : 'application/json',
								type : 'POST',
								success: function (data) {
									if(data == '') {      
										window.location = base_url + "newdelivery";
									}
									else {
										window.location = base_url + "factory/editdelivery/" + data;
									}
								}
							});

							event.preventDefault();
						}
					}
				}
			});

			$('#parsley_editproduct #delivery_date').val( $('#delivery_date_value').html() );
			if($('#delivery_lc_date_value').html() != '0000-00-00')
				$('#parsley_editproduct #delivery_lc_date').val( $('#delivery_lc_date_value').html() );

			$('#parsley_editproduct').parsley({
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
				},
				listeners: {
					onFormSubmit: function ( isFormValid, event, ParsleyForm ) {
						if(isFormValid){
							$('#btn_product_submit span').removeClass('icon-plus');
							$('#btn_product_submit span').addClass('icon-spinner icon-spin icon-large');
						
							var ar = {};
							ar['delivery_id']               = $('#delivery_pi_no').val();
							ar['delivery_pi_name']          = $('#delivery_pi_name').val();
							ar['delivery_date']             = $('#delivery_date').val();
							ar['delivery_po_no']            = $('#delivery_po_no').val();
							ar['delivery_by']               = $('#delivery_by').val();
							ar['delivery_status']           = $('#delivery_status').val();
							ar['delivery_doc_status']       = $('#delivery_doc_status').val();
							ar['delivery_lc_status']        = $('#delivery_lc_status').val();
							if(ar['delivery_lc_status'] == 0)
								ar['delivery_lc_date']          = '';
							else
								ar['delivery_lc_date']          = $('#delivery_lc_date').val();  
							ar['delivery_item_no']          = $('#delivery_item_no').val();
							ar['delivery_type']             = $('#delivery_type').val();
							ar['delivery_company_name']     = $('#delivery_company_name').val();
							ar['delivery_company_address']  = $('#delivery_company_address').val();
							ar['delivery_address']          = $('#delivery_address').val();
							ar['delivery_contact_person']   = $('#delivery_contact_person').val();
							ar['delivery_buyer']            = $('#delivery_buyer').val();
							ar['delivery_bank']             = $('#delivery_bank').val();
							ar['delivery_payment']          = $('#delivery_payment').val();
							ar['delivery_style']            = $('#delivery_style').val();		
							ar['delivery_revised']          = $('#delivery_revised').val();						
							ar['delivery_commission_status']= $('#delivery_commission_status').val();
							ar['delivery_commission']       = $('#delivery_commission').val();
							ar['delivery_remarks']       	= $('#delivery_remarks').val();
							ar['editor_id']                 = $('#editor_id').val();
                                                        ar['delivery_hs_code']                 = $('#delivery_hs_code').val();
							var i = 0;
							$('#delivery_product_table > tbody > tr').each(function() {  
								ar['delivery_product_id_' + i]      = $(this).find('#delivery_product_id').val();
								ar['article_id_' + i]               = $(this).find('select.article_id').val();
								ar['description_id_' + i]           = $(this).find('select.description_id').val();
								ar['softness_id_' + i]              = $(this).find('select.softness_id').val();
								ar['width_id_' + i]                 = $(this).find('select.width_id').val();
								ar['color_id_' + i]                 = $(this).find('select.color_id').val();
                                                                ar['mtype_' + i]                 = $(this).find('select.mtype').val();
								ar['order_quantity_' + i]           = $(this).find('input.order_quantity').val();
								ar['delivery_quantity_' + i]        = $(this).find('input.delivery_quantity').val();
								ar['unit_price_' + i]               = $(this).find('input.unit_price').val();
								ar['over_invoice_unit_price_' + i]  = $(this).find('input.over_invoice_unit_price').val();
								i++;
							});

							$.ajax({
								url: base_url + 'inventory/updatedelivery/' + ar['delivery_id'],
								data : JSON.stringify(ar),
								contentType : 'application/json',
								type : 'POST',
								success: function (data) {                           
									window.location = base_url + "factory/editdelivery/" + ar['delivery_id'];
								}
							});

							event.preventDefault();
						}
					}
				}
			});

			var prev_val;

			$('#delivery_company_name').focus(function() {
				prev_val = $(this).val();
			}).change(function() {
				$(this).blur();
				if(confirm('Do you really want to change the address?')) {
					if(this.value != "") {
						$.ajax({
							url: base_url + 'inventory/getDeliveryAddress/' + this.value,
							success: function (data) {    
								data = JSON.parse(data);   
								$('#delivery_buyer').val(data['buyer']);
								$('#delivery_contact_person').val(data['contact_person']);
								$('#delivery_company_address').val(data['company_address']);
								$('#delivery_address').val(data['delivery_address']);
							}
						});
					}
					else {
						$('#delivery_buyer').val('');
						$('#delivery_contact_person').val('');
						$('#delivery_company_address').val('');
						$('#delivery_address').val('');
					}
				}
				else {
					$(this).val(prev_val);
				}
			});

			$('#delivery_product_table > tbody').on('change', '.article_id', function () {
				var elmx = $(this);			
				$(this).blur();
				var address_id_val = $('#delivery_company_name').find('option:selected'); 
        		address_id_val = address_id_val.attr("data-id"); 

				if(this.value != "" && address_id_val != "") {
					$.ajax({
						url: base_url + 'inventory/getArticleAddressPrice/' + address_id_val + '/' + this.value,
						success: function (data) {	
							elmx.closest('tr').find('td:eq(8)').find('input').val(data);
							elmx.closest('tr').find('td:eq(8)').find('input').trigger("change");
						}
					});
				}
			});

		}
	}