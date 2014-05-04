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

            if($('#report_table').length) {
                $('#report_table').dataTable({
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
                            $("#edit_article_alt_val").val($(this).attr('data-alt'));
                            $("#edit_article_id").val($(this).attr('data-id'));

                            var arr = $(this).attr('data-alt').split(',');
                            $('#edit_article_alt').select2("val", arr);

                            $("#edit_article_alt").on("change", function(e) {
                                $("#edit_article_alt_val").val($("#edit_article_alt").select2("val"));
                            });
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

            if($('#softness_table').length) {
                $('#softness_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "softness/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#softness_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_softness_name").val($(this).attr('data-name'));
                            $("#edit_softness_id").val($(this).attr('data-id'));
                        });

                        $('#softness_table').delegate('.bootbox_confirm', 'click', function(e) {
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

            if($('#description_table').length) {
                $('#description_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "description/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#description_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_description_name").val($(this).attr('data-name'));
                            $("#edit_description_id").val($(this).attr('data-id'));
                        });

                        $('#description_table').delegate('.bootbox_confirm', 'click', function(e) {
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


            if($('#issue_table').length) {
                $('#issue_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "issue/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#issue_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_issue_name").val($(this).attr('data-name'));
                            $("#edit_issue_id").val($(this).attr('data-id'));
                        });

                        $('#issue_table').delegate('.bootbox_confirm', 'click', function(e) {
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

            if($('#price_table').length) {
                $('#price_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "price/data",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#price_table').delegate('.simple_edit', 'click', function() {
                            $("#edit_price_id").val($(this).attr('data-id'));
                            $("#edit_article_name").val($(this).attr('data-article'));
                            $("#edit_width_name").val($(this).attr('data-width'));
                            $("#edit_softness_name").val($(this).attr('data-softness'));
                            $("#edit_color_name").val($(this).attr('data-color'));
                            $("#edit_buy_price").val($(this).attr('data-buy-price'));
                            $("#edit_sell_price").val($(this).attr('data-sell-price'));
                        });

                        $('#price_table').delegate('.bootbox_confirm', 'click', function(e) {
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

            if($('#raw_table').length) {
                $('#raw_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'desc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "factory/dataraw",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#raw_table').delegate('.raw_edit', 'click', function() {
                            $("#edit_raw_id").val($(this).attr('data-id'));
                            $("#edit_article_name").val($(this).attr('data-article'));
                            $("#edit_construction_name").val($(this).attr('data-construction'));
                            $("#edit_width_name").val($(this).attr('data-width'));
                            $("#edit_softness_name").val($(this).attr('data-softness'));
                            $("#edit_color_name").val($(this).attr('data-color'));
                            $("#edit_source_name").val($(this).attr('data-source'));
                            $("#edit_raw_date").val($(this).attr('data-date'));
                            $("#edit_raw_received_balance").val($(this).attr('data-received'));
                            $("#edit_raw_lc_no").val($(this).attr('data-lc'));
                            $("#edit_raw_pi_no").val($(this).attr('data-pi'));
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

            if($('#raw_issue_table').length) {
                $('#raw_issue_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "factory/datarawissue/" + $('#raw_issue_raw_id').html(),
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                        
                        $('#raw_issue_table').delegate('.raw_edit_issue', 'click', function() {
                            $("#edit_issue_id").val($(this).attr('data-id'));
                            $("#edit_issue_date").val($(this).attr('data-date'));
                            $("#edit_issue_quantity").val($(this).attr('data-quantity'));
                            $("#edit_issue_type").val($(this).attr('data-type'));
                            $("#edit_total_finish_goods").val($(this).attr('data-total'));
                        });

                        $('#raw_issue_table').delegate('.bootbox_confirm', 'click', function(e) {
                            e.preventDefault();
                            var link = $(this).attr("href");     
                            bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
                                if(result == true) {
                                    location.href = link;
                                }
                            }); 
                        });
                    },
                    "fnFooterCallback": function ( nRow, aaData, iStart, iEnd, aiDisplay ) {
                        var quantity = 0;
                        for ( var i=0 ; i<aaData.length ; i++ )
                        {
                            quantity += aaData[i][3]*1;
                        }

                        var total = 0;
                        for ( var i=iStart ; i<iEnd ; i++ )
                        {
                            total += aaData[ aiDisplay[i] ][4]*1;
                        }

                        var waste = 0;
                        for ( var i=iStart ; i<iEnd ; i++ )
                        {
                            waste += aaData[ aiDisplay[i] ][5]*1;
                        }

                        var nCells = nRow.getElementsByTagName('th');
                        nCells[3].innerHTML = parseInt(quantity);
                        nCells[4].innerHTML = parseInt(total);
                        nCells[5].innerHTML = parseInt(waste);
                    }
                });
            }


            // Inventory Module

            if($('#stock_table').length) {
                $('#stock_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'asc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "aoColumns": [ null, null, null, null, null, null, { "bSearchable": false } ],
                    "sAjaxSource": base_url + "inventory/datastock",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                    },
                    "fnCreatedRow": function( nRow, aData, iDataIndex ) {                        
                        if ( aData[6] <= 2000 )
                        {
                            $('td:eq('+6+')', nRow).css('color', '#D04533');
                        }
                    }
                });
            }

            if($('#delivery_table').length) {
                $('#delivery_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'desc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "inventory/datadelivery",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');

                        $('#delivery_table').delegate('.bootbox_confirm', 'click', function(e) {
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

            // Marketing Module

            if($('#order_table').length) {
                $('#order_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'desc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "marketing/dataorder",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                    }
                });
            }

            if($('#lcstatements_table').length) {
                $('#lcstatements_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'desc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "marketing/datalcstatements",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                    }
                });
            }

            if($('#expissues_table').length) {
                $('#expissues_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "commercial/dataexpissues",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');

                        $('#expissues_table').delegate('.bootbox_confirm', 'click', function(e) {
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

            // Accounts Module

            if($('#cashpayment_table').length) {
                $('#cashpayment_table').dataTable({
                    "sPaginationType": "bootstrap_full",
                    "bSort": true,
                    "aaSorting": [[0, 'desc']],
                    "iDisplayLength": 25,
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": base_url + "accounts/datacashpayment",
                    "sServerMethod": "POST",
                    "sDom": "R<'dt-top-row'Clf>r<'dt-wrapper't><'dt-row dt-bottom-row'<'row'<'col-sm-6'i><'col-sm-6 text-right'p>>",
                    "fnInitComplete": function(oSettings, json) {
                        $('.ColVis_Button').addClass('btn btn-info btn-sm').html('Columns <span class="icon-caret-down"></span>');
                    }
                });
            }

            // Admin Module

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