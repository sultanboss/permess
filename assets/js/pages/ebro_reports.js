/* [ ---- Ebro Admin - datatables ---- ] */

    $(function() {
        ebro_enquiry.reports();  
    })
    
    ebro_enquiry = {
        
        reports: function() {

            if( ($('#dpStart').length) && ($('#dpEnd').length) ) {
                $('#dpStart').datepicker().on('changeDate', function(e){
                    $('#dpEnd').datepicker('setStartDate', e.date);
                });
                $('#dpEnd').datepicker().on('changeDate', function(e){
                    $('#dpStart').datepicker('setEndDate', e.date)
                });
            }

            if( ($('#type').length) ) {
                var lcval = $('#type').find(':selected')[0].value;
                if(lcval == '1')
                    $('#single').show(200);
                else
                    $('#single').hide(200);

                $('#type').change(function(){
                    var value = $(this).find(':selected')[0].value;
                    if(value == '1')
                        $('#single').show(200);
                    else
                        $('#single').hide(200);
                });
            }
        }
    }