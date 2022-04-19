 
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
                                    <h4 class="card-title card-title-dash">DISASTER RESPONSE REQUEST FORM</h4>
                                </div>
                                <br>
                                <hr>
                                <br>
                                <div class="row">
                                <div class="col-md-3">
                                   <div class="form-group">
                                    <label for="">TYPE OF INCIDENT</label>
                                    <select class="form-control" id="incident">
                                         <?php
                                              foreach($get_incident as $value){ 
                                                  echo '<option value ='.$value['id'].'>'.$value['description'].'</option>';
                                               }
                                         ?>
                                    </select>
                                    </div>
                                  </div>
                                   <div class="col-md-3 others">
                                    <div class="form-group">
                                      <label for="exampleFormControlSelect2">PLEASE SPECIFY</label>
                                        <input type="text" placeholder="Please specify incident" class="form-control" id="otherincident" disabled="true"/>
                                      </div>
                                   </div>

                                   <div class="col-md-3">
                                     <div class="form-group">
                                      <label for="">PROVINCE</label>
                                        <select class="form-control" id="province">
                                             <?php
                                                  foreach($get_province as $value){ 
                                                      echo '<option value ='.$value['provCode'].'>'.$value['provDesc'].'</option>';
                                                  }
                                             ?>
                                        </select>
                                     </div>
                                   </div>

                                  <div class="col-md-3">
                                   <div class="form-group">
                                    <label for="">MUNICIPALITY</label>
                                         <select class="form-control" id="municipality">
                                             <?php
                                                  foreach($get_default_city as $value){ 
                                                      echo '<option id='.$value['psgcCode'].' value='.$value['citymunCode'].'>'.$value['citymunDesc'].'</option>';
                                                  } 
                                             ?>
                                         </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="row">
                                 
                                 <div class="col-md-3">
                                    <div class="form-group">
                                    <label for="">REQUESTER</label>
                                         <select class="form-control" id="requester">
                                             <?php
                                                  foreach($get_requester as $value){ 
                                                      echo '<option value='.$value['id'].'>'.$value['description'].'</option>';
                                                  } 
                                             ?>
                                         </select>
                                    </div>
                                 </div>
                                 <div class="col-md-3 otherrequester">
                                   <div class="form-group">
                                    <label for="exampleFormControlSelect2">SPECIFY REQUESTER</label>
                                      <input type="text" placeholder="Please specify requester" class="form-control" id="otherrequester" disabled="true"/>
                                    </div>
                                  </div>

                                   <div class="col-md-4 otherrequester">
                                      <div class="form-group">
                                        <label for="exampleFormControlSelect2">REMARKS</label>
                                          <textarea type="text" placeholder="Enter remarks if available" class="form-control" id="remarks" ></textarea>    
                                      </div>
                                  </div>

                                 </div>
                                <div class="d-sm-flex justify-content-between align-items-start">
                                    <h4 class="card-title card-title-dash">DATE ENTRIES</h4>
                                </div>
                                <br>
                                 <div class="row">
                                   <div class="col-md-6">
                                    <div class="form-group">
                                      <label for="exampleFormControlSelect2">DATE LETTER REQUEST(with complete attachments) RECEIVED</label>
                                       <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                        <span class="input-group-addon input-group-prepend border-right">
                                          <span class="icon-calendar input-group-text calendar-icon"></span>
                                        </span>
                                       <input type="text" class="form-control" id="datepicker" readonly>
                                      </div>
                                     </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="exampleFormControlSelect2">DATE FORWARDED TO DRRS</label>
                                           <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                                             <span class="input-group-addon input-group-prepend border-right">
                                               <span class="icon-calendar input-group-text calendar-icon"></span>
                                             </span>
                                            <input type="text" class="form-control" id="datepicker1" readonly>
                                          </div>
                                        </div>
                                    </div>
                                 </div>
                                 <br>
                                 <hr>
                                 <!--  <p>UPLOAD SCANNED FILES HERE</p>
                                 <form method="POST" name="form-example-1" id="form-example-1" enctype="multipart/form-data">
                                     <div class="input-images"></div>
                                 </form> -->

                                   <div class="row">
                                         <div class="col-md-2">
                                            <div class="form-check">
                                            <label class="form-check-label">
                                              <input type="radio" class="form-check-input" name="optionsRadios" id="rad_food_item" value="option2" />
                                              FOOD ITEMS
                                            <i class="input-helper"></i></label>
                                            </div>
                                         </div>
                                         <div class="col-md-2">
                                            <div class="form-check">
                                              <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="rad_non_food_item" value="option2" />
                                               NON-FOOD ITEMS
                                              <i class="input-helper"></i></label>
                                            </div>
                                         </div>
                                           <div class="col-md-2">
                                            <div class="form-check">
                                              <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="optionsRadios" id="rad_both" value="option2" />
                                                BOTH
                                              <i class="input-helper"></i></label>
                                            </div>
                                         </div>
                                   </div>
                                  
                                   
                                     <div class="row food-items">
                                   <br><br>
                                  <h4>FOOD ITEMS</h4>
                                   <br>
                                    <?php 
                                       foreach($get_food_items as $key =>  $value){ 
                                        $food_text = '';
                                         if($key == 0){
                                            $food_text = 'food_text';
                                         }
      
                                         echo'<div class="col-md-2">
                                                <div class="form-group">
                                                 <input value="'.$value['description'].'" data-id="'.$value['id'].'" type="text" class="form-control food_item"  title="'.$value['description'].'" readonly/>
                                                </div>
                                              </div>
                                               <div class="col-md-2">
                                               <div class="form-group">
                                                  <select class="form-control food-uom">'; 
                                                  foreach($get_food_item_uom as $value1){
                                                    if($value['id'] == $value1['item']){
                                                        echo '<option value="'.$value1['uom'].'">'.$value1['description'].'</option>';
                                                    }
                                                  }
                                                 echo'</select>
                                                </div>
                                              </div>
                                              <div class="col-md-2">
                                                 <div class="form-group">
                                                    <input placeholder="QTY REQUESTED" type="number" min="0" value="" title="QTY REQUESTED" class="form-control food-qty-request '.$food_text.'" />
                                                 </div>
                                              </div>';

                                              // <div class="col-md-1">
                                              //    <div class="form-group">
                                              //       <input placeholder="QTY APPROVED" type="number" min="0" value="" title="QTY REQUESTED"  class="form-control food-qty '.$food_text.'" />
                                              //    </div>
                                              // </div>';
                                       }
                                    ?>
                                
                                   </div>

                                  <div class="row non-food-items">
                                  <br><br>
                                  <h4>NON-FOOD ITEMS</h4>
                                  <br>
                                    <?php 
                                         foreach($get_non_food_items as $key =>  $value){ 
                                           echo'
                                               <div class="col-md-2">
                                                  <div class="form-group">
                                                   <input value="'.$value['description'].'" data-id="'.$value['id'].'" type="text" class="form-control non_food_item"  title="'.$value['description'].'" readonly/>
                                                  </div>
                                                </div>
                                                 <div class="col-md-2">
                                                 <div class="form-group">
                                                    <select class="form-control non-food-uom">'; 
                                                    foreach($get_food_item_uom as $value1){
                                                      if($value['id'] == $value1['item']){
                                                          echo '<option value="'.$value1['uom'].'">'.$value1['description'].'</option>';
                                                      }
                                                    }
                                                   echo'</select>
                                                  </div>
                                                </div>

                                                 <div class="col-md-2">
                                                   <div class="form-group">
                                                      <input placeholder="QTY REQUESTED" type="number" min="0" value="" title="QTY REQUESTED" class="form-control non-food-requested"/>
                                                   </div>
                                                </div>';

                                                // <div class="col-md-1">
                                                //    <div class="form-group">
                                                //       <input placeholder="QTY APPROVED" type="number" min="0" value="" title="QTY REQUESTED" class="form-control non-food-qty"/>
                                                //    </div>
                                                // </div>';
                                          }
                                    ?>
                                    
                                     </div>  

                                     <br><hr>
                                       <div class="row">
                                         <div class="col-md-2">
                                           <a href="javascript:void(0)" id="cancel_bt" class="btn btn-otline-dark"><i class="icon-trash"></i> Cancel</a>
                                           <a href="javascript:void(0)" id="save_bt" class="btn btn-otline-dark"><i class="icon-briefcase"></i> Save</a>
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
  <style type="text/css">
    /*! Image Uploader - v1.0.0 - 15/07/2019
 * Copyright (c) 2019 Christian Bayer; Licensed MIT */

