<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
              </div>
              <!-- <p>HELLO I GUESS THIS IS YOUR FIRST TIME PLEASE UPDATE YOUR DETAILS.</p> -->
              <!-- <label>Hello I guess this is your first time please update your details</label> -->
              <h6 class="fw-light">HELLO  <?php  echo '<b>'.strtoupper($first_name).'</b>'; ?> ,  I GUESS THIS IS YOUR FIRST TIME, PLEASE UPDATE YOUR PASSWORD AND E-MAIL.</h6>
              <br>
              <form class="pt-3" method="post" action="<?php echo 'login_auth_update_r' ?>">
                <div class="form-group">
                   <label for="exampleFormControlSelect2">NEW PASSWORD</label>
                  <input type="password" minlength="5" class="form-control form-control-lg" name="new_password"  placeholder="New Password">
                </div>
                <div class="form-group">
                   <label for="exampleFormControlSelect2">E-MAIL</label>
                   <input type="email" class="form-control form-control-lg" name="email"  placeholder="E-mail">
                </div>
                <button type="submit" class="btn btn-block  btn-sm font-weight-medium auth-form-btn" >UPDATE</button>
              </form>
              <br>
              <br>
              <br>
              <br>
               <small><a class="nav-link" href='logout_r'>Log out</a></small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>