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
                                  <!-- <hr> -->
                                	<div class="row">
                  						<?php
                  						$prov = "";
                  						  foreach($get_directory_loc as $value){ 
                  						  	$prov = $value['provDesc'];
                  						  	if($value['provDesc']=='NEGROS ORIENTAL'){
                  						  		$prov = 'NEGROS OR';
                  						  	}
   											echo '<div class="col-md-1">
                                      		    <div class="button">
											     <div class="button_shadow"></div>
											    <button data-id='.$value['provCode'].' class="button_content btn_dir"><small><b>'.$prov.'</b></small></button>
											   </div>
                                     	      </div>';
   										  }
                                     	?>
                                     </div>   
                                   <div class="status_details">
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

		*{
		  outline-style: none;
		  -webkit-touch-callout: none; /* iOS Safari */
		    -webkit-user-select: none; /* Safari */
		     -khtml-user-select: none; /* Konqueror HTML */
		       -moz-user-select: none; /* Firefox */
		        -ms-user-select: none; /* Internet Explorer/Edge */
		            user-select: none; /* Non-prefixed version, currently
		                                  supported by Chrome and Opera */
		  margin: 0px;
		  padding: 0px;
		}

		.button{
		    width: 100px;
		    height: 35px;
		}

		.button_content{
		    width: 100%;
		    height: 35px;
		    border-radius: 5px;
		    border: none;
		    background: #3E93CC;
		    cursor: pointer;
		    text-align: center;
		    vertical-align: middle;
		    display: table-cell;
		    position: relative;
		    top: -35px;  /*  -(100% button height) */
		    z-index: 16;
		    transition: 400ms;
		    /*transform-origin: center bottom 0px; */
		    transition: all 0.4s ease 0s;
		    -webkit-transform-origin: center bottom 0px; 
		    -webkit-transition: all 0.4s ease 0s;
		 /*   transform: matrix3d(10,0,0.00,0,0.00,0.71,1.71,0.0035,0,-0.20,0.71,0,0,0,0,1);
		    -webkit-transform: matrix3d(1,0,0.00,0,0.00,0.71,0.71,0.0035,0,-0.71,0.71,0,0,0,0,1);*/
		}

		.button_shadow{
		    width: 100%;
		    height: 100%;
		    background: #49ADF0;
		    border-radius: 5px;
		    margin: auto;
		    z-index: 15;
		    position: relative;
		    top: -8px;  /* [3,5]% button height */
		}

		/*.button_content:active{
		    transform-origin: center bottom 0px; 
		    transition: all 0.4s ease 0s;
		    -webkit-transform-origin: center bottom 0px; 
		    -webkit-transition: all 0.4s ease 0s;
		    transform: matrix3d(1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1);
		    transition: 400ms;
		}*/

  </style>
  