<body>
  <div class="container-scroller"> 
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
         
        </div>
        <div>
          <a class="navbar-brand brand-logo">
            <img src="assets/images/DSWD-FO7-INSIGNIA.png" alt="logo" />
          </a>
          <a class="navbar-brand brand-logo-mini">
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
                  <h1 class="welcome-text">'.$greetings.'</h1>
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
          <li class="nav-item active">
            <a class="nav-link"  href="login_r" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
               <span class="menu-title ">Log In Here</span>
                <i class="menu-arrow"></i>
            </a>
           </li>
        </ul>
      </nav>
      <!-- partial -->
     