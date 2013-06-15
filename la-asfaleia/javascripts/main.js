$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });

				// Tabs
				$('#tabs').tabs();
				$('#tabs-inside').tabs();
				$( "#tabs-inside" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
				$( "#tabs-inside li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
				
				//menu
				$( "#menu" ).menu({
					position: {at: "left bottom"}
				});

				// Dialog
				$('#dialog-ktimatologio').dialog({
					autoOpen: false,
					width: 800,
					height: 600,
					buttons: {
						"ΟΚ": function() {
							$(this).dialog("close");
						},
						"Άκυρο": function() {
							$(this).dialog("close");
						}
					}
				});

				// Dialog Link
				$('#dialog-ktimatologio-link').click(function(){
					$('#dialog-ktimatologio').dialog('open');
					return false;
				});

				//Timepicker
				$('#ta_datepicker').datepicker({
					inline: true
				});
				$('#ie_datepicker').datepicker({
					inline: true
				});
				
				$('#ta_timestart').timepicker({
					hourGrid: 4,
					minuteGrid: 10,
					timeFormat: 'HH:mm'
				});
				$('#ta_timeend').timepicker({
					hourGrid: 4,
					minuteGrid: 10,
					timeFormat: 'HH:mm'
				});
				$('#ie_timestart').timepicker({
					hourGrid: 4,
					minuteGrid: 10,
					timeFormat: 'HH:mm'
				});
				$('#ie_timeend').timepicker({
					hourGrid: 4,
					minuteGrid: 10,
					timeFormat: 'HH:mm'
				});
				$("input.timepicker").timepicker({
					hourGrid: 4,
					minuteGrid: 10,
					timeFormat: 'HH:mm'
				}); 
				
				//tooltips
				$('#tb_meletes_aa').tooltip();
				$('#tb_meletes_onoma').tooltip();
				$('#tb_meletes_address').tooltip();
				$('#tb_meletes_epiloges').tooltip();
				$('#tb_meletes_teyxos').tooltip();
				
				

				// Slider
				$('#slider').slider({
					range: true,
					values: [17, 67]
				});

				// Progressbar
				$("#progressbar").progressbar({
					value: 20
				});

				//hover states on the static widgets
				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);
				
				$(".btmiddle").click(function() {
                    if ($(".btmiddle").hasClass("bt")) {
                        $(".btmiddle").removeClass("bt");
                        $(".btmiddle").addClass("clicked");
						$("#menu2").hide();
                        $("#menu1").show();
                    } else {
                        $(".btmiddle").removeClass("clicked");
                        $(".btmiddle").addClass("bt");
                        $("#menu1").hide();
                    }
                });
				$(".btright").click(function() {
                    if ($(".btright").hasClass("bt")) {
                        $(".btright").removeClass("bt");
                        $(".btright").addClass("clicked");
						$("#menu1").hide();
                        $("#menu2").show();
                    } else {
                        $(".btright").removeClass("clicked");
                        $(".btright").addClass("bt");
                        $("#menu2").hide();
                    }
                });

			});