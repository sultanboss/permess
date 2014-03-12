/* [ ---- Ebro Admin - wizard ---- ] */

	$(function() {
		ebro_wizard.add_wizard();
	});
	
	ebro_wizard = {
		add_wizard: function() {
			if($('#enq_addcat').length) {
				var wizard_form = $('#enq_addcat');
				//* wizard
				wizard_form.steps({
					headerTag: "h4",
					enableAllSteps: true,
					bodyTag: "fieldset",
					transitionEffect: "slideLeft",
					labels: {
						next: "Next",
						previous: "Previous",
						finish: "<i class=\"icon-ok\"></i> Submit"
					},
					titleTemplate: "<span class=\"number\">#index#</span> #title#",
					onStepChanging: function (event, currentIndex, newIndex) {
						
						// Allways allow previous action even if the current form is not valid!
						if (currentIndex > newIndex) {
							return true;
						}
			
                        var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onStepChanged: function (event, currentIndex, priorIndex) {
						//* resize wizard step to fit error messages
                        ebro_wizard.setHeight();
					},
					onFinishing: function (event, currentIndex) {
						var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onFinished: function (event, currentIndex) {
						$('#enq_addcat li.last_step i').removeClass('icon-ok');
						$('#enq_addcat li.last_step i').addClass('icon-spinner icon-spin icon-large');
						var ar = {};
						ar['enquiry_name'] 		= $('#enq_addcat #enquiry_name').val();
						ar['enquiry_contact'] 	= $('#enq_addcat #enquiry_contact').val();
						ar['enquiry_date'] 		= $('#enq_addcat #enquiry_date').val();
						ar['enquiry_source'] 	= $('#enq_addcat #enquiry_source').val();
						ar['enquiry_address'] 	= $('#enq_addcat #enquiry_address').val();
						ar['enquiry_phone'] 	= $('#enq_addcat #enquiry_phone').val();
						ar['enquiry_email'] 	= $('#enq_addcat #enquiry_email').val();
						ar['enquiry_remarks'] 	= $('#enq_addcat #enquiry_remarks').val();

						var i = 0;
						$('#enquiry_product_table > tbody > tr').each(function() {	
							var pname 	= $(this).find('select.eq_product_name').val();
							var pqty 	= $(this).find('input.eq_product_qty').val()
							var prate 	= $(this).find('input.eq_product_rate').val()
							if(pname != '-')	
							{
								if(!isNaN(pqty) && !isNaN(prate))
								{					
									ar['eq_product_name_' + i] = pname;
									ar['eq_product_qty_' + i] = pqty;
									ar['eq_product_rate_' + i] = prate;
									ar['eq_product_amount_' + i] = pqty*prate;
									i++;
								}
							}
						});

						$.ajax({
					        url: base_url + 'enquiry/add',
					        data : JSON.stringify(ar),
    						contentType : 'application/json',
    						type : 'POST',
					        success: function () {
					        	$('#enq_addcat li.last_step i').removeClass('icon-spinner icon-spin icon-large');
								$('#enq_addcat li.last_step i').addClass('icon-ok');								
								self.parent.location.reload();

								// $('#add_enquiry').modal('hide');
								// $('#enq_addcat').find('input[type=text], input[type=password], input[type=number], input[type=email], textarea, select').val('');
								// $('#enquiry_product_table > tbody').html('');
								// $('.ebro_datepicker').datepicker("setDate", new Date());
								// wizard_form.steps("previous");

				    			// $('#product_table').dataTable().fnReloadAjax(base_url + "product/data");

					        }
					    });
					}
				});
				//* validate
				wizard_form.parsley({
                    errors: {
						classHandler: function ( elem, isRadioOrCheckbox ) {
							if(isRadioOrCheckbox) {
								return $(elem).closest('div');
							}
						},
						container: function (element, isRadioOrCheckbox) {
							if(isRadioOrCheckbox) {
								return element.closest('div');
							}
						}
					},
					listeners: {
						onFieldError: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						},
						onFieldSuccess: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						}
					}
				});
				
                //* resize wizard step
				ebro_wizard.setHeight();
				
			}

			if($('#parsley_editcat').length) {
				var wizard_form = $('#parsley_editcat');
				//* wizard
				wizard_form.steps({
					headerTag: "h4",
					enableAllSteps: true,
					bodyTag: "fieldset",
					transitionEffect: "slideLeft",
					labels: {
						next: "Next",
						previous: "Previous",
						finish: "<i class=\"icon-ok\"></i> Submit"
					},
					titleTemplate: "<span class=\"number\">#index#</span> #title#",
					onStepChanging: function (event, currentIndex, newIndex) {
						
						// Allways allow previous action even if the current form is not valid!
						if (currentIndex > newIndex) {
							return true;
						}
			
                        var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onStepChanged: function (event, currentIndex, priorIndex) {
						//* resize wizard step to fit error messages
                        ebro_wizard.setHeight();
					},
					onFinishing: function (event, currentIndex) {
						var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onFinished: function (event, currentIndex) {
						$('#parsley_editcat li.last_step i').removeClass('icon-ok');
						$('#parsley_editcat li.last_step i').addClass('icon-spinner icon-spin icon-large');
						var ar = {};
						ar['enquiry_id'] 		= $('#parsley_editcat #enquiry_id').val();
						ar['enquiry_name'] 		= $('#parsley_editcat #enquiry_name').val();
						ar['enquiry_contact'] 	= $('#parsley_editcat #enquiry_contact').val();
						ar['enquiry_date'] 		= $('#parsley_editcat #enquiry_date').val();
						ar['enquiry_source'] 	= $('#parsley_editcat #enquiry_source').val();
						ar['enquiry_address'] 	= $('#parsley_editcat #enquiry_address').val();
						ar['enquiry_phone'] 	= $('#parsley_editcat #enquiry_phone').val();
						ar['enquiry_email'] 	= $('#parsley_editcat #enquiry_email').val();
						ar['enquiry_remarks'] 	= $('#parsley_editcat #enquiry_remarks').val();

						var i = 0;
						$('#enquiry_edit_product_table > tbody > tr').each(function() {	
							var pname 	= $(this).find('select.eq_product_name').val();
							var pqty 	= $(this).find('input.eq_product_qty').val()
							var prate 	= $(this).find('input.eq_product_rate').val()
							if(pname != '-')	
							{
								if(!isNaN(pqty) && !isNaN(prate))
								{					
									ar['eq_product_name_' + i] = pname;
									ar['eq_product_qty_' + i] = pqty;
									ar['eq_product_rate_' + i] = prate;
									ar['eq_product_amount_' + i] = pqty*prate;
									i++;
								}
							}
						});

						$.ajax({
					        url: base_url + 'enquiry/edit',
					        data : JSON.stringify(ar),
    						contentType : 'application/json',
    						type : 'POST',
					        success: function () {
					        	$('#parsley_editcat li.last_step i').removeClass('icon-spinner icon-spin icon-large');
								$('#parsley_editcat li.last_step i').addClass('icon-ok');								
								self.parent.location.reload();
					        }
					    });
					}
				});
				//* validate
				wizard_form.parsley({
                    errors: {
						classHandler: function ( elem, isRadioOrCheckbox ) {
							if(isRadioOrCheckbox) {
								return $(elem).closest('div');
							}
						},
						container: function (element, isRadioOrCheckbox) {
							if(isRadioOrCheckbox) {
								return element.closest('div');
							}
						}
					},
					listeners: {
						onFieldError: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						},
						onFieldSuccess: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						}
					}
				});
				
                //* resize wizard step
				ebro_wizard.setHeight();
				
			}

			if($('#parsley_followup').length) {
				var wizard_form = $('#parsley_followup');
				//* wizard
				wizard_form.steps({
					headerTag: "h4",
					enableAllSteps: true,
					bodyTag: "fieldset",
					transitionEffect: "slideLeft",
					labels: {
						next: "Next",
						previous: "Previous",
						finish: "<i class=\"icon-ok\"></i> Submit"
					},
					titleTemplate: "<span class=\"number\">#index#</span> #title#",
					onStepChanging: function (event, currentIndex, newIndex) {
						
						// Allways allow previous action even if the current form is not valid!
						if (currentIndex > newIndex) {
							return true;
						}
			
                        var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onStepChanged: function (event, currentIndex, priorIndex) {
						//* resize wizard step to fit error messages
                        ebro_wizard.setHeight();
					},
					onFinishing: function (event, currentIndex) {
						var isFormValid = true;
						wizard_form.find('.body').filter(':visible').find('.parsley-validated').each(function() {
                            $(this).parsley('validate');
                            isFormValid = $(this).parsley("isValid");
                        });
                        return isFormValid;
					},
					onFinished: function (event, currentIndex) {
						$('#parsley_followup li.last_step i').removeClass('icon-ok');
						$('#parsley_followup li.last_step i').addClass('icon-spinner icon-spin icon-large');
						var ar = {};
						var i = 0;
						ar['enquiry_id'] = $('#parsley_followup #enquiry_id').val();
						ar['eq_followup_next_date'] = $('#eq_followup_next_date').val();
						$('#enquiry_edit_product_table > tbody > tr').each(function() {								
							var fdate 	= $(this).find('#eq_followup_date').val();
							var ftype 	= $(this).find('select.eq_followup_type').val();
							if(fdate != '' && ftype != '-')	
							{
								ar['eq_followup_date_' + i] 	= fdate;
								ar['eq_followup_time_' + i] 	= $(this).find('input.eq_followup_time').val()
								ar['eq_followup_type_' + i] 	= ftype;
								ar['eq_followup_remarks_' + i] 	= $(this).find('textarea.eq_followup_remarks').val()
								i++;
							}
						});

						$.ajax({
					        url: base_url + 'followup/edit',
					        data : JSON.stringify(ar),
    						contentType : 'application/json',
    						type : 'POST',
					        success: function () {
					        	$('#parsley_followup li.last_step i').removeClass('icon-spinner icon-spin icon-large');
								$('#parsley_followup li.last_step i').addClass('icon-ok');								
								self.parent.location.reload();
					        }
					    });
					}
				});
				//* validate
				wizard_form.parsley({
                    errors: {
						classHandler: function ( elem, isRadioOrCheckbox ) {
							if(isRadioOrCheckbox) {
								return $(elem).closest('div');
							}
						},
						container: function (element, isRadioOrCheckbox) {
							if(isRadioOrCheckbox) {
								return element.closest('div');
							}
						}
					},
					listeners: {
						onFieldError: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						},
						onFieldSuccess: function ( elem, constraints, ParsleyField ) {
							//* resize wizard step to fit error messages
                            ebro_wizard.setHeight();
						}
					}
				});
				
                //* resize wizard step
				ebro_wizard.setHeight();
				
			}
		},
		setHeight: function() {
			setTimeout(function() {
				var cur_height = $('#enq_addcat .body.current').filter(':visible').outerHeight();
				$('#enq_addcat > .content').height(cur_height);

				var cur_height = $('#parsley_editcat .body.current').filter(':visible').outerHeight();
				$('#parsley_editcat > .content').height(cur_height);

				var cur_height = $('#parsley_followup .body.current').filter(':visible').outerHeight();
				$('#parsley_followup > .content').height(cur_height);

			},300);
		}
	}