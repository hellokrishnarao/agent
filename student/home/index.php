<?php
require "../../error-report.php";
require "../../database/db-config.php";
session_start();
require '../Student.php';
require '../../teacher/Teacher.php';
$student = new Student(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
$teacher = new Teacher(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (!$student->get_session()) {
	header("location:../login");
}
// set private variable $id in $student object
$student->set_id($_SESSION['id']);

//Fetch all student's data like name, email, id etc
$data = $student->get_student_info();
$_SESSION = array_merge($_SESSION, $data);

//Get all teachers

$teachers = $teacher->get_all_teachers();

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
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/fontawesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- calender -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <!--external css-->
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
    <style>


    </style>


    <!-- Custom styles for this template -->
    <script>

  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    theme: '',
    timeZone: 'UTC',
    disableResizing: true,
    disableDragging: true,
    eventResizableFromStart:false,
   //  editable:false,
   visibleRange: {
    start: '2017-03-22',
    end: '2017-03-25'
  },
    header:{
     left:'prev,next today',
     center:'title',
     right: 'agendaWeek, list, rrule'//'month,agendaWeek,agendaDay'
    },
    editable:false,
    eventOverlap: false,
    defaultView: 'agendaWeek',
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

    select: function(start, end, allDay)
    {
     //var title = prompt("Enter Event Title");
     // if(title)
     // {

      var title = 'Available';
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url:"insert.php",
       type:"POST",
       data:{title:title,start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //alert("Added Successfully");
       }

      })
      calendar.fullCalendar('refetchEvents');
     // }

    },
    editable:false,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       //alert('Event Update');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"update.php",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
      // alert("Event Updated");
      }
     });
    },

    eventClick:function(event)
    {
     if(confirm("Are you sure you want to remove it?"))
     {
      var id = event.id;
      $.ajax({
       url:"delete.php",
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        //alert("Event Removed");
       }
      })
     }
    },

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
                <li><a class="logout" href="../logout">Logout</a></li>
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

              	  <p class="centered"><a href="profile"><img src="assets/img/profile.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered" id="profile-picture"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></h5>

                  <li class="mt">
                      <a class="active" href="">
                          <i class="fa fa-home"></i>
                          <span>Home</span>
                      </a>
                  </li>
                   <li class="mt">
                      <a class="" href="profile">
                          <i class="fa fa-user"></i>
                          <span>Profile</span>
                      </a>
                  </li>
                   <li class="mt">
                      <a class="" href="schedule">
                          <i class="fa fa-calendar-alt"></i>
                          <span>Schedule</span>
                      </a>
                  </li>
                   <li class="mt">
                      <a class="" href="settings">
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
      <!--main content start-->

        <section id="main-content">
          <section class="wrapper  site-min-height">
            <h3><i class="" style="padding:10px; margin-top: -100px !important;"></i>Your Classes  for the Week!</h3>

                            <div class="row">
<?php
$last = count($teachers) - 1;
$i = 0;
foreach ($teachers as $teacher => $values) {
	$isFirst = ($teacher == 0);
	$isLast = ($teacher == $last);

	echo '


                            <div class="col-lg-4 col-md-4 col-sm-4 mb" >

                                    <div class="wrapper">



    <div class="span3 well">
        <center>
        <a href="#aboutModal" data-toggle="modal" data-target="#myModal' . $i . '"><img src="assets/img/profile.png" class="img-circle responsive img-fluid"></a>
        <h3>' . $values["first_name"] . ' ' . $values["last_name"] . '</h3>
        <em>click my face for more</em>
    </center>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="myModal' . $i . '" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="myModalLabel">About ' . $values["first_name"] . ' ' . $values["last_name"] . '</h4>
                    </div>
                <div class="modal-body">
                    <center>
                    <img src="assets/img/profile.png" name="aboutme" width="140" height="140" border="0" class="img-circle img-fluid"></a>
                    <h3 class="media-heading">' . $values["first_name"] . ' ' . $values["last_name"] . '<small>,  ' . $values["nationality"] . '</small></h3>
                    <span><strong>Level </strong></span>
                        <span class="label label-info">' . $values["jlpt"] . '</span>

                    </center>
                    <hr>
                    <center>
                    <p class="text-left"><strong>Bio: </strong><br>
                        ' . $values["description"] . '</p>
                    <br>
                    </center>
                </div>
                <div class="modal-footer">
                    <center>

<form action="teachers" method="get">
                    <button type="submit" style="float=left" name="id" value="' . $values["id"] . '" class="logout btn btn-success" >Check Availability</button>

</form>
                    <a href="" class="logout btn btn-danger" data-dismiss="modal">Cancel</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>





                                </div>




';
	$i = $i + 1;
}

?>


                            </div>
                        </div>
                    </section>




      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer center" >
      Copyright © AGENT, Inc. All Rights Reserved.
      </footer>
      <!--footer end-->
  </section>




  </section>


    <script src="assets/js/common-scripts.js"></script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