/* Base style */
.image-uploader {
    min-height: 19rem;
    border: 1px solid #d9d9d9;
    position: relative;
}

/* Style on hover */
.image-uploader.drag-over {
    background-color: #f3f3f3;
}

/* Hide the file input */
.image-uploader input[type="file"] {
    width: 0;
    height: 0;
    position: absolute;
    z-index: -1;
    opacity: 0;
}

/* Text container */
.image-uploader .upload-text {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    bottom: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.image-uploader .upload-text i {
    display: block;
    font-size: 3rem;
    margin-bottom: .5rem;
}

.image-uploader .upload-text span {
    display: block;
}

/* Hide the text if there is at least one uploaded image */
.image-uploader.has-files .upload-text {
    display: none;
}

/* Uploaded images container */
.image-uploader .uploaded {
    padding: .5rem;
    line-height: 0;
}

.image-uploader .uploaded .uploaded-image {
    display: inline-block;
    width: calc(16.6666667% - 1rem);
    padding-bottom: calc(16.6666667% - 1rem);
    height: 0;
    position: relative;
    margin: .5rem;
    background: #f3f3f3;
    cursor: default;
}

.image-uploader .uploaded .uploaded-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    position: absolute;
}

/* Delete image button */
.image-uploader .uploaded .uploaded-image .delete-image {
    display: none;
    cursor: pointer;
    position: absolute;
    top: .2rem;
    right: .2rem;
    border-radius: 50%;
    padding: .3rem;
    background-color: rgba(0, 0, 0, .5);
    -webkit-appearance: none;
    border: none;
}

.image-uploader .uploaded .uploaded-image:hover .delete-image {
    display: block;
}

.image-uploader .uploaded .uploaded-image .delete-image i {
    color: #fff;
    font-size: 1.4rem;
}

  </style>