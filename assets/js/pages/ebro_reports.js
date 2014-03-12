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
        }
    }