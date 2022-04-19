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
                                    <h3>BELOW ARE PENDING REQUEST FROM DRRS</h3>
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
                                                    <th>Added by</th>
                                                    <th>Date processed</th>
                                                    <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <?php
                                                    foreach($get_drrs_request as $key =>  $value){ 
                                                       $key++;
                                                        echo 
                                                          '<tr>
                                                             <td>'.$key.'</td>
                                                             <td>'.$value['reference_no'].'</td>
                                                             <td>'.$value['description'].'</td>
                                                             <td>'.ucfirst(strtolower($value['provDesc'])).'</td>
                                                             <td>'.ucfirst(strtolower($value['citymunDesc'])).'</td>
                                                             <td>'.ucfirst(strtolower($value['requester'])).'</td>
                                                             <td>'.ucfirst(strtolower($value['first_name'])).' '.ucfirst(strtolower($value['last_name'])).'</td>
                                                             <td>'.$value['date_approval'].'</td>
                                                             <td><a href="javascript:void(0);" class="btn_add_date" value="'.$value['drid'].'"><i class="icon-calendar"></i> Add date</a>&nbsp;&nbsp;&nbsp;<a class="drmd_more_details" value="'.$value['drid'].'" href="javascript:void(0);"><i class="icon-info"></i> Details</a></td> 
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
        a{
          text-decoration: none;
          color: gray;
        }
        a:hover{
          text-decoration: none;
        }
  </style>
  