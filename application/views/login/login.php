<video autoplay muted loop id="myVideo">
  <!-- <source src="assets/video/background1.mp4" type="video/mp4"> -->
</video>
<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
             <!--  <div class="brand-logo">
              </div> -->
              <h4>Hello let's get started</h4>
              <!-- <h6 class="fw-light">Sign in to continue.</h6> -->
              <form class="pt-3" method="post" action="<?php echo 'login_auth_r' ?>">
                <div class="form-group">
                  <label for="exampleFormControlSelect2">USERNAME</label>
                  <input type="text" class="form-control form-control-lg" name="username" id="exampleInputEmail1" placeholder="User Id">
                </div>
                <div class="form-group">
                   <label for="exampleFormControlSelect2">PASSWORD</label>
                   <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                </div>
                 <br>
                  <?php
                    if($this->session->flashdata('error')){
                      echo '<div class="alert alert-danger text-center" style="margin-top:20px;">'.$this->session->flashdata('error').'</div>';
                    }
                    if($this->session->flashdata('success')){
                      echo '<div class="alert alert-success text-center" style="margin-top:20px;">'.$this->session->flashdata('success').'</div>';
                    }
                  ?>
                <!-- <div class="mt-3"> -->
                  <button type="submit" class="btn btn-block  btn-sm font-weight-medium auth-form-btn" >SIGN IN</button>
                <!-- </div> -->
                <div class="my-3 d-flex justify-content-between align-items-center">
                  <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
<style type="text/css">
  /* Style the video: 100% width and height to cover the entire window */
  #myVideo {
    position: fixed;
    right: 0;
    bottom: 0;
    min-width: 100%;
    min-height: 100%;
  }

  /* Add some content at the bottom of the video/page */
  .content {
    position: fixed;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    color: #f1f1f1;
    width: 100%;
    padding: 20px;
  }

  /* Style the button used to pause/play the video */
  #myBtn {
    width: 200px;
    font-size: 18px;
    padding: 10px;
    border: none;
    background: #000;
    color: #fff;
    cursor: pointer;
  }

  #myBtn:hover {
    background: #ddd;
    color: black;
  }
</style>