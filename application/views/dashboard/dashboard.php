 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom"></div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-9">
                       <p style="color:gray; font-size: 9;"><a style="text-decoration:none;" href="#" class="minimize_btn"><b>HIDE/SHOW WEATHER FORECAST</b></a></p>  
                      </div>
                      <!-- <div class="col-sm-2">
                        <input type="text" placeholder="Search" class="form-control search_txt">
                      </div> -->
                     
                     <!-- <div class="col-sm-1">
                       <a href="javascript:void(0)"  class="btn btn-otline-dark search"> <i class="icon-magnifying-glass"></i> Search</a>
                     </div> -->
                      <div class="row windy">
                          <div class="card-body">
                            <!-- <iframe width="1600" height="500" src="https://embed.windy.com/embed2.html?lat=10.310&lon=123.893&detailLat=10.310&detailLon=123.893&width=400&height=500&zoom=5&level=surface&overlay=wind&product=ecmwf&menu=&message=&marker=&calendar=now&pressure=true&type=map&location=coordinates&detail=&metricWind=default&metricTemp=default&radarRange=-1" frameborder="0"></iframe> -->
                              <br>
                              <br>
                              <br>
                         </div>
                      </div>
                      <br>
                      <br>
                      <br>
                      <!-- <hr> -->
                      <div class="row">            
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <h4>FILTER HERE</h4>
                                </div>
                                <hr>
                                <div class="row">
                                    
																	<div class="col-md-2">
																		<div class="form-group">
																			<label for="">TYPE OF INCIDENT</label>
																				<select class="form-control" id="incident">
                                          <option value="">ALL</option>
																					<?php
																						foreach($get_incident as $value){ 
																							$inci_desc = $value['description'];
																							if($value['id'] == '13'){
																								$inci_desc = 'Others';
																							}
																							echo '<option value ='.$value['id'].'>'.$inci_desc.'</option>';
																						}
																					?>
																				</select>
																		</div>
																	</div>

																	<div class="col-md-2">
																		<div class="form-group">
																			<label for="">PROVINCE</label>
																				<select class="form-control" id="dash_province">
                                          <option value="">ALL</option>
																					<?php
																						foreach($get_province as $value){ 
																							 echo '<option value ='.$value['provCode'].'>'.$value['provDesc'].'</option>';
																						}
																					?>
																				</select>
																		</div>
																	</div>

																	<div class="col-md-2">
																		<div class="form-group">
																			<label for="">MUNICIPALITY</label>
																				<select class="form-control" id="municipality">
                                          <option value=""></option>
																					<?php
																						foreach($get_default_city as $key => $value){ 
																							if($key == 0){
																								 echo 'hahaha';
																							}else{
 																								 echo '<option id='.$value['psgcCode'].' value='.$value['citymunCode'].'>'.$value['citymunDesc'].'</option>';
																							}	 
																						}
																					?>
																				</select>
																		 </div>
																	</div>

																	<div class="col-md-2">
																		<div class="form-group">
																			<label for="">REQUESTER</label>
																				<select class="form-control" id="requester">
                                          <option value=""></option>
																					<?php
																						 foreach($get_requester as $value){ 
																						 	  $req_desc = $value['description'];
																						 	  if($value['id'] == '11'){
																						 	  	$req_desc = "Others";
																						 	  }
									                              echo '<option value='.$value['id'].'>'.$req_desc.'</option>';
									                           } 
																					?>
																				</select>
																		</div>
																	</div>

																	<div class="col-md-2">
                                    <div class="form-group">
                                      <label for="exampleFormControlSelect2">FROM</label>
                                       <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                          <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                       <input type="text" class="form-control" id="datepicker" readonly>
                                      </div>
                                     </div>
                                   </div>

																	 <div class="col-md-2">
                                    <div class="form-group">
                                      <label for="exampleFormControlSelect2">TO</label>
                                       <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                          <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                       <input type="text" class="form-control" id="datepicker1" readonly>
                                      </div>
                                     </div>
                                    </div>

                                   </div>
                                    <div class="row">
                                 	   <div class="col-md-2">
                                       <a href="javascript:void(0)" id="cancel_bt" class="btn btn-otline-dark"><i class="icon-trash"></i> Cancel</a>
                                       <a href="javascript:void(0)" id="filter_bt" class="btn btn-otline-dark"><i class="icon-briefcase"></i>Filter</a>
                                    </div>
                                 </div>
                                <br><br>
                                <div class="row">
                  								<div class="col-12 report_tbl">
                                        <table id="tbl_exporttable_to_xls" class="display nowrap" style="width:100%">
                                              <thead>
                                                  <tr>
	                                                    <th><p>#</p></th>
	                                                    <th><p>Province</p></th>
	                                                    <th><p>Municipality</p></th>
	                                                    <th><p>Incident</p></th>
                                                      <th><p>Affected families</p></th>
	                                                    <!-- <th><p>Quantity requested</p></th> -->
	                                                    <th><p>Date letter request</p></th>
                                                      <!-- <th><p>Date letter request</p></th> -->
                                                    
                                                      <!-- <th><p>S</p></th> -->
                                                      <th><p>Quantity requested</p></th>
                                                      <th><p>Quantity approved</p></th>
                                                      <th><p>Date approved</p></th>
                                                      <th><p>Date first release</p></th>
	                                                    <!-- <th><p>Distribution area</p></th> -->
	                                                  	<!--   <th><p>Total</p></th> -->
                                                  </tr>
                                              </thead>
                                              <tbody class="rep_result">

                                              </tbody>
                                              <br>
                                                 <a href="javascript:void(0);" onclick="ExportToExcel('xlsx')" class="btn_dl_excel"><small>Download as excel</small> <img src="assets/images/xls.png" width="30" height="30" alt="logo"></a>
                                              <br><br>
                                            </table>
                                 	 </div>    
                               	</div>  
                                        

                               <hr>                            
                              </div>
                           <br>   
                      <div class="col-sm-12">
                        <br>
                        <br>
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          
                           <div>
                            <p class="statistics-title">TOTAL COST OF ASSISTANCE</p>
                            <h3 class="rate-percentage">&#8369; <?php echo number_format($total_assistance->total,2); ?></h3>
                           </div>
                          
                           <div>
                            <p class="statistics-title">FOOD COST </p>
                            <h3 class="rate-percentage">&#8369; <?php echo number_format($get_cost_food->total_food_item,2); ?></h3>
                           </div>

                           <div>
                            <p class="statistics-title">NON-FOOD COST </p>
                            <h3 class="rate-percentage">&#8369; <?php echo number_format($get_cost_non_food->total_food_item,2); ?></h3>
                           </div>

                           <div>
                            <p class="statistics-title">NFI/FFPs RELEASED</p>
                            <h3 class="rate-percentage"><?php echo number_format($total_ffp->qty_released); ?></h3>
                           </div>
                          
                           <div>
                            <p class="statistics-title">NFI/FFPs TO BE DISTRIBUTE</p>
                            <h3 class="rate-percentage"><?php echo number_format($total_to_distribute->qty_left); ?></h3>
                           </div>
                          
                          <!--<div class="d-none d-md-block">
                            <p class="statistics-title">Avg. Time on Site</p>
                            <h3 class="rate-percentage">2m:35s</h3>
                          </div>-->
                                             
                          <!--<div class="d-none d-md-block">
                            <p class="statistics-title">New Sessions</p>
                            <h3 class="rate-percentage">68.8</h3>
                          </div>-->
                         
                          <div class="d-none d-md-block" style="padding:5px ; border-radius:15px; border: 2px solid white; background-color:yellow;">
                            <p class="statistics-title">STAND BY FUNDS</p>
                            <h3 class="rate-percentage">&#8369; <?php echo number_format($get_latest_fund->fund ,2) ?></h3>
                          </div>
                        </div>
                      </div>
                    </div> 
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                          <div class="row flex-grow">
                           
                         
                            <?php
                            
                              foreach($get_segregated_province as $value1){
                               
                                echo '<div class="col-6 grid-margin stretch-card">
                                  <div class="card card-rounded">
                                   <div style="overflow-y: auto; overflow-x: hidden; height:580px;"> 
                                    <div class="card-body">

                                     <h4 class="align-baseline"><b>'.$value1['provDesc'].'</b></h4> 
                                  
                                     <h4 class="align-text-top"><b> &#8369; '.number_format($value1['total_per_lgu'] ,2).'</b></h4>
                                      
                                      <div class="d-sm-flex justify-content-between align-items-start">
                                          <table class="table select-table">
                                          <thead>
                                            <tr>
                                              <th>MUNICIPALITY</th>
                                              <th>Progress</th>
                                              <th>Status</th>
                                            </tr>
                                          </thead>
                                           <tbody>';
                                                 
                                                  foreach($get_running_data as $key =>  $value){
                                                        // echo $value['total_approv_per_lgu'].  '<br>';
                                                       
                                                        $statusBar = "";
                                                        $status    = "";
                                                        $text      = "";     
                                                                           
                                                        $total_relase_per_lgu = $value['total_app_perlgu'] - $value['total_per_lgu'] ;
                                                        $total_overall_to_be_release_per_lgu = $value['total_app_perlgu'];
                                
                                                        $percent = round($total_relase_per_lgu / $total_overall_to_be_release_per_lgu * 100,0);
                                                          if($percent < 100){
                                                             $statusBar = "bg-warning"; 
                                                             $status    = "badge-opacity-warning";
                                                             $text      = "On-going";
                                                          }
                                                          if($percent == 100){
                                                             $statusBar = "bg-success";
                                                             $status    = "badge-opacity-success";
                                                             $text      = "View details";
                                                          }
                                                          if($value1['provCode'] == $value['provinceCode']){
                                                              $incident_name = $value['incidesc'];
                                                              $requester_name = $value['reqsdesc'];

                                                              if($value['inci_num'] == 13){
                                                                $incident_name = 'u.s: '.$value['ot_inci'];
                                                              }
                                                             
                                                              if($value['req_num'] == 11){
                                                                $requester_name = $value['ot_req_desc'];
                                                              }

                                                             echo '<tr>
                                                                <td> 
                                                                 <h6>'.$value['muniDesc'].'</h6>
                                                                 <p>'.$incident_name.'</p>
                                                                 <p>'.$requester_name.'</p>
                                                                </td>
                                                               <td>
                                                                 <div>
                                                                   <div class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                                     <p class="text-success">'. $percent.'%</p>
                                                                     <p>'.number_format($total_relase_per_lgu).'/'.number_format($value['total_app_perlgu']).'</p>
                                                                   </div>
                                                                   <div class="progress progress-md">
                                                                     <div class="progress-bar '.$statusBar.'" role="progressbar" style="width: '.$percent.'%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                                                   </div>
                                                                 </div>
                                                                </td>
                                                              <td><a href="javascript:void(0);" class="dash_view_det" id-id="'.$value['rosb_id'].'"><div class="badge '.$status.'">'.$text.'</div></a></td>
                                                         </tr> ';
                                                      }
                                                    }
                                        echo  '</tbody>
                                       </table> 
                                      </div>
                                     </div>
                                   </div>
                                  </div>
                                </div>';

                              }
                             ?>
                        </div>
                       
                        <!-- <div class="row flex-grow">
                          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body card-rounded">
                                <h5 class="card-title  card-title-dash">LABANGON WAREHOUSE</h5>
                                <div class="list align-items-center border-bottom py-2">
                                 <div class="wrapper w-100"> 
                                   <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <p>Mar 14, 2019</p>
                                        &nbsp;&nbsp;&nbsp;<p>500 FFPs</p>
                                        &nbsp;&nbsp;&nbsp;
                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span><b>-0.5%</b></span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body card-rounded">
                                <h5 class="card-title  card-title-dash">BOHOL WAREHOUSE</h5>
                                <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100"> 
                                   <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <p>Mar 14, 2019</p>
                                        &nbsp;&nbsp;&nbsp;<p>500 FFPs</p>
                                        &nbsp;&nbsp;&nbsp;
                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span><b>-0.5%</b></span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-4 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body card-rounded">
                                <h5 class="card-title  card-title-dash">NEGROS WAREHOUSE</h5>
                                 <div class="list align-items-center border-bottom py-2">
                                  <div class="wrapper w-100"> 
                                   <div class="d-flex justify-content-between align-items-center">
                                      <div class="d-flex align-items-center">
                                        <p>Mar 14, 2019</p>
                                        &nbsp;&nbsp;&nbsp;<p>500 FFPs</p>
                                        &nbsp;&nbsp;&nbsp;
                                        <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span><b>-0.5%</b></span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="#" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div> -->
                              
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                <div class="row" style="width:100%">
                                    <table id="drrs_table">
                                            <thead>
                                                  <tr>
                                                     <th>#</th>
                                                     <th>Reference #</th>
                                                     <th><p>Incident</p></th>
                                                     <th><p>Province</p></th>
                                                     <th><p>Municipality</p></th>
                                                     <th><p>Requester</p></th>
                                                     <th><p>More</p></th>                                           
                                                  </tr>
                                               </thead>
                                              <tbody>
                                                 <?php
                                                    foreach($get_drmd_request as $key =>  $value){ 
                                                      $incident_name = $value['incidesc'];
                                                      $requester_name = $value['reqsdesc'];
                                                      $remarks = "";
                                                      if($value['inci_num'] == 13){
                                                        $incident_name = $value['ot_inci'];                                                  
                                                      }

                                                      
                                                      if($value['inci_num'] == 1){
                                                        $remarks = '-'.$value['remarks'];
                                                      }

                                                      if($value['req_num'] == 11){
                                                        $requester_name = $value['ot_req_desc'];
                                                      }

                                                       $key++;
                                                        echo 
                                                        '<tr>
                                                          <td><p>'.$key.'</p></td>
                                                          <td><p>'.$value['reference_no'].'</p></td>
                                                          <td><p>'.$incident_name.' '.$remarks.'<p></td>
                                                          <td><p>'.ucfirst(strtolower($value['provDesc'])).'</p></td>
                                                          <td><p>'.ucfirst(strtolower($value['citymunDesc'])).'</p></td>
                                                          <td><p>'.$requester_name.'</p></td>
                                                          <td>
                                                              <a href="javascript:void(0);" <button data-id="'.$value['drid'].'" class="btn_drmd_details_dash"><div class="badge badge-opacity-success">View Details</div></a>
                                                          </td>
                                                        </tr>';
                                                    } 
                                                  ?>
                                                <!-- <td><a href=""><p>Expand</p></a></td> -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <br>

                                <div class="d-sm-flex justify-content-between align-items-start">
                                  
                                <div class="row" style="width:100%">
                                    <table id="disapp_dash_table">
                                            <thead>
                                                  <tr>
                                                     <th>#</th>
                                                     <th>Reference #</th>
                                                     <th><p>Incident</p></th>
                                                     <th><p>Province</p></th>
                                                     <th><p>Municipality</p></th>
                                                     <th><p>Requester</p></th>
                                                     <th><p>More</p></th>                                           
                                                  </tr>
                                               </thead>
                                              <tbody>
                                                 <?php
                                                    foreach($get_drrs_disap_request as $key =>  $value){ 
                                                      $incident_name = $value['incident_desc'];
                                                      $requester_name = $value['requester_desc'];
                                                      $remarks = "";
                                                      if($value['inci_num'] == 13){
                                                        $incident_name = $value['ot_inci'];                                                  
                                                      }

                                                      
                                                      if($value['inci_num'] == 1){
                                                        $remarks = '-'.$value['remarks'];
                                                      }

                                                      if($value['req_num'] == 11){
                                                        $requester_name = $value['ot_req_desc'];
                                                      }

                                                       $key++;
                                                        echo 
                                                        '<tr>
                                                          <td><p>'.$key.'</p></td>
                                                          <td><p>'.$value['reference_no'].'</p></td>
                                                          <td><p>'.$incident_name.' '.$remarks.'<p></td>
                                                          <td><p>'.ucfirst(strtolower($value['provDesc'])).'</p></td>
                                                          <td><p>'.ucfirst(strtolower($value['citymunDesc'])).'</p></td>
                                                          <td><p>'.$requester_name.'</p></td>
                                                          <td>
                                                              <a href="javascript:void(0);" <button data-id="'.$value['drid'].'" class="btn_drmd_disapp_details"><div class="badge badge-opacity-warning">View Details</div></a>
                                                          </td>
                                                        </tr>';
                                                    } 
                                                  ?>
                                                <!-- <td><a href=""><p>Expand</p></a></td> -->
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                        
                        <!-- 
                         <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div> -->
                                    <!--  <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur adipisicing elit</p> -->
                                  <!-- </div> -->
                                <!-- </div> -->
                               <!-- <iframe src="https://www.google.com/maps/d/embed?mid=13dimgFijGPW_NXJYxIhO3kqFU1RvZzmb&hl=en&ehbc=2E312F" width="1550" height="480"></iframe> -->
                              <!-- </div> -->
                            <!-- </div> -->
                          <!-- </div> -->
                        <!-- </div> -->
                      </div>
                      <!-- <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <div>
                                        <h4 class="card-title card-title-dash">Top Performer</h4>
                                      </div>
                                    </div>
                                    <div class="mt-3">
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                        
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Brandon Washington</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                        
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Wayne Murphy</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                          
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Katherine Butler</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                                        <div class="d-flex">
                                         
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Matthew Bailey</p>
                                            <small class="text-muted mb-0">162543</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                      <div class="wrapper d-flex align-items-center justify-content-between pt-2">
                                        <div class="d-flex">
                                          <div class="wrapper ms-3">
                                            <p class="ms-1 mb-1 fw-bold">Rafell John</p>
                                            <small class="text-muted mb-0">Alaska, USA</small>
                                          </div>
                                        </div>
                                        <div class="text-muted text-small">
                                          1h ago
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © <?php echo date("Y"); ?>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

   <!-- container-scroller -->
   <style>
    /* width */
    ::-webkit-scrollbar {
      width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey; 
      border-radius: 10px;
    }
    
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: grey; 
      border-radius: 10px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #b5aba9; 
    }
  </style>

<script>

function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('tbl_exporttable_to_xls');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || (Date.now() + '.' + (type || 'xlsx')));
}

</script>