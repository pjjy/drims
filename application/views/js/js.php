<script>
	$(document).ready(function(){
			var req_id;
			var both;
			var non_food;
			var food;

			// showGraph();

			$('.input-images').imageUploader();
			$('.non-food-items').hide();
			$('.food-items').hide();
			$('.autofilled').hide();
			$('.autofilled_disapprove').hide();
			$('.more_details').hide();
			$('.report_tbl').hide();
			$('.windy').hide();
			// $('.others').hide();
			// $('.otherrequester').hide();

			
			
			$(document).ready(function() {
    			$('#drrs_table').DataTable();
			});

			$(document).ready(function() {
    			$('#disapp_dash_table').DataTable();
			});

			$(document).ready(function() {
    			$('#drrs_table1').DataTable();
			});

			$(document).ready(function() {
    			$('#drrs_table2').DataTable();
			});
			
			$('#incident').on('change',function(){
				
				 if($(this).val() == '13'){
					$('#otherincident').removeAttr('disabled'); 
				 }else{
				 	$('#otherincident').attr('disabled', 'enabled'); 
				 	$('#otherincident').val(''); 
				 }
			});	

			$('#requester').on('change',function(){
					// alert($(this).val()); 
				 if($(this).val() == '11'){
					$('#otherrequester').removeAttr('disabled'); 
				 }else{
				 	$('#otherrequester').attr('disabled', 'enabled'); 
				 	$('#otherrequester').val(''); 
				 }
			});	

			$('#province').on('change',function(){
			   var province_id = $('#province option:selected').val();
			 	 $.ajax({
		            url:'get_city_r',
		            method:'POST',
		            cache: false,
		            data:{
		              post_province_id:province_id
		            },
		            success:function(data)
		            { 
		              if(data){
		              	$("#municipality").html(data);
		              }
		            }
			    });
			});	

			

			$('#dash_province').on('change',function(){
			   var province_id = $('#dash_province option:selected').val();
			 	 $.ajax({
		            url:'dash_get_city_r',
		            method:'POST',
		            cache: false,
		            data:{
		              post_province_id:province_id
		            },
		            success:function(data)
		            { 
		              if(data){
		              	$("#municipality").html(data);
		              }
		            }
			    });
			});	


		
			$('#save_bt').on('click',function(){

				var food_item		= [];
				var food_qty 		= [];
				var food_uom 		= [];
			

				var non_food_item   = [];
				var non_food_qty 	= [];
				var non_food_uom 	= [];
	

				$('.food_item').each(function(){
					food_item.push($(this).attr('data-id'));
				});
				
				$('.food-uom').each(function(){
					food_uom.push($(this).val());
				});
				
				$('.food-qty-request').each(function(){
					food_qty.push($(this).val());
				});

				//non food item
				
				$('.non_food_item').each(function(){
					non_food_item.push($(this).attr('data-id'));
				});


				$('.non-food-uom').each(function(){
					non_food_uom.push($(this).val());	
				});

				$('.non-food-requested').each(function(){
					non_food_qty.push($(this).val());
				});


				var incident 	    = $("#incident").val();
				var otherincident   = $("#otherincident").val();
				var province 	    = $("#province").val();
				var municipality    = $("#municipality").val();
				var requester 	    = $("#requester").val();
				var otherrequester  = $("#otherrequester").val();	
				var remarks 	    = $("#remarks").val();
				var datepicker 	    = $("#datepicker").val();
				var datepicker1     = $("#datepicker1").val();

				//if(requester.length <= 0 || datepicker.length <= 0 || datepicker1.length <= 0){
				// bootbox.alert("Hello, please enter some valid values");
				//}

				if(datepicker.length <= 0){
					bootbox.alert("Notice, please enter valid value in date letter request");
				}
				else if(datepicker1.length <= 0){
					bootbox.alert("Notice, please enter valid values in date forwarded in drrs");
				}
				else if(remarks.trim().length <= 0){
					bootbox.alert("Notice, Empty remarks!");
				}
				// else if(food_item == ""){
				// 	alert();
				// }
				else{
					bootbox.confirm({
					    title: "Hello!",
					    message: "Please review you entry before proceeding, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
									$.ajax({
								            url:'save_drmd_r',
								            method:'POST',
								            cache: true,
								            data:{
								                incident       		: incident,
												province       		: province,
											    municipality   		: municipality,
											    otherincident  		: otherincident,
											    requester      		: requester,
											    otherrequester 		: otherrequester,
											    remarks 	   		: remarks,
											    datepicker     		: datepicker,
											    datepicker1    		: datepicker1,
												food_item 			: food_item, 			//array
												food_qty  			: food_qty,				//array
												food_uom     		: food_uom,				//array
												non_food_item		: non_food_item,		//array
												non_food_qty		: non_food_qty,			//array
												non_food_uom		: non_food_uom			//array
								            },
									});
									bootbox.alert({
										message: "Nice, your entry was successfully saved!",
									   		 callback: function(){
									       	 location.reload();
									    }
									});
					         }
					    }
					});
				}
			});	

			$('.drrs_process').on('click',function(){
				$('.autofilled').fadeOut(300);
				$('.autofilled').fadeIn(300);

				$('.autofilled_disapprove').fadeOut(300);

				$('.drrs_save_req').html('<i class="icon-briefcase"></i>Save as approved');
				$('.drrs_save_req').css("background-color", "white");
				$('.drrs_save_req').attr('data-id','1');

				var id 		= $(this).attr('data-id');
				var data1 	= $(this).attr('data-id1');
				var data2 	= $(this).attr('data-id2');
				var data3 	= $(this).attr('data-id3');
				var data4 	= $(this).attr('data-id4');
				var data5 	= $(this).attr('data-id5');
				var data6   = $(this).attr('data-id6');	

				req_id = id;

				$('.reference_no').val(data1);
				$('.type_incident').val(data2);
				$('.province').val(data3);
				$('.municipality').val(data4);
				$('.requester').val(data5);
				$('.congressional_disctrict').val(data6);
					
					$.ajax({
						url: 'drrs_get_item_r',
						method: 'POST',
						cache: false,
						data:{
							id:id
						},
						success:function(data)
						{ 
							$(".assist").html(data);
						} 
					})
			});

			$('.drrs_canel_req').on('click',function(){
				$('.autofilled').hide();
			});

			$('.drrs_process_disapprove').on('click',function(){
				$('.autofilled_disapprove').fadeOut(300);
				$('.autofilled_disapprove').fadeIn(300);

				$('.autofilled').fadeOut(300);

				

				$('.drrs_disapprove_req').attr('data-id','0');

				var id 		= $(this).attr('data-id');
				var data1 	= $(this).attr('data-id1');
				var data2 	= $(this).attr('data-id2');
				var data3 	= $(this).attr('data-id3');
				var data4 	= $(this).attr('data-id4');
				var data5 	= $(this).attr('data-id5');
				var data6   = $(this).attr('data-id6');	

				req_id = id;

				$('.reference_no').val(data1);
				$('.type_incident').val(data2);
				$('.province').val(data3);
				$('.municipality').val(data4);
				$('.requester').val(data5);
				$('.congressional_disctrict').val(data6);

			});


			$('.drrs_distri_process').on('click',function(){
				$('.autofilled').fadeOut(300);
				$('.autofilled').fadeIn(300);
				var id 		= $(this).attr('data-id');
				var data1 	= $(this).attr('data-id1');
				var data2 	= $(this).attr('data-id2');
				var data3 	= $(this).attr('data-id3');
				var data4 	= $(this).attr('data-id4');
				var data5 	= $(this).attr('data-id5');
				var data7	= $(this).attr('data-id7');
				
				req_id = id;

				$('.reference_no').val(data1);
				$('.type_incident').val(data2);
				$('.province').val(data3);
				$('.municipality').val(data4);
				$('.requester').val(data5);
				$('.qty_ffp_req').val(data7);

				$('.more_details').fadeOut(300);
				$('.more_details').fadeIn(300);
				var ris_num = $(this).attr('data-id6');
				$.ajax({
			            url:'drmd_view_details_r',
			            method:'POST',
			            cache: false,
			            data:{
				           ris_num:ris_num
			            },
			            success:function(data)
			            { 
			              if(data){			              
			              	$('.more_details').html(data);
			              	// alert(data);
			              }
			            }
				});

			});

			$('#rad_food_item').on('click',function(){
				food = true;
				non_food = false;
				both = false;
				$('.food-items').fadeIn(300);
				$('.non-food-items').fadeOut(300);
				$('.qty_ffp_req').val('');
				$('.total_qty_distributed').val('');
				$('.total_qty_distributed').attr("readonly",true);
				$('.balance').val('');
				// $('.non-food-qty').each(function(){
    //     			$(this).val('0');
    // 			});
			});

			$('#rad_non_food_item').on('click',function(){
				non_food = true;
				food = false;
				both = false;
				$('.non-food-items').fadeIn(300);
				$('.food-items').fadeOut(300);
				$('.qty_ffp_req').val('');
				$('.total_qty_distributed').val('');
				$('.qty_ffp_req').val($('.no_affected_fam').val());
				$('.total_qty_distributed').attr("readonly",true);
				$('.no_affected_fam').val('');
				$('.qty_ffp_req').val('');
				$('.balance').val('');
				// $('.food-qty').each(function(){
    //     			$(this).val('0');
    // 			});
			});	

			$('.no_affected_fam').on('change',function(){
				if(non_food){
					$('.qty_ffp_req').val($('.no_affected_fam').val());
					$('.total_qty_distributed').attr("readonly",false);
				};
			});

			$('#rad_both').on('click',function(){
				non_food = false;
				food = true;
				both = true;
				$('.non-food-items').slideDown(300);
				$('.food-items').slideDown(300);
				// $('.qty_ffp_req').val('');
				$('.total_qty_distributed').val('');
				$('.total_qty_distributed').attr("readonly",true);
				$('.balance').val('');
			});	

			$('.food_text').on('change',function(){
				if(food){
					$('.qty_ffp_req').val($(this).val());
					if($(this).val() <= 0){
						$('.qty_ffp_req').val('');
						$('.total_qty_distributed').attr("readonly", true);
					}else{
						$('.total_qty_distributed').attr("readonly", false);
					}
				}
			});	

			$('.total_qty_distributed').on('change',function(){
				$('.balance').val($('.qty_ffp_req').val() - $(this).val());
				if($('.balance').val() < 0){
					alert('Your total quantity distributed is much higher than your FFPs requested');
					$(this).val('');
					$(this).attr("readonly", true);
					$('.balance').val('');
					$('.qty_ffp_req').val('');
					$('.food_text').val('0');
				}
			});	



			$('.drmd_more_details').on('click',function(){

 				$('.more_details').fadeIn(100);
				$('.more_details').fadeOut(100);
				var drmd_id = $(this).attr('value');
				$.ajax({
			            url:'drmd_view_details_r',
			            method:'POST',
			            cache: false,
			            data:{
				           drmd_id:drmd_id
			            },
			            success:function(data)
			            { 
			              if(data){			              
			              	$('.more_details').html(data);
			              	// alert(data);
			              }
			            }
				});
			});	

			$('.drrs_save_req').on('click',function(){
			
			
			    var	item_id_arr			= [];			
	    	    var	cqty_uom_arr		= [];
	    	    var	cqty_requested_arr	= [];
	    	    var	cqty_release_arr    = [];

				//food item
				$('.food_item').each(function(){
	    			food_item.push($(this).attr('data-id'));
				});
				
				$('.food-qty-request').each(function(){
       				food_requested.push($(this).val());
    			});
			    
			    //
				$('.item_id').each(function(){
					item_id_arr.push($(this).attr('data-id6'));
				});

				$('.cqty_uom').each(function(){
					cqty_uom_arr.push($(this).attr('data-id6'));
				});

				$('.cqty_requested').each(function(){
					cqty_requested_arr.push($(this).val());	
				});

				$('.cqty_release').each(function(){
					cqty_release_arr.push($(this).val());
				});
	    		
	    		// item_id			
	    		// cqty_uom		
	    		// cqty_requested	
	    		// cqty_release    
			    
				var date_letter_req_rec_from_drmd 	= $('.date_letter_req_rec_from_drmd').val();
				var date_approval_drmd 			  	= $('.date_approval_drmd').val();
				var date_incident 					= $('.date_incident').val();
				var num_beneficiaries				= $('.num_beneficiaries').val();
				if(date_letter_req_rec_from_drmd <= 0){
					bootbox.alert("Hello, please enter valid values in date forwarded in drrs");
				}
				else if(date_approval_drmd <= 0){
					bootbox.alert("Hello, please enter valid values in date forwarded in drrs");
				}
				else if(date_incident <= 0){
					bootbox.alert("Hello, please enter valid values in date forwarded in drrs");
				}
				else if(num_beneficiaries <= 0){
					bootbox.alert("Hello, please enter valid values in date forwarded in drrs");
				}	
				else{
					bootbox.confirm({
					    title: "Hello!",
					    message: "Please review you entry before proceeding, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function(result){
					         if(result){
								$.ajax({
						            url:'save_drrs_r',
						            method:'POST',
						            cache: false,
						            data:{
							            req_id							: req_id,
							         	date_letter_req_rec_from_drmd	: date_letter_req_rec_from_drmd,
										date_approval_drmd				: date_approval_drmd,
										date_incident					: date_incident,
										num_beneficiaries				: num_beneficiaries,
										item_id_arr						: item_id_arr,
										cqty_uom_arr					: cqty_uom_arr,
										cqty_requested_arr				: cqty_requested_arr,
										cqty_release_arr				: cqty_release_arr
						            },
						            success:function(data)
						            { 
						              if(data){
						                bootbox.alert({
										    message: "Nice, your entry was successfully saved!",
										    callback: function() {
										       location.reload();
										    }
										});
						              }
						            }
							    });
					         }
					    }
					});
				}
				
			});

			$('.drrs_disapprove_req').on('click',function(){
				var reasons = $('.reasons').val();
				
				bootbox.confirm({
					    title: "Hello!",
					    message: "Please review you entry before proceeding, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
								$.ajax({
						            url:'save_drrs_disapprove_r',
						            method:'POST',
						            cache: false,
						            data:{
							            req_id	: req_id,
							            reasons : reasons
						            },
						            success:function(data)
						            { 
						              if(data){
						              
						              	bootbox.alert({
										    message: "Nice, your entry was successfully saved!",
										    callback: function() {
										       location.reload();
										    }
										});
						              }
						            }
							    });
					         }
					    }
					});
			});


			$('.btn_add_date').on('click',function(){
				var drid = $(this).attr('value');
				bootbox.prompt({
				    title: "Date Acknowledgement  Notice of Approval Sent to LGU",
				    inputType: 'date',
				    callback: function(date){
				    if(date){
						$.ajax({
						url:'drmd_add_date_r',
						method:'POST',
						cache: false,
						data:{
							date:date,
							drid:drid
						},
						success:function(data)
						{ 
							alert("Date Added");
						} 
					  });	
				     }
				   }
				});
			});


				
			$('.rros_process').on('click',function(){
				$('.autofilled').fadeOut(300);
				$('.autofilled').fadeIn(300);
				var id 		= $(this).attr('data-id');
				var data1 	= $(this).attr('data-id1');
				var data2 	= $(this).attr('data-id2');
				var data3 	= $(this).attr('data-id3');
				var data4 	= $(this).attr('data-id4');
				var data5 	= $(this).attr('data-id5');
				var data6   = $(this).attr('data-id6');
				
				req_id = id;

				console.log(req_id);
					
				$('.reference_no').val(data1);
				$('.type_incident').val(data2);
				$('.province').val(data3);
				$('.municipality').val(data4);
				$('.requester').val(data5);
				$('.congressional_disctrict').val(data6);

				$.ajax({
						url: 'rros_get_item_r',
						method: 'POST',
						cache: false,
						data:{
							id:id
						},
						success:function(data)
						{ 
							$(".assist").html(data);
						} 
					 });	

			});
 
 
			$('.drrs_distri_save_req').on('click',function(){
				
				var no_affected_fam 		= $('.no_affected_fam').val();
				var qty_ffp_req 			= $('.qty_ffp_req').val();
				var date_of_distribution 	= $('.date_of_distribution').val();
				var total_qty_distributed 	= $('.total_qty_distributed').val();
				var balance 				= $('.balance').val();
				var area_of_distribution 	= $('.area_of_distribution').val();
				var total_no_asper_rds 		= $('.total_no_asper_rds').val();
				var date_of_submission 		= $('.date_of_submission').val();
				var date_received 			= $('.date_received').val();
				var doc_upload 				= $('.doc_upload').val();
				
				
				bootbox.confirm({
					    title: "Hello!",
					    message: "Please review you entry before proceeding, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
								$.ajax({
							            url:'drrs_distri_save_req_r',
							            method:'POST',
							            cache: false,
							            data:{
								            	req_id					: req_id,
												no_affected_fam			: no_affected_fam,
												qty_ffp_req				: qty_ffp_req,
												date_of_distribution	: date_of_distribution,
												total_qty_distributed	: total_qty_distributed,
												balance					: balance,
												area_of_distribution	: area_of_distribution,
												total_no_asper_rds		: total_no_asper_rds,
												date_of_submission		: date_of_submission,
												date_received			: date_received,
												doc_upload				: doc_upload
							            },
							            success: function(data)
							            {
							              if(data){
											bootbox.alert({
											    message: "Nice, your entry was successfully saved!",
											    callback: function(){
											       		location.reload();
											    }
											});
							              }
							            }
							    });
					         }
					    }
					});
			});


			$('.rros_save_req').on('click',function(){
				var item_uom				= [];
				var items 					= [];			
				var qty_requested			= [];
				var qty_approved			= [];
				var qty_released 			= [];
				var qty_left				= [];
				var price 					= [];
				var total 					= []; 	
				// var province_origin			= [];
				// var warehouse 				= [];
				// var trucking 				= [];

				var date_let_aprv_drmd		= $('.date_let_aprv_drmd').val();	
				var date_crd_pull_fr_drmd   = $('.date_crd_pull_fr_drmd').val();
				var date_ris_frw_drmd		= $('.date_ris_frw_drmd').val();
				var warehouse_origin 		= $('.province_sel').val();
				var t;
				var y;

				$('.cqty_uom').each(function(){
					 item_uom.push($(this).attr('data-id6'));
				});
				
				//
				$('.item_id').each(function(){
					 items.push($(this).attr('data-id6'));
				}); 
				//
				
				$('.cqty_requested').each(function(){
	    			qty_requested.push($(this).val());
				});

				$('.cqty_approved').each(function(){
					qty_approved.push($(this).val());
				});

				$('.cqty_release').each(function(){
	    			qty_released.push($(this).val());

					if(this.value == ""){
						t = true;
					}else{
						t = false;
					}
				});

				$('.cqty_left').each(function(){
	    			qty_left.push($(this).val());
				});

				$('.cprice').each(function(){
	    			price.push($(this).val());

					if(this.value == ""){
						y = true;
					}else{
						y = false;
					}
				});

				$('.ctotal').each(function(){
	    			total.push($(this).val());
				});

				// $('.province_sel').each(function(){
				// 	province_origin.push($(this).val());
				// });

				// $('.warehouse_sel').each(function(){
	   			//	warehouse.push($(this).val());
				// });

				// $('.trucking_sel').each(function(){
	   			//	trucking.push($(this).val());
				// });
				
				// alert(req_id);
				if(t == true || y == true){
					bootbox.alert("Please enter price and quantity release");
				}	
				else if( $('.date_let_aprv_drmd').val() == "" || $('.date_crd_pull_fr_drmd').val() == "" || $('.date_ris_frw_drmd ').val() == ""){
					bootbox.alert("Please enter date values");
				}
				//if(price == null)
				else if(req_id!=null){
					bootbox.confirm({
					    title: "Hello!",
					    message: "Please review you entry before proceeding, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
									$.ajax({														
							            url:'rros_save_req_r',                                  
							            method:'POST',                                          
							            cache: false,                                           
							            data:{												   	
								            	req_id				   : req_id,                
												date_let_aprv_drmd	   : date_let_aprv_drmd,    
												date_crd_pull_fr_drmd  : date_crd_pull_fr_drmd, 
												date_ris_frw_drmd	   : date_ris_frw_drmd,   
												warehouse_origin	   : warehouse_origin,
												
												item_uom			   : item_uom, 			   // array
												items 				   : items,				   // array
												qty_requested		   : qty_requested, 	   // array
												qty_approved		   : qty_approved,		   // array
												qty_released		   : qty_released, 		   // array
												qty_left			   : qty_left,			   // array
												price 				   : price, 			   // array
												total 				   : total,				   // array
												// province_origin		   : province_origin 	   // array
												// warehouse		   : warehouse,		       // array	
												// trucking			   : trucking			   // array
							            },
							            success: function(data)
							            {
							              if(data){
											bootbox.alert({
											    message: "Nice, your entry was successfully saved!",
											    callback: function(){
											         location.reload();
											    }
											});
							              }
							            }
								    });
					         }
					    }
					});
				}else{
					bootbox.alert({
					    message: "Please enter valid data",					    
					});
				}
			});	


			$('.rros_cancel_req').on('click',function(){
				$('.autofilled').hide();
			});


			$('.rros_save_req1').on('click',function(){
				var id 						= [];
				var item_uom				= [];
				var items 					= [];			
				var qty_requested			= [];
				var qty_approved			= [];
				var qty_released 			= [];
				var qty_left				= [];
				var price 					= [];
				var total 					= []; 
				// var warehouse 				= [];
				// var trucking 				= [];

				var date_let_aprv_drmd		= $('.date_let_aprv_drmd').val();	
				var date_crd_pull_fr_drmd   = $('.date_crd_pull_fr_drmd').val();
				var date_ris_frw_drmd		= $('.date_ris_frw_drmd').val();
				

	


				$('.cqty_uom').each(function(){
					item_uom.push($(this).attr('data-id6'));
				});
				
				//
				$('.item_id').each(function(){
					id.push($(this).attr('data-id7'));
				}); 

				$('.item_id').each(function(){
					 items.push($(this).attr('data-id6'));
				}); 
				//
				
				$('.cqty_requested').each(function(){
	    			qty_requested.push($(this).val());
				});

				$('.cqty_approved').each(function(){
					qty_approved.push($(this).val());
				});

				$('.cqty_release').each(function(){
	    			qty_released.push($(this).val());
				});

				$('.cqty_left').each(function(){
	    			qty_left.push($(this).val());
				});

				$('.cprice').each(function(){
	    			price.push($(this).val());
				});

				$('.ctotal').each(function(){
	    			total.push($(this).val());
				});

				$('.warehouse_sel').each(function(){
	    			warehouse.push($(this).val());
				});

				$('.trucking_sel').each(function(){
	    			trucking.push($(this).val());
				})
				
				// alert(items);

				if(req_id!=null){
					bootbox.confirm({
					    title: "Hello!",
					    message: "Please review you entry before proceeding, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
									$.ajax({
							            url:'rros_save_req_r1',
							            method:'POST',
							            cache: false,
							            data:{
							            		id 					   : id,
								            	req_id				   : req_id,
												date_let_aprv_drmd	   : date_let_aprv_drmd,
												date_crd_pull_fr_drmd  : date_crd_pull_fr_drmd,
												date_ris_frw_drmd	   : date_ris_frw_drmd,
												item_uom			   : item_uom, 			 // array
												items 				   : items,				 // array
												qty_requested		   : qty_requested, 	 // array
												qty_approved		   : qty_approved,		 // array
												qty_released		   : qty_released, 		 // array
												qty_left			   : qty_left,			 // array
												price 				   : price, 			 // array
												total 				   : total				 //	array
												// warehouse			   : warehouse,			 // array	
												// trucking			   : trucking			 // array
							            },
							            success: function(data)
							            {
							              if(data){
											bootbox.alert({
											    message: "Nice, your entry was successfully saved!",
											    callback: function(){
											         location.reload();
											    }
											});
							              }
							            }
								    });
					         }
					    }
					});
				}else{
					bootbox.alert({
					    message: "Please enter valid data",					    
					});
				}
			});	

			$('#cancel_bt').on('click', function(){
				$('.report_tbl').hide();
			});

			$('#filter_bt').on('click',function(){
				var	incident     = $('#incident').val();
				var	province  	 = $('#province').val();
				var	municipality = $('#municipality').val();
				var	requester    = $('#requester').val();
				var	datepicker   = $('#datepicker').val();
				var datepicker1  = $('#datepicker1').val();

				$.ajax({
		            url:'fetch_report_r',
		            method:'POST',
		            cache: false,
		            data:{
			            incident  	 :incident,
						province  	 :province,
						municipality :municipality,
						requester 	 :requester,
						datepicker 	 :datepicker,
						datepicker1  :datepicker1
		            },
		            success: function(data)
		            {
 					  $('.report_tbl').show();	
		              if(data){
						$('.rep_result').html(data);
		              }if($.trim(data) == ""){
		              	$('.rep_result').html("<p>NO DATA FOR THIS FOR NOW</p>");
		              }
		            },
			    });
			});

			 
			$('.disapp_btn').on('click', function(){
				var drid = $(this).attr('data-id');
				bootbox.confirm({
					    title: "Warning!",
					    message: "Please review you entry before cancelling, thank you",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
								 $.ajax({
							            url:'drrs_disapprove_r',
							            method:'POST',
							            cache: false,
							            data:{
								            drid:drid
							            },
							            success: function(data)
							            {
					 					  bootbox.alert({
											    message: "Your entry was successfully cancelled!",
											    callback: function(){
											       location.reload();
											    }
											});
							            },
				   				 });		
					       }
					    }
					});
			});

			
			$('.undo_btn').on('click',function(){
				var drid = $(this).attr('data-id');

				bootbox.confirm({
					    title: "Warning!",
					    message: "Are you sure you want to restore this request?",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
								 $.ajax({
							            url: 'drrs_undo_r',
							            method:'POST',
							            cache: false,
							            data:{
								            drid:drid
							            },
							            success: function(data)
							            {
					 					  bootbox.alert({
											    message: "Your entry was successfully restored!",
											    callback: function(){
											       location.reload();
											    }
											});
							            },
				   				 });		
					       }
					    }
					});
			
			});

			$('.btn_rrsmoredet').on('click',function(){
				var drid = $(this).attr('data-id');
				// $('.rrosmore_details').fadeOut(300);
				// $('.rrosmore_details').fadeIn(300);
				$.ajax({
			            url:'drmd_view_details_r',
			            method:'POST',
			            cache: false,
			            data:{
				           drid:drid
			            },
			            success:function(data)
			            { 
			              if(data){
			              	// alert(data);			              
			              	// $('.rrosmore_details').html(data);
			              	// alert(data);
			              	bootbox.dialog({
							    // title: 'A custom dialog with buttons and callbacks',
							    onEscape: true,
							    message: data,
							    size: 'large',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                console.log('Custom OK clicked');
							            }
							        }
							    }
							});

			              }
			            }
				});

			});

			$('.btn_print').on('click',function(){
				bootbox.prompt({
				    title: "This is a prompt with a textarea!",
				    inputType: 'textarea',
				    callback: function (result) {
				        alert(result);
				    }
				});
	 		});	

	 		$('.rros_process_delinquent').on('click',function(){
				$('.autofilled').fadeOut(300);
				$('.autofilled').fadeIn(300);
				var id 	   = $(this).attr('data-id');
				var data1  = $(this).attr('data-id1');
				var data2  = $(this).attr('data-id2');
				var data3  = $(this).attr('data-id3');
				var data4  = $(this).attr('data-id4');
				var data5  = $(this).attr('data-id5');
				var data6  = $(this).attr('data-id6');

				req_id = id;
				
				$('.reference_no').val(data1);
				$('.type_incident').val(data2);
				$('.province').val(data3);
				$('.municipality').val(data4);
				$('.requester').val(data5);
				$('.congressional_disctrict').val(data6);

				$.ajax({
					url: 'rros_get_del_r',
					method: 'POST',
					cache: false,
					data:{
						id:id
					},
					success:function(data)
					{
					  $(".assist").html(data);
					  // alert(data);
					}
				});

	 		});	


	 		$('.minimize_btn').on('click',function(){
	 			 $('.windy').toggle();
	 		});


	        function showGraph()
	        {

	            {
	                $.post("chart_r",
	                function(data)
	                {
	                    console.log(data);
	                    var name = [];
	                    var marks = [];

	                    for (var i in data){
	                        name.push(data[i].qty_left);
	                        marks.push(data[i].qty_left);
	                    }

	                    var chartdata = {
	                        labels: name,
	                        datasets:[
	                            {
	                                label: 'Distributed',
	                                backgroundColor: '#49e2ff',
	                                borderColor: 'white',
	                                hoverBackgroundColor: '#CCCCCC',
	                                hoverBorderColor: '#666666',
	                                data: marks
	                            }
	                        ]
	                    };

	                    var graphTarget = $("#marketingOverview");
	                    var barGraph = new Chart(graphTarget, {
	                        type: 'bar',
	                        data: chartdata
	                    });
	                });
	            }
	        }

			$('.btn_drmd_details_dash').on('click',function(){
				var drmd_id = $(this).attr('data-id');
	 			//$('.status_details').fadeOut(300);
				//$('.status_details').fadeIn(300);
	 			
	 		    $.ajax({
					url: 'drmd_details_dash_r',
					method: 'POST',
					cache: false,
					data:{
						drmd_id:drmd_id
					},
					success:function(data)
					{
					  // $(".status_details").html(data);
					  bootbox.dialog({
							    // title: 'A custom dialog with buttons and callbacks',
							    onEscape: true,
							    message: data,
							    size: 'extra-large',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                // console.log('Custom OK clicked');
							            }
							        }
							    }
							});
					  }
				});
			});
	        

	        $('.btn_drmd_details').on('click',function(){
	 			var drmd_id = $(this).attr('data-id');
	 			//$('.status_details').fadeOut(300);
				//$('.status_details').fadeIn(300);
	 			
	 		    $.ajax({
					url: 'drmd_details_r',
					method: 'POST',
					cache: false,
					data:{
						drmd_id:drmd_id
					},
					success:function(data)
					{
					  // $(".status_details").html(data);
					  bootbox.dialog({
							    // title: 'A custom dialog with buttons and callbacks',
							    onEscape: true,
							    message: data,
							    size: 'extra-large',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                // console.log('Custom OK clicked');
							            }
							        }
							    }
							});
					  }
				});
	 		});



	 		$('.btn_drmd_disapp_details').on('click',function(){
				var drmd_id = $(this).attr('data-id');
	 			//$('.status_details').fadeOut(300);
				//$('.status_details').fadeIn(300);
	 			
	 		    $.ajax({
					url: 'btn_drmd_disapp_details_r',
					method: 'POST',
					cache: false,
					data:{
						drmd_id:drmd_id
					},
					success:function(data)
					{
					  // $(".status_details").html(data);
					  bootbox.dialog({
							    // title: 'A custom dialog with buttons and callbacks',
							    onEscape: true,
							    message: data,
							    size: 'extra-large',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                // console.log('Custom OK clicked');
							            }
							        }
							    }
							});
					  }
				});
			});


	 		$('.btn_dir').on('click',function(){
	 			var prov_id = $(this).attr('data-id');

	 		});


	 		$('.btn_rros_edit').on('click',function(){
	 			alert();
	 		});

	 		$('#first_name').keypress('click',function(){
				$('#first_name').css('border-color', '');
	 		});


	 		$('#last_name').keypress('click',function(){
				$('#last_name').css('border-color', '');
	 		});

	 		$('.su_saveuser').on('click',function(){
	 			
	 			var	first_name = $('#first_name').val();
	 			var	last_name  = $('#last_name').val();
	 			var user_name = $('#user_name').val();
	 			var	usertype  = $('#usertype').val();

	 			if(first_name == "" ){
	 				$('#first_name').css('border-color', 'red');
	 			}
				
	 			if(last_name == ""){
	 				$('#last_name').css('border-color', 'red');
	 			}

	 			if(user_name == ""){
	 				$('#user_name').css('border-color', 'red');
	 			}

	 			if(first_name != ""){
	 				$('#first_name').css('border-color', '');
	 			}

	 			if(last_name != ""){
	 				$('#last_name').css('border-color', '');
	 			}

	 			if(user_name != ""){
	 				$('#user_name').css('border-color', '');
	 			}
	 			
	 			if(first_name != "" && last_name != "" && user_name != ""){
	 				bootbox.confirm({
					    title: "Hello!",
					    message: "Are you sure you want to add this user?",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
									$.ajax({
										url: 'su_saveuser_r',
										method: 'POST',
										cache: false,
										data:{
											first_name :first_name,
											last_name  :last_name,
											user_name  :user_name,
											usertype   :usertype
										},
										success:function(data)
										{
										  bootbox.alert({
										    message: "New user was successfully added!",
										    callback: function(){
										       location.reload();
										    }
										  });
										}
									});		
					       }
					    }
					});
	 			}
	 		});
	 		 

	 		$('.update_funds_bt').on('click',function(){
	 			bootbox.prompt({
				    title: "ENTER STAND-BY BALANCE",
				    inputType: 'number',
				    min: '0',
				    required: true,
				    callback: function(amount){
				    if(amount){
						$.ajax({
						url: 'rros_update_stand_fund_r',
						method: 'POST',
						cache: false,
						data:{
							amount:amount
						},
						success:function(amount)
						{ 
							 bootbox.alert({
							    message: "Your stand by funds was successfully updated",
							    callback: function(){
							       location.reload();
							    }
							 });
						} 
					  });	
				     }
				   }
				});
	 		});
			
			$('.updateSt_fund_btn').on('click', function(){
	 				var fund = $(this).attr('data-id');
					var id 	 = $(this).attr('data-id1'); 
					bootbox.prompt({
				    title: "UPDATE STAND BY FUND", 
				    inputType: 'number',
				    min: '0',
				    value: fund,
				    callback: function(fund){ 
					      if(fund){
					     		$.ajax({
									url: 'rros_update_list_stand_fund_r',
									method: 'POST',
									cache: false,
									data:{
									   id   :id,
									   fund :fund
									},
									success:function(amount)
									{ 
										 bootbox.alert({
										    message: "Your stand by funds was successfully updated",
										    callback: function(){
										       location.reload();
										    }
										  });
									} 
							  });	
					      }   	
				    }
				});
	 		});

			$('.dash_view_det').on('click', function(){
				var rosb_id = $(this).attr('id-id');
				$.ajax({
						url: 'dash_view_det_r',
						method: 'POST',
						cache: false,
						data:{
						   rosb_id:rosb_id
						},
						success:function(data)
						{ 
							 bootbox.dialog({
							    // title: 'A custom dialog with buttons and callbacks',
							    onEscape: true,
							    message: data,
							    size: 'large',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                console.log('Custom OK clicked');
							            }
							        }
							    }
							});
						} 
			    });	
			});		

			$('.search').on('click',function(){
				var search = $('.search_txt').val();
				$.ajax({
						url: 'search_r',
						method: 'POST',
						cache: false,
						data:{
						   search:search
						},
						success:function(data)
						{ 
							bootbox.dialog({
							    title: 'Search results',
							    onEscape: true,
							    message: data,
							    size: 'extra-small',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                console.log('Custom OK clicked');
							            }
							        }
							    }
							});
						} 
			    });
			});

			$('.reset_btn').on('click',function(){
				var id = $(this).attr('data-id');
				bootbox.confirm({
					    title: "Hello!",
					    message: "Are you sure you want to add this user?",
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
					         if(result){
									$.ajax({
										url: 'su_reset_user_r',
										method: 'POST',
										cache: false,
										data:{
											id:id
										},
										success:function(data)
										{
										  bootbox.alert({
										    message: "User was successfully reset!",
										    callback: function(){
										       location.reload();
										    }
										  });
										}
									});		
					        }
					    }
					});
			});


			
			$('.update_pass_bt').on('click',function(){
				
				var currentpassword	= $('.current_password').val();
				var newpassword 	= $('.new_password').val();

				if(currentpassword == "" ){
	 				$('.current_password').css('border-color', 'red');
	 			}
				if(newpassword == "" ){
	 				$('.new_password').css('border-color', 'red');
	 			}

				 
				if(currentpassword != ""){
					$('.current_password').css('border-color', '');
				}
				if(newpassword != ""){
					$('.new_password').css('border-color', '');
				}
		
				// alert();
				if(currentpassword !="" && newpassword !=""){

					$.ajax({
							url: 'update_pass_r',
							method: 'POST',
							cache: false,
							data:{
								currentpassword:currentpassword,
								newpassword:newpassword
							
							},
							success:function(data)
							{
								// alert(data);
								
								if(data == 2){
									bootbox.alert({
									message: "Please enter your correct password",
									
									});
								}
								
								
								if(data == 1){
									bootbox.alert({
									message: "Password is successfully updated , You will be log out now",
									callback: function(){
										window.location = 'logout_r';
									}
									});
								}
							}
						});	

					}
				
			});
			

			$('.btn_add_response_letter').on('click',function(){
				var id = $(this).attr('data-id');
				$.ajax({
					url: 'drmd_add_response_letter_r',
					method: 'POST',
					cache: false,
					data:{
						id:id
					},
					success:function(data)
					{	
					 bootbox.confirm({
					    title: " ",
					    message: data,
					    buttons: {
					        cancel: {
					            label: 'Cancel'
					        },
					        confirm: {
					            label: 'Confirm'
					        }
					    },
					    callback: function (result){
							if(result){
								if($('.response_date').val() == ""){
									bootbox.alert({
										    message: "Please enter a valid date!",
										    // callback: function(){
										    //    location.reload();
										    // }
										  });
								}else{
									// alert($('.response_date').val());
									var response_date = $('.response_date').val();
								
									$.ajax({
										url: 'drmd_save_response_letter_r',
										method: 'POST',
										cache: false,
										data:{
											id:id,
											response_date:response_date
										},
										success:function(data1)
										{
										  bootbox.alert({
										    message: "Date response successfully added!",
										    callback: function(){
										       location.reload();
										    }
										  });
										}
									});		

								}
							}
					    }
					  });	
					}
				});	
			});		


			$('.btn_view_response_letter').on('click',function(){
				var drmd_id = $(this).attr('data-id');
				$.ajax({
						url: 'drmd_view_response_letter_r',
						method: 'POST',
						cache: false,
						data:{
							drmd_id:drmd_id
						},
						success:function(data)
						{
							bootbox.alert({
							message: data,
							callback: function(){
							
							}
							});
						}
					});	
			});

			$('.wr_add_stockpile').on('click',function(){
										$.ajax({
											url:"add_stockpile_form_r",
											method:"POST",
											cache: false,
											data:{
												title:'Add stockpile'
											},
											success:function(data){
												bootbox.confirm({
													title:"Add stockpile",
													message: data,
													buttons: {
														cancel: {
															label: "No",
															className: "btn-danger"
														},
														 confirm: {
															label: "Yes",
															className: "btn-success"
														}
													},  
													callback: function (result) {
														if(result){
															var stockpile_count = $(".stockpile_count").val();
															if(stockpile_count.length === 0){
																alert("Please enter some value!");
															}
															else{
																if(confirm("Are you sure you want to proceed?") == true) {
																	$.ajax({
																		url: 'add_stockpile_r',
																		method: 'POST',
																		cache: false,
																		data:{
																			stockpile_count:stockpile_count
																		},
																		success:function(data)
																		{
																			bootbox.alert({
																			message: "Stockpile is Successfully added!",
																			callback: function(){
																				location.reload();
																			}
																		});
																	   }
																	});	
																 } 
															   }						        	
															}
														}
													})
												}
											});
											
			});


			
			$('.wr_edit_stock').on('click',function(){
				var stockpile_id = $(this).attr('data-id');
				
				$.ajax({
						url:"add_stockpile_form_r",
						method:"POST",
						cache: false,
						data:{
							title:'Edit stockpile'
						},
						success:function(data){
							bootbox.confirm({
								title:"edit stockpile",
								message: data,
								buttons: {
									cancel: {
										label: "No",
										className: "btn-danger"
									},
										confirm: {
										label: "Yes",
										className: "btn-success"
									}
								},  
								callback: function (result) {
									if(result){
										var stockpile_count = $(".stockpile_count").val();
										if(stockpile_count.length === 0){
											alert("Please enter some value!");
										}
										else{
											if(confirm("Are you sure you want to proceed?") == true) {
												
												$.ajax({
													url: 'edit_stockpile_r',
													method: 'POST',
													cache: false,
													data:{
														stockpile_count:stockpile_count,
														stockpile_id:stockpile_id
													},
													success:function(data)
													{
														bootbox.alert({
														message: "Stockpile is Successfully updated!",
														callback: function(){
															location.reload();
														}
													});
													}
												});	
											  } 
											}						        	
										}
									}
								})
							}
						});

			});


			$('.show_all_labangon').on('click',function(){
				$.ajax({
						url: 'show_all_bohol_r',
						method: 'POST',
						cache: false,
						data:{
						   province: '0722'
						},
						success:function(data)
						{ 
							bootbox.dialog({
							    title: 'Labangon Stock pile',
							    onEscape: true,
							    message: data,
							    size: 'extra-small',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                console.log('Custom OK clicked');
							            }
							        }
							    }
							});
						} 
			    });
			});

			$('.show_all_bohol').on('click',function(){
				$.ajax({
						url: 'show_all_bohol_r',
						method: 'POST',
						cache: false,
						data:{
						   province: '0712'
						},
						success:function(data)
						{ 
							bootbox.dialog({
							    title: 'Bohol Stock pile',
							    onEscape: true,
							    message: data,
							    size: 'extra-small',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                console.log('Custom OK clicked');
							            }
							        }
							    }
							});
						} 
			    });
			});

			$('.show_all_negros').on('click',function(){
				$.ajax({
						url: 'show_all_bohol_r',
						method: 'POST',
						cache: false,
						data:{
						   province: '0746'
						},
						success:function(data)
						{ 
							bootbox.dialog({
							    title: 'Negros Stock pile',
							    onEscape: true,
							    message: data,
							    size: 'extra-small',
							    buttons: {
							        ok: {
							            label: "Close",
							            className: 'btn-info',
							            callback: function(){
							                console.log('Custom OK clicked');
							            }
							        }
							    }
							});
						} 
			    });
			});

	})
</script>