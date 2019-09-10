<?php
require "../../../error-report.php";
require "../../../database/db-config.php";
session_start();
require '../../Teacher.php';
require '../../../student/Student.php';
$teacher = new Teacher(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$student = new Student(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$teacher->get_session()) {
	header("location:../../login");
}
// set private variable $id in $teacher object
$teacher->set_id($_SESSION['id']);

//Fetch all teacher's data like name, email, id etc
$data = $teacher->get_teacher_info();

$students_id = $_GET['id'];
$event_id = $_GET['event'];

$student_info = $student->get_student_data($students_id);

$start_event = $teacher->get_start_event($event_id);
$end_event = $teacher->get_end_event($event_id);

$_SESSION['teachers_id'] = $teachers_id;
//print_r($student_info)
if ($_POST['submit'] == "confirm") {

	if ($teacher->confirm_event($start_event[0], $end_event[0], $event_id)) {
		$error = false;
		header("location:../");

	} else {
		if (!$error) {
			$error = "Already confirmed";
		}
		$error = "Not confirmed";
	}
} elseif ($_POST['submit'] == "cancel") {
	$result = $teacher->cancel_event($start_event[0], $end_event[0], $event_id);
	if ($result == "1") {
		$error = false;
		header("location:../");

	} else {
		$error = "Could not Delete";
	}
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <script src="https://kit.fontawesome.com/3fc7d0e35a.js"></script>
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>Teacher | New Requests</title>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">

    <!-- calender -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <!--external css-->
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script>

  $(document).ready(function () {
            $imgSrc = $('#imgProfile').attr('src');
            function readURL(input) {

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgProfile').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            $('#btnChangePicture').on('click', function () {
                // document.getElementById('profilePicture').click();
                if (!$('#btnChangePicture').hasClass('changing')) {
                    $('#profilePicture').click();
                }
                else {
                    // change
                }
            });
            $('#profilePicture').on('change', function () {
                readURL(this);
                $('#btnChangePicture').addClass('changing');
                $('#btnChangePicture').attr('value', 'Confirm');
                $('#btnDiscard').removeClass('d-none');
                // $('#imgProfile').attr('src', '');
            });
            $('#btnDiscard').on('click', function () {
                // if ($('#btnDiscard').hasClass('d-none')) {
                $('#btnChangePicture').removeClass('changing');
                $('#btnChangePicture').attr('value', 'Change');
                $('#btnDiscard').addClass('d-none');
                $('#imgProfile').attr('src', $imgSrc);
                $('#profilePicture').val('');
                // }
            });
        });
</script>
<link rel="stylesheet" href="https://bootswatch.com/4/simplex/bootstrap.min.css"/>
    <style>
.fc-event-dot {
background: #FF3161;
}
body{
    padding-top: 68px;
    padding-bottom: 50px;
}
        .image-container {
            position: relative;
        }

        .image {
            opacity: 1;
            display: block;
            width: 100%;
            height: auto;
            transition: .5s ease;
            backface-visibility: hidden;
        }

        .middle {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            text-align: center;
        }

        .image-container:hover .image {
            opacity: 0.3;
        }

        .image-container:hover .middle {
            opacity: 1;
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
            <a href="#" class="logo" id=""><b>Teacher</b> <span class="fa fa-chevron-right">&nbsp;</span><b>New Requests</b> </a>
            <!--logo end-->

            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                <li><a class="logout" href="../../logout">Logout</a></li>
                </ul>
            </div>
        </header>

      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

                  <p class="centered"><a href="../profile"><img src="../assets/img/profile.png" class="img-circle" width="60"></a></p>
                  <h5 class="centered" id="profile-picture"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></h5>

                  <li class="mt">
                      <a class="active" href="../">
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
                      <a class="" href="../schedule">
                          <i class="fa fa-calendar-alt"></i>
                          <span>Schedule</span>
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
<section id="main-content">
          <section class="wrapper site-min-height">


          		<div class="col-lg-12">





<div class="container">
        <div class="row">
            <div class="col-12">


                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                              <!--   <div class="image-container">
                                    <img src="http://placehold.it/150x150" id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    <div class="middle">
                                          <input type="button" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                        <input type="file" style="display: none;" id="profilePicture" name="file" />
                                    </div>
                                </div> -->
                                <?php
if (isset($error)) {
	echo "<p class=\" d-block col-sm form-control alert-danger\" style=\"margin-bottom: 10px; width: 100%;font-family: montserrat; color: #2C3E50; font-size: 13px; \">" . $error;

}
?>
            </p><br/>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><a href=""><?php echo $student_info['first_name'] . ' ' . $student_info['last_name'] ?></a></h2>
                                    <!-- <h6 class="d-block"><a href="">1,500</a> Video Uploads</h6>
                                    <h6 class="d-block"><a href="">300</a> Blog Posts</h6> -->
                                </div>
                                <div class="ml-auto">
                                    <input type="button" class="btn btn-primary d-none" id="btnDiscard" value="Discard Changes" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">

                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        <hr />

                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Birth Date</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_info['dob'] ?>
                                            </div>
                                        </div>
                                        <hr />


                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Interests, Goals and Introduction</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_info['description'] ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">JLPT</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_info['jlpt'] ?>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Gender</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?php echo $student_info['gender'] ?>
                                            </div>
                                        </div>
                                        <hr />

                                    </div>

                                </div>

                                <?php
if ($teacher->is_confirmed($event_id) == true) {
	echo '<form action="" method="post">
        <button type="submit" class="btn btn-danger" name="submit" value="cancel">Cancel</button>
      </form>';
} else {
	echo '<form action="" method="post">
        <button type="submit" class="btn btn-success" name="submit" value="confirm">Confirm</button>
      </form>';
}

?>
                            </div>
                        </div>


                    </div>

            </div>
        </div>
    </div>


</div>
		</section>
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
    <script src="../assets/js/common-scripts.js"></script>

  </body>
</html>
