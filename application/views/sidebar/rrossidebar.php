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
          if(date('H') >= 1 && date('H') <=12){
           $greetings = "Good morning";
          }if(date('H') >= 13 && date('H') <=17){
           $greetings = "Good Afternoon";
          }if(date('H') >= 18 && date('H') <=23){
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
      <!-- if unsa ang user type mao ang ipagawas nga sidebar -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item  <?php if($this->uri->segment(1)=="dashboard_r"){echo "active";}?>">
            <a class="nav-link" href="dashboard_r">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item <?php if($this->uri->segment(1)=="rros_request_r"){echo "active";}?>">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Menu</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
               <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="rros_request_r"){echo "active";}?>" href="rros_request_r">Pending Request (<?php echo $count_pending; ?>)</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="rros_myentry_r"){echo "active";}?>" href="rros_myentry_r">Processed Data (<?php echo $count_processed; ?>)</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="rros_disapp_r"){echo "active";}?>" href="rros_disapp_r">Disapproved Request (<?php echo $count_disapproved; ?>)</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="rros_delinquent_r"){echo "active";}?>" href="rros_delinquent_r">Delinquent request (<?php echo $count_delinquent; ?>)</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="eterato_r"){echo "active";}?>" href="eterato_r">Reports</a></li>
                <li class="nav-item"><a class="nav-link <?php if($this->uri->segment(1)=="standy_fund_r"){echo "active";}?>" href="standy_fund_r">Stand by funds</a></li>
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
                <li class="nav-item"> <a class="nav-link <?php if($this->uri->segment(1)=="standy_fund_r"){echo "active";}?>" href='my_profile_r'>Profile</a></li>
                <li class="nav-item"> <a class="nav-link" href=''>About</a></li>
                <li class="nav-item"> <a class="nav-link" href='logout_r'>Log out</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
     