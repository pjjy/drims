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
                                    <!-- <h4>PLEASE SELECT LOCATIONS BELOW</h4> -->
                                </div>
                                  <br>
                                	  <div class="row">
                          							<h1><b><?php echo number_format($get_latest_fund->fund ,2) ?></b></h1>
                          						</br>
                                     </div>   
                                     <br> 
                                    <a href="javascript:void(0)" class="btn btn-otline-dark update_funds_bt"><i class="icon-pencil"></i> Update Funds</a>
                                    <br><hr>
                                    <div class="row">
                                    <div class="col-12">
                                      <div class="table-responsive">
                                        <table id="drrs_table" class="" style="width:100%">
                                              <thead>
                                                  <tr>
                                                    <th><small>#</small></th>
                                                    <th><small>History</small></th>
                                                    <th><small>Added by</small></th>
                                                    <th><small>Date Added</small></th>
                                                    <th><small>Action</small></th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                  foreach($stand_by_funds_tbl as $key =>  $value){
                                                    $key++;
                                                    echo 
                                                    '<tr>
                                                        <td><p>'.$key.'</p></td>
                                                        <td><p>PHP '.number_format($value['fund'],2).'</p></td>
                                                        <td><p>'.ucfirst(strtolower($value['first_name'])).' '.ucfirst(strtolower($value['last_name'])).'</p></td>
                                                        <td><p>'.date('Y-m-d', strtotime($value['created'])).'</p></td>
                                                        <td><p><a class="updateSt_fund_btn" data-id1='.$value['stfid'].' data-id='.$value['fund'].' href="javascript:void(0)">UPDATE</a></p></td>
                                                      </tr> ';
                                                  } 
                                                ?>
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
  