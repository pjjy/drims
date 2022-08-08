<script>
				   		
        $('.btn_ris_edit').on('click',function(){
            var id              = $(this).attr('data-id');
            var qty             = $(this).attr('data-id1');
            var price 		    = $(this).attr('data-id2');
            
            var qty_approved 	= $(this).attr('data-id4');
        
            $.ajax({
                url: 'ris_edit_r',
                method: 'POST',
                cache: false,
                data:{
                    id:id,
                    qty:qty,
                    price:price
                },
                success:function(data)
                {								
                    bootbox.confirm({
                        title:'Update Quantity and Pricing',
                        message: data,
                        buttons: {
                            cancel: {
                                label: 'No',
                                className: 'btn-danger'
                            },
                                confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            }
                        },
                        callback: function (result) {
                            if(result){
                                
                                var edited_qty = $('.edited_qty').val();
                                var edited_price = $('.edited_price').val();
                                var edited_total = $('.edited_total').val();			

                                if (confirm('Are you sure you want to proceed?') == true) {
                                    $.ajax({
                                        url: 'ris_edit_final_r',
                                            method: 'POST',
                                            cache: false,
                                            data:{
                                                id:id,                       
                                                edited_qty:edited_qty,
                                                edited_price:edited_price,
                                                edited_total:edited_total,
                                                
                                                qty_approved:qty_approved
                                            },
                                            success:function(data)
                                            {
                                                bootbox.hideAll();
                                                bootbox.alert('Quantity and price successfuly updated.');
                                            }
                                        });
                                }   
                            }
                        }
                    }); 
                }
            });						
        });

        $('.add_distribution').on('click', function(){
            var rosit = $(this).attr('data-id');
                $.ajax({
                url: 'add_distribution_r',
                method: 'POST',
                cache: false,
                data:{
                    rosit:rosit
                },
                success:function(data)
                {
                    bootbox.confirm({
                        title:'Please enter trucking and actual release',
                        message: data,
                        buttons: {
                            cancel: {
                                label: 'No',
                                className: 'btn-danger'
                            },
                                confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            }
                        },
                        callback: function (result) {
                            if(result){
                            
                                var warehouse_id = $('.warehouse_sel').val();
                                var trucking_id  = $('.trucking_sel').val();
                                var plannedRelease = $('.plannedrelease').val();	
                                var actualRelease = $('.actualrelease').val();
                                var remarks = $('.remarks').val();																		

                                if(remarks.length === 0 ){
                                    alert('Please enter remarks');
                                }
                                if(actualRelease.length === 0){
                                    alert('Please enter actual release');
                                }	
                                else{
                                    if(confirm('Are you sure you want to proceed?') == true) {
                                            $.ajax({
                                                    url: 'update_add_distribution_r',
                                                    method: 'POST',
                                                    cache: false,
                                                    data:{
                                                        rosit:rosit,
                                                        warehouse_id:warehouse_id,
                                                        trucking_id:trucking_id,
                                                        plannedRelease:plannedRelease,
                                                        actualRelease:actualRelease,
                                                        remarks:remarks
                                                    },
                                                    success:function(data)
                                                    {
                                                        bootbox.hideAll();
                                                        bootbox.alert('Trucking and actual release was successfuly added to this RIS');
                                                    }
                                            });
                                    } 
                                }							        	
                            }
                        }
                    }); 
                }
            });
                
        });	

    

        $('.view_distribution').on('click', function(){
            var rosit = $(this).attr('data-id');
            
                $.ajax({
                url: 'view_distribution_r',
                method: 'POST',
                cache: false,
                data:{
                    rosit:rosit
                },
                success:function(data)
                {
                    bootbox.dialog({
                        title: 'Distribution',
                        onEscape: true,
                        message: data,
                        size: 'extra-large',
                        buttons: {
                            ok: {
                                label: 'Close',
                                className: 'btn-info',
                                callback: function(){
                                    
                                }
                            }
                        }
                    });
                }
                });	
        });	

        $('.print_ris').on('click', function(){
            var rosit = $(this).attr('data-id');
            var drmd_id = $(this).attr('data-id1');
            var ris_no = $(this).attr('data-id2');
            $.ajax({
                url: 'add_pdf_file_data_r',
                method: 'POST',
                cache: false,
                data:{
                    rosit:rosit
                },
                success:function(data)
                {
                    bootbox.confirm({
                        title:'Please enter data for ris printing',
                        message: data,
                        buttons: {
                            cancel: {
                                label: 'No',
                                className: 'btn-danger'
                            },
                            confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            }
                        },
                        callback: function (result) {
                            if(result){
                                    var contactperson  = $('.contactperson').val(); 
                                    var contactnumber  = $('.contactnumber').val();
                                    var drn            = $('.drn').val();
                                    var purpose		   = $('.purpose').val();

                                    

                                    if(confirm('Are you sure you want to proceed?') == true) {

                                        $.ajax({
                                            url: 'save_report_pdf_details_r',
                                            method: 'POST',
                                            cache: false,
                                            data:{
                                                rosit:rosit,
                                                drmd_id:drmd_id,
                                                ris_no:ris_no,
                                                contactperson:contactperson,
                                                contactnumber:contactnumber,
                                                drn:drn,
                                                purpose:purpose
                                            },
                                            // success:function(data)
                                            // {
                                            //     bootbox.dialog({
                                            //         title: 'Distribution',
                                            //         onEscape: true,
                                            //         message: data,
                                            //         size: 'extra-large',
                                            //         buttons: {
                                            //             ok: {
                                            //                 label: 'Close',
                                            //                 className: 'btn-info',
                                            //                 callback: function(){
                                                                
                                            //                 }
                                            //             }
                                            //         }
                                            //     });
                                            // }
                                        });	

                                        window.open('ris_get_reporting_r?rosit='+rosit+'&drmd_id='+drmd_id+'&ris_no='+ris_no+'&contactperson='+contactperson+'&contactnumber='+contactnumber+'&drn='+drn+'&purpose='+purpose, '_blank');
                                    } 
                            }
                        }
                    }); 
                }
            });
        });

      
 </script>