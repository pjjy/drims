 <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom"></div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <h4>FILTER REPORTS HERE</h4>
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
																				<select class="form-control" id="province">
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
                                <br><hr><br>
                                <div class="row">
                  								<div class="col-12 report_tbl">
                                        <table id="" class="" style="width:100%">
                                              <thead>
                                                  <tr>
	                                                    <th><p>#</p></th>
	                                                    <th><p>Reference No.</p></th>
	                                                    <th><p>Incident</p></th>
	                                                    <th><p>Requester</p></th>
	                                                    <th><p>Province</p></th>
	                                                    <th><p>Municipality</p></th>
	                                                    <!-- <th><p>Distribution area</p></th> -->
	                                                  	<!--   <th><p>Total</p></th> -->
                                                  </tr>
                                              </thead>
                                              <tbody class="rep_result">

                                              </tbody>
                                        </table>
                                 	 </div>    
                               	</div>                              
                              </div>

                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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
        a{
          text-decoration: none;
          color: gray;
        }
        a:hover{
          text-decoration: none;
        }
  </style>
  