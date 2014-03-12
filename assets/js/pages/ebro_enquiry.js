/* [ ---- Ebro Admin - datatables ---- ] */

    $(function() {
        ebro_enquiry.add_enquiry();  
    })
    
    ebro_enquiry = {
        
        add_enquiry: function() {

            if($('.ebro_datepicker').length) {
                $('.ebro_datepicker').datepicker("setDate", new Date());
            }

            if($('.ebro_datepicker_add').length) {
                $('body').on('click','.ebro_datepicker_add', function() {
                    $('.ebro_datepicker_add').datepicker();
                });
            }

            if($('.eq_followup_time').length) {
                $('body').on('click','.eq_followup_time', function() {
                    $('.eq_followup_time').timepicker();
                });
            }

            $('#btn_product_add').on('click', function(e){
                e.preventDefault();
                $('#enquiry_product_table > tbody').append('<tr>' + $('#eq_add_product_form tr').html() + '</tr>');
                $('.wizard > .content').height('auto');
            });

            $('#enquiry_product_table').on('click','tr .eq_add_product_form_remove',function(e){
                e.preventDefault();
                var result = confirm("Are you sure?");
                if (result == true) {
                    $(this).closest('tr').remove();
                }              
            });

            $('#enquiry_product_table').on('change','tr .eq_product_name',function(e){
                e.preventDefault();
                $(this).closest('tr').find('input.eq_product_rate').val($(this).find(':selected')[0].id);
                var qty = $(this).closest('tr').find('input.eq_product_qty').val();
                var rate = $(this).closest('tr').find('input.eq_product_rate').val();
                $(this).closest('tr').find('input.eq_product_amount').val(qty*rate);
            });

            $('#enquiry_product_table').on('change keyup paste mouseup','tr .eq_product_qty',function(e){
                e.preventDefault();
                var qty = $(this).closest('tr').find('input.eq_product_qty').val();
                var rate = $(this).closest('tr').find('input.eq_product_rate').val();
                $(this).closest('tr').find('input.eq_product_amount').val(qty*rate);
            });

            $('#enquiry_product_table').on('change keyup paste mouseup','tr .eq_product_rate',function(e){
                e.preventDefault();
                var qty = $(this).closest('tr').find('input.eq_product_qty').val();
                var rate = $(this).closest('tr').find('input.eq_product_rate').val();
                $(this).closest('tr').find('input.eq_product_amount').val(qty*rate);
            });



            $('#btn_product_edit').on('click', function(e){
                e.preventDefault();
                $('#enquiry_edit_product_table > tbody').append('<tr>' + $('#eq_edit_product_form tr').html() + '</tr>');
                $('.wizard > .content').height('auto');
            });

            $('#enquiry_edit_product_table').on('click','tr .eq_edit_product_form_remove',function(e){
                e.preventDefault();
                var result = confirm("Are you sure?");
                if (result == true) {
                    $(this).closest('tr').remove();
                }              
            });

            $('#enquiry_edit_product_table').on('change','tr .eq_product_name',function(e){
                e.preventDefault();
                $(this).closest('tr').find('input.eq_product_rate').val($(this).find(':selected')[0].id);
                var qty = $(this).closest('tr').find('input.eq_product_qty').val();
                var rate = $(this).closest('tr').find('input.eq_product_rate').val();
                $(this).closest('tr').find('input.eq_product_amount').val(qty*rate);
            });

            $('#enquiry_edit_product_table').on('change keyup paste mouseup','tr .eq_product_qty',function(e){
                e.preventDefault();
                var qty = $(this).closest('tr').find('input.eq_product_qty').val();
                var rate = $(this).closest('tr').find('input.eq_product_rate').val();
                $(this).closest('tr').find('input.eq_product_amount').val(qty*rate);
            });

            $('#enquiry_edit_product_table').on('change keyup paste mouseup','tr .eq_product_rate',function(e){
                e.preventDefault();
                var qty = $(this).closest('tr').find('input.eq_product_qty').val();
                var rate = $(this).closest('tr').find('input.eq_product_rate').val();
                $(this).closest('tr').find('input.eq_product_amount').val(qty*rate);
            });
        }
    }