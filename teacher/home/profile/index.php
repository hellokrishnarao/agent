<?php
require "../../../error-report.php";
require "../../../database/db-config.php";
require "../../Teacher.php";
require '../../../profile-images/Photo.php';
session_start();

$teacher = new Teacher(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$data = $teacher->get_teacher_info();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if (!isset($_POST['jlpt'])) {
		$_POST['jlpt'] = $data['jlpt'];
	}
	if (!isset($_POST['experience'])) {
		$_POST['experience'] = $data['experience'];
	}
	if (isset($_FILES['file'])) {
		$fileupload = new Photo($_FILES['file']);
		if ($fileupload->uploadfile()) {
			echo 'Yay';
		} else {
			echo "Nope ";
		}
	}

	if ($teacher->update_details($data['id'], $_POST['first_name'], $_POST['last_name'], $_POST['jlpt'], $_POST['experience'], $_POST['phone'], $_POST['description'])) {
		$data = $teacher->get_teacher_info();
		$error = false;
	} else {
		$error = "Something's wrong";
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

    <title>Teacher Profile</title>
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
            <a href="#" class="logo" id=""><b>Teacher</b> <span class="fa fa-chevron-right">&nbsp;</span><b>Profile</b> </a>
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
                      <a class="active" href="">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>
                   <li class="mt">
                      <a class="" href="../settings">
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

                      <form class="form-horizontal style-form" method="post"  action="" enctype="multipart/form-data">

                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">User ID</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $_SESSION['id']; ?>" disabled>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">First Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="first_name"  value="<?php echo $data['first_name']; ?>">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Last Name</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="last_name" value="<?php echo $data['last_name']; ?>"  >
                              </div>
                          </div>
                          <div class="form-group">
                               <label class="col-sm-2 col-sm-2 control-label">Email</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" type="text"  name="email" value="<?php echo $data['email']; ?>" disabled>
                              </div>
                          </div>
                            <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Phone</label>
                              <div class="col-sm-10">
                                  <input type="text" class="form-control" name="phone" value="<?php echo $data['phone']; ?>" >
                              </div>
                          </div>
                            <div class="form-group">
                               <label class="col-sm-2 col-sm-2 control-label">Gender</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" type="text" name="gender" value="<?php echo $data['gender']; ?>"  disabled>
                              </div>
                          </div>
                            <div class="form-group">
                               <label class="col-sm-2 col-sm-2 control-label">Nationality</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" type="text" name="nationality" value="<?php echo $data['nationality']; ?>"  disabled>
                              </div>
                          </div>
                            <div class="form-group">
                               <label class="col-sm-2 col-sm-2 control-label">Date of Birth</label>
                              <div class="col-sm-10">
                                  <input class="form-control" id="disabledInput" type="text" name="dob" value="<?php echo $data['dob']; ?>" disabled>
                              </div>
                          </div>




                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">JLPT</label>
                              <div class="col-sm-10">
                                       <select class="form-control" name="jlpt">
                            <option value="<?php echo $data['jlpt']; ?>" selected disabled><?php echo $data['jlpt']; ?> (Current)</option>
                            <option value="n1">n1 (Native)</option>
                            <option value="n2">n2</option>
                            <option value="n3">n3</option>
                            <option value="n4">n4</option>
                            <option value="n5">n5</option>

                          </select>

                              </div>
                          </div>


                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Experience</label>
                              <div class="col-sm-10">
                                       <select class="form-control" name="experience" >
                                        <option  selected disabled><?php echo $data['experience']; ?> (Current)</option>
                                        <option value="formal">Yes (Formal)</option>
                                        <option value="informal">Yes (Informal)</option>
                                        <option value="no">No</option>
                                      </select>

                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Self Introduction</label>
                              <div class="col-sm-10">
                                  <textarea type="text" name="description" placeholder="About you, your classes, and interests" class="form-control"><?php echo $data['description']; ?></textarea>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Profile Picture</label>
                              <div class="col-sm-10">
                                  <input type="file" class="form-control" name="profile" value="New Picture">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-2 col-sm-2 control-label">Save and Update</label>
                              <div class="col-sm-10">
                                  <button type="submit" class="form-control btn btn-success">Done</button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div><!-- col-lg-12-->
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
