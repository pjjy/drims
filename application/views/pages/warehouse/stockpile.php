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
                             </div>
                                  <div class="row">
	                                    <div class="col-md-2">     
	                                       <a href="javascript:void(0)" class="btn btn-otline-dark wr_add_stockpile"><i class="icon-briefcase"></i> Add stockpile</a> 
	                                    </div>
	                                  </div>
	                                <hr>
                                	<div class="col-12">
                                      <!-- <div class="table-responsive"> -->
                                         <table id="drrs_table" class="" style="width:100%">
                                              <thead>
                                                  <tr>
                                                     <th>#</th>
                                                     <th>Stock pile</th>
                                                     <th>Added by</th>
                                                     <th>Created</th>
                                                     <th>Action</th>
                                                  </tr>
                                               </thead>
                                              <tbody>

                                              <?php
                                                  foreach($stockpile_count as $key =>  $value){   
                                                    $key++;
                                                    echo 
                                                    '<tr>
                                                        <td><p>'.$key.'</p></td>
                                                        <td><p>'.number_format($value['count'],1).'</p></td>
                                                        <td><p>'.$value['first_name'].' '.$value['last_name'].'</p></td>
                                                        <td><p>'.$value['stockcreated'].'</p></td>
                                                        <td>
                                                           <a  data-id="'.$value['stc_id'].'" class="wr_edit_stock"  href="javascript:void(0);" <button><div class="badge badge-opacity-success">Edit</div></a>
                                                        </td>
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
  