/* [ ---- Ebro Admin - notifications ---- ] */

	$(function() {
		//* bootbox.js
		ebro_bootbox.init();
		//* stickyNote
		ebro_sticky.init();
	});
	
	//* bootbox.js
	ebro_bootbox = {
		init: function() {
			$('.bootbox_confirm').click(function(e) {
				var link = $(this).attr("href");
				e.preventDefault();
				bootbox.confirm("<span class='icon-question icon-4x dil-icon'></span>Are you sure you want to delete this item?", function(result) {
					if(result == true) {
						location.href = link;
					}
				}); 
			});			
		}
	}
	
	//* sticky
	ebro_sticky = {
		init: function() {
			$(function(){
                var defaults = {
                    position: 'top-right',
                    speed: 'fast',
                    allowdupes: true,
                    autoclose: 10000,
                    classList: ''
            	};

                function callback(r) {
                    console.log(JSON.stringify(r));
                }

                var msg = $('.msg').html();
            	var msg_type = $('.msg_type').html();

            	if(msg != "") {
					$.stickyNote(msg, $.extend({}, defaults, {classList: 'stickyNote-'+msg_type}));
            	}
            });
		}
	}

