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
                             <h4>REQUEST BELOW ARE READY FOR RELEASING AND RIS PRINTING</h4>
                                </div>
                                  <div class="row">
                  									<div class="col-12">
                                      <div class="table-responsive">
                                        <table id="drrs_table" class="" style="width:100%">
                                              <thead>
                                                  <tr>
                                                    <th>#</th>
                                                    
                                                    <!-- <th>Incident</th> -->
                                                    <!-- <th>Remarks</th> -->
                                                    <th>Province</th>
                                                    <th>Municipality</th>
                                              
                                                    <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  foreach($get_wr_to_release as $key =>  $value){
                                                   
                                                    $key++;
                                                    echo 
                                                    '<tr>
                                                        <td><p>'.$key.'</p></td>
                                                        <td><p>'.ucfirst(strtolower($value['provDesc'])).'</p></td>
                                                        <td><p>'.ucfirst(strtolower($value['citymunDesc'])).'</p></td>
                                                        <td>
                                                            <a data-id="'.$value['drid'].'" class="btn_rrsmoredet"  href="javascript:void(0);" <button><div class="badge badge-opacity-success">Process now</div></a>                   
                                                            <a  data-id="'.$value['drid'].'" class="btn_drmd_details"  href="javascript:void(0);" <button><div class="badge badge-opacity-success">View Persons</div></a>
                                                        </td>
                                                    </tr> ';
                                                  } 
                                                ?>
                                                    <!-- <a data-id="'.$value['ris_no'].'" class="btn_rros_edit"  href="javascript:void(0);">&nbsp;&nbsp;  EDIT</a> -->
                                                    <!-- <a data-id="'.$value['ris_no'].'" data-id1="'.$value['reference_no'].'" data-id2="'.$incident_name.'" data-id3="'.$value['provDesc'].'" data-id4="'.$value['citymunDesc'].'" data-id5="'.$requester_name.'" class="btn_print"  href="javascript:void(0);"> PRINT RIS</a> -->
                                                    <!--  <td><p>'.ucfirst(strtolower($value['df_name'])).' '.ucfirst(strtolower($value['dl_name'])).'</p></td>
                                                    <td><p>'.ucfirst(strtolower($value['f_name'])).' '.ucfirst(strtolower($value['l_name'])).'</p></td>
                                                    <td><p>'.ucfirst(strtolower($value['rs_fname'])).' '.ucfirst(strtolower($value['rs_lname'])).'</p></td> -->
                                                    <!-- <td><p>'.$value['field_office'].'-'.substr($value['reference_no'],0,3).'-'.$value['ris_no'].'</p></td> -->
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
  