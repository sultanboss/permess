    
    $(function() {
        ebro_custom_function.accounts();  
    })

    ebro_custom_function = {
        
        accounts: function() {   

            setdate('bill_date');  
            setdate('bill_mr_date');
            setdate('bill_cheque_date');
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