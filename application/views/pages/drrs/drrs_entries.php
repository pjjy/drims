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
                                    <h4>NFI ASSISTANCE</h4>
                                </div>
                                <hr>
                                <div class="row">
                  									<div class="col-12">
                                      <!-- <div class="table-responsive"> -->
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
                                                    <!-- <th>Approved by</th> -->
                                                    <!-- <th>Status</th> -->
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
                                                          <a data-id="'.$value['drid'].'" class="btn_drmd_details" href="javascript:void(0);" <button=""><div class="badge badge-opacity-success">View Details</div></a>
                                                         
                                                        </td>
                                                       
                                                      </tr> ';
                                                    }   
                                                  ?>
                                              </tbody>
                                               <!-- <td><a data-id="'.$value['drid'].'" class="undo_btn" href="javascript:void(0);"><p>More details</p></a></td> -->
                                          </table>
                                      </div>
                                    </div>   
                                   <!--  <div class="status_details">
                                   </div> -->
                                    <br>
                                    <br>
                                    <!-- <div class="d-sm-flex justify-content-between align-items-start">
                                      <h4>CANCELLED F/NFI ASSISTANCE</h4>
                                    </div>
                                   <hr> -->
                                   <!-- <div class="row"> -->
                                    <!-- <div class="col-12"> -->
                                      <!-- <div class="table-responsive"> -->
                                       <!--  <table id="drrs_table1" class="" style="width:100%">
                                              <thead>
                                                  <tr>
                                                      <th>#</th>
                                                      <th>Reference #</th>
                                                      <th>Incident</th>
                                                      <th>Province</th>
                                                      <th>Municipality</th>
                                                      <th>Requester</th>
                                                      <th>Drmd</th>
                                                      <th>Cancelled by</th>
                                                      <th>Status</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody> -->
                                                  <?php
                                                    // foreach($get_cancelled_entry as $key =>  $value){ 
                                                    //   $incident_name = $value['incidesc'];
                                                    //   $requester_name = $value['reqsdesc'];
                                                    //   if($value['inci_num'] == 13){
                                                    //     $incident_name = 'u.s: '.$value['ot_inci'];
                                                    //   }
                                                    //   if($value['req_num'] == 11){
                                                    //     $requester_name = 'u.s: '.$value['ot_req_desc'];
                                                    //   }
                                                    //   $key++;
                                                    //   echo 
                                                    //   '<tr>
                                                    //     <td><p>'.$key.'</p></td>
                                                    //     <td><p>'.$value['reference_no'].'</p></td>
                                                    //     <td><p>'.$incident_name.'</p></td>
                                                    //     <td><p>'.ucfirst(strtolower($value['provDesc'])).'</p></td>
                                                    //     <td><p>'.ucfirst(strtolower($value['citymunDesc'])).'</p></td>
                                                    //     <td><p>'.$requester_name.'</p></td>
                                                    //     <td><p>'.ucfirst(strtolower($value['df_name'])).' '.ucfirst(strtolower($value['dl_name'])).'</p></td>
                                                    //     <td><p>'.ucfirst(strtolower($value['disFname'])).' '.ucfirst(strtolower($value['disLname'])).' @ '.$value['drscreated'].'</p></td>
                                                    //     <td><p style="color:red;">Cancelled</p></td>
                                                    //     <td><a data-id="'.$value['drid'].'" class="undo_btn" href="javascript:void(0);"><p>Restore</p></a></td>
                                                    //   </tr> ';
                                                    // }   
                                                  ?>
                                       <!--        </tbody>
                                         </table>
                                      </div>
                                    </div> -->
                                   
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
  