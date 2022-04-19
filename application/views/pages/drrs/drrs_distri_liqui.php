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
                                 <h4 class="card-title card-title-dash">PENDING TRANSACTIONS TO BE LIQUIDATED</h4>
                                  </div>
                                    <div class="row">
                    									<div class="col-12">
                                        <div class="table-responsive">
                                           <table id="drrs_table2" class="" style="width:100%">
                                                <thead>
                                                    <tr>
                                                      <th>#</th>
                                                      <th>Incident</th>
                                                      <th>Province</th>
                                                      <th>Municipality</th>
                                                      <th>Requester</th>
                                                      <th>RIS #</th>
                                                      <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                    foreach($get_rros_entries as $key => $value){
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
                                                           <td><p>'.$incident_name.'</p></td>
                                                           <td><p>'.ucfirst(strtolower($value['provDesc'])).'</p></td>
                                                           <td><p>'.ucfirst(strtolower($value['citymunDesc'])).'</p></td>
                                                           <td><p>'.$requester_name.'</p></td>
                                                           <td><p>'.$value['field_office'].'-'.substr($value['reference_no'],0,3).'-'.$value['ris_no'].'</p></td>
                                                           <td><a href="javascript:void(0);" data-id="'.$value['drid'].'" class="btn_rrsmoredet" ><i class="icon-info"></i> Details</a> <a data-id="'.$value['drid'].'" data-id1="'.$value['reference_no'].'" data-id2="'.$incident_name.'" data-id3="'.$value['provDesc'].'" data-id4="'.$value['citymunDesc'].'" data-id5="'.$requester_name.'" data-id6="'.$value['ris_no'].'" data-id7="'.$value['no_beneficiaries'].'" class="drrs_distri_process" href="javascript:void(0);"><i class="icon-play"></i> Liquadate</a> </td>
                                                        </tr>';
                                                    } 
                                                  ?>
                                            </tbody>
                                          </table>
                                        </div>
                                      </div>    
                                   	</div>
                                  <div class="more_details">
                                 <hr>
                                </div>
                                <br>
                                 <div class="row autofilled">
                                  <br>
                                  <hr>
                                  <br>
                                  <h4>DRRS ENTRY FORM</h4>
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
                                 <hr>
                                 <br>
                                 <h4>F/NFI DISTRIBUTION </h4><br>
                                 <div class="row">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="exampleFormControlSelect2"># OF AFFECTED FAMILIES</label>
                                          <input type="number" min="0" class="form-control no_affected_fam" id="requester"/>
                                       </div>
                                    </div>

                                      <div class="col-md-3">
                                         <div class="form-group">
                                          <label for="exampleFormControlSelect2">QUANTITY RELIEFS REQUESTED</label>
                                            <input type="text" class="form-control qty_ffp_req" />
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                        <div class="form-group">
                                          <label for="exampleFormControlSelect2">DATE OF DISTRIBUTION</label>
                                           <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                            <span class="input-group-addon input-group-prepend border-right">
                                              <span class="icon-calendar input-group-text calendar-icon"></span>
                                            </span>
                                           <input type="text" class="form-control date_of_distribution" id="datepicker5" readonly>
                                         </div>
                                        </div>
                                      </div>

                                      <div class="col-md-3">
                                         <div class="form-group">
                                          <label for="exampleFormControlSelect2">TOTAL QUANTITY DISTRIBUTED</label>
                                            <input type="number" min="0" class="form-control total_qty_distributed" />
                                          </div>
                                      </div>

                                      <div class="col-md-3">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">RETURNED RELIEFS</label>
                                          <input type="number" min="0" class="form-control balance" />
                                        </div>
                                      </div>

                                      <div class="col-md-3">
                                       <div class="form-group">
                                        <label for="exampleFormControlSelect2">AREA OF DISTRIBUTION</label>
                                          <input type="text" class="form-control area_of_distribution" />
                                        </div>
                                      </div>
                                   </div>
                                   <h4>F/NFI LIQUIDATION</h4><br>
                                   <div class="row">
                                      <div class="col-md-2">
                                         <div class="form-group">
                                          <label for="exampleFormControlSelect2">QUANTITY LIQUIDATED</label>
                                            <input type="number" class="form-control total_no_asper_rds"/>
                                          </div>
                                      </div> 

                                       <div class="col-md-2">
                                          <div class="form-group">
                                            <label for="exampleFormControlSelect2">DATE SUBMISSION OF RDS</label>
                                             <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                              <span class="input-group-addon input-group-prepend border-right">
                                                <span class="icon-calendar input-group-text calendar-icon"></span>
                                              </span>
                                            <input type="text" class="form-control date_of_submission" id="datepicker6" readonly>
                                           </div>
                                          </div>
                                      </div>
                                   </div>
                                   <br>
                                    <h4>CLIENT SATISFACTION MEASUREMENT REPORT<h4>
                                   <br>
                                   <div class="row"> 
                                       <div class="col-md-3">
                                          <div class="form-group">
                                            <label for="exampleFormControlSelect2">DATE OF RECEIVED </label>
                                             <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                              <span class="input-group-addon input-group-prepend border-right">
                                                <span class="icon-calendar input-group-text calendar-icon"></span>
                                              </span>
                                             <input type="text" class="form-control date_received" id="datepicker" readonly>
                                           </div>
                                          </div>
                                      </div>
                                      
                                      <div class="col-md-3">
                                          <form class="upload_image">
                                            <div class="form-group">
                                              <label for="exampleFormControlSelect2">UPLOAD DOCUMENT</label>
                                                 <input type="file" class="form-control file-upload-info doc_upload" placeholder="Upload Document">
                                            </div>
                                          </form>
                                      </div>
                                    </div>
                                   <br><br>
                                   <div class="row">
                                     <div class="col-md-2">
                                        <a href="." class="btn btn-otline-dark"><i class="icon-trash"></i> Cancel</a>
                                        <a href="javascript:void(0)" class="btn btn-otline-dark drrs_distri_save_req"><i class="icon-briefcase"></i> Save</a> 
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
  