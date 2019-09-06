<?php
require "../../../error-report.php";
require "../../../database/db-config.php";
session_start();
require '../../Student.php';

$student = new Student(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$student->get_session()) {
	header("location:../../login");
}
// set private variable $id in $student object
$student->set_id($_SESSION['id']);

//Fetch all student's data like name, email, id etc
$data = $student->get_student_info();

$teachers_id = $_GET['id'];
$_SESSION['teachers_id'] = $teachers_id;

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
    <title>Student | Home</title>
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
    <style>
.fc-event-dot {
background: #FF3161;
}

    </style>


    <!-- Custom styles for this template -->
    <script>

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    theme: '',
    disableResizing: true,
    disableDragging: true,
    eventResizableFromStart:false,
    //editable:false,

    header:{
     left:'prev,next today',
     center:'title',
     //'month,agendaWeek,agendaDay'
    },
    editable:false,
    eventOverlap: false,
    defaultView: 'listWeek',
    nowIndicator:true,
    duration: { days: 5 },
    events: 'load.php', // to get the slots from the database
    selectable:true,
    selectHelper:true,
    slotEventOverlap:false,
    eventStartEditable:false,
    selectAllow: function(selectInfo) {
         var duration = moment.duration(selectInfo.end.diff(selectInfo.start));
         return duration.asHours() <= 0.5;
    },
	    eventClick:function(event)
    {
	if(confirm("Are you sure you want to book your class?"))
     {
        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     var teacher_id =<?php echo $teachers_id ?>;
     var student_id =<?php echo $_SESSION['id'] ?>;
     $.ajax({
      url:"book.php",
      type:"POST",
      data:{start:start, end:end, id:id, teacher_id:teacher_id, student_id:student_id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       //alert('Event Update');
      }
     })
     }

    },


    // eventClick:function(event)
    // {
    //  if(confirm("Are you sure you want to cancel your class it?"))
    //  {
    //   var id = event.id;
    //   $.ajax({
    //    url:"delete.php",
    //    type:"POST",
    //    data:{id:id},
    //    success:function()
    //    {
    //     calendar.fullCalendar('refetchEvents');
    //     //alert("Event Removed");
    //    }
    //   })
    //  }
    // },

   });
   $( ".fc-v-event" ).css( "background", "red" );
   $( ".fc-event" ).css( "background", "red" );
  });

  </script>

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
            <a href="#" class="logo" id=""><b>Student</b> <span class="fa fa-chevron-right">&nbsp;</span><b>Home</b> </a>
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
          	<h3><?php echo $values["first_name"] ?></h3>
          	<div class="row mt">
          		<div class="col-lg-12">
          		<section class="panel">
                        <div class="panel-body">
                            <div id="calendar" class="has-toolbar"></div>
                        </div>
                    </section>
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
