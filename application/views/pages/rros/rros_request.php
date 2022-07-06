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
                                    <h4>BELOW ARE PENDING REQUEST FROM DRRS</h4>
                                </div>
                                <hr>
                                <div class="row">
                  									<div class="col-12">
                                      <div class="table-responsive">
                                        <table id="drrs_table" class="" style="width:100%">
                                              <thead>
                                                  <tr>
                                                      <th>#</th>
                                                      <th>Reference #</th>
                                                      <th>Incident</th>
                                                      <th>Province</th>
                                                      <th>Municipality</th>
                                                      <th>Requester</th>
                                                      <!-- <th>Drmd</th> -->
                                                      <!-- <th>Drrs</th> -->
                                                      <!-- <th>Qty requested</th> -->
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                    foreach($get_rros_request as $key =>  $value){ 
                                                      $incident_name = $value['incidesc'];
                                                      $requester_name = $value['reqsdesc'];
                                                      if($value['inci_num'] == 13){
                                                        $incident_name = 'u.s: '.$value['ot_inci'];
                                                      }
                                                      if($value['req_num'] == 11){
                                                        $requester_name = 'u.s: '.$value['ot_req_desc'];
                                                      }
                                                      $key++;
                                                      echo 
                                                      '<tr>
                                                        <td><p>'.$key.'</p></td>
                                                        <td><p>'.$value['reference_no'].'</p></td>
                                                        <td><p>'.$incident_name.'</p></td>
                                                        <td><p>'.ucfirst(strtolower($value['provDesc'])).'</p></td>
                                                        <td><p>'.ucfirst(strtolower($value['citymunDesc'])).'</p></td>
                                                        <td><p>'.$requester_name.'</p></td>
                                                        <td>
                                                          <a data-id="'.$value['drid'].'" class="btn_drmd_details"  href="javascript:void(0);" <button><div class="badge badge-opacity-success"><i class="icon-info"></i> View Details</div></a>                                                       
                                                          <a data-id="'.$value['drid'].'" data-id1="'.$value['reference_no'].'" data-id2="'.$incident_name.'" data-id3="'.$value['provDesc'].'" data-id4="'.$value['citymunDesc'].'" data-id5="'.$requester_name.'" data-id6="'.$value['disctrictcode'].'" class="rros_process" href="javascript:void(0);" <button><div class="badge badge-opacity-success"><i class="icon-play"></i> Process</div></a>
                                                        </tr> ';
                                                    } 
                                                  ?>
                                                   <!-- <td><p>'.ucfirst(strtolower($value['df_name'])).' '.ucfirst(strtolower($value['dl_name'])).'</p></td> -->
                                                   <!-- <td><p>'.ucfirst(strtolower($value['f_name'])).' '.ucfirst(strtolower($value['l_name'])).'</p></td> -->
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>    
                               	</div>
                               
                                <div class="row autofilled">
                                   <br><h4>RROS ENTRY FORM</h4><br><br>
                                    <div class="col-md-2">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">REFERENCE #</label>
                                          <input type="text" class="form-control reference_no" readonly/>
                                        </div>
                                     </div>
                                     <div class="col-md-2">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">TYPE OF INCIDENT</label>
                                          <input type="text" class="form-control type_incident" readonly/>
                                        </div>
                                     </div>
                                     <div class="col-md-2">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">PROVINCE</label>
                                          <input type="text" class="form-control province" readonly/>
                                        </div>
                                     </div>

                                     <div class="col-md-2">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">MUNICIPALITY</label>
                                          <input type="text" class="form-control municipality" readonly/>
                                        </div>
                                     </div>
                                     
                                     <div class="col-md-2">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">CONGRESSIONAL DISTRICT</label>
                                          <input type="text" class="form-control congressional_disctrict" readonly/>
                                        </div>
                                     </div>
                                     
                                     <div class="col-md-2">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">REQUESTER</label>
                                          <input type="text" class="form-control requester" readonly/>
                                        </div>
                                      </div>
                                    <div class="row">
                                <!--      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">RIS CONTROL NUMBER</label>
                                            <input type="text" min="0" class="form-control ris_num" id="requester"/>
                                         </div>
                                     </div> -->
                                     <div class="col-md-3">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">DATE NOTICE OF APPROVAL RECEIVED FROM DRMD </label>
                                          <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                          <span class="input-group-addon input-group-prepend border-right">
                                            <span class="icon-calendar input-group-text calendar-icon"></span>
                                          </span>
                                        <input type="text" class="form-control date_let_aprv_drmd" id="datepicker" readonly>
                                       </div>
                                        </div>
                                     </div>
                                     <div class="col-md-3">
                                       <div class="form-group">
                                          <label for="exampleFormControlSelect2">PULL-OUT LETTER FRWD TO DRMD</label>
                                            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                            <span class="input-group-addon input-group-prepend border-right">
                                              <span class="icon-calendar input-group-text calendar-icon"></span>
                                            </span>
                                           <input type="text" class="form-control date_crd_pull_fr_drmd" id="datepicker1" readonly>
                                         </div>
                                        </div>
                                     </div>

                                     <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">DATE RIS FORWARDED TO DRMD</label>
                                            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                             <span class="input-group-addon input-group-prepend border-right">
                                               <span class="icon-calendar input-group-text calendar-icon"></span>
                                             </span>
                                           <input type="text" class="form-control date_ris_frw_drmd" id="datepicker2" readonly>
                                         </div>
                                        </div>
                                      </div>

                                      <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="exampleFormControlSelect2">WAREHOUSE ORIGIN</label>
                                          <select class="form-control province_sel">
                                            <?php
                                              foreach($get_province as $value){
                                                echo '<option value ='.$value['provCode'].'>'.$value['provDesc'].'</option>';
                                              }
                                            ?>
                                        </select>
                                      </div>
                                      </div>


                                      
                                    </div>

                                 
                                 <!-- <div class="row "> -->
                                    
                                      <!-- <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">RIS CONTROL NUMBER</label>
                                            <input type="text" min="0" class="form-control ris_num" id="requester"/>
                                         </div>
                                      </div> -->

                                      <!-- <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">QUANTITY OF FFPs RELEASED</label>
                                            <input type="number" min="0" class="form-control ffps_qty" id="requester"/>
                                         </div>
                                      </div> -->

                                    <!--   <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">QUANTITY OF NFIs RELEASED</label>
                                            <input type="number" min="0" class="form-control nfis_qty" id="requester"/>
                                         </div>
                                      </div> -->

                                 <!-- </div> -->
                                 <!--           
                                  <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">DATE RIS FORWARDED TO DRMD</label>
                                            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                             <span class="input-group-addon input-group-prepend border-right">
                                               <span class="icon-calendar input-group-text calendar-icon"></span>
                                             </span>
                                           <input type="text" class="form-control date_ris_frw_drmd" id="datepicker2" readonly>
                                         </div>
                                        </div>
                                      </div>
                                  </div> -->

                                  <div class="assist">
                              
                                  </div>
                                   <br><hr> <br>
                                   <div class="row">
                                    <div class="col-md-2">
                                       <a href="javascript:void(0)" class="btn btn-otline-dark rros_cancel_req"><i class="icon-trash"></i> Cancel</a>
                                       <a href="javascript:void(0)" class="btn btn-otline-dark rros_save_req"><i class="icon-briefcase"></i> Save</a> 
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
  