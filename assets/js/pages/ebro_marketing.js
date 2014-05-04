    
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