    
    $(function() {
        ebro_custom_function.marketing();  
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

        }
    }

    function setdate(val)
    {
        if($('#' + val + '_value').html() == '0000-00-00') {
            $('#' + val).val('');
        }
        else {
            $('#' + val).val($('#' + val + '_value').html());
        }
    }