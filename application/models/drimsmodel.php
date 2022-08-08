<?php 
    class drimsmodel extends CI_Model {
        public function __construct(){
		    // Call the CI_Model constructor
		    parent::__construct();
		}


		public function get_incident_mod(){
			$this->db->select('*');
	    	$this->db->from('incident as inci');
	    	$this->db->order_by('inci.id', 'asc'); 
	    	$query = $this->db->get();
	    	return $query->result_array();
		}

		public function get_requester(){
			$this->db->select('*');
	    	$this->db->from('requester as req');
	    	$this->db->order_by('req.id', 'asc'); 
	    	$query = $this->db->get();
	    	return $query->result_array();
		}

		public function get_province_mod(){
			$this->db->select('*');
    		$this->db->from('refprovince as prov');
    		$this->db->where('prov.active', '1');
    		$query = $this->db->get();
    		return $query->result_array();
		}
		
		 public function get_default_city_mod($id_sa_bohol){
	    	$this->db->select('*');
	    	$this->db->from('refcitymun as city');
			$this->db->where('city.provCode', $id_sa_bohol);
			$query = $this->db->get();
    		return $query->result_array();
	    }

		
		
	    public function dash_get_city_mod($post_province_id){
			// echo $post_province_id;
	    	$this->db->select('*');
	    	$this->db->from('refcitymun as city');
	    	$this->db->where('city.provCode', $post_province_id);
	    	$query = $this->db->get();
	    	$data = $query->result_array();
			echo '<option value="">ALL</option>';
	   		foreach ($data as $value){
   				echo 
   				'
   				 	<option value='.$value['citymunCode'].'>'.$value['citymunDesc'].'</option>
   				';
   			}
	    }


	    public function get_city_mod($post_province_id){
	    	$this->db->select('*');
	    	$this->db->from('refcitymun as city');
	    	$this->db->where('city.provCode', $post_province_id);
	    	$query = $this->db->get();
	    	$data = $query->result_array();
			echo '<option value="">ALL</option>';
	   		foreach ($data as $value){
   				echo 
   				'
   				 	<option value='.$value['citymunCode'].'>'.$value['citymunDesc'].'</option>
   				';
   			}
	    }

	    public function btn_drmd_disapp_details_mod($drmd_id){
			$this->db->select('*,drmd_req.id as drid,reqs.description as requester_desc , drmdrusr.first_name as drf_name, drmdrusr.last_name as drl_name , inci.description as incident_desc,other_req.requester as other_req, ot_inci.incident as other_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num , drmd_req.created as dr_created , drusr.first_name as dr_fname,drusr.last_name as dr_lname, drrs_disapp.created as drs_created, drmd_req.remarks as drmdremarks');
			$this->db->from('drrs_disapprove as drrs_disapp');
			$this->db->join('drmd_request as drmd_req','drmd_req.id = drrs_disapp.drmd_id','inner');
			$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
			$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
			$this->db->join('requester as reqs','reqs.id = drmd_req.requester','inner');
			$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
			$this->db->join('users as drusr','drusr.user_id = drrs_disapp.added_by', 'left');
			$this->db->join('users as drmdrusr','drmdrusr.user_id = drmd_req.added_by', 'left');
			                                        
			$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
			$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');

			// $this->db->join('users as usr_det', 'usr_det.user_id = drrs_disapp.added_by','inner');
	    	
	    	$this->db->where('drrs_disapp.drmd_id', $drmd_id);
	    
	    	$query = $this->db->get();
	    	$data = $query->row_array();
    		
    		$drf_name = $data['drf_name'];
	   		$drl_name = $data['drl_name'];
	   		$dr_created = date('m/d/Y h:i:s a', strtotime($data['dr_created'])); 

				$dr_fname = $data['dr_fname'];
				$dr_lname = $data['dr_lname'];
				$drs_created = date('m/d/Y h:i:s a', strtotime($data['drs_created']));

				// $rs_fname = $data['rs_fname'];
				// $rs_lname = $data['rs_lname'];
				// $rs_created = date('m/d/Y h:i:s a', strtotime($data['rs_created']));
				// $ris_stat = $data['rros_it_drmd_id'];			

				// $ris_btn = '<a class="ris_btn" data-id='.$data['rros_it_drmd_id'].' href="">Click to view RIS</a>';


				$years	    = "";
				$months	    = "";
				$days	    = "";
				$hours	    = "";
				$minuts  	= "";
				$seconds	= "";

				$rrosyears	= "";
				$rrosmonths	= "";
				$rrosdays	= "";
				$rroshours	= "";
				$rrosminuts	= "";
				$rrosseconds	= "";


				if($drf_name == null){
						$drf_name = "";
				}

				if($drl_name == null){
						$drl_name = "";
				}
				
				if($dr_created == '01/01/1970 08:00:00 am'){
						$dr_created = "";
				}
				
				if($dr_fname == null){
						$dr_fname = "";						
				}
				
				if($dr_lname == null){
						$dr_lname = "";
				}
				
				if($drs_created == '01/01/1970 08:00:00 am'){
						$drs_created = "";
				}
				
				// if($rs_fname == null){
				// 		$rs_fname = "";
				// }
				
				// if($rs_lname == null){
				// 		$rs_lname = "";
				// }

				// if($rs_created == '01/01/1970 08:00:00 am'){
				// 		$rs_created = "";	
				// }

				// if($ris_stat == null){
				// 		$ris_btn = "";
				// }
				
				if($dr_fname != null){

						$diff = abs(strtotime('01/19/2022 11:25:51 am') - strtotime('01/19/2022 11:12:00 am'));
						// $diff = abs(strtotime($drs_created) - strtotime($dr_created)); 
						$years   = floor($diff / (365*60*60*24)); 
						$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
						$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
						$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
						$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

						if($years == 0){
							$years = "";
						}else{
							$years = $years. 'Yrs';
						}

						if($months == 0){
							$months = "";
						}else{
							$months = $months. 'Months';
						}

						if($days == 0){
							$days = "";
						}else{
							$days = $days.' Days';
						}

						if($hours == 0){
							$hours = "";
						}else{
							$hours = $hours.' Hours';
						}

						if($minuts == 0){
							$minuts = "";
						}else{
							$minuts = $minuts.' Minutes';
						}

						if($seconds == 0){
							$seconds = "";
						}else{
							$seconds= $seconds.' Seconds';
						}

				}	

			
				$status = "";

				// if($data['dissapp_id'] == 0){
					// $status = '<div class="badge badge-opacity-success">APPROVED</div>'; 
				// }else{
					$status = '<div class="badge badge-opacity-warning">DISAPPROVED</div>';
				// }
				

	   		// echo '<a href="javascript:void(0);" class="btn btn-otline-dark align-items-center btn_close_more_det"><i class="icon-close"></i> Close</a><br>';  		

	   		echo '<div class="row">
						<div class="col-md-4">
			              <div class="form-group">
			                   <b><label>DRMD</label></b>
			                </div>
			              </div>
							<div class="col-md-4">
			                 <div class="form-group">
			                   <b><label>DRRS</label></b>
			                </div>
			              </div>
			            <div>';
              echo '<div class="row">
				   			 <div class="col-md-4">                                        
				                  <small>'.$drf_name.' '.$drl_name.'</small><br>
				                  <small>'.$dr_created.'</small>
				              </div>
	   						<div class="col-md-4">
	                        <small>'.$dr_fname.' '.$dr_lname.'</small><br>
	                        <small>'.$drs_created.'</small><br>
	                        <small>'.$years.' '.$months.' '.$days.' '.$hours.' '.$minuts.' '.$seconds.'</small><br>
	                        <small>'.$status.'</small><br>
	                    </div>
	                <div>';		

	             echo '<br>';
	             echo '<div class="row">
						<div class="col-md-4">
			              <div class="form-group">
			                   <b><label>REMARKS</label></b>
			                </div>
			              </div>
							<div class="col-md-4">
			                 <div class="form-group">
			                   <b><label>REASON OF DISAPPROVAL</label></b>
			                </div>
			              </div>
			            <div>';

			    echo '<div class="row">
			    			<div class="col-md-4">
			    				<small>'.$data['drmdremarks'].'</small>
			    			</div>
			    			<div class="col-md-4">
			    				<small>'.$data['reason'].'</small>
			    			</div>
			    	  </div>';        
	            echo '<hr>';

            	$this->db->select('*,itms.description as spec_items,drmd_itms.item as drsItm , drmd_itms.item_requested as drmd_item_req, uom_desc.description as uom_description');
            	$this->db->from('drmd_items as drmd_itms');
	       		$this->db->join('items as itms','itms.id = drmd_itms.item','inner');
	       		$this->db->join('uom as uom_desc','uom_desc.id = drmd_itms.item_uom','inner');
	       		$this->db->where('drmd_itms.drmd_id', $drmd_id);
	       		$this->db->order_by('itms.type', 'desc');
	       	 	$query = $this->db->get();
			  	$data = $query->result_array();
       			echo '<div class="row">
						   <div class="col-md-3">
			                  <div class="form-group">
			                    <b><label>ITEMS</label></b>
			                 </div>
			                </div>
		               	   	<div class="col-md-3">
			                  <div class="form-group">
			                    <b><label>UOM</label></b>
			                 </div>
			               </div>
			               
			                <div class="col-md-3">
			                  <div class="form-group">
			                    <b><label>QTY REQUESTED</label></b>
			                 </div>
			               </div>
			         <div>';

			    	foreach($data as $value){     
       					echo '<div class="row">
			   				 	  <div class="col-md-3">                                        
			                  <small>'.$value['spec_items'].'</small>
			              </div>
			   			  <div class="col-md-3">
			                 <small>'.$value['uom_description'].'</small>
			              </div>
			              <div class="col-md-3">
			                 <small>'.$value['drmd_item_req'].'</small>
			              </div>
			            <div>';	
   				}

	    }

	    public function drmd_details_dash_mod($drmd_id){
	   
	    	$this->db->select('inci.description as inci_desc,drmd_req.incident as inci_num,drmd_req.remarks as drmdremarks,drmd_req.id as drmd_id, drusr.first_name as drf_name, drusr.last_name as drl_name, drmd_req.created as dr_created , usr.first_name as dr_fname,usr.last_name as dr_lname, drs_req.drmd_id as drs_req_id ,drs_req.added_by as drs_by, drs_req.created as drs_created, ros_req.added_by as rs_by,ros_req.created as rs_created,usrs.first_name as rs_fname,usrs.last_name as rs_lname, rros_it.drmd_id as rros_it_drmd_id');
	    	$this->db->from('drmd_request as drmd_req');
	    	$this->db->join('users as drusr','drusr.user_id = drmd_req.added_by', 'left');
			$this->db->join('incident as inci','inci.id = drmd_req.incident','inner');
	    	// $this->db->join('drrs_disapprove as drrs_disapp','drrs_disapp.drmd_id = drmd_req.id','left');
	    	$this->db->join('drrs_request as drs_req','drs_req.drmd_id = drmd_req.id','left');
	    	$this->db->join('users as usr','usr.user_id = drs_req.added_by','left');
	    	$this->db->join('rros_request as ros_req','ros_req.drmd_id = drmd_req.id','left');
	    	$this->db->join('users as usrs','usrs.user_id = ros_req.added_by','left');
	    	$this->db->join('rros_items as rros_it','rros_it.drmd_id = drmd_req.id','left');
	    	$this->db->where('drmd_req.id', $drmd_id);
	    	$query = $this->db->get();

	   		$data = $query->row_array();

	   		// echo json_encode($data); 
	   		// exit();
	   		$drf_name = $data['drf_name'];
	   		$drl_name = $data['drl_name'];
	   		$dr_created = date('m/d/Y h:i:s a', strtotime($data['dr_created'])); 

				$dr_fname = $data['dr_fname'];
				$dr_lname = $data['dr_lname'];
				$drs_created = date('m/d/Y h:i:s a', strtotime($data['drs_created']));

				$rs_fname = $data['rs_fname'];
				$rs_lname = $data['rs_lname'];
				$rs_created = date('m/d/Y h:i:s a', strtotime($data['rs_created']));
				$ris_stat = $data['rros_it_drmd_id'];			

				$years		  = "";
				$months		  = "";
				$days		  = "";
				$hours		  = "";
				$minuts		  = "";
				$seconds	  = "";

				$rrosyears	  = "";
				$rrosmonths	  = "";
				$rrosdays	  = "";
				$rroshours	  = "";
				$rrosminuts	  = "";
				$rrosseconds  = "";


				if($drf_name == null){
						$drf_name = "";
				}

				if($drl_name == null){
						$drl_name = "";
				}
				
				if($dr_created == '01/01/1970 08:00:00 am'){
						$dr_created = "";
				}
				
				if($dr_fname == null){
						$dr_fname = "";						
				}
				
				if($dr_lname == null){
						$dr_lname = "";
				}
				
				if($drs_created == '01/01/1970 08:00:00 am'){
						$drs_created = "";
				}
				
				if($rs_fname == null){
						$rs_fname = "";
				}
				
				if($rs_lname == null){
						$rs_lname = "";
				}

				if($rs_created == '01/01/1970 08:00:00 am'){
						$rs_created = "";	
				}

				if($ris_stat == null){
						$ris_btn = "";
				}
				
				if($dr_fname != null){

						// $diff = abs(strtotime('01/19/2022 11:25:51 am') - strtotime('01/19/2022 11:12:00 am'));

						$diff = abs(strtotime($drs_created) - strtotime($dr_created)); 

						$years   = floor($diff / (365*60*60*24)); 
						$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
						$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
						$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
						$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
						$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

						if($years == 0){
							$years = "";
						}else{
							$years = $years. 'Yrs';
						}

						if($months == 0){
							$months = "";
						}else{
							$months = $months. 'Months';
						}

						if($days == 0){
							$days = "";
						}else{
							$days = $days.' Days';
						}

						if($hours == 0){
							$hours = "";
						}else{
							$hours = $hours.' Hours';
						}

						if($minuts == 0){
							$minuts = "";
						}else{
							$minuts = $minuts.' Minutes';
						}

						if($seconds == 0){
							$seconds = "";
						}else{
							$seconds= $seconds.' Seconds';
						}
				}

				if($rs_fname != null){

						$diff = abs(strtotime($rs_created) - strtotime($drs_created)); 

						$rrosyears   = floor($diff / (365*60*60*24)); 
						$rrosmonths  = floor(($diff - $rrosyears * 365*60*60*24) / (30*60*60*24)); 
						$rrosdays    = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24)/ (60*60*24));
						$rroshours   = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24 - $rrosdays*60*60*24)/ (60*60)); 
						$rrosminuts  = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24 - $rrosdays*60*60*24 - $rroshours*60*60)/ 60); 
						$rrosseconds = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24 - $rrosdays*60*60*24 - $rroshours*60*60 - $rrosminuts*60)); 

						if($rrosyears == 0){
							$rrosyears = "";
						}else{
							$rrosyears = $rrosyears. 'Yrs';
						}


						if($rrosmonths == 0){
							$rrosmonths = "";
						}else{
							$rrosmonths = $rrosmonths. 'Months';
						}


						if($rrosdays == 0){
							$rrosdays = "";
						}else{
							$rrosdays = $rrosdays.' Days';
						}


						if($rroshours == 0){
							$rroshours = "";
						}else{
							$rroshours = $rroshours.' Hours';
						}


						if($rrosminuts == 0){
							$rrosminuts = "";
						}else{
							$rrosminuts = $rrosminuts.' Minutes';
						}


						if($rrosseconds == 0){
							$rrosseconds = "";
						}else{
							$rrosseconds = $rrosseconds.' Seconds';
						}
				}

				  echo '<div class="row">
						  <div class="col-md-4">
			              <div class="form-group">
			                   <b><label>DRMD</label></b>
			                </div>
			              </div>
						  <div class="col-md-4">
			                 <div class="form-group">
			                   <b><label>DRRS</label></b>
			                </div>
			              </div>
			              <div class="col-md-4">
			                 <div class="form-group">
			                   <b><label>RROS</label></b>
			                </div>
			              </div>
			            <div>';
	               echo '<div class="row">
					   			<div class="col-md-4">    
					                 <small>'.$drf_name.' '.$drl_name.'</small><br>
					                 <small>'.$dr_created.'</small>
					            	 </div>
					   			<div class="col-md-4">

		                        <small>'.$dr_fname.' '.$dr_lname.'</small><br>
		                        <small>'.$drs_created.'</small><br>
		                        <small>'.$years.' '.$months.' '.$days.' '.$hours.' '.$minuts.' '.$seconds.'</small><br>
		                    
		                    </div>
		                    <div class="col-md-4">
		                        <small>'.$rs_fname.' '.$rs_lname.'</small><br>
		                        <small>'.$rs_created.'</small><br>
		                        <small>'.$rrosyears.' '.$rrosmonths.' '.$rrosdays.' '.$rroshours.' '.$rrosminuts.' '.$rrosseconds.'</small>
		                    </div>
		             <div>';		

		            echo '<p>Incident:'.$data['inci_desc'].'</p>';
					echo '<p>Remarks:'.$data['drmdremarks'].'</p>'; 
		            echo '<hr>';
	            	$this->db->select('*,drmd_itms.id as drid, drmd_itms.drmd_id as drmdid ,itms.description as spec_items,drmd_itms.item as drsItm , drmd_itms.item_requested as drmd_item_req, uom_desc.description as uom_description');
	            	$this->db->from('drmd_items as drmd_itms');
	            	$this->db->join('drmd_request as drmd_req','drmd_req.id = drmd_itms.drmd_id','inner');
		       		$this->db->join('items as itms','itms.id = drmd_itms.item','inner');
		       		$this->db->join('uom as uom_desc','uom_desc.id = drmd_itms.item_uom','inner');
		       		$this->db->where('drmd_itms.drmd_id', $drmd_id);
		       		// $this->db->where('drmd_itms.isdeleted !=','yes');
		       		$this->db->order_by('itms.type', 'desc');
		       	 	$query = $this->db->get();
				  	$data = $query->result_array();
           			echo '<div class="row">
							    <div class="col-md-3">
				                  <div class="form-group">
				                    <b><label>ITEMS</label></b>
				                 </div>
				                </div>

			               	   	<div class="col-md-3">
				                  <div class="form-group">
				                    <b><label>UOM</label></b>
				                 </div>
				                </div>
				               
				                <div class="col-md-3">
				                  <div class="form-group">
				                    <b><label>QTY REQUESTED</label></b>
				                 </div>
				                </div>
				         <div>';

				    	foreach($data as $value){     
           					echo '<div class="row">
				   				 	  <div class="col-md-3">                                        
				                  <small>'.$value['spec_items'].'</small>
				              </div>
				   			  <div class="col-md-3">
				                 <small>'.$value['uom_description'].'</small>
				              </div>
				              <div class="col-md-4">
				                 <small>'.$value['drmd_item_req'].'</small>
				              	 	 &nbsp;&nbsp;&nbsp;
				              	 	 
					             </div>	             
				            <div>';	
							// <small><a class="drmd_details_add_item" data-id='.$value['drmdid'].' href="javascript:void(0);"  style="color:red">ADD NEW ITEM</a></small>&nbsp;	&nbsp;	&nbsp;
       				}


       				echo '<hr>';
	            	$this->db->select('*,drmd_itms.id as drrsid ,itms.description as spec_items,drmd_itms.item as drsItm , drmd_itms.item_requested as drmd_item_req, uom_desc.description as uom_description');
	            	$this->db->from('drrs_items as drmd_itms');
		       		$this->db->join('items as itms','itms.id = drmd_itms.drmd_id','inner');
		       		$this->db->join('uom as uom_desc','uom_desc.id = drmd_itms.item_uom','inner');
		       		$this->db->where('drmd_itms.drmd_id', $drmd_id);
		       		$this->db->order_by('itms.type', 'desc');
		       	 	$query = $this->db->get();
				  	$data1 = $query->result_array();
           			echo '<div class="row">
							   <div class="col-md-9">
				                  <div class="form-group">
				                    <b><label></label></b>
				                 	</div>
				                </div>
					            <div class="col-md-3">
				                  <div class="form-group">
				                    <b><label>QTY ARPPROVED</label></b>
				                 </div>
				               </div>
				        <div>';
				   
				    	foreach($data1 as $value1){     
           					echo '<div class="row">
				   				  	<div class="col-md-9">                                        
						              </div>
						                 <div class="col-md-3">
						                 <small>'.$value1['item_qty'].'</small>
						             </div>	           	     
				           	      </div>';	
       				}

		 			echo "<script>
		 					$('.drmd_details_remove_item').on('click', function(){
									var drid = $(this).attr('data-id');								
									bootbox.confirm({
								    title: 'Warning!',
								    message: 'Please review you entry before removing, thank you',
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
										            url:'drmd_remove_r',
										            method:'POST',
										            cache: false,
										            data:{
											            drid:drid
										            },
										            success: function(data)
										            {
								 					    bootbox.alert({
														    message: 'Your entry was successfully removed!',
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

						$('.drrs_edit_qty').on('click',function(){
							var drrsid = $(this).attr('data-id');
							var quantity = $(this).attr(' data-id1');
							bootbox.prompt({
							    title: 'Update quantiy',
							    inputType: 'number',
							    min: '0',
							    required: true,
							    callback: function(quantity){
							    if(quantity){
									$.ajax({
									url: 'drrs_update_quatity_r',
									method: 'POST',
									cache: false,
									data:{
										drrsid:drrsid,
										quantity:quantity
									},
									success:function(quantity)
									{ 
										 bootbox.alert({
										    message: 'Quantity was successfully updated',
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

						$('.drmd_details_edit_item').on('click', function(){
							var drid = $(this).attr('data-id');
								
							$.ajax({
							  	url: 'drmd_details_edit_item_r',
								 method: 'POST',
								 cache: false,
								 data:{
								 	drid:drid
								 },
								 success:function(data)
								 {
								 	bootbox.dialog({
								 	    onEscape: true,
								 	    message: data,
								 	    size: 'extra-small',
								 	    buttons: {
								 	        ok: {
									            label: 'Update',
								 	            className: 'btn-info',
								 	            callback: function(){
								 	               			var edit_items 	= $('#edit_items').val();
															var drmd_id     = $('.drmd_details_edit_item').attr('data-id1');
															var edit_uom    = $('#edit_uom').val();
															var remarks     = $('#remarks').val();
															if(edit_uom == null){
																alert('Please enter UOM');
															}else{
																$.ajax({
													            url:'drmd_details_edit_item_r_r',
													            method:'POST',
													            cache: false,
													            data:{
														            drid  	   : drid,
														            drmd_id    : drmd_id,
																	edit_items : edit_items,
																	edit_uom   : edit_uom,
																	remarks    : remarks
													            },
													            success: function(data)
													            {
											 					  bootbox.alert({
																	    message: 'Your entry was successfully updated!',
																	    callback: function(){
																	       location.reload();
																	    }
																	});
													            },
									   					  });
													}		 	               
								 	            }
								 	        }
								 	    }
								 	});
								 }
							  });					  
						});	
					  </script>";          	
	   }

	   public function drmd_details_mod($drmd_id){
	   
		$this->db->select('date_letter_request, date_forwarded_drrs, inci.description as incident_description, drmd_req.incident, drmd_req.typhoonName, drmd_req.remarks as drmdremarks,drmd_req.id as drmd_id, drusr.first_name as drf_name, drusr.last_name as drl_name, drmd_req.created as dr_created , usr.first_name as dr_fname,usr.last_name as dr_lname, drs_req.drmd_id as drs_req_id ,drs_req.added_by as drs_by, drs_req.created as drs_created, ros_req.added_by as rs_by,ros_req.created as rs_created,usrs.first_name as rs_fname,usrs.last_name as rs_lname, rros_it.drmd_id as rros_it_drmd_id');
		$this->db->from('drmd_request as drmd_req');
		$this->db->join('users as drusr','drusr.user_id = drmd_req.added_by', 'left');
		// $this->db->join('drrs_disapprove as drrs_disapp','drrs_disapp.drmd_id = drmd_req.id','left');
		$this->db->join('incident as inci','inci.id = drmd_req.incident','inner');
		$this->db->join('drrs_request as drs_req','drs_req.drmd_id = drmd_req.id','left');
		$this->db->join('users as usr','usr.user_id = drs_req.added_by','left');
		$this->db->join('rros_request as ros_req','ros_req.drmd_id = drmd_req.id','left');
		$this->db->join('users as usrs','usrs.user_id = ros_req.added_by','left');
		$this->db->join('rros_items as rros_it','rros_it.drmd_id = drmd_req.id','left');
		$this->db->where('drmd_req.id', $drmd_id);
		$query = $this->db->get();

		   $data = $query->row_array();

		   // echo json_encode($data); 
		   // exit();
		   $drf_name = $data['drf_name'];
		   $drl_name = $data['drl_name'];
		   $dr_created = date('m/d/Y h:i:s a', strtotime($data['dr_created'])); 

			$dr_fname = $data['dr_fname'];
			$dr_lname = $data['dr_lname'];
			$drs_created = date('m/d/Y h:i:s a', strtotime($data['drs_created']));

			$rs_fname = $data['rs_fname'];
			$rs_lname = $data['rs_lname'];
			$rs_created = date('m/d/Y h:i:s a', strtotime($data['rs_created']));
			$ris_stat = $data['rros_it_drmd_id'];			

			$ris_btn = '<a class="ris_btn" data-id='.$data['rros_it_drmd_id'].' href="">Click to view RIS</a>';


			$years		  = "";
			$months		  = "";
			$days		  = "";
			$hours		  = "";
			$minuts		  = "";
			$seconds	  = "";

			$rrosyears	  = "";
			$rrosmonths	  = "";
			$rrosdays	  = "";
			$rroshours	  = "";
			$rrosminuts	  = "";
			$rrosseconds  = "";


			if($drf_name == null){
					$drf_name = "";
			}

			if($drl_name == null){
					$drl_name = "";
			}
			
			if($dr_created == '01/01/1970 08:00:00 am'){
					$dr_created = "";
			}
			
			if($dr_fname == null){
					$dr_fname = "";						
			}
			
			if($dr_lname == null){
					$dr_lname = "";
			}
			
			if($drs_created == '01/01/1970 08:00:00 am'){
					$drs_created = "";
			}
			
			if($rs_fname == null){
					$rs_fname = "";
			}
			
			if($rs_lname == null){
					$rs_lname = "";
			}

			if($rs_created == '01/01/1970 08:00:00 am'){
					$rs_created = "";	
			}

			if($ris_stat == null){
					$ris_btn = "";
			}
			
			if($dr_fname != null){

					// $diff = abs(strtotime('01/19/2022 11:25:51 am') - strtotime('01/19/2022 11:12:00 am'));

					$diff = abs(strtotime($drs_created) - strtotime($dr_created)); 

					$years   = floor($diff / (365*60*60*24)); 
					$months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
					$days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
					$hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
					$minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
					$seconds = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60 - $minuts*60)); 

					if($years == 0){
						$years = "";
					}else{
						$years = $years. 'Yrs';
					}


					if($months == 0){
						$months = "";
					}else{
						$months = $months. 'Months';
					}


					if($days == 0){
						$days = "";
					}else{
						$days = $days.' Days';
					}


					if($hours == 0){
						$hours = "";
					}else{
						$hours = $hours.' Hours';
					}


					if($minuts == 0){
						$minuts = "";
					}else{
						$minuts = $minuts.' Minutes';
					}


					if($seconds == 0){
						$seconds = "";
					}else{
						$seconds= $seconds.' Seconds';
					}

			}

			if($rs_fname != null){

					$diff = abs(strtotime($rs_created) - strtotime($drs_created)); 

					$rrosyears   = floor($diff / (365*60*60*24)); 
					$rrosmonths  = floor(($diff - $rrosyears * 365*60*60*24) / (30*60*60*24)); 
					$rrosdays    = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24)/ (60*60*24));
					$rroshours   = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24 - $rrosdays*60*60*24)/ (60*60)); 
					$rrosminuts  = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24 - $rrosdays*60*60*24 - $rroshours*60*60)/ 60); 
					$rrosseconds = floor(($diff - $rrosyears * 365*60*60*24 - $rrosmonths*30*60*60*24 - $rrosdays*60*60*24 - $rroshours*60*60 - $rrosminuts*60)); 

					if($rrosyears == 0){
						$rrosyears = "";
					}else{
						$rrosyears = $rrosyears. 'Yrs';
					}


					if($rrosmonths == 0){
						$rrosmonths = "";
					}else{
						$rrosmonths = $rrosmonths. 'Months';
					}


					if($rrosdays == 0){
						$rrosdays = "";
					}else{
						$rrosdays = $rrosdays.' Days';
					}


					if($rroshours == 0){
						$rroshours = "";
					}else{
						$rroshours = $rroshours.' Hours';
					}


					if($rrosminuts == 0){
						$rrosminuts = "";
					}else{
						$rrosminuts = $rrosminuts.' Minutes';
					}


					if($rrosseconds == 0){
						$rrosseconds = "";
					}else{
						$rrosseconds = $rrosseconds.' Seconds';
					}
			}

				echo '<div class="row">
					  <div class="col-md-4">
					  <div class="form-group">
						   <b><label>DRMD</label></b>
						</div>
					  </div>
					  <div class="col-md-4">
						 <div class="form-group">
						   <b><label>DRRS</label></b>
						</div>
					  </div>
					  <div class="col-md-4">
						 <div class="form-group">
						   <b><label>RROS</label></b>
						</div>
					  </div>
					<div>';
			    echo '<div class="row">
						<div class="col-md-4">    
							 <small>'.$drf_name.' '.$drl_name.'</small><br>
								 <small>'.$dr_created.'</small>
							 </div>
						<div class="col-md-4">

						<small>'.$dr_fname.' '.$dr_lname.'</small><br>
							<small>'.$drs_created.'</small><br>
							<small>'.$years.' '.$months.' '.$days.' '.$hours.' '.$minuts.' '.$seconds.'</small><br>
						</div>
						
						<div class="col-md-4">
							<small>'.$rs_fname.' '.$rs_lname.'</small><br>
							<small>'.$rs_created.'</small><br>
							<small>'.$rrosyears.' '.$rrosmonths.' '.$rrosdays.' '.$rroshours.' '.$rrosminuts.' '.$rrosseconds.'</small>
						</div>
				<div>';		
				
				$tyname = "";
				if($data['incident'] == 1){
					$tyname = '<p>Typhoon Name: '.$data['typhoonName'].'</p>';
				}
				echo '<hr>';
				echo '<p>Incident: '.$data['incident_description'].'</p>';
				echo $tyname;
				echo '<p>Remarks: '.$data['drmdremarks'] .'</p>'; 
				
				// $this->db->select('*');
				// $this->db->from();
				// $this->db->join();
				// $this->db->where();
				// $query = $this->db->get();
				// $data = $query->result_array();
				
				echo '<p>Date letter request recieved: '.date("m/d/y", strtotime($data['date_letter_request'])).'</p>';
				echo '<p>Date forwarded to DRRS: '.date("m/d/y", strtotime($data['date_forwarded_drrs'])).'</p>';
				echo '<hr>';

				$this->db->select('*,drmd_itms.id as drid, drmd_itms.drmd_id as drmdid ,itms.description as spec_items,drmd_itms.item as drsItm , drmd_itms.item_requested as drmd_item_req, uom_desc.description as uom_description');
				$this->db->from('drmd_items as drmd_itms');
				$this->db->join('drmd_request as drmd_req','drmd_req.id = drmd_itms.drmd_id','inner');
				$this->db->join('items as itms','itms.id = drmd_itms.item','inner');
				$this->db->join('uom as uom_desc','uom_desc.id = drmd_itms.item_uom','inner');
				$this->db->where('drmd_itms.drmd_id', $drmd_id);
				$this->db->order_by('itms.type', 'desc');
				$query = $this->db->get();
				$data = $query->result_array();
				   echo '<div class="row">
							<div class="col-md-3">
							  <div class="form-group">
								<b><label>ITEMS</label></b>
							 </div>
							</div>

								  <div class="col-md-3">
							  <div class="form-group">
								<b><label>UOM</label></b>
							 </div>
							</div>
						   
							<div class="col-md-3">
							  <div class="form-group">
								<b><label>QTY REQUESTED</label></b>
							 </div>
							</div>
					 <div>';

					foreach($data as $value){     
						   echo '<div class="row">
									  <div class="col-md-3">                                        
							  <small>'.$value['spec_items'].'</small>
						  </div>
							 <div class="col-md-3">	
							 <small>'.$value['uom_description'].'</small>
						  </div>
						  <div class="col-md-4">
							 <small>'.number_format($value['drmd_item_req']).'</small>
									&nbsp;&nbsp;&nbsp;
									'.(($value['drrs_status'] == '1')? '' :'  
									<small><a class="drmd_details_edit_item" data-id='.$value['drid'].' data-id1='.$value['drmdid'].' href="javascript:void(0);" style="color:BLUE">EDIT</a></small>&nbsp;	&nbsp;	&nbsp;
								 <small><a class="drmd_details_remove_item" data-id='.$value['drid'].' href="javascript:void(0);" style="color:green">REMOVE</a></small>').'
							 </div>	             
						<div>';	
						// <small><a class="drmd_details_add_item" data-id='.$value['drmdid'].' href="javascript:void(0);"  style="color:red">ADD NEW ITEM</a></small>&nbsp;	&nbsp;	&nbsp;
				   }


				   echo '<hr>';
				   $this->db->select('*,drmd_itms.id as drrsid ,itms.description as spec_items,drmd_itms.item as drsItm , drmd_itms.item_requested as drmd_item_req, uom_desc.description as uom_description');
				   $this->db->from('drrs_items as drmd_itms');
				   $this->db->join('items as itms','itms.id = drmd_itms.drmd_id','inner');
				   $this->db->join('uom as uom_desc','uom_desc.id = drmd_itms.item_uom','inner');
				   $this->db->where('drmd_itms.drmd_id', $drmd_id);
				   $this->db->order_by('itms.type', 'desc');
				   $query = $this->db->get();
				   $data1 = $query->result_array();
				   echo '<div class="row">
						   <div class="col-md-9">
							  <div class="form-group">
								<b><label></label></b>
								 </div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<b><label>QTY ARPPROVED</label></b>
							 </div>
						   </div>
					<div>';
				
					foreach($data1 as $value1){     
							echo '<div class="row">
									 <div class="col-md-9">                                        
								  </div>    
									 <div class="col-md-3">
									 	<small>'.number_format($value1['item_qty']).'</small>
									 		'.(($this->session->userdata('user')['role'] != '4')? '' : '
											 <small>  <a class="drrs_edit_qty" data-id='.$value1['drrsid'].' data-id1='.$value1['item_qty'].' href="javascript:void(0);" style="color:BLUE">EDIT</a></small>').'
										</div>	           	     
								  </div>';
				   }

				   echo "<script>
						 $('.drmd_details_remove_item').on('click', function(){
								var drid = $(this).attr('data-id');								
								bootbox.confirm({
								title: 'Warning!',
								message: 'Please review you entry before removing, thank you',
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
												url:'drmd_remove_r',
												method:'POST',
												cache: false,
												data:{
													drid:drid
												},
												success: function(data)
												{
												   bootbox.alert({
														message: 'Your entry was successfully removed!',
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

					$('.drrs_edit_qty').on('click',function(){
						var drrsid = $(this).attr('data-id');
						var quantity = $(this).attr(' data-id1');
						bootbox.prompt({
							title: 'Update quantiy',
							inputType: 'number',
							min: '0',
							required: true,
							callback: function(quantity){
							if(quantity){
								$.ajax({
								url: 'drrs_update_quatity_r',
								method: 'POST',
								cache: false,
								data:{
									drrsid:drrsid,
									quantity:quantity
								},  
								success:function(quantity)
								{   
									 bootbox.alert({
										message: 'Quantity was successfully updated',
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

					$('.drmd_details_edit_item').on('click', function(){
						var drid = $(this).attr('data-id');
							     
						$.ajax({
							  url: 'drmd_details_edit_item_r',
							 method: 'POST',
							 cache: false,
							 data:{
								 drid:drid
							 },
							 success:function(data)
							 {
								 bootbox.dialog({
									 onEscape: true,
									 message: data,
									 size: 'extra-small',
									 buttons: {
										 ok: {
											label: 'Update',
											 className: 'btn-info',
											 callback: function(){
														var edit_items 	= $('#edit_items').val();
														var drmd_id     = $('.drmd_details_edit_item').attr('data-id1');
														var edit_uom    = $('#edit_uom').val();
														var remarks     = $('#remarks').val();
														if(edit_uom == null){
															alert('Please enter UOM');
														}else{
															$.ajax({
															url:'drmd_details_edit_item_r_r',
															method:'POST',
															cache: false,
															data:{
																drid  	   : drid,
																drmd_id    : drmd_id,
																edit_items : edit_items,
																edit_uom   : edit_uom,
																remarks    : remarks
															},
															success: function(data)
															{
															   bootbox.alert({
																	message: 'Your entry was successfully updated!',
																	callback: function(){
																	   location.reload();
																	}
																});
															},
															});
													}
																						
											 }
										 }
									 }
								 });
							 }
						  });					  
					});	
				  </script>";			
				  
				  
       }

	   public function drrs_update_quatity_mod($drrsid,$quantity){
	   			$this->db->set('item_qty',$quantity);
				// $this->db->set('item_uom',$edit_uom);
				$this->db->where('id', $drrsid);
				$this->db->update('drrs_items');
	   }

	   public function drmd_details_edit_item_r_r_mod($drid,$drmd_id,$edit_items,$edit_uom,$remarks){
				
				$this->db->set('item',$edit_items);
				$this->db->set('item_uom',$edit_uom);
				$this->db->where('id', $drid);
				$this->db->update('drmd_items');


				$this->db->set('remarks',$remarks);
				$this->db->where('id', $drmd_id);
				$this->db->update('drmd_request');
	   }

	   public function drmd_details_edit_item_mod($drid){
	   			$this->db->select('*,it_oum.id as uom_id ,itms.id as itms_id ,itms.description as itms_description , it_oum.description as uom_description');
	   			$this->db->from('drmd_items as drmd_itms');
	   			$this->db->join('items as itms','itms.id = drmd_itms.item','inner');
	   			$this->db->join('uom as it_oum','it_oum.id = drmd_itms.item_uom','inner');
	   			$this->db->join('drmd_request as drmd_req','drmd_req.id = drmd_itms.drmd_id','inner');
	   			$this->db->where('drmd_itms.id' ,$drid);
	   			$query = $this->db->get();
	   			$data = $query->row_array();

	   			$this->db->select('*');
	   			$this->db->from('items as itms');	   		
	   			$query1 = $this->db->get();
	   			$data1 = $query1->result_array();

	   			// $this->db->select('*');
	   			// $this->db->from();
	   			// $query2 = $this->db->get();
	   			// $data2 = $query2->result_array();
			

   				  echo '<label>EDIT ASSISTANCE</label>
   							<select class="form-control" id="edit_items">
                  			 <option value="'.$data['itms_id'].'">'.$data['itms_description'].'</option>';         		
		                      	foreach($data1 as $value1){
		                      		echo '<option value="'.$value1['id'].'">'.$value1['description'].'</option>';
		                      	}
                  echo	'</select>';

                  echo '<br>';

                  echo '
                  		<label>EDIT UOM</label>
   						<select class="form-control" id="edit_uom">';
                  			
                  			
                  echo 	'</select>';
              
                  echo '<br>';
                  echo '<label>EDIT REMARKS</label>';
                  echo '<textarea type="text" placeholder="Enter remarks if available" class="form-control" id="remarks">'.$data['remarks'].'</textarea>';
			   	

			   	  echo "<script>
			   	 		
						$('#edit_items').on('change', function(){
							var drid = $(this).val();			
							$.ajax({
							  	url: 'drmd_details_edit_uom_r',
								 method: 'POST',
								 cache: false,
								 data:{
								 	drid:drid
								 },
								 success:function(data)
								 {
								 	
								 	$('#edit_uom').html(data);
								 }
							  });
						});	
					  </script>";		
	   }


		public function drmd_details_edit_uom_mod($drid){
			// echo $drid;

			$this->db->select('*,um.description as uom_desc');
			$this->db->from('item_uom as it_oum');
			$this->db->join('uom as um','um.id = it_oum.uom','inner');
			$this->db->where('it_oum.item',$drid);
			$query = $this->db->get();
			$data = $query->result_array();
			foreach($data as $value){
				echo '<option value="'.$value['uom'].'">'.$value['uom_desc'].'</option>';
		    }    
		}			


	    public function save_drmd_mod($incident,$typhoonName,$province,$municipality,$requester,$otherrequester,$otherincident,$remarks,$datepicker,$datepicker1, $food_item, $food_qty, $food_uom, $non_food_item, $non_food_qty, $non_food_uom,$user_id){
	    		$last_id = 0;
				$this->db->select('id');
				$this->db->from('drmd_request as dr');
				$this->db->order_by('dr.id', 'desc');
				$query = $this->db->get();
				$reqdata = $query->result_array();
	      		$last_id = $reqdata[0]['id'];
				$last_id ++;

				$this->db->select('*');
				$this->db->from('refprovince as prov');
				$this->db->where('prov.provCode',$province);
				$query = $this->db->get();
				$reqdata = $query->result_array();
				$prov_name = $reqdata[0]['provDesc'];

				$this->db->select('*');
				$this->db->from('incident as inci');
				$this->db->where('inci.id',$incident);
				$query = $this->db->get();
				$reqdata = $query->result_array();
				$incident_name = $reqdata[0]['description'];
				
		    	$data = array(
						'incident'		 			=> $incident,
						'typhoonName'				=> $typhoonName,
						'reference_no' 	 			=> substr($prov_name,0,3).'-'.strtoupper($incident_name).'-'.date("Ymd").'-'.$last_id,
						'province' 		 			=> $province,
						'mucipality'	 			=> $municipality,
						'requester' 	 			=> $requester,
						'remarks'					=> $remarks,
						'date_letter_request' 	    => date('Y-m-d H:i', strtotime($datepicker.date('H:i'))),
						'date_forwarded_drrs' 	    => date('Y-m-d H:i', strtotime($datepicker1.date('H:i'))),
						'added_by'			    	=> $user_id,	
						'drrs_status'				=> '0',
						'created' 					=> date('Y-m-d H:i:s'),	
						'deleted' 					=> date('Y-m-d H:i:s')
						// 'isdelete'					=> 'no'
					);
					$this->db->insert('drmd_request', $data);

					if(!empty($otherincident)){
							$data = array(
								'drmd_id'		=> $last_id,
								'incident'  	=> $otherincident,
								'created'		=> date('Y-m-d H:i:s'),	
								'deleted'		=> date('Y-m-d H:i:s')	
							);
						$this->db->insert('drmd_other_request_inci',$data);
					}

					 if(!empty($otherrequester)){
							$data = array(
								'drmd_id'		=> $last_id,
								'requester'		=> $otherrequester,
								'created' 		=> date('Y-m-d H:i:s'),	
								'deleted'		=> date('Y-m-d H:i:s')
							);
						$this->db->insert('drmd_other_requester',$data);
					}


					for($q = 0; $q < count($food_item); $q++){ 
		    			if($food_qty[$q] !=0 || $food_qty[$q] != null){
		    					$data = array(
										'drmd_id'			=> $last_id,
										'item'				=> $food_item[$q],
										'item_uom'			=> $food_uom[$q],
										'item_requested'	=> $food_qty[$q],
										'created'			=> date('Y-m-d H:i:s'),	 
										'deleted'			=> date('Y-m-d H:i:s')	 
								);	   
								$this->db->insert('drmd_items', $data); 		
		    			}
		    		}

					for($w = 0; $w < count($non_food_item); $w++){ 
		    			if($non_food_qty[$w] !=0 || $non_food_qty[$w] != null){
		    					$data = array(
										'drmd_id'			=> $last_id,
										'item'				=> $non_food_item[$w],
										'item_uom'			=> $non_food_uom[$w],
										'item_requested'	=> $non_food_qty[$w],
										'created'			=> date('Y-m-d H:i:s'),	 
										'deleted'			=> date('Y-m-d H:i:s')	 
								);	   
								$this->db->insert('drmd_items', $data); 		
		    			}
		    		}
	    }


	    public function get_drmd_request_mod(){
	    	$this->db->select('*,dr.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,dr.incident as inci_num,dr.requester as req_num,other_req.requester as ot_req_desc');
	    	$this->db->from('drmd_request as dr');
	    	$this->db->join('incident as inci', 'inci.id = dr.incident','left');
	    	$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = dr.id','left');
	    	$this->db->join('requester as reqs','reqs.id = dr.requester','left');
	    	$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = dr.id','left');
	    	$this->db->join('refprovince as prov', 'prov.provCode = dr.province','inner');
	    	$this->db->join('refcitymun as mun', 'mun.citymunCode = dr.mucipality','inner');
	    	$this->db->join('users as usr_det','usr_det.user_id = dr.added_by','inner');
	    	$this->db->where('dr.drrs_status','0');
	    	$this->db->where('dr.id NOT IN (SELECT drmd_id FROM drrs_disapprove)', NULL, FALSE);
	    	$this->db->order_by('dr.id', 'desc');
	    	$query = $this->db->get();
    		return $query->result_array();
	    }

	     
		public function get_drmd_request_dash_mod(){
	    	$this->db->select('*,dr.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,dr.incident as inci_num,dr.requester as req_num,other_req.requester as ot_req_desc');
	    	$this->db->from('drmd_request as dr');
	    	$this->db->join('incident as inci', 'inci.id = dr.incident','left');
	    	$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = dr.id','left');
	    	$this->db->join('requester as reqs','reqs.id = dr.requester','left');
	    	$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = dr.id','left');
	    	$this->db->join('refprovince as prov', 'prov.provCode = dr.province','inner');
	    	$this->db->join('refcitymun as mun', 'mun.citymunCode = dr.mucipality','inner');
	    	$this->db->join('users as usr_det','usr_det.user_id = dr.added_by','inner');
	    	
			$this->db->where('dr.id NOT IN (SELECT drmd_id FROM drrs_disapprove)' , NULL , FALSE);
			
			// $this->db->where('dr.drrs_status','0');
	    	// $this->db->where('dr.id NOT IN (SELECT drmd_id FROM drrs_disapprove)', NULL, FALSE);
	    	$this->db->order_by('dr.id', 'desc');
	    	$query = $this->db->get();
    		return $query->result_array();
	    }

	    public function get_drmd_entries_mod(){
	    	$this->db->select('*,date_res.drmd_id as response_id, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
    	   	$this->db->from('drmd_request as drmd_req');
			$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
			$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
			$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
			$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
		   	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','left');
	    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','left');
	    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','left');
	    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','left');
	    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','left');
			$this->db->join('drmd_date_response as date_res','date_res.drmd_id = drmd_req.id','left');
	    	$this->db->where('drmd_req.id NOT IN (SELECT drmd_id FROM drrs_disapprove)', NULL, FALSE);
	       	$this->db->order_by('drmd_req.id', 'desc');
			$this->db->group_by('drmd_req.id');   
	    	$query = $this->db->get();
    		return $query->result_array();
	    }

	    public function get_drrs_request_mod(){
	    	$this->db->select('*, drmd_req.id as drid');
	    	$this->db->from('drrs_request as drs_req');
	    	$this->db->join('drmd_request as drmd_req','drmd_req.id = drs_req.drmd_id','inner');
	    	$this->db->join('refcitymun as muni','muni.citymunCode = drmd_req.mucipality','inner');
	    	$this->db->join('refprovince as prov','prov.provCode = drmd_req.province','inner');
	    	$this->db->join('incident as inci','inci.id = drmd_req.incident','inner');
	    	$this->db->join('users as usr_det','usr_det.user_id = drs_req.added_by','inner');
	    	$this->db->where('drs_req.drmd_id IN (SELECT drmd_id FROM drrs_date_fw)', NULL, FALSE);
	    	$query = $this->db->get();
	    	return $query->result_array();
	    }

	    public function drrs_get_item_mod($drmd_id){    		
				$this->db->select('*,itms.description as spec_items,drd_itms.item as drsItm , drmd_req.created as drmdcreated');
	       		$this->db->from('drmd_items as drd_itms');
				$this->db->join('drmd_request as drmd_req','drmd_req.id = drd_itms.drmd_id','inner');
	       		$this->db->join('items as itms','itms.id = drd_itms.item','inner');
	       		$this->db->join('uom as uom_desc','uom_desc.id = drd_itms.item_uom','inner');
				$this->db->join('users as usr','usr.user_id = drmd_req.added_by','inner');
	       		$this->db->where('drd_itms.drmd_id', $drmd_id);
	       		$this->db->order_by('itms.type', 'desc');
			 	$query = $this->db->get();
			  	$data = $query->result_array();

				echo '<br><h5>Time Encoded: '.date('M/d/Y @ h:i:s a', strtotime($data[0]['drmdcreated'])).'</h5>';
				echo '<h5>Date forwarded to DRRS: '.date('M/d/Y @ h:i:s a', strtotime($data[0]['date_forwarded_drrs'])).'</h5>';
				echo '<h5>Encoded By: '.$data[0]['first_name'].' '.$data[0]['last_name'].'</h5>';
				echo '<br>';
				echo '<hr>';
			  		echo '<br><h5>ASSISTANCE</h5><br>';
					  echo '
						<div class="row">									
			                <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>ITEM</label></b>
			                 </div>
			                </div>
			                <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>UOM</label></b>
			                 </div>
			                </div>
			                <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>REQUESTED</label></b>
			                 </div>
			               </div>
			                <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>APPROVED</label></b>
			                 </div>
			               </div>    
			            <div>';
					  foreach($data as $key => $value){
	    			  echo '
  		   				  <div class="row">
	                    	<div class="col-md-2">
	                    	  <div class="form-group">
	                      	  	<input type="text" class="form-control item_id" data-id6="'.$value['drsItm'].'" value="'.$value['spec_items'].'"readonly/>
	                      	  </div>
	                    	</div>
	                    	
	                    	<div class="col-md-2">
				   			  <div class="form-group">
	                      	  	<input type="text" class="form-control cqty_uom" data-id6="'.$value['item_uom'].'" value="'.$value['description'].'"readonly/>
	                      	  </div>
	                    	</div>

	                     	<div class="col-md-2">
	                    	  <div class="form-group">
	                      	     <input type="" min="0" class="form-control cqty_requested" value="'.$value['item_requested'].'" readonly/>
	                      	  </div>
	                    	</div>
	                    	
	                    	<div class="col-md-2">
	                    		<div class="form-group">
	                      	  <input type="number" min="0" class="form-control cqty_release" />
	                      	 </div>
	                    	</div>	                    	
	             		  </div>';
   					}	
	    }

	    public function get_item_mod(){
	    	$this->db->select('*');
	    	$this->db->from('items as ite');
	    	$this->db->where('ite.type','1');
	    	$this->db->order_by('ite.id', 'desc');
	    	$query = $this->db->get();
	    	return $query->result_array();
	    }

	    public function get_non_food_item_mod(){
	    	$this->db->select('*');
	    	$this->db->from('items as ite');
	    	$this->db->where('ite.type','0');
	    	$this->db->order_by('ite.id', 'desc');
	    	$query = $this->db->get();
	    	return $query->result_array();
	    }

	    public function get_item_uom_mod(){
	    	$this->db->select('*');
	    	$this->db->from('item_uom as it_oum');
	    	$this->db->join('uom as uoms','uoms.id = it_oum.uom','inner');
	    	$query = $this->db->get();
	    	return $query->result_array();
	    }

	    public function drmd_view_details_mod($drid){
	    	$this->db->select('*,um.description as uom_desc ,  rrosit.id as rosit, rrosit.created as rosb_created');
	    	$this->db->from('rros_items as rrosit');
	    	$this->db->join('uom as um','um.id = rrosit.item_uom','inner');
	    	$this->db->join('items as itm','itm.id = rrosit.item','inner');
	        $this->db->join('delivery_and_trucking as del_trc','del_trc.rrosit_id = rrosit.id','left');
	    	$this->db->join('drmd_request as drmd_req','drmd_req.id = rrosit.drmd_id','inner');
	    	$this->db->order_by('rrosit.id', 'asc');
	    	$this->db->where('rrosit.drmd_id', $drid);
	    	$this->db->where('rrosit.qty_released !=', 0);
	    	$query = $this->db->get();
	    	$data = $query->result_array();
	   		
	    
	    	echo '
				<div class="row">
					<div class="col-md-2">
                 <div class="form-group">
                   <b><label>ITEM</label></b>
                </div>
                </div>
                <div class="col-md-1">
                 <div class="form-group">
                   <b><label>UOM</label></b>
                </div>
                </div>

               <div class="col-md-1">
                 <div class="form-group">
                   <b><label>QTY REQUESTED</label></b>
                 </div>
            	 </div>
            	  <div class="col-md-1">
                 <div class="form-group">
                   <b><label>QTY APPROVED</label></b>
                 </div>
            	 </div>
            	 
            	 <div class="col-md-1">
                 <div class="form-group">
                   <b><label>QTY RELEASED</label></b>
                 </div>
            	 </div>

            	 <div class="col-md-1">
                 <div class="form-group">
                   <b><label>PRICE</label></b>
                 </div>
            	 </div>
            	  <div class="col-md-1">
                 <div class="form-group">
                   <b><label>TOTAL</label></b>
                 </div>
            	 </div>

            	   <div class="col-md-2">
                 <div class="form-group">
                   <b><label>RIS NUMBER</label></b>
                 </div>
            	 </div>

            	 <div class="col-md-2">
                 <div class="form-group">
                   <b><label>DATE PROCESSED</label></b>
                 </div>
            	 </div>
            	
          <div>';
				$grand_total = 0;
				
				$button = '';
	    	foreach($data as $key =>  $value){
	    		$key++;
	    		$grand_total += $value['price'] * $value['qty_released'];
	    		

	    		if($value['rrosit_id']){
	    			$button = '<button class="view_distribution button2" data-id="'.$value['rosit'].'">View Distributon</button>'; 
	    		}

   				echo '
	   				 <div class="row">
				   		<div class="col-md-2">
				   		  <div class="form-group">
	                        <p>'.$value['description'].'</p>
	                      </div>
	                    </div>

	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <p>'.$value['uom_desc'].'</p>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <p>'.number_format($value['qty_requested']).'</p>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <p>'.number_format($value['qty_approved']).'</p>
	                      </div>
	                    </div>
	                   
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <p>'.number_format($value['qty_released']).'</p>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <p>₱'.number_format($value['price'],2).'</p>
	                      </div>
	                    </div>

	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <p>₱'.number_format($value['price'] * $value['qty_released'],2).'</p>
	                      </div>
	                    </div>

	                    <div class="col-md-2">
	                      <div class="form-group">
	                    	<p>'.$value['field_office'].'-'.substr($value['reference_no'],0,3).'-'.$value['ris_no'].'  '.$button.'</p>
	                      </div>
	                    </div>

	                    <div class="col-md-2">
	                      <div class="form-group">
	                    	<p>'.date('m/d/Y h:i:s a', strtotime($value['rosb_created'])).'</p>
	                      </div>
	                    </div>
	                 <div>';
   				}
   				echo '<br><br>';
   				echo '<div class="row">
	              				<div class="col-md-3">
	                    		<div class="form-group">
	                    		  <h3 class="grandTotal">₱'.number_format($grand_total,2).'</h3>
	                      	  <h3>GRAND TOTAL</h3>
	                      	 </div>
	                    	</div>
	              		</div>';	    
	    
	             echo 
						"
						<script>
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
										title: 'hello',
									    onEscape: true,
									    message: data,
									    size: 'extra-large',
									    buttons: {
									        ok: {
									            label: 'Close',
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

					  </script>";

					  echo '<style>
							.button2 {background-color: #008CBA;} /* Blue */
							.button3 {background-color: #f44336;} /* Red */ 
							</style>'; 		
	    }

	    public function drrs_dristibution_mod($drid){   	    	

			$this->db->select('*, um.description as uom_desc , rrosit.drmd_id as rros_drmd_id , rrosit.id as rosit ,rrosit.created as rosb_created , usr_det1.first_name as f_name, usr_det1.last_name as l_name');
	    	$this->db->from('rros_items as rrosit');
	    	$this->db->join('uom as um','um.id = rrosit.item_uom','inner');
	    	$this->db->join('items as itm','itm.id = rrosit.item','inner');
	    	// $this->db->join('delivery_and_trucking as del_trc','del_trc.rrosit_id = rrosit.id','inner');
	    	$this->db->join('users as usr_det1', 'usr_det1.user_id = rrosit.added_by','inner');
	    	$this->db->join('drmd_request as drmd_req','drmd_req.id = rrosit.drmd_id','inner');
			$this->db->join('refprovince as province','province.provCode = rrosit.province_origin','inner');
	    	// $this->db->order_by('rrosit.id', 'asc');
	    	$this->db->where('rrosit.drmd_id', $drid);
	    	$this->db->where('rrosit.qty_released !=', 0);
	    	$query = $this->db->get();
	    	$data = $query->result_array();
			
	   		echo '
				<div class="row">
					<div class="col-md-2">
                 <div class="form-group">
                   <b><label>ITEM</label></b>
                </div>
                </div>
                <div class="col-md-1">
                 <div class="form-group">
                   <b><label>UOM</label></b>
                </div>
                </div>
                <div class="col-md-1">
                 <div class="form-group">
                   <b><label>QTY REQUESTED</label></b>
                 </div>
            	 </div>
            	  <div class="col-md-1">
                 <div class="form-group">
                   <b><label>QTY APPROVED</label></b>
                 </div>
            	 </div>
            	 
            	 <div class="col-md-1">
                 <div class="form-group">
                   <b><label>QTY RELEASED</label></b>
                 </div>
            	 </div>
            	 <div class="col-md-1">
                 <div class="form-group">
                   <b><label>PRICE</label></b>
                 </div>
            	 </div>
            	  <div class="col-md-1">
                 <div class="form-group">
                   <b><label>TOTAL</label></b>
                 </div>
            	 </div>
            	 <div class="col-md-3">
                  <div class="form-group">
                   <b><label>RIS NUMBER</label></b>
                  </div>
            	 </div>
            	 <div class="col-md-1">
                  <div class="form-group">
                   <b><label>DATE PROCESSED</label></b>
                  </div>
            	 </div>
               <div>';

			   $grand_total = 0;
			   $button = '';
			   $buttonView = '';
			   
			   foreach($data as $key =>  $value){
	    		$key ++;
	    		$grand_total += $value['price'] * $value['qty_released'];
				
				// $print = '<button class="print_ris button2" data-id="'.$value['rosit'].'"  data-id1="'.$value['rros_drmd_id'].'" data-id2="'.$value['ris_no'].'">Print</button>'; 
				
				$print = '<div class="dropdown">
							<button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuSizeButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								'.$value['field_office'].'-'.substr($value['provDesc'],0,3).'-'.$value['ris_no'].' By '.$value['f_name'].' '.$value['l_name'].'
							</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3" style="">
								    <a class="view_distribution dropdown-item" data-id="'.$value['rosit'].'" href="#"><i class="mdi mdi-eye"></i>&nbsp;&nbsp;&nbsp;View distribution</a>
									<a class="add_distribution  dropdown-item" data-id="'.$value['rosit'].'" href="#"><i class="mdi mdi-playlist-plus"></i>&nbsp;&nbsp;&nbsp;Add distribution</a>
									<a class="print_ris dropdown-item" data-id="'.$value['rosit'].'"  data-id1="'.$value['rros_drmd_id'].'" data-id2="'.$value['ris_no'].'" href="#"><i class="mdi mdi-printer"></i>&nbsp;&nbsp;&nbsp;Print RIS</a>
								</div>
						</div>';
					

					if($this->session->userdata('user')['role'] != '7'){
						$edit_btn = '<a href="javascript:void(0);" <button data-id="'.$value['rosit'].'" data-id1="'.$value['qty_released'].'" data-id2="'.$value['price'].'" data-id3="'.$value['qty_left'].'" data-id4="'.$value['qty_approved'].'" class="btn_ris_edit"><div class="badge badge-opacity-success">Edit</div></a>';
   				    }else{
						$edit_btn = "";
					}
					
				echo '
	   				 <div class="row">
				   		<div class="col-md-2">
				   		  <div class="form-group">			 
	                        <small>'.$edit_btn.'  '.ucwords(strtolower($value['description'])).'</small>
	                      </div>
	                    </div>
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <small>'.$value['uom_desc'].'</small>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <small>'.number_format($value['qty_requested']).'</small>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <small>'.number_format($value['qty_approved']).'</small>
	                      </div>
	                    </div>
	                   
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <small>'.number_format($value['qty_released']).'</small>
	                      </div>
	                    </div>
	                    
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <small>₱'.number_format($value['price'],2).'</small>
	                      </div>
	                    </div>
	                    <div class="col-md-1">
	                      <div class="form-group">
	                        <small>₱'.number_format($value['price'] * $value['qty_released'],2).'</small>
	                      </div>
	                    </div>
	                    <div class="col-md-3">
	                      <div class="form-group">
						    <small>'.$button.'  '.$buttonView.'  '.$print.'</small>
	                      </div>
	                    </div>
	                    <div class="col-md-1">
	                      <div class="form-group">
	                    	<small>'.date('m/d/Y h:i:s a', strtotime($value['rosb_created'])).'</small>
	                      </div>
	                    </div>
	                 <div>';
   				}
   				echo '<br><br>';
   				echo '<div class="row">
	              				<div class="col-md-3">
	                    		<div class="form-group">
	                    		  <h3 class="grandTotal">₱'.number_format($grand_total,2).'</h3>
	                      	  <h3>GRAND TOTAL</h3>
	                      	 </div>
	                    	</div>
	              		</div>';	    			
			
		}

		public function ris_edit_mod($id, $qty, $price){

				$total = $price * $qty;

				echo '<div class="col-md-12">
				<div class="form-group">
						<small><a href="javascript:void(0);" data-id="'.$id.'" class="view_edit_history">View edit history</a></small>
				 </div>
	      		</div>';

				echo '<div class="col-md-12">
						  <div class="form-group">
						 	<label>Qty Released</label>
							<input type="number" min="0" value="'.$qty.'" class="form-control edited_qty">
						  </div>
						</div>';

				echo '<div class="col-md-12">
						<div class="form-group">
						   <label>Price</label>
						  <input type="number" min="0" value="'.$price.'" class="form-control edited_price">
						</div>
					  </div>';

				echo '<div class="col-md-12">
					  <div class="form-group">
						 <label>Total</label>
						<input type="number" min="0" value="'.$total.'" class="form-control edited_total" disabled>
					  </div>
					</div>'; 

				echo  "<script>
				$('.edited_qty, .edited_price').on('keyup', function(){
					$('.edited_total').val($('.edited_qty').val() * $('.edited_price').val());				
				});

				
				$('.view_edit_history').on('click',function(){
					var id = $(this).attr('data-id');
					$.ajax({
						url: 'view_edit_history_r',
						method: 'POST',
						cache: false,
						data:{
							id:id
						},
						success:function(data)
						{ 
							bootbox.dialog({
							    title: 'Edit history',
							    onEscape: true,
							    message: data,
								
							    size: 'extra-small',
							    buttons: {
							        ok: {
							            label: 'Close',
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
				</script>";	
		}		

		public  function view_edit_history_mod($id){
				$this->db->select('*');
				$this->db->from('rros_items_edit_history as edit_history');
				$this->db->join('users as usr','usr.user_id = edit_history.added_by', 'inner');
				$this->db->where('edit_history.rros_id', $id);
				$query = $this->db->get();
				$data = $query->result_array();
			
				echo '<div class="row">
						<div class="col-md-1">
							<div class="form-group">
								<b><label>#</label></b>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<b><label>Released</label></b>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<b><label>Price</label></b>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<b><label>Total</label></b>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<b><label>Peson</label></b>
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<b><label>Date</label></b>
							</div>
						</div>
					</div>';

				foreach($data as $key => $value){
					$key++;
					echo '<div class="row">
							<div class="col-md-1">
								<div class="col-md-2">
									<p>'.$key.'.</p>
								</div>
							</div>

							<div class="col-md-2">
								<div class="col-md-2">
									<p>'.$value['qty_realeased'].'.</p>
								</div>
							</div>

							<div class="col-md-2">
								<div class="col-md-2">
									<p>'.$value['price'].'.</p>
								</div>
							</div>

							<div class="col-md-2">
								<div class="col-md-2">
									<p>'.$value['total'].'.</p>
								</div>
							</div>
                                							 						
							<div class="col-md-2">
								<div class="col-md-2">
									<p>'.$value['first_name'].' '.$value['last_name'].'.</p>
								</div>
							</div>
                                
							<div class="col-md-2">
								<div class="col-md-2">
									<p>'.$value['created'].'.</p>
								</div>
							</div>					
						</div>';
				}	
		}

		public function ris_edit_final_mod($id,$qty_approved,$edited_qty,$edited_price,$edited_total){
				//update	
				$this->db->set('qty_released', $edited_qty);
				$this->db->set('price', $edited_price);
				$this->db->set('qty_left', $qty_approved - $edited_qty);
				$this->db->set('total', $edited_total);
				$this->db->where('id', $id);
				$this->db->update('rros_items');

				// insert edit_history
				$data = array(
					'rros_id'	    => $id,
					'qty_realeased' => $edited_qty,
					'price'         => $edited_price,
					'total'         => $edited_total,
					'added_by'		=>  $this->session->userdata('user')['user_id'],
					'created'       => date('Y-m-d H:i:s'),	
					'deleted'       => date('Y-m-d H:i:s')	
				);
				$this->db->insert('rros_items_edit_history', $data);

		}

		public function add_distribution_mod($rosit){

				$this->db->select('*');
				$this->db->from('rros_items as rositem');
				$this->db->where('rositem.id', $rosit);
				$query = $this->db->get();
				$data0 = $query->result_array();
				
				
				$this->db->select('*');
				$this->db->from('trucking');
				$query = $this->db->get();
				$data1 = $query->result_array();

				$this->db->select('*');
				$this->db->from('Warehouse');
				$query = $this->db->get();
				$data2 = $query->result_array();

				$this->db->select('*');
				$this->db->from('delivery_and_trucking as d_n_t');
				$this->db->where('d_n_t.rrosit_id', $rosit);
				$this->db->order_by('d_n_t.id', 'desc');
				$query = $this->db->get();
				$data3 = $query->row_array();
				
				// $data0[0][''] - $data0[0]['qty_released'];
				
				// $q = $data0[0]['qty_released'] - $data3['actual_release'];
				$b = 0;
				if(isset($data3)){
					$b = $data3['actual_left'];
				}else{   
					$b =  $data0[0]['qty_released'];
				}
				
				echo '<div class="col-md-12">
					<div class="form-group">
					<label>Select Warehouse*</label>
						<select class="form-control warehouse_sel">';
							foreach($data2 as $value2){
								echo '<option value ='.$value2['id'].'>'.$value2['description'].'</option>';
							}
						echo '</select>
					</div>
				</div>';

				echo '<div class="col-md-12">
					<div class="form-group">
					<label>Select Trucking*</label>
						<select class="form-control trucking_sel">';
							foreach($data1 as $value1){
								echo '<option value ='.$value1['id'].'>'.$value1['description'].'</option>';
							}
					  echo '</select>
					</div>
				</div>';
				
				echo '
				<div class="col-md-12">
					<div class="form-group">
							<label>Planned release</label>
							<input type="number" value="'.$data0[0]['qty_released'].'" min="0" class="form-control plannedrelease" disabled="true">
					</div>
				</div>';			

				echo '
				<div class="col-md-12">
					<div class="form-group">
							<label>Qty left</label>
							<input type="number" value="'.$b.'" min="0" class="form-control plannedrelease" disabled="true">
					</div>
				</div>';

				echo '
				<div class="col-md-12">
					<div class="form-group">
							<label>Actual Release*</label>
							<input type="number" min="0" class="form-control actualrelease">
					</div>
				</div>';

				echo '<div class="col-md-12">
					<div class="form-group">
					<label>Remarks*</label>
							<textarea class="form-control remarks"></textarea>
					</div>
				</div>';

		}	    


	    // public function get_drrs_distri_liqui_mod(){
	    // 	$this->db->select('*, drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
	    // 	$this->db->from('rros_request as ros_req');
	    // 	$this->db->join('drmd_request as drmd_req','drmd_req.id = ros_req.drmd_id','inner');
	    // 	$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
	    // 	$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
	    // 	$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
	    // 	$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
	    // 	$this->db->join('refcitymun as muni','muni.citymunCode = drmd_req.mucipality','inner');
	    // 	$this->db->join('refprovince as prov','prov.provCode = drmd_req.province','inner');
	    // 	$this->db->join('users as usr_det','usr_det.user_id = ros_req.added_by','inner');
	    // 	$this->db->join('drrs_request as drs_req','drs_req.drmd_id = ros_req.drmd_id','inner');
	    // 	$this->db->where('ros_req.drmd_id NOT IN (SELECT drmd_id FROM drrs_request_distri)', NULL, FALSE);
	    // 	$query = $this->db->get();
	    // 	return $query->result_array();
	    // }

	    public function login_auth_mod($username, $password){
	    	$this->db->select('*, usr.id as usr_id');
	    	$this->db->from('users as usr');
	    	$this->db->where('usr.user_name',$username);
	    	$this->db->where('usr.password',md5($password));
			 $query = $this->db->get();
			return $query->row_array();
	    }

	    public function login_auth_update_mod($id,$user_id,$new_password,$email){
	    	
		  	 $data = array(
			 		'user_id'  => $user_id,
			 		'email'	   => $email,
			 		'created'  => date('Y-m-d H:i:s'),	
			 		'deleted'  => date('Y-m-d H:i:s')	
			 );
			 $this->db->insert('user_details', $data);
			 $this->db->set('status','1');
			 $this->db->set('password',md5($new_password));
			 $this->db->where('id', $id);
			 $this->db->update('users');

	    }

	    public function save_drrs_mod(
		    	$drmd_id,
				$date_letter_req_rec_from_drmd,
				$date_approval_drmd,
				$date_incident,
				$num_beneficiaries,
				$item_id_arr,
				$cqty_uom_arr,
				$cqty_requested_arr,
				$cqty_release_arr,
				$user_id
			){	


	    		$data = array(
						'drmd_id'							=> $drmd_id,
						'date_letter_req'					=> date('Y-m-d', strtotime($date_letter_req_rec_from_drmd)),
						'date_approval' 					=> date('Y-m-d', strtotime($date_approval_drmd)),
						'date_incident' 					=> date('Y-m-d', strtotime($date_incident)),
						'no_beneficiaries'				 	=> $num_beneficiaries,
						'added_by'							=> $user_id,
						'created' 							=> date('Y-m-d H:i:s'),	
						'deleted' 							=> date('Y-m-d H:i:s')
				);
				$this->db->insert('drrs_request', $data);

	    		for($q = 0; $q < count($item_id_arr); $q++){
	    			     	$data1 = array(
									 	'drmd_id'			=> $drmd_id,
									 	'item'				=> $item_id_arr[$q],
									 	'item_uom'			=> $cqty_uom_arr[$q],
									 	'item_requested'	=> $cqty_requested_arr[$q],
									 	'item_qty'  		=> $cqty_release_arr[$q],
									 	'created'			=> date('Y-m-d H:i:s'),	 
									 	'deleted'			=> date('Y-m-d H:i:s')	 
							);	   
							$this->db->insert('drrs_items', $data1); 		
	    	 	}
			


    			$this->db->set('drrs_status','1');
				$this->db->where('id', $drmd_id);
				$this->db->update('drmd_request');

	       }

	       public function save_drrs_disapprove_mod($req_id, $reasons){
	       			$data = array(
							'drmd_id'		=> $req_id,
							'reason'		=> $reasons,
							'added_by'		=> $this->session->userdata('user')['user_id'],
						 	'created'		=> date('Y-m-d H:i:s'),	 
						 	'deleted'		=> date('Y-m-d H:i:s')	
					 );
					 $this->db->insert('drrs_disapprove', $data);
	       }


	       public function drrs_distri_save_req_mod(
	       	 $drmd_id,
	         $no_affected_fam,
					 $qty_ffp_req,
					 $date_of_distribution,
					 $total_qty_distributed,
					 $balance,
					 $area_of_distribution,
					 $total_no_asper_rds,
					 $date_of_submission,
					 $date_received,
					 $doc_upload,
					 $user_id
				 ){
	       				$data = array(
							'drmd_id'					=> $drmd_id,
							'no_affected_fam'			=> $no_affected_fam,
							'qty_ffp_req'				=> $qty_ffp_req,
							'date_of_distribution'		=> date('Y-m-d', strtotime($date_of_distribution)),
							'total_qty_distributed'		=> $total_qty_distributed,
							'balance'					=> $balance,
							'area_of_distribution'		=> $area_of_distribution,	
							'total_no_asper_rds'		=> $total_no_asper_rds,
							'date_of_submission'		=> date('Y-m-d', strtotime($date_of_submission)),	
							'date_received'				=> date('Y-m-d', strtotime($date_received)),
							'doc_upload'				=> $doc_upload,
							'added_by'					=> $user_id,
							'created'					=> date('Y-m-d H:i:s'),	
							'deleted'					=> date('Y-m-d H:i:s')	
						);
						$this->db->insert('drrs_request_distri', $data);
	       }


	       public function su_saveuser_mod($first_name,$last_name,$user_name,$usertype){

	       		$this->db->select('id');
						$this->db->from('users as usr');
						$this->db->order_by('usr.id', 'desc');
						$query = $this->db->get();
						$reqdata = $query->result_array();
			      		$last_id = $reqdata[0]['id'];
						$last_id ++;
						
	       	 	$data = array(
							'user_id'        => date("ymd").'-'.$last_id,
							'password'       => md5('12345'),
							'role'			 => $usertype,
							'first_name'     => $first_name,
							'last_name'      => $last_name,
							'user_name'		 => $user_name,
							'status'		 => '0',
						 	'created'		 => date('Y-m-d H:i:s'),	 
						 	'deleted'		 => date('Y-m-d H:i:s')	
				);
				$this->db->insert('users', $data);
	       }



	       public function drmd_add_date_mod($user_id,$date,$drid){
	       			  $data = array(
							  'user_id'   	  => $user_id,
							  'drmd_id'       => $drid,
							  'date'		  => $date,
						 	  'created'	  	  => date('Y-m-d H:i:s'),
						 	  'deleted'	  	  => date('Y-m-d H:i:s')
					  );
					  $this->db->insert('drrs_date_fw', $data); 	
					  $this->db->set('drrs_status','1');
					  $this->db->where('id', $drid);
					  $this->db->update('drmd_request');
	       }


	       public function get_rros_request_mod(){
				       	$this->db->select('*,drs.created as drscreated ,drs.drmd_id as drid, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
					    	$this->db->from('drrs_request as drs');
			    		// $this->db->join('drmd_request as drmd_req','dr.id = drs.drmd_id','inner');
						$this->db->join('drmd_request as drmd_req','drmd_req.id = drs.drmd_id','inner');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = drs.drmd_id','left');

				    	// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				    	$this->db->where('drmd_req.drrs_status','1');
				    	$this->db->where('drmd_req.id NOT IN (SELECT drmd_id FROM rros_request)', NULL, FALSE);
				    	
				    	$this->db->group_by('drs.drmd_id');
				    	$this->db->order_by('drmd_req.id', 'desc');
				    	$query = $this->db->get();
			    		return $query->result_array();
	       }

	       public function get_drrs_done_request_mod(){
		       			$this->db->select('*,drs.created as drscreated ,drs.drmd_id as drid, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
			    	    $this->db->from('drrs_request as drs');
			    	    // $this->db->join('drmd_request as drmd_req','dr.id = drs.drmd_id','inner');
                                                                                                            
						$this->db->join('drmd_request as drmd_req','drmd_req.id = drs.drmd_id','inner');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = drs.drmd_id','left');
						$this->db->join('drrs_disapprove as drrs_disapp','drrs_disapp.drmd_id = drs.drmd_id','left');
				    	// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				    	$this->db->where('drmd_req.drrs_status','1');
				    	// $this->db->where('drmd_req.id NOT IN (SELECT drmd_id FROM rros_request)', NULL, FALSE);
				    	// $this->db->where('drmd_req.id IN ');
				    	$this->db->group_by('drs.drmd_id');
				    	$this->db->order_by('drmd_req.id', 'desc');
				    	$query = $this->db->get();
			    		return $query->result_array();
	       }

	       public function get_drrs_disap_request_mod(){
	       				$this->db->select('*,drmd_req.id as drid,reqs.description as requester_desc , inci.description as incident_desc,other_req.requester as other_req, ot_inci.incident as other_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num , other_req.requester as ot_req_desc ');
	       				$this->db->from('drrs_disapprove as drrs_disapp');
	       				$this->db->join('drmd_request as drmd_req','drmd_req.id = drrs_disapp.drmd_id','inner');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','inner');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');

						
				                                                                                
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drrs_disapp.added_by','inner');
				    	
				    
				    	$query = $this->db->get();
				    	
			    		return $query->result_array();
			    		// echo json_encode($query->result_array());
							       				
	       }

	       	public function get_rros_entries_mod(){
						$this->db->select('*,rros_it.drmd_id as drid, usr_det2.first_name as rs_fname, usr_det2.last_name as rs_lname , usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
	    				$this->db->from('ris as rs');
	    				$this->db->join('rros_items as rros_it','rros_it.ris_no = rs.ris_no','inner');
	    				$this->db->join('drmd_request as drmd_req','drmd_req.id = rros_it.drmd_id','left');

						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = rros_it.drmd_id','left');

			    		// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				  		$this->db->join('users as usr_det2', 'usr_det2.user_id = rros_it.added_by','inner');
				    	$this->db->order_by('rs.id','asc');
				    	$this->db->group_by('drmd_req.id');
	    				$query = $this->db->get();
	    				return $query->result_array();
    			}

	        public function rros_get_item_mod($drmd_id){

	       		$this->db->select('*');
	       		$this->db->from('trucking');
	       		$query = $this->db->get();
			  		// $data1 = $query->result_array();

		  		$this->db->select('*,itms.description as spec_items,drs_item.item as drsItm');
	       		$this->db->from('drrs_items as drs_item');
	       		$this->db->join('items as itms','itms.id = drs_item.item','inner');
	       		$this->db->join('uom as uom_desc','uom_desc.id = drs_item.item_uom','inner');
	       		$this->db->where('drs_item.drmd_id', $drmd_id);
	       		$this->db->where('drs_item.item_qty !=','0');
	       		$this->db->order_by('itms.type', 'desc');
			 	$query = $this->db->get();
			  	$data = $query->result_array();
			  	echo '<br><h5>ASSISTANCE</h5><br>';
				    echo '    
							<div class="row">				
			                <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>ITEM</label></b>
			                 </div>
			                </div>
			                <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>UOM</label></b>
			                 </div>
			                </div>
			                <div class="col-md-1">
			                  <div class="form-group">
			                    <b><label>REQUESTED</label></b>
			                 </div>
			               </div>
			                <div class="col-md-1">
			                  <div class="form-group">
			                    <b><label>APPROVED</label></b>
			                 </div>
			               </div>
		                   <div class="col-md-2">
		                     <div class="form-group">
		                      <b><label>QTY RELEASED</label></b>
		                     </div>
			               </div>
					
			               <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>PRICE(₱)</label></b>
			                 </div>
			               </div>

			               <div class="col-md-2">
			                  <div class="form-group">
			                    <b><label>TOTAL(₱)</label></b>
			                 </div>
			               </div>

						  
			            <div>';
					  foreach($data as $key =>  $value){
	    			  echo '
  		   				  <div class="row">
	                    	<div class="col-md-2">
	                    	  <div class="form-group">
	                      	  	<input type="text" class="form-control item_id" data-id6="'.$value['drsItm'].'" value="'.$value['spec_items'].'"readonly/>
	                      	  </div>
	                    	</div>
	                    	
	                    	<div class="col-md-2">
				   			  <div class="form-group">
	                      	  	<input type="text" class="form-control cqty_uom" data-id6="'.$value['item_uom'].'" value="'.$value['description'].'"readonly/>
	                      	  </div>
	                    	</div>

	                     	<div class="col-md-1">
	                    	  <div class="form-group">
	                      	     <input type="" min="0" class="form-control cqty_requested" value="'.$value['item_requested'].'" readonly/>
	                      	  </div>
	                    	</div>
	                    	
	                    	<div class="col-md-1">
	                    	  <div class="form-group">
	                      	  	<input type="number" min="0" class="form-control cqty_approved" value="'.$value['item_qty'].'" readonly/>
	                      	 </div>
	                    	</div>

	                    	<div class="col-md-2">
	                    		<div class="form-group">
	                      	  <input type="number" min="0" class="form-control cqty_release" />
	                      	 </div>
	                    	</div>

	                    	<div class="col-md-2">
	                    	  <div class="form-group">
	                      	 	 <input type="number" min="0" class="form-control cprice" id="price-'.$key.'"/>
							  </div>
	                    	</div>

	                    	<div class="col-md-2" >
	                    	  <div class="form-group">
	                      	  	<input type="text" min="0" class="form-control ctotal" id="total-'.$key.'" readonly/>
	                      	  </div>
	                    	</div>
	             		  </div>';
					}	

   					echo '<div class="row">
	              				<div class="col-md-3">
	                    		<div class="form-group">
	                    		  <h3 class="grandTotal">₱0.00</h3>
	                      	  <h3>GRAND TOTAL</h3>
	                      	 </div>
	                    	</div>
	              		</div>';
   					
   					echo   
   						'<script>
   								
   								$(".cprice, .cqty_release").on("keyup",function(){

   											var grandTotal = 0;
   						 					var cqty_release = 	parseFloat($(this).closest(".row").find(".cqty_release").val()) || 0;
   						 					var price = parseFloat($(this).closest(".row").find(".cprice").val()) || 0;
   						 					var ctotalval = price * cqty_release;
   						 					$(this).closest(".row").find(".ctotal").val(ctotalval);   
   						 					$(".ctotal").each(function() {          
											    if(!isNaN(this.value) && this.value.length != 0) {
											      	grandTotal += parseFloat(this.value);
											    }    
											  });

											 
											  $("h3.grandTotal").html("₱"+new Intl.NumberFormat("en-US").format(grandTotal)+".00");
   								});
					  	</script>';
	      	}

	      	public function rros_save_req_mod($req_id,$date_let_aprv_drmd,$date_crd_pull_fr_drmd,$date_ris_frw_drmd,$user_id,$warehouse_origin,$item_uom,$items,$qty_requested,$qty_approved,$qty_released,$qty_left,$price,$total){
							$data = array(
							 	'drmd_id'				 => $req_id,
							 	'date_let_aprv_drmd'	 => date('Y-m-d', strtotime($date_let_aprv_drmd)),
							 	'date_crd_pull_fr_drmd'	 => date('Y-m-d', strtotime($date_crd_pull_fr_drmd)),
							 	'date_ris_frw_drmd'		 => date('Y-m-d', strtotime($date_ris_frw_drmd)),
							 	'added_by'				 => $user_id,
						 	  	'created'	  			 => date('Y-m-d H:i:s'),
						 	  	'deleted'	 		 	 => date('Y-m-d H:i:s')
					  		);
						  	
						  	$this->db->insert('rros_request', $data);
						  	$ris_no = $this->rros_auto_ris_mod($req_id);
						  	for($q = 0; $q < count($qty_requested); $q++){
								//   if($qty_released[$q] != '0' || !empty($qty_released[$q]) || $qty_released[$q] != 0){

									$data = array(
										'drmd_id'			=> $req_id,
										'item_uom'			=> $item_uom[$q], 	//array
										'item'				=> $items[$q], 			//array
										'qty_requested'     => $qty_requested[$q],	//array
										'qty_approved'	    => $qty_approved[$q],	//array
									  	'qty_released'      => $qty_released[$q],	//array
									  	'qty_left'			=> $qty_approved[$q] - $qty_released[$q], 	//array
									  	'price'				=> $price[$q],	//array
									  	'total'				=> $total[$q],	//array
										'province_origin'   => $warehouse_origin,	//array
									 	'added_by'			=> $this->session->userdata('user')['user_id'],
									 	'ris_no'			=> date('ymd').'-'.$ris_no,
									  	'field_office'	    => 'FO7',
										'created'			=> date('Y-m-d H:i:s'),	 
										'deleted'			=> date('Y-m-d H:i:s')	 
									);	   
									$this->db->insert('rros_items', $data);

								//   }
									
									$data1 = array(
										'item_uom'			=> $item_uom[$q],
										'item'				=> $items[$q],
										'drmd_id'			=> $req_id,
										'qty_requested'	    => $qty_requested[$q],
										'qty_approved'      => $qty_approved[$q],
										'qty_released'      => $qty_released[$q],
										'qty_left'			=> $qty_approved[$q] - $qty_released[$q],
										'added_by'			=> $this->session->userdata('user')['user_id'],
										'created'			=> date('Y-m-d H:i:s'),	 
										'deleted'			=> date('Y-m-d H:i:s')	 
									);
									$this->db->insert('rros_items_running_balance', $data1);
		    			 	}

	      }

	      public function rros_save_req_mod1($id,$req_id,$date_let_aprv_drmd,$date_crd_pull_fr_drmd,$date_ris_frw_drmd,$user_id,$item_uom,$items,$qty_requested,$qty_approved,$qty_released,$qty_left,$price,$total){
				
					  	$ris_no = $this->rros_auto_ris_mod($req_id);
					  	for($q = 0; $q < count($qty_requested); $q++){
						  			$data = array(
										'drmd_id'			=> $req_id,
										'item_uom'			=> $item_uom[$q],
										'item'				=> $items[$q],
										'qty_requested' 	=> $qty_requested[$q],
										'qty_approved'		=> $qty_approved[$q],
									  	'qty_released'  	=> $qty_released[$q],
									  	'qty_left'			=> $qty_left[$q] - $qty_released[$q],
									  	'price'				=> $price[$q],
									  	'total'				=> $total[$q],
										// 'warehouse'			=> $warehouse[$q],
										// 'trucking'			=> $trucking[$q],
									  	'added_by'			=> $this->session->userdata('user')['user_id'],
									  	'ris_no'			=> date('ymd') . '-'. $ris_no,
									  	'field_office'		=> 'FO7',
										'created'			=> date('Y-m-d H:i:s'),	 
										'deleted'			=> date('Y-m-d H:i:s')	 
									);	   
									
									$this->db->insert('rros_items', $data);
									$this->db->set('qty_left', $qty_left[$q] - $qty_released[$q]);
									$this->db->where('drmd_id', $req_id);
									$this->db->where('id', $id[$q]);
									$this->db->update('rros_items_running_balance');

	    			 	}
	      	}


	      	public function fetch_report_mod($incident,$province,$municipality,$requester,$datepicker,$datepicker1){

							$this->db->select('*,drs_req.no_beneficiaries as drs_no_bene ,drmd_req.incident as inci_num ,ros_it.id as rosb_id , ros_it.created as rosb_created, drmd_req.id as drid  , inci.description as incidesc , req.description as  reqdesc');
							$this->db->from('drmd_request as drmd_req');
							$this->db->join('drrs_request as drs_req','drs_req.drmd_id = drmd_req.id', 'left');
							$this->db->join('refcitymun as rcity','rcity.citymunCode = drmd_req.mucipality','left');
							$this->db->join('incident as inci','inci.id = drmd_req.incident', 'left');
							$this->db->join('requester as req','req.id = drmd_req.requester', 'left');
							$this->db->join('drrs_items as drrs_it','drrs_it.drmd_id = drmd_req.id','left');
							$this->db->join('rros_items as ros_it','ros_it.drmd_id = drmd_req.id','left');
							$this->db->join('drmd_date_response as d_response','d_response.drmd_id = drmd_req.id','left');
							// $this->db->join('drrs_request_distri as drs_liq','drs_liq.drmd_id = drmd_req.id','left');						
							$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province', 'left');
							$this->db->join('refcitymun as muni', 'muni.citymunCode = drmd_req.mucipality', 'left');
							
							if($incident != ""){
								$this->db->where('drmd_req.incident', $incident);
							}
							else if($province != ""){
								$this->db->where('drmd_req.province', $province);
							}
							else if($municipality != ""){
								$this->db->where('drmd_req.mucipality', $municipality);
							}
							else if($requester != ""){		
								$this->db->where('drmd_req.requester', $requester);
							}
							else if($datepicker != "" && $datepicker1 != ""){
								$this->db->where('drmd_req.created BETWEEN "'.date('Y-m-d', strtotime($datepicker)). '" and "'.date('Y-m-d', strtotime($datepicker1)).'"');
							}
							$this->db->group_by('drmd_req.reference_no');
							$query = $this->db->get();
							$data = $query->result_array();
														
							foreach($data as $key => $value){
    		  				$key++;
							$remarks = "";	

							if($value['inci_num'] == 1){
								$remarks = '-'.$value['remarks'];
							}else if($value['response_date'] != null){
								
							}
							
							// $noDaysResponded = $value['response_date'] - $value['date_approval'];

							$datetime1 = date_create($value['response_date']);
							$datetime2 = date_create($value['date_approval']);
							
							
							$interval = date_diff($datetime1, $datetime2);
		
							echo '<tr>
								  	<td><p>'.$key.'.</p></td>
									<td><p>'.$value['disctrictcode'].'</p></td>
								 	<td><p>'.$value['provDesc'].'</p></td>
								 	<td><p>'.$value['citymunDesc'].'</p></td>
								 	
									<td><p>'.$value['drs_no_bene'].'</p></th>
								 	<td><p>'.date_format(new DateTime($value['date_letter_request']), 'd-m-Y').'</p></td>
							  	 	<td><p>'.number_format($value['item_requested']).'</p></td>
								 	<td><p>'.number_format($value['item_qty']).'</p></td>

									<td><p>'.$value['response_date'].'</p></td>
									<td><p>'.$interval->format('%R%y years %m months %R%a days').'</p></td>

								 	<td><p>'.date_format(new DateTime($value['date_approval']), 'd-m-Y').'</p></td>
									<td><p>'.date_format(new DateTime($value['rosb_created']), 'd-m-Y').'</p></td>
							 	
								 </tr>';		 
	    	 		        }   
	      	}
			  						// <td><p>'.number_format($value['total'], 0).'</p></td>
			  						// <td><p>Cost of Non-Food Items</p></td>
									// <td><p>Cost of Non-Food Items</p></td>
									// <td><p>'.number_format($value['total'],2).'</p></td>
									// <td><p>RDS</p></td>

	      	public function fetch_more_mod($drid){
	      		  $this->db->select('*, itms.description as itms_description');
	      		  $this->db->from('rros_items as rros_it');
	      		  $this->db->join('items as itms','itms.id = rros_it.item' ,'inner');
	      		  $this->db->join('item_type as itm_type','itm_type.type = itms.type','inner');
	      		  $this->db->where('rros_it.drmd_id', $drid);
	      		  $query = $this->db->get();
	      		  $data = $query->result_array();
	      		  // echo json_encode($data);

	      		  echo '<table id="" class="" style="width:50%">
                      <thead>
                          <tr>
                             
                          </tr>
                      </thead>
                      <tbody>';
                   
                   	foreach($data as $key =>  $value){
                   		$key++;
	                   		echo '<tr>
									<td><p>'.$key.'</p></td>
									<td><p>'.$value['itms_description'].'</p></td>
									<td><p>'.$value['qty_requested'].'</p></td>
									<td><p>'.$value['qty_released'].'</p></td>
									<td><p>'.$value['price'].'</p></td>
									<td><p>'.$value['total'] * $value['price'].'</p></td>
								 </tr>';
                   	 }			     
                 echo '</tbody>
                  </table>';
	      	}

	      	public function drrs_disapprove_mod($drid,$usr_id){
	      		 	$data = array(
								'drmd_id'	=> $drid,
								'added_by'	=> $usr_id,
								'created'	=> date('Y-m-d H:i:s'),	 
								'deleted'	=> date('Y-m-d H:i:s')	 
							);	   
							$this->db->insert('drrs_disapprove', $data); 	
							$this->db->set('drrs_status','2');
							$this->db->where('id', $drid);
							$this->db->update('drmd_request');
	      	}

			//  	public function drrs_cancelled_mod(){
			//    	$this->db->select('*,drs.created as drscreated,drs.drmd_id as drid, usr_det.first_name as df_name , usr_det.last_name as dl_name, usr_det1.first_name as disFname,usr_det1.last_name as disLname,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
			//  	$this->db->from('drrs_disapprove as drs');
			// 		$this->db->join('drmd_request as drmd_req','drmd_req.id = drs.drmd_id','inner');
			// 		$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
			// 		$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
			// 		$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
			// 		$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
			//  	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
			//  	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
			//  	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
			//  	$this->db->join('users as usr_det1', 'usr_det1.user_id = drs.added_by','inner');
			//  	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
			//  	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
			//  	$query = $this->db->get();
			// 		return $query->result_array();
			//  	}

	      	public function drrs_undo_ctrl($drid){
							$this->db->where('drmd_id', $drid);
							$this->db->delete('drrs_disapprove');
							$this->db->set('drrs_status','0');
							$this->db->where('id', $drid);
							$this->db->update('drmd_request');
	      	}

	      	public function rros_auto_ris_mod($req_id){

						$count = 1;
						$this->db->select('*');
						$this->db->from('ris as rst');
						$this->db->where('SUBSTR(rst.ris_no,1,7)', date('ymd') . '-');
						
						$tody_order = $this->db->count_all_results();

						if (!empty($tody_order)) {
								$count = $tody_order + 1;
						}
						
						$data = array(
							'drmd_id' 		=> $req_id,	
							'ris_no'		=> date('ymd') . '-' . $count,
							'field_office' 	=> 'FO7',
							'created' 		=> date('Y-m-d H:i:s'),
							'deleted' 		=> date('Y-m-d H:i:s'),
						);
						$this->db->insert('ris', $data);
						return $count;
				}


				public function hudleboard_mod(){
						$this->db->select('*');
						$this->db->from('refregion as reg');
						$this->db->join('refprovince as prov','prov.regCode = reg.regCode','inner');
						$this->db->join('refcitymun as city','city.provCode = prov.provCode','inner');
						$this->db->where('reg.regCode','07');
						$query = $this->db->get();
						return $query->result_array();
				}
			
					public function rros_delinquent_mod(){
							$this->db->select('*, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
					  		$this->db->from('rros_items_running_balance as ros_bal');
					  		$this->db->join('drmd_request as drmd_req','drmd_req.id = ros_bal.drmd_id','inner');
							$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
							$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
							$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
							$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
					    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
					    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
					    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
					    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
					    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');					    	
					    	$this->db->group_by('ros_bal.drmd_id');
					    	$this->db->where('ros_bal.qty_left !=','0');
					    	$query = $this->db->get();
				    		return $query->result_array();
    				}

    			public function rros_get_del_mod($drmd_id){


			       		$this->db->select('*');
			       		$this->db->from('trucking');
			       		$query = $this->db->get();
					  	$data1 = $query->result_array();
					  		
					  	$this->db->select('*');
					  	$this->db->from('Warehouse');
					  	$query = $this->db->get();
					  	$data2 = $query->result_array();

			       		$this->db->select('*,uom_desc.description as uom_desc, rros_it.id as rros_it_id');
			       		$this->db->from('rros_items_running_balance as rros_it');
			       		$this->db->join('uom as uom_desc', 'uom_desc.id = rros_it.item_uom','inner');
			    		$this->db->join('items as itms', 'itms.id = rros_it.item','inner');
			    		$this->db->order_by('rros_it.id','desc');
			       		$this->db->where('rros_it.drmd_id', $drmd_id);
					 	$query = $this->db->get();
					  	$data = $query->result_array();
					  		echo '<br><h5>ASSISTANCE</h5><br>';
							  echo '
									<div class="row">
					               <div class="col-md-2">
					                 <div class="form-group">
					                   <b><label>ITEM</label></b>
					                </div>
					               </div>
					               <div class="col-md-2">
					                 <div class="form-group">
					                   <b><label>UOM</label></b>
					                </div>
					               </div>
					               <div class="col-md-1">
					                  <div class="form-group">
					                    <b><label>QTY RQSTD</label></b>
					                 </div>
					               </div>
					                <div class="col-md-1">
					                  <div class="form-group">
					                    <b><label>QTY APPROVED</label></b>
					                 </div>
					               </div>
					                <div class="col-md-1">
					                  <div class="form-group">
					                    <b><label>QTY REMAINING</label></b>
					                 </div>
					               </div>
				                  <div class="col-md-1">
				                   <div class="form-group">
				                      <b><label>QTY RELEASED</label></b>
				                  </div>
					               </div>
					               
					               <div class="col-md-1">
					                 <div class="form-group">
					                    <b><label>PRICE(₱)</label></b>
					                 </div>
					               </div>
					               
					               <div class="col-md-2">
					                 <div class="form-group">
					                    <b><label>TOTAL(₱)</label></b>
					                 </div>
					               </div>
					             <div>';
										foreach($data as $key => $value){
							    		  $key++;
							    		  $readonly = '';
							    		  if($value['qty_left'] <= 0){
													$readonly = 'readonly';
							    		  }
						   				 	echo '
							   				  	<div class="row">
							                    	<div class="col-md-2">
							                    		<div class="form-group">
							                      	 
							                      	  <input type="text" class="form-control item_id" data-id7="'.$value['rros_it_id'].'" data-id6="'.$value['item'].'" value="'.$value['description'].'"readonly/>
							                      	  </div>
							                    	</div>
							                    	
							                    	<div class="col-md-2">
										   			 <div class="form-group">
							                      	  	<input type="text" class="form-control cqty_uom" data-id6="'.$value['item_uom'].'" value="'.$value['uom_desc'].'"readonly/>
							                      	  </div>
							                    	</div>

							                     	<div class="col-md-1">
							                    		<div class="form-group">
							                      	  <input type="" min="0" class="form-control cqty_requested" value="'.$value['qty_requested'].'" readonly/>
							                      	 </div>
							                    	</div>
							                    	
							                    	<div class="col-md-1">
							                    		<div class="form-group">
							                      	  <input type="number" min="0" class="form-control cqty_approved" value="'.$value['qty_approved'].'" readonly/>
							                      	 </div>
							                    	</div>

							                    	<div class="col-md-1">
							                    		<div class="form-group">
							                      	  <input type="number" min="0" class="form-control cqty_left" value="'.$value['qty_left'].'" readonly/>
							                      	 </div>
							                    	</div>

							                    	<div class="col-md-1">
							                    		<div class="form-group">
							                      	  <input type="number" min="0" class="form-control cqty_release" '.$readonly.'/>
							                      	 </div>
							                    	</div>
						            
							                    	<div class="col-md-1">
							                    		<div class="form-group">
							                      	  <input type="number" min="0" class="form-control cprice" id="price-'.$key.'" '.$readonly.'/>
																			</div>
							                    	</div>
							                    	
							                    	<div class="col-md-3" >
						                    		<div class="form-group">
						                      	  <input type="text" min="0" class="form-control ctotal" id="total-'.$key.'" readonly/>
						                      	  </div>
						                    	</div>
	              						</div>';
						   					}	

						   					echo '<div class="row">
							              				<div class="col-md-3">
							                    		<div class="form-group">
							                    		  <h3 class="grandTotal">₱0.00</h3>
							                      	  <h3>GRAND TOTAL</h3>
							                      	 </div>
							                    	</div>
							              		</div>';
						   					echo   
						   						'<script>
						   								$(".cprice, .cqty_release").on("keyup",function(){
						   											var grandTotal = 0;
						   						 					var cqty_release = 	parseFloat($(this).closest(".row").find(".cqty_release").val()) || 0;
						   						 					var price = parseFloat($(this).closest(".row").find(".cprice").val()) || 0;
						   						 					var ctotalval = price * cqty_release;
						   						 					$(this).closest(".row").find(".ctotal").val(ctotalval);   
						   						 					$(".ctotal").each(function() {          
																	    if(!isNaN(this.value) && this.value.length != 0) {
																	      	grandTotal += parseFloat(this.value);
																	    }    
																	  });												 
																	  $("h3.grandTotal").html("₱"+new Intl.NumberFormat("en-US").format(grandTotal)+".00");
						   								});
											  	</script>';
					}
					//dashboard
    			public function get_overall_ass_mod(){
    					$this->db->select_sum('total');
						$this->db->from('rros_items');
						$query = $this->db->get();
	      		 		return $query->row();
    			}

    			public function get_overall_ffp_mod(){
    					$this->db->select_sum('qty_released');
						$this->db->from('rros_items');
						$query = $this->db->get();
	      		  		return $query->row();
    			}

    			public function get_overall_to_distri_ffp_mod(){
    					$this->db->select_sum('qty_left');
    					$this->db->from('rros_items_running_balance');
    					$query = $this->db->get();
    					return $query->row();
    			}

    			public function chart_mod(){
    					// $this->db->select('*');
    					// $this->db->from('rros_items as rros_it');
    					// // $this->db->group_concat('rros_it.created',' ');
    					// $query = $this->db->get();
    					// return $query->result_array();

    					$query = $this->db->query('select year(created) as year, month(created) as month, sum(paid) as total_amount from amount_table group by year(created), month(created)');
    					echo json_encode($query->result());
    			}

					//end dashboard

					public function get_directory_loc_mod(){
						 $this->db->select('*');
						 $this->db->from('dir_locations as dr_loc');
						 $this->db->join('refprovince as prov','prov.provCode = dr_loc.provCode','inner');
						 $query = $this->db->get();
	      		 return $query->result_array();
					}

					public function get_sections_mod(){
						$this->db->select('*');
						$this->db->from('roles');
						$query = $this->db->get();
	      		return $query->result_array();
					}

					public function get_user_list_mod(){
						$this->db->select('*');
						$this->db->from('users as usr');
						$this->db->join('roles as rls','rls.id = usr.role','inner');
						$query = $this->db->get();
	      		return $query->result_array();
					}

					public function rros_update_stand_fund_mod($amount){
						$data = array(
								'fund'			=> $amount,
								'added_by'	    => $this->session->userdata('user')['user_id'],
								'created'		=> date('Y-m-d H:i:s'),	
								'deleted'		=> date('Y-m-d H:i:s')	
						);
						$this->db->insert('stand_by_funds',$data);
					}
    	
    			public function stand_by_funds_tbl_mod(){
    				$this->db->select('*,stf.id as stfid');
						$this->db->from('stand_by_funds as stf');
						$this->db->join('users as usr','usr.user_id = stf.added_by','inner');
						$this->db->order_by('stf.id','desc');
						$query = $this->db->get();
	      				return $query->result_array();
    			}

			 	public function	get_latest_fund_mod(){
			 			$this->db->select('*');
						$this->db->from('stand_by_funds as stf');
						$this->db->order_by('stf.id','desc');
						$this->db->limit(1);
						$query = $this->db->get();
	      				return $query->row();
			 	}

			 	public function get_running_data_mod(){
			 			$this->db->select('*,sum(rosb.qty_left) as total_per_lgu, sum(rosb.qty_approved) as total_app_perlgu ,rqstr.description as reqsdesc, drmd_req.reference_no, municipality.citymunDesc as muniDesc, rosb.qty_approved , rosb.qty_released, revprov.provCode as provinceCode, rosb.drmd_id as rosb_id , inci.description as incidesc, drmd_req.incident as inci_num, drmd_req.requester as req_num,
			 				ot_inci.incident as ot_inci , other_req.requester as ot_req_desc');
						$this->db->from('rros_items_running_balance as rosb');
				
						$this->db->join('drmd_request as drmd_req','drmd_req.id = rosb.drmd_id', 'inner');
						$this->db->join('refcitymun as municipality','municipality.citymunCode = drmd_req.mucipality','inner');
						$this->db->join('refprovince as revprov','revprov.provCode = municipality.provCode','inner');
						$this->db->join('requester as rqstr','rqstr.id = drmd_req.requester', 'inner');
						$this->db->join('incident as inci','inci.id = drmd_req.incident','inner');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						// $this->db->join('delivery_and_trucking as del_trc','del_trc.id = rosb.id','inner');
					    // $this->db->where('rosb.id IN (SELECT rrosit_id FROM delivery_and_trucking)', NULL, FALSE);
						$this->db->group_by('rosb.drmd_id');
						
						// $this->db->order_by('municipality.citymunCode','asc');
						
						$query = $this->db->get();
	      				return $query->result_array();
			 	}

			 	public function get_cost_food(){
			 			$this->db->select('*, sum(rros_it.total) as total_food_item');
			 			$this->db->from('rros_items as rros_it');
			 			$this->db->join('items as itms','itms.id = rros_it.item','inner');
			 			$this->db->join('item_type as itms_typ','itms_typ.type = itms.type','inner');
			 			$this->db->where('itms.type','1');
			 			$query = $this->db->get();
			 			return $query->row();
			 	}	

			 	public function get_cost_non_food(){
			 			$this->db->select('*, sum(rros_it.total) as total_food_item');
			 			$this->db->from('rros_items as rros_it');
			 			$this->db->join('items as itms','itms.id = rros_it.item','inner');
			 			$this->db->join('item_type as itms_typ','itms_typ.type = itms.type','inner');
			 			$this->db->where('itms.type','0');
			 			$query = $this->db->get();
			 			return $query->row();
			 	}	

			 	

			 	public function get_segregated_province_mod(){
			 			$this->db->select('*,sum(rros_it.total) as total_per_lgu');
						// $this->db->from('rros_items_running_balance as rosb');
						$this->db->from('rros_items as rros_it');
						// $this->db->join('rros_items as rros_it','rros_it.drmd_id = rosb.drmd_id','left');
						$this->db->join('drmd_request as drmd_req','drmd_req.id = rros_it.drmd_id', 'inner');
						$this->db->join('refcitymun as municipality','municipality.citymunCode = drmd_req.mucipality','inner');
						$this->db->join('refprovince as revprov','revprov.provCode = municipality.provCode','inner');
						$this->db->group_by('revprov.provCode');
						$this->db->order_by('revprov.provCode','asc');
						$query = $this->db->get();
	      				return $query->result_array();
			 	}

			 		public function rros_update_list_stand_fund_mod($id, $fund){
			 			$this->db->set('fund',$fund);
			 			$this->db->where('id', $id);
			 			$this->db->update('stand_by_funds');
	
			 			//update history
			 			$data = array(
								'fund_id'	=> $id,
								'fund'		=> $fund,
								'added_by'	=> $this->session->userdata('user')['user_id'],
								'created'	=> date('Y-m-d H:i:s'),	
								'deleted'	=> date('Y-m-d H:i:s')	
						);
						$this->db->insert('stand_by_fund_edit_history', $data);

			 		}


			 		public function dash_view_det_mod($rosb_id){
			 			
			 			$this->db->select('*, itms.description as itms_description , rosb.created as rosb_created');
						$this->db->from('rros_items as rosb');
						$this->db->join('drmd_request as drmd_req','drmd_req.id = rosb.drmd_id', 'inner');
						$this->db->join('users as usr','usr.user_id = rosb.added_by','inner');
						$this->db->join('items as itms','itms.id = rosb.item','inner');
						// $this->db->join('warehouse as wrhs','wrhs.id = rosb.warehouse','inner');
						// $this->db->join('trucking as trck','trck.id = rosb.trucking','inner');
						// $this->db->where('rosb.id IN (SELECT rrosit_id FROM delivery_and_trucking)', NULL, FALSE);
						$this->db->where('rosb.drmd_id', $rosb_id);
						$this->db->where('rosb.qty_released !=','0');
						$this->db->order_by('rosb.id','desc');
						// $this->db->group_by('revprov.provCode');
						// $this->db->order_by('revprov.provCode','asc');
						$query = $this->db->get();
	      		
	      				$data  = $query->result_array();

	      					echo '<div class="row">
						                <div class="col-md-2">
						                  <div class="form-group">
						                    <b><label>RIS #</label></b>
						                  </div>
						                </div>
						                <div class="col-md-2">
						                  <div class="form-group">
						                    <b><label>PROCESSED BY</label></b>
						                  </div>
						                </div>
						                <div class="col-md-1">
						                  <div class="form-group">
						                    <b><label>QTY RELEASED</label></b>
						                  </div>
						               </div>
						               
						                <div class="col-md-2">
						                  <div class="form-group">
						                    <b><label>ITEM</label></b>
						                  </div>
						                </div>	               
						  
						                <div class="col-md-1">
						                  <div class="form-group">
						                    <b><label>COST</label></b>
						                  </div>
						                </div>

						                
						                <div class="col-md-1">
						                  <div class="form-group">
						                    <b><label>TOTAL COST</label></b>
						                  </div>
						               </div>
										<div class="col-md-2">
										  <div class="form-group">
										 	<b><label>DATE PROCESSED</label></b>
										  </div>
										</div>    
						             <div>';
						            $grand_total = 0;

									foreach($data as $key => $value){
					  		  		$key++;
						            $grand_total += $value['total'];
						            echo ' 	
		       		   				  <div class="row">
				                    	<div class="col-md-2">
				                    		<div class="form-group">
				                      	  <p>'.$value['field_office'].'-'.substr($value['reference_no'],0,3).'-'.$value['ris_no'].'</p>
				                      	  </div>
				                    	</div>
				                    	
				                    	<div class="col-md-2">
							   			  <div class="form-group">
				                      	  	<p>'.$value['first_name'].' '.$value['last_name'].'</p>
				                      	  </div>
				                    	</div>

				                     	<div class="col-md-1">
				                    		<div class="form-group">
				                      	 <p>'.$value['qty_released'].'</p>
				                      	 </div>
				                    	</div>
				                    	
				                    	<div class="col-md-2">
				                    		<div class="form-group">
				                      	  <p>'.$value['itms_description'].'</p>
				                      	 </div>
				                    	</div>
				                    		
				                    	<div class="col-md-1">
				                    		<div class="form-group">
				                      	  <p>'.number_format($value['price'] ,2).'</p>
				                      	 </div>
				                    	</div>

				                    	<div class="col-md-1">
				                    		<div class="form-group">
				                      	  <p>'.number_format($value['total'] ,2).'</p>
				                      	 </div>
				                    	</div>

				                    	
				                    	

				                    	<div class="col-md-2">
				                    		<div class="form-group">
				                      	  <p>'.$value['rosb_created'].'</p>
				                      	 </div>
				                    	</div>
									 </div>';
				    				}

				    				echo '<br><hr><br>';
					   				echo '<div class="row">
						              				<div class="col-md-3">
						                    		<div class="form-group">
						                    		  <h3 class="grandTotal">₱'.number_format($grand_total,2).'</h3>
						                      	  <h3>GRAND TOTAL</h3>
						                      	 </div>
						                    	</div>
						              		</div>';
			 		}

			 		// <div class="col-md-2">
					//                   		<div class="form-group">
					//                     	  <p>'.$value['wrhs_description'].'</p>
					//                     	 </div>
					//                   	</div>

					//                   	<div class="col-md-1">
					//                   		<div class="form-group">
					//                     	  <p>'.$value['trck_description'].'</p>
					//                     	 </div>
					//                   	</div>

			 		public function profile_data_mod(){
			 				$this->db->select('*');
			 				$this->db->from('users as usr');
			 				$query = $this->db->get();
	      		 			return $query->result_array();
			 		}

			 		public function rros_get_disapproved_mod(){
				 		$this->db->select('*,drs.created as drscreated ,drs.drmd_id as drid, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
			    		$this->db->from('drrs_request as drs');
			    		// $this->db->join('drmd_request as drmd_req','dr.id = drs.drmd_id','inner');

						$this->db->join('drmd_request as drmd_req','drmd_req.id = drs.drmd_id','inner');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = drs.drmd_id','left');

				    	// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				    	$this->db->where('drmd_req.drrs_status','1');
				    	$this->db->where('drmd_req.id NOT IN (SELECT drmd_id FROM rros_request)', NULL, FALSE);
				    	// $this->db->where('drs.status','0');
				    	// $this->db->where('drmd_req.id IN ');
				    	$this->db->group_by('drs.drmd_id');
				    	$this->db->order_by('drmd_req.id', 'desc');
				    	$query = $this->db->get();
			    		return $query->result_array();
			 		}

					public function count_pending_mod(){
						$this->db->select('id');
						$this->db->from('drrs_request as drs');
						// $this->db->where('drs.status','1');
						$this->db->where('drs.drmd_id NOT IN (SELECT drmd_id FROM rros_request)', NULL, FALSE);
						$query = $this->db->get();
						return $query->num_rows();
					}	

					public function count_disapproved(){
						$this->db->select('id');
						$this->db->from('drrs_disapprove as drrs_disapp');
						// $this->db->where('drs.status', '0');
						$query = $this->db->get();
						return $query->num_rows();
					}		 		

					public function count_processed(){
						$this->db->select('*,rros_it.drmd_id as drid, usr_det2.first_name as rs_fname, usr_det2.last_name as rs_lname , usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
	    				$this->db->from('ris as rs');
	    				$this->db->join('rros_items as rros_it','rros_it.ris_no = rs.ris_no','inner');
	    				$this->db->join('drmd_request as drmd_req','drmd_req.id = rros_it.drmd_id','left');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = rros_it.drmd_id','left');

			    		// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				  		$this->db->join('users as usr_det2', 'usr_det2.user_id = rros_it.added_by','inner');
				    	$this->db->order_by('rs.id','asc');
				    	$this->db->group_by('drmd_req.id');
	    				$query = $this->db->get();
	    				return $query->num_rows();
					}

					public function count_delinquent(){
						$this->db->select('*, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
				  		$this->db->from('rros_items_running_balance as ros_bal');
				  		$this->db->join('drmd_request as drmd_req','drmd_req.id = ros_bal.drmd_id','inner');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');					    	
				    	$this->db->group_by('ros_bal.drmd_id');
				    	$this->db->where('ros_bal.qty_left !=','0');
				    	$query = $this->db->get();
			    		return $query->num_rows();
					}


					public function count_pending_dr_mod(){
						$this->db->select('*,dr.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,dr.incident as inci_num,dr.requester as req_num,other_req.requester as ot_req_desc');
				    	$this->db->from('drmd_request as dr');
				    	$this->db->join('incident as inci', 'inci.id = dr.incident','left');
				    	$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = dr.id','left');
				    	$this->db->join('requester as reqs','reqs.id = dr.requester','left');
				    	$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = dr.id','left');
				    	$this->db->join('refprovince as prov', 'prov.provCode = dr.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = dr.mucipality','inner');
				    	$this->db->join('users as usr_det','usr_det.user_id = dr.added_by','inner');
				    	$this->db->where('dr.drrs_status','0');
				    	$this->db->where('dr.id NOT IN (SELECT drmd_id FROM drrs_disapprove)', NULL, FALSE);
				    	$this->db->order_by('dr.id', 'desc');
				    	$query = $this->db->get();
			    		return $query->num_rows();
					}

					public function count_processed_dr_mod(){
						// $this->db->select('*,rros_it.drmd_id as drid, usr_det2.first_name as rs_fname, usr_det2.last_name as rs_lname , usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
						// 			$this->db->from('ris as rs');
						// 			$this->db->join('rros_items as rros_it','rros_it.ris_no = rs.ris_no','inner');
						// 			$this->db->join('drmd_request as drmd_req','drmd_req.id = rros_it.drmd_id','left');

						// $this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						// $this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						// $this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						// $this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						// $this->db->join('drrs_items as drs_item','drs_item.drmd_id = rros_it.drmd_id','left');

						//  		// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
						//   	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
						//   	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
						//   	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
						//   	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
						//   	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
						// 		$this->db->join('users as usr_det2', 'usr_det2.user_id = rros_it.added_by','inner');
						//   	// $this->db->order_by('rs.id','asc');
						//   	$this->db->group_by('drmd_req.id');
						// 			$query = $this->db->get();
						// 			return $query->num_rows();

						$this->db->select('*,drs.created as drscreated ,drs.drmd_id as drid, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
			    	    $this->db->from('drrs_request as drs');
			    	    // $this->db->join('drmd_request as drmd_req','dr.id = drs.drmd_id','inner');
                                                                                                            
						$this->db->join('drmd_request as drmd_req','drmd_req.id = drs.drmd_id','inner');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = drs.drmd_id','left');
						$this->db->join('drrs_disapprove as drrs_disapp','drrs_disapp.drmd_id = drs.drmd_id','left');
				    	// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				    	$this->db->where('drmd_req.drrs_status','1');
				    	// $this->db->where('drmd_req.id NOT IN (SELECT drmd_id FROM rros_request)', NULL, FALSE);
				    	// $this->db->where('drmd_req.id IN ');
				    	$this->db->group_by('drs.drmd_id');
				    	$this->db->order_by('drmd_req.id', 'desc');
				    	$query = $this->db->get();
			    		return $query->num_rows();
					}


					

					public function count_ris_dr_mod(){
						$this->db->select('*,rros_it.drmd_id as drid, usr_det2.first_name as rs_fname, usr_det2.last_name as rs_lname , usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
	    				$this->db->from('ris as rs');
	    				$this->db->join('rros_items as rros_it','rros_it.ris_no = rs.ris_no','inner');
	    				$this->db->join('drmd_request as drmd_req','drmd_req.id = rros_it.drmd_id','left');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
						$this->db->join('drrs_items as drs_item','drs_item.drmd_id = rros_it.drmd_id','left');

			    		// $this->db->join('incident as inci', 'inci.id = dr.incident','inner');
				    	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','inner');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','inner');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','inner');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','inner');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','inner');
				  		$this->db->join('users as usr_det2', 'usr_det2.user_id = rros_it.added_by','inner');
				    	$this->db->order_by('rs.id','asc');
				    	$this->db->group_by('drmd_req.id');
	    				$query = $this->db->get();
	    				return $query->num_rows();
					}


					public function cound_drmd_entry_mod(){	
						$this->db->select('*, usr_det1.first_name as f_name, usr_det1.last_name as l_name , usr_det.first_name as df_name , usr_det.last_name as dl_name,drmd_req.id as drid,reqs.description as reqsdesc,inci.description as incidesc,ot_inci.incident as ot_inci,drmd_req.incident as inci_num,drmd_req.requester as req_num,other_req.requester as ot_req_desc');
			    	   	$this->db->from('drmd_request as drmd_req');
						$this->db->join('incident as inci', 'inci.id = drmd_req.incident','left');
						$this->db->join('drmd_other_request_inci as ot_inci','ot_inci.drmd_id = drmd_req.id','left');
						$this->db->join('requester as reqs','reqs.id = drmd_req.requester','left');
						$this->db->join('drmd_other_requester as other_req','other_req.drmd_id = drmd_req.id','left');
					   	$this->db->join('refprovince as prov', 'prov.provCode = drmd_req.province','left');
				    	$this->db->join('refcitymun as mun', 'mun.citymunCode = drmd_req.mucipality','left');
				    	$this->db->join('users as usr_det', 'usr_det.user_id = drmd_req.added_by','left');
				    	$this->db->join('drrs_request as drrs_req', 'drrs_req.drmd_id = drmd_req.id','left');
				    	$this->db->join('users as usr_det1', 'usr_det1.user_id = drrs_req.added_by','left');
				    	$this->db->where('drmd_req.id NOT IN (SELECT drmd_id FROM drrs_disapprove)', NULL, FALSE);
				       	$this->db->order_by('drmd_req.id', 'desc');
				    	$query = $this->db->get();
			    		return $query->num_rows();
    				}

    				public function update_add_distribution_mod($rosit, $warehouse_id, $trucking_id, $plannedRelease, $actualRelease, $remarks){

						$this->db->select('*');
						$this->db->from('delivery_and_trucking as del_trc');
						$this->db->where('del_trc.rrosit_id', $rosit);
						$this->db->order_by('del_trc.id','desc');

						$query = $this->db->get();
						$data = $query->row_array();
						$b = 0;
						if(isset($data)){
							$b = $data['actual_left'];
						}else{
							$b = $plannedRelease;
						}
						$ris_no = $this->rros_auto_ris_mod($rosit);
						
			       	 	$data1 = array(
								 'rrosit_id' => $rosit,
								 'warehouse' => $warehouse_id,
								 'trucking' => $trucking_id,
								 'planned_release' => $b,
								 'actual_release' => $actualRelease,
								 'actual_left' => $b - $actualRelease,
								 'ris_no' => date('ymd').'-'.$ris_no,
								 'remarks' => $remarks,
								 'added_by' => $this->session->userdata('user')['user_id'],
								 'created' => date('Y-m-d H:i:s'),
								 'deleted' => date('Y-m-d H:i:s')
						);
						$this->db->insert('delivery_and_trucking', $data1);
    				}

    				public function view_distribution_mod($rosit){
						$this->db->select('*,del_trc.id as del_trc_id,del_trc.ris_no as del_ris_no,province.provDesc as provName,del_trc.remarks as del_trc_remarks,wrhs.description as wrhs_description , trck.description as trck_description');
						$this->db->from('delivery_and_trucking as del_trc');
						$this->db->join('warehouse as wrhs','wrhs.id = del_trc.warehouse', 'inner');
						$this->db->join('trucking as trck','trck.id = del_trc.trucking','inner');
						$this->db->join('rros_items as rrosit','rrosit.id = del_trc.rrosit_id','left');
						$this->db->join('drmd_request as drmd_req','drmd_req.id = rrosit.drmd_id','left');
						$this->db->join('refprovince as province','province.provCode = drmd_req.province','left');
						$this->db->join('users as usr','usr.user_id = del_trc.added_by','inner');
						$this->db->where('del_trc.rrosit_id', $rosit);
						$this->db->order_by('del_trc.id','desc');

						$query = $this->db->get();
						$data = $query->result_array();
						
						echo '
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
								<b><label>Warehouse</label></b>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
								<b><label>Logistics</label></b>
								</div>
							</div>
							<div class="col-md-2">
								<div class="form-group">
									<b><label>Processed By</label></b>
								</div>
							</div>
								<div class="col-md-2">
								<div class="form-group">
									<b><label>QTY Released</label></b>
								</div>
							</div>
								<div class="col-md-2">
								<div class="form-group">
									<b><label>RIS #</label></b>
								</div>
							</div>
							<div class="col-md-2">
							<div class="form-group">
								<b><label></label></b>
							</div>
							</div>
					 	<div>';
						
						if(empty($data)){
							echo '<h4 style="color: red;"> No data yet for this now. </h4>';
						}
																		
						foreach($data as $key => $value){
							$key++;
							echo '<div class="row">

									<div class="col-md-2">
										<div class="form-group">
											<small>'.$key.'.  '.ucwords(strtolower($value['wrhs_description'])).'</small>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<small>'.ucwords(strtolower($value['trck_description'])).'</small>
										</div>
									</div>


									<div class="col-md-2">
										<div class="form-group">
											<small>'.ucwords(strtolower($value['first_name'].' '.$value['last_name'])).'</small>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<small>'.$value['actual_release'].'</small>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<small>FO7-'.substr($value['provName'],0,3).'-'.$value['del_ris_no'].'</small>
										</div>
									</div>

									<div class="col-md-2">
										<div class="form-group">
											<small><a href="javascript:void(0);" <button="" data-id="'.$value['del_trc_id'].'" class="distri_view_details"><div class="badge badge-opacity-danger">View</div></a></small>|
											<small><a href="javascript:void(0);" <button="" data-id="'.$value['del_trc_id'].'" class="edit_release"><div class="badge badge-opacity-danger">Edit</div></a></small>|
											<small><a href="javascript:void(0);" <button="" data-id="'.$value['del_trc_id'].'" class="edit_release"><div class="badge badge-opacity-danger">Print</div></a></small>

										</div>
									</div>
							</div>';				
						}
					

						echo   
							'<script>

									$(".distri_view_details").on("click",function(){
										var distri_id = $(this).attr("data-id");
										$.ajax({
											url: "distri_id_r",
											method: "POST", 
											cache: false,
											data:{ 
												distri_id:distri_id
											},
											success:function(data){
												bootbox.dialog({
													title: "Remarks",
													onEscape: true,
													message: data,
													size: "extra-small",
													buttons: {
														ok: {
															label: "Close",
															className: "btn-info",
															callback: function(){
																// console.log("Custom OK clicked");
															}
														}
													}
												});
											}
										});
									});

									
									$(".edit_release").on("click",function(){
										var rosit = $(this).attr("data-id");
										
										$.ajax({
											url:"edit_distribution_r",
											method:"POST",
											cache: false,
											data:{
												rosit:rosit
											},
											success:function(data){
												bootbox.confirm({
													title:"Edit trucking and actual release",
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
														
															var warehouse_sel   = $(".warehouse_sel").val();
															var trucking_sel	= $(".trucking_sel").val();
															var actualrelease   = $(".actualrelease").val();
															var remarks		    = $(".remarks").val();		

					
															if(remarks.length === 0 ){
																alert("Please enter remarks");
															}
															if(actualrelease.length === 0){
																alert("Please enter actual release");
															}	
															else{
																if(confirm("Are you sure you want to proceed?") == true) {
																	  	
																	  
																	   		$.ajax({
																	 			url: "update_distribution_r",
																		 			method: "POST",
																		 			cache: false,
																		 			data:{
																		 				rosit:rosit,

																		 				warehouse_sel:warehouse_sel,
																		 				trucking_sel:trucking_sel,
																		 				actualrelease:actualrelease,
																		 				remarks:remarks
																		 			},
																		 			success:function(data)
																		 			{
																		 				bootbox.hideAll();
																		 				bootbox.alert("Trucking and actual release was successfuly updated!");
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
						</script>';
    				}
					
			// 		$.ajax({
			// 			url: "update_add_distribution_r",
			// 			method: "POST",
			// 			cache: false,
			// 			data:{
			// 				rosit:rosit,
			// 				warehouse_id:warehouse_id,
			// 				trucking_id:trucking_id,
			// 				plannedRelease:plannedRelease,
			// 				actualRelease:actualRelease,
			// 				remarks:remarks
			// 			},
			// 			success:function(data)
			// 			{
			// 				bootbox.hideAll();
			// 				bootbox.alert("Trucking and actual release was successfuly added to this RIS");
			// 			}
			//    });
			

    				//tiwason
    				public function drmd_remove_mod($drid){
    					$this->db->set('isdeleted','yes');
						$this->db->where('id', $drid);
						$this->db->update('drmd_items');    					
    				}
    				//end of tiwason

    				public function search_mod($search){
    					$this->db->select('*,inci.description as incidesc,req.description as reqsdesc');
    					$this->db->from('drmd_request as drmd_req');
    					$this->db->join('refcitymun as city','city.citymunCode = drmd_req.mucipality','inner');
    					$this->db->join('incident as inci','inci.id = drmd_req.incident','inner');
    					$this->db->join('requester as req','req.id = drmd_req.requester','inner');
    					$this->db->like('city.citymunDesc', $search);
    					$query = $this->db->get();
						$data = $query->result_array();
							echo '<div class="row">
						                <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>MUNICIPALITY</label></b>
						                  </div>
						                </div> 

						                <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>INCIDENT</label></b>
						                  </div>
						                </div> 

						                 <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>REQUESTER</label></b>
						                  </div>
						                </div>
						             <div>';

						foreach($data as $value){
							echo '  <div class="row">
				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.$value['citymunDesc'].'</p>
				                      	  </div>
				                    	</div>   

				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.$value['incidesc'].'</p>
				                      	  </div>
				                    	</div>

				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.$value['reqsdesc'].'</p>
				                      	  </div>
				                    	</div>

				                    	

									</div>';
						}
    				}


    				public function su_reset_user_mod($id){
    					$this->db->set('status', '0');
    					$this->db->set('password', md5(12345));
						$this->db->where('id', $id);
						$this->db->update('users');
					}

					public function update_pass_mod($currentpassword,$newpassword){
						
						$this->db->select('*');
						$this->db->from('users as usr');
						$this->db->where('usr.user_id',  $this->session->userdata('user')['user_id']);
						$this->db->where('usr.password', md5($currentpassword));
						$query = $this->db->get();
						$data = $query->row_array();
						if($data){
    						$this->db->set('password', md5($newpassword));
							$this->db->where('user_id',  $this->session->userdata('user')['user_id']);
							$this->db->update('users');							
							echo 1;
						}
						else{
						    echo 2;
						}
    				}

					public function drmd_response_letter_mod($id){
						
						$this->db->select('*');
						$this->db->from('drmd_date_response as drmd_d_r');
						$this->db->where('drmd_d_r.drmd_id', $id);
						$this->db->order_by('drmd_d_r.id','desc');
						$this->db->limit(1);
						
						$query = $this->db->get();
						$data = $query->row_array();
			
    					echo '<div class="row">
								<div class="col-md-12">
							     	<label for="exampleFormControlSelect2">Date response letter sent</label>
										<input type="text" value="'.$data['response_date'].'" class="form-control response_date" id="datepicker1" readonly="true">
							  	</div>
							  </div>';
					
						echo '<script type="text/javascript">
									$(function() {
										$("#datepicker1").datepicker();
									});
							  </script>';
					}

					public function drmd_save_response_letter_mod($response_date,$id){
						$data = array(
							'drmd_id'		 => $id,
							'response_date'  => date('Y-m-d H:i', strtotime($response_date.date('H:i'))),
							'added_by'	     => $this->session->userdata('user')['user_id'],
							'created'		 => date('Y-m-d H:i:s'),	 
							'deleted'		 => date('Y-m-d H:i:s')	
				   		);
				   		$this->db->insert('drmd_date_response', $data);
					}

					public function drmd_view_response_letter_mod($drmd_id){
						
						$this->db->select('*,date_res.drmd_id as date_res_id,date_res.created as date_res_created');
						$this->db->from('drmd_date_response as date_res');
						$this->db->join('users as usr','usr.user_id = date_res.added_by','inner');
						$this->db->where('date_res.drmd_id',  $drmd_id);
						$this->db->order_by('date_res.id','desc');

						$query = $this->db->get();
						$data = $query->result_array();
						
							echo '<div class="row">
						                <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>Date of response</label></b>
						                  </div>
						                </div> 

						                <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>Edited by</label></b>
						                  </div>
						                </div> 

						                 <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>Date proccessed</label></b>
						                  </div>
						                </div>
						            <div>';

						foreach($data as $value){
								echo '<div class="row">
				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.$value['response_date'].'</p>
				                      	  </div>
				                    	</div>   

				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.$value['first_name'].' '.$value['last_name'].'</p>
				                      	  </div>
				                    	</div>
									
				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.date('y-m-d', strtotime($value['date_res_created'])).'</p>
				                      	  </div>
				                    	</div>			            
						 		    </div>';
						}			
					}

					public function wr_toreleas_mod(){
						// echo $this->session->userdata('user')['role'];
						$province = "";
						if($this->session->userdata('user')['role'] == '7'){
							$province = '0712';
						}
						if($this->session->userdata('user')['role'] == '8'){
							$province = '0722';
						}
						if($this->session->userdata('user')['role'] == '9'){
							$province = '0746';
						}
						


						$this->db->select('*,drreq.id as drid');
			    		$this->db->from('rros_items as rosit');
						$this->db->join('drmd_request as drreq', 'drreq.id  = rosit.drmd_id', 'left');
						$this->db->join('refcitymun as citymun', 'citymun.citymunCode = drreq.mucipality', 'left');
						$this->db->join('refprovince as refprov', 'refprov.provCode = citymun.provCode', 'left');
				    	$this->db->group_by('rosit.drmd_id');
				    	$this->db->order_by('rosit.id', 'desc');
						$this->db->where('rosit.province_origin', $province);
				    	$query = $this->db->get();
			    		return $query->result_array();
						
					}	

					// public function wr_stockpile_mod(){
					// 	$this->db->select('*');
					// 	$this->db->from('');
					// 	$this->db->join('');
					// 	$this->db->join('');
					// }

					public function distri_id_mod($distri_id){
						$this->db->select('*');
						$this->db->from('delivery_and_trucking as del_trc');
						$this->db->where('del_trc.id',$distri_id);
						$query = $this->db->get();
						$data = $query->row_array();
						echo $data['remarks'];
					}
					
					public function edit_distribution_mod($rosit){
						$this->db->select('*');
						$this->db->from('delivery_and_trucking as del_trc');
						$this->db->where('del_trc.id',$rosit);
						$query = $this->db->get();
						$data = $query->row_array();	

						$this->db->select('*');
						$this->db->from('trucking');
						$query = $this->db->get();
						$data1 = $query->result_array();
		
						$this->db->select('*');
						$this->db->from('Warehouse');
						$query = $this->db->get();
						$data2 = $query->result_array();

						echo '<div class="col-md-12">
						<div class="form-group">
						<label>Select Warehouse*</label>
							<select class="form-control warehouse_sel">';
								foreach($data2 as $value2){
									echo '<option value ='.$value2['id'].'>'.$value2['description'].'</option>';
								}
							echo '</select>
						</div>
						</div>';

						echo '<div class="col-md-12">
							<div class="form-group">
							<label>Select Trucking*</label>
								<select class="form-control trucking_sel">';
									foreach($data1 as $value1){
										echo '<option value ='.$value1['id'].'>'.$value1['description'].'</option>';
									}
							echo '</select>
							</div>
						</div>';
								
						echo '
						<div class="col-md-12">
							<div class="form-group">
								    <label>Actual Release*</label>
									<input type="number" value="'.$data['actual_release'].'" min="0" class="form-control actualrelease">
							</div>
						</div>';
									
						echo '<div class="col-md-12">
							<div class="form-group">
							<label>Remarks*</label>
									<textarea class="form-control remarks">'.$data['remarks'].'</textarea>
							</div>
						</div>';
					}
					//tiwason
					public function update_distribution_mod($id,$warehouse_sel,$trucking_sel,$actualrelease,$remarks){
						
						// $this->db->select('*');
						// $this->db->from('delivery_and_trucking as del_trc');
						// $this->db->where('del_trc.id', $id);
						// $query = $this->db->get();
						// $data = $query->row_array();
						 
						// echo $data['actual_left'];
						$this->db->set('warehouse', $warehouse_sel);
						$this->db->set('trucking', $trucking_sel);
						$this->db->set('actual_release', $actualrelease);
						// $this->db->set('actual_left',$actualrelease + $data['actual_left']);
						$this->db->set('remarks', $remarks);
						$this->db->where('id', $id);
						$this->db->update('delivery_and_trucking');
					}

					public function add_stockpile_form_mod($title){
								
								
						echo '
						<div class="col-md-12">
							<div class="form-group">
								    <label>'.$title.'</label>
									<input type="number" value="" min="0" class="form-control stockpile_count">
							</div>
						</div>';
					}

					public function add_stockpile_mod($stockpile_count){

						$province = "";
						if($this->session->userdata('user')['role'] == '7'){
							$province = '0712';
						}
						if($this->session->userdata('user')['role'] == '8'){
							$province = '0722';
						}
						if($this->session->userdata('user')['role'] == '9'){
							$province = '0746';
						}

						$data = array(
							'count'	         => $stockpile_count,
						    'added_by'	     => $this->session->userdata('user')['user_id'],
							'role'			 => $this->session->userdata('user')['role'],
							'province'		 => $province,
							'created'		 => date('Y-m-d H:i:s'),	 
							'deleted'		 => date('Y-m-d H:i:s')	
				   		);
				   		$this->db->insert('stockpile', $data);
						// echo json_encode($this->session->userdata('user'));
					}

					public function wr_stockpile_mod(){
						$province = "";
						if($this->session->userdata('user')['role'] == '7'){
							$province = '0712'; //bohol
						}
						if($this->session->userdata('user')['role'] == '8'){
							$province = '0722'; //cebu
						}
						if($this->session->userdata('user')['role'] == '9'){
							$province = '0746'; //neg-or
						}
						
						$this->db->select('*, stc.id as stc_id, stc.created as stockcreated');
			    		$this->db->from('stockpile as stc');
						$this->db->join('users as usr','usr.user_id = stc.added_by','inner');
					  	$this->db->order_by('stc.id', 'desc');
						$this->db->where('stc.province', $province);
				    	$query = $this->db->get();
			    		return $query->result_array();
					}

					public function edit_stockpile_mod($stockpile_count,$stockpile_id){
						$this->db->set('count', $stockpile_count);
						$this->db->where('id', $stockpile_id);
						$this->db->update('stockpile');
					}

					public function get_labangon_wr_mod(){						
						$this->db->select('*');
						$this->db->from('stockpile as stc');
						$this->db->where('stc.province', '0722');
						$this->db->limit(1);
						$query = $this->db->get();
						return $query->result_array();
					}

					public function get_bohol_wr_mod(){
						$this->db->select('*');
						$this->db->from('stockpile as stc');
						$this->db->where('stc.province', '0712');
						$this->db->limit(1);
						$query = $this->db->get();
						return $query->result_array();
					}

					public function get_negros_wr_mod(){
						$this->db->select('*');
						$this->db->from('stockpile as stc');
						$this->db->where('stc.province', '0746');
						$this->db->limit(1);
						$query = $this->db->get();
						return $query->result_array();
					}


					public function show_all_mod($province){
						$this->db->select('*');
						$this->db->from('stockpile as stc');
						$this->db->where('stc.province',$province);
						$query = $this->db->get();
						$data = $query->result_array();

						

						echo '<div class="row">
						                <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>Date </label></b>
						                  	
											</div>
						                </div> 

						                <div class="col-md-4">
						                  <div class="form-group">
						                    <b><label>Stockpile</label></b>
						                  </div>
						                </div> 
						            <div>';
						if(empty($data)){
							echo '<h4 style="color: red;"> No data yet for this now. </h4>';
						}
						foreach($data as $value){
								echo '<div class="row">
				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.date("M-d-Y", strtotime($value['created'])).'</p>
				                      	  </div>
				                    	</div>   

				                    	<div class="col-md-4">
				                    		  <div class="form-group">
				                      		  <p>'.number_format($value['count'],2).' - FFPs</p>
				                      	  </div>
				                    	</div>		            
						 		    </div>';
						}		

					}

					public function add_pdf_file_data_mod($rros_id){
						
						$this->db->select('*');
						$this->db->from('rros_pdf_save_data as ros_pdf_data');
						$this->db->where('ros_pdf_data.rros_id',$rros_id);
						$this->db->order_by('ros_pdf_data.id','desc');
						$this->db->limit(1);
						$query = $this->db->get();
						$data = $query->row_array();	
						// echo $rros_id;
						echo '
							<div class="col-md-12">
								<div class="form-group">
									<label>Contact Person*</label>
										<input type="text" value="'.$data['contactperson'].'" min="0" class="form-control contactperson">
								</div>
							</div>';
						
						echo '
							 <div class="col-md-12">
							 	<div class="form-group">
							 		<label>Contact Number*</label>
							 		   <input type="number" value="'.$data['contactnumber'].'" min="0" class="form-control contactnumber">
							 	</div>
							 </div>';
                        
						echo '<div class="col-md-12">
							 	<div class="form-group">
							 		<label>DRN*</label>
							 		   <input type="text" min="0" value="'.$data['drn'].'" style="text-transform:uppercase" class="form-control drn">
							 	</div>
							 </div>';
                        
						echo '<div class="col-md-12">
								<div class="form-group">
								  <label>Purpose*</label>
										<textarea class="form-control purpose" value="'.$data['purpose'].'">'.$data['purpose'].'</textarea>
								</div>
							 </div>';					
					}

					public function pdf_get_data_mod($rosit,$drmd_id){
							$this->db->select('*');
							$this->db->from('rros_items as rosit');
							$this->db->join('refprovince as province','province.provCode = rosit.province_origin','inner');
							$this->db->join('warehouse as wr','wr.provCode = rosit.province_origin','inner');
							$this->db->where('rosit.id', $rosit);
							$query = $this->db->get();
							return $query->row_array();
					}

					public function pdf_get_assessed_mod($ris_no){
							// $this->db->select('*');
							// $this->db->from('drrs_items as drs_items');
							// $this->db->join('items as itms', 'itms.id = drs_items.item','inner');
							// $this->db->join('uom as om','om.id = drs_items.item_uom','inner');
							// $this->db->where('drs_items.drmd_id', $drmd_id);
							// $query = $this->db->get();
							// return $query->row_array();

							$this->db->select('*,itms.description as itemdescription');
							$this->db->from('rros_items as rosit');
							$this->db->join('items as itms', 'itms.id = rosit.item','inner');
							$this->db->join('uom as om', 'om.id = rosit.item_uom','inner');
							$this->db->join('drmd_request as drmd_req', 'drmd_req.id = rosit.drmd_id','inner');
							$this->db->join('refprovince as province', 'province.provCode = drmd_req.province' ,'inner');
							$this->db->join('refcitymun as municipality','municipality.citymunCode = drmd_req.mucipality','inner');
							$this->db->where('rosit.ris_no', $ris_no);
							$query = $this->db->get();
							return $query->result_array();
							
							// echo json_encode($query->result_array());
							
					}


					public function save_report_pdf_details_mod($rosit,$drmd_id,$ris_no,$contactperson,$contactnumber,$drn,$purpose){
						
						$data = array(
							'rros_id' => $rosit,
							'drmd_id' => $drmd_id,
							'contactperson' =>  $contactperson,
							'contactnumber' => $contactnumber,
							'drn' => $drn,
							'purpose' => $purpose	
						);
						$this->db->insert('rros_pdf_save_data', $data);
					}
    }
?>










	