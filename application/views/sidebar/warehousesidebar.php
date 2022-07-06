<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="index.html">
            <img src="assets/images/DSWD-FO7-INSIGNIA.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini" href="index.html">
            <img src="assets/images/DSWD-FO7-INSIGNIA.png" alt="logo" />
          </a>
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
         <?php
          $greetings = "";
          if(date('H') >= 1 && date('H') <= 12){
           $greetings = "Good morning";
          }if(date('H') >= 13 && date('H') <= 17){
           $greetings = "Good Afternoon";
          }if(date('H') >= 18 && date('H') <= 23){
           $greetings = "Good Evening";
          }
          echo '<li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                  <h1 class="welcome-text">'.$greetings.',<span class="text-black fw-bold">'.$first_name.'</span><h5><span class="text ">'.$user_id.'</span></h5></h1>
                </li>';?>
         </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item  <?php if($this->uri->segment(1)=="dashboard_r"){echo "active";}?>">
            <a class="nav-link" href="dashboard_r">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
              <i class="menu-arrow"></i>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(1)=="drmd_request_r"){echo "active";}?>">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Menu</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="drmd_request_r"){echo "active";}?>" href="wr_toreleas_r">Releases</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="drmd_entries_r"){echo "active";}?>" href="wr_stockpile_r">Stock Pile Update</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="drrs_disapprove_r"){echo "active";}?>" href="wr_disapproved_r">Disapproved Entries ()</a></li>
                <!-- <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="drmd_ris_repo_r"){echo "active";}?>" href="wr_ris_repo_r">RIS repo (<?php echo $count_ris_dr_mod; ?>)</a></li> -->
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link <?php if($this->uri->segment(1)=="my_profile_r"){echo "active";}?>" href='my_profile_r'>Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href=''>About</a></li>
                <li class="nav-item"> <a class="nav-link" href='logout_r'>Log out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
     