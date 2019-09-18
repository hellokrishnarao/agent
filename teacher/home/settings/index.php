<?php
require "../../../error-report.php";
require "../../../database/db-config.php";
require "../../Teacher.php";

session_start();

$teacher = new Teacher(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (!$teacher->get_session()) {
	header("location:../../login");
}
$data = $teacher->get_teacher_info();
$teacher->set_id($_SESSION['id']);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (isset($_POST['submit'])) {
		$warning = $teacher->change_password($_POST['old'], $_POST['new'], $_POST['confirm']);
	}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Teacher Settings</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3fc7d0e35a.js"></script>
    <link href="../assets/css/main.css" rel="stylesheet">

    <style>
    body{padding-top:30px;}

    .glyphicon {  margin-bottom: 10px;margin-right: 10px;}

    small {
    display: block;
    line-height: 1.428571429;
    color: #999;
}
    </style>
</head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="#" class="logo" id=""><b>Teacher</b> <span class="fa fa-chevron-right">&nbsp;</span><b>Settings</b> </a>
            <!--logo end-->

            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                <li><a class="logout" href="../../logout">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="profile"><img src="../assets/img/profile.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $data['first_name'] . " " . $data['last_name'] ?></h5>

                  <li class="mt">
                      <a class="" href="../">
                          <i class="fa fa-home"></i>
                          <span>Home</span>
                      </a>
                  </li>
                   <li class="mt">
                      <a class="" href="../profile">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>

                   <li class="mt">
                      <a class="active" href="">
                          <i class="fa fa-cogs"></i>
                          <span>Settings</span>
                      </a>
                  </li>



              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

      <section id="main-content">
          <section class="wrapper site-min-height">

            <!-- BASIC FORM ELELEMNTS -->
            <div class="row mt">
            	 <div class="col-lg-12">
                  <div class="form-panel">
				<form action="" method="post" accept-charset="utf-8">
<?php
echo '<div class="p-3 bg-danger text-white" style="margin-bottom: 20px;">' . $warning . '</div>';
?>
						<div class="form-group">

						    <input type="password" name="old" class="form-control" id="exampleInputPassword1" placeholder="Current Password">
						</div>
						<div class="form-group">

						    <input type="password" name="new" class="form-control" id="exampleInputPassword1" placeholder="New Password">
						</div>
						<div class="form-group">

						    <input type="password" name="confirm" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
						</div>
							<div class="form-group">

						    <button type="submit" name="submit" class="form-control btn btn-success">Change Password</button>
						</div>

				</form>
			</div>
		</div>
            </div><!-- /row -->


		</section>
        <!---/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">

      Copyright © AGENT, Inc. All Rights Reserved.

          </div>
      </footer>
      <!--footer end-->
  </section>

      <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>



    <!-- js placed at the end of the document so the pages load faster -->

    <script src="../assets/js/bootstrap.min.js"></script>


    <script src="../assets/js/font.js" type="text/javascript" charset="utf-8"></script>
    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <!--script for this page-->

    <!--common script for all pages-->


  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
		 <script src="../assets/js/common-scripts.js"></script>
  </body>
</html>
