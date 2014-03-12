/* [ ---- Ebro Admin - datatables ---- ] */

    $(function() {
		ebro_datatables.colReorder_visibility();
		
		//* add placeholder to search input
        $('.dataTables_filter input').each(function() {
            $(this).attr("placeholder", "Search...");
            $(this).attr("class", "form-control");
        }),

        $('.dataTables_length select').each(function() {
            $(this).attr("class", "form-control");
        }),

        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');      
	})
	
	ebro_datatables = {

        //* column reorder & toggle visibility
        colReorder_visibility: function() {

            // Report Module

            if($('#report_list_table').length) {
                $('#report_list_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "sDom": "R<'dt-top-row'ClfT>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "oTableTools": {
                        "aButtons": [
                            "copy",
                            "print",
                            {
                                "sExtends":    "collection",
                                "sButtonText": 'Save <span class="caret" />',
                                "aButtons":    [ "csv", "xls", "pdf" ]
                            }
                        ],
                        "sSwfPath": base_url + "assets/js/lib/dataTables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
                    }
                });
            }

            if($('#report_product_table').length) {
                $('#report_product_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "sDom": "R<'dt-top-row'ClfT>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "oTableTools": {
                        "aButtons": [
                            "copy",
                            "print",
                            {
                                "sExtends":    "collection",
                                "sButtonText": 'Save <span class="caret" />',
                                "aButtons":    [ "csv", "xls", "pdf" ]
                            }
                        ],
                        "sSwfPath": base_url + "assets/js/lib/dataTables/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
                    }
                });
            }

            // Settings Module

            if($('#article_table').length) {
                $('#article_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "article/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#article_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_article_name").val($(this).attr('data-name'));
                            $("#edit_article_id").val($(this).attr('data-id'));
                        });

                        $('#article_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            if($('#construction_table').length) {
                $('#construction_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "construction/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#construction_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_construction_name").val($(this).attr('data-name'));
                            $("#edit_construction_id").val($(this).attr('data-id'));
                        });

                        $('#construction_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            if($('#color_table').length) {
                $('#color_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "color/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#color_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_color_name").val($(this).attr('data-name'));
                            $("#edit_color_id").val($(this).attr('data-id'));
                        });

                        $('#color_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            if($('#width_table').length) {
                $('#width_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "width/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#width_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_width_name").val($(this).attr('data-name'));
                            $("#edit_width_id").val($(this).attr('data-id'));
                        });

                        $('#width_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            if($('#source_table').length) {
                $('#source_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "source/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#source_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_source_name").val($(this).attr('data-name'));
                            $("#edit_source_id").val($(this).attr('data-id'));
                        });

                        $('#source_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            if($('#raw_table').length) {
                $('#raw_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "raw/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#raw_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_raw_name").val($(this).attr('data-name'));
                            $("#edit_raw_id").val($(this).attr('data-id'));
                        });

                        $('#raw_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            // Factory Module

            if($('#import_table').length) {
                $('#import_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'desc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "factory/dataimport",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#import_table').delegate('.import_edit', 'click', function() {
                            $("#edit_import_id").val($(this).attr('data-id'));
                            $("#edit_raw_name").val($(this).attr('data-raw'));
                            $("#current_raw_id").val($(this).attr('data-raw'));
                            $("#edit_import_date").val($(this).attr('data-date'));
                            $("#edit_import_received_balance").val($(this).attr('data-recev'));
                            $("#edit_import_invoice_challan").val($(this).attr('data-challan'));
                            $("#edit_import_lc_no").val($(this).attr('data-lc'));
                            $("#edit_import_issue_to").val($(this).attr('data-issue'));
                            $("#edit_import_inv_req_challan").val($(this).attr('data-irc'));
                        });

                        $('#import_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }


            //Admin Module

            if($('#groups_table').length) {
                $('#groups_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "groups/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#groups_table').delegate('.group_edit', 'click', function() {
                            $("#edit_group_name").val($(this).attr('data-name'));
                            $("#edit_group_id").val($(this).attr('data-id'));
                        });

                        $('#groups_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

            if($('#users_table').length) {
                $('#users_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "user/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#users_table').delegate('.user_edit', 'click', function() {
                            $("#edit_first_name").val($(this).attr('data-fname'));
                            $("#edit_last_name").val($(this).attr('data-lname'));
                            $("#edit_email").val($(this).attr('data-email'));
                            $("#edit_user_id").val($(this).attr('data-id'));
                            $("#edit_group").val($(this).attr('data-group'));
                        });

                        $('#users_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    }
                });
            }

        }
	}