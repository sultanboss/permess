    
    $(function() {
        ebro_custom_function.marketing();  
        ebro_custom_function.exportissues();
    })

    ebro_custom_function = {
        
        marketing: function() {   

            setdate('lc_date');  
            setdate('ship_date');
            setdate('lc_rdate');
            setdate('exp_date');
            setdate('bank_submit_date');
            setdate('submit_party_date');
            setdate('submit_party_rdate');
            setdate('acc_date');
            setdate('purchase_date');
            setdate('due_date');
            setdate('due_rdate');  

            var lcval = $('#advance_delivery').find(':selected')[0].value;
            if(lcval == '1') {
                $('#advance_details_box').show(200);
                $("#advance_delivery_details").attr("data-required","true");
            }
            else {
                $('#advance_details_box').hide(200);
                $("#advance_delivery_details").removeAttr("data-required");
            }

            $('#advance_delivery').change(function(){
                var value = $(this).find(':selected')[0].value;
                if(value == '1') {
                    $('#advance_details_box').show(200);
                    $("#advance_delivery_details").attr("data-required","true");
                }
                else {
                    $('#advance_details_box').hide(200);
                    $("#advance_delivery_details").removeAttr("data-required");
                }
            });
        },

        exportissues: function() {   

            setdate('ip_date');  
            setdate('issue_date');
            setdate('up_date');
            setdate('send_date');
            setdate('receive_date');
            setdate('exp_bank_submit_date');
            setdate('exp_due_date');
            setdate('payment_collection_date');
        }
    }

    function setdate(val)
    {
        if($('#' + val).length) {
            if($('#' + val + '_value').html() == '0000-00-00') {
                $('#' + val).val('');
            }
            else {
                $('#' + val).val($('#' + val + '_value').html());
            }
        }
    }