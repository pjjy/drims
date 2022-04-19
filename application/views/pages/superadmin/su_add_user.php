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
	                  									<div class="col-md-3">
	                                      <div class="form-group">
	                                      	<label for="exampleFormControlSelect2">First Name</label>
	                                        <input type="text" class="form-control" id="first_name" />
	                                       </div>	
	                                    </div> 
	                                    <div class="col-md-3">
	                                      <div class="form-group">
	                                      	<label for="exampleFormControlSelect2">Last Name</label>
	                                        <input type="text" class="form-control" id="last_name" />
	                                       </div>	
	                                    </div>

	                                     <div class="col-md-3">
	                                      <div class="form-group">
	                                      	<label for="exampleFormControlSelect2">User Name</label>
	                                        <input type="text" class="form-control" id="user_name" />
	                                       </div>	
	                                    </div>

	                                    <div class="col-md-3">
	                                    <div class="form-group">
	                                    <label for="">USE TYPE</label>
	                                        <select class="form-control" id="usertype">
	                                             <?php
	                                                  foreach($get_sections as $value){ 
	                                                      echo '<option value ='.$value['id'].'>'.$value['description'].'</option>';
	                                                  }
	                                             ?>
	                                        </select>
	                                    </div>
	                                  </div>  
	                               	</div>
	                                   <div class="row">
	                                    <div class="col-md-2">
	                                       <a href="." class="btn btn-otline-dark"><i class="icon-trash"></i> Cancel</a>
	                                       <a href="javascript:void(0)" class="btn btn-otline-dark su_saveuser"><i class="icon-briefcase"></i> Save</a> 
	                                    </div>
	                                  </div>
	                                <hr>
                                	<div class="col-12">
                                      <!-- <div class="table-responsive"> -->
                                         <table id="drrs_table" class="" style="width:100%">
                                              <thead>
                                                  <tr>
                                                     <th>#</th>
                                                     <th>User ID</th>
                                                     <th>Username</th>
                                                     <th>First name</th>
                                                     <th>Last name</th>
                                                     <th>Role</th>
                                                     <th>Status</th>
                                                     <th>Created</th>
                                                     <th>Action</th>
                                                     <!-- <th>More</th> -->
                                                  </tr>
                                               </thead>
                                              <tbody>
                                                 <?php
                                                    foreach($get_user_list as $key =>  $value){
                                                       $key++;
                                                        echo 
                                                        '<tr>
                                                          <td><p>'.$key.'</p></td>
                                                          <td><p>'.$value['user_id'].'</p></td>
                                                          <td><p>'.$value['user_name'].'</p></td>
                                                          <td><p>'.$value['first_name'].'</p></td>
                                                          <td><p>'.$value['last_name'].'</p></td>
                                                          <td><p>'.$value['description'].'</p></td>
                                                          <td><p>'.$value['status'].'</p></td>
                                                          <td><p>'.date('m/d/Y h:i:s a', strtotime($value['created'])).'</p></td>
                                                          <td><p><button class="reset_btn" data-id='.$value['id'].'>Reset account</button</p></td>
                                                        </tr>';
                                                    } 
                                                  ?>
                                                <!-- <td><a href=""><p>Expand</p></a></td> -->
                                                <!-- <td><p><a data-id="'.$value['id'].'" class="btn_drmd_details"  href="javascript:void(0);">BLOCK</a></p></td> -->
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
  