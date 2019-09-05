<?php
require "../../../error-report.php";
session_start();

?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://kit.fontawesome.com/3fc7d0e35a.js"></script>
    <meta name="author" content="Dashboard">
 
    <title>Teacher Schedule</title>

    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="../assets/font-awesome/css/fontawesome.css" rel="stylesheet" />
   
    <link rel="stylesheet" type="text/css" href="../assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/style-responsive.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">   
     <style>
      
        label {
            width: 80px;
            display: inline-block;
        }
        
    </style>
    <link rel="stylesheet" href="TimeSheet.css" type="text/css" media="screen">
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
            <a href="#" class="logo" id=""><b>Teacher</b> <span class="fa fa-chevron-right">&nbsp;</span><b>Schedular</b> </a>
            <!--logo end-->
            
            <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="../../logout">Logout</a></li>
            	</ul>
            </div>
        </header>
      <!--header end-->

 <!--sidebar start-->
 <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="profile"><img src="../assets/img/profile.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?></h5>

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
                      <a class="active" href="schedule">
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
      <!--sidebar end-->

<section id="main-content">
          <section class="wrapper site-min-height">
          	<h3><i class="fa fa-angle-right"></i> Schedule your class for the next 12 days</h3>
          
        


          	<div class="row mt">
          		<div class="col-lg-12">
          		
    <div class="container" style="margin-top:70px;">
        <div id="J_calenderWrapper">
            <table>
                <thead></thead>
                <tbody id="J_timedSheet"> </tbody>
            </table>
        </div>

        <div style="padding:15px 0 10px; ">
            <button class="J_sheetControl btn btn-outline-primary sucess-btn" id="J_timingDisable">Disable</button>
            <button class="J_sheetControl btn btn-outline-primary sucess-btn" id="J_timingEnable">Enable</button>
            <button class="J_sheetControl btn btn-outline-primary sucess-btn" id="J_timingClean">Clean</button>
            <button class="J_sheetControl btn btn-outline-primary sucess-btn" id="J_timingSubmit">Submit</button>

        </div>
        <p id="J_dataDisplay" style="color:#aaaaaa;font-family: 'Arial';">

        </p>
    </div>
          		</div>
          	</div>
			
		</section><! --/wrapper -->
      </section><!-- /MAIN CONTENT -->

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              Footer
              <a href="blank.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>
   
  
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="TimeSheet.js"></script>
    <script type="text/javascript">
        var dimensions = [12, 48];

        var dayList = [<?php
$max_dates = 12;
$countDates = 0;
while ($countDates < $max_dates) {
    $NewDate=Date('M d, Y', strtotime("+".$countDates." days"));
    echo " {
        name: ". "\"".$NewDate."\"".
    "},";
    $countDates += 1;
}
?>  
        ];

        var hourList = [{
                name: "00",
                title: "00:00-00:30"
            }, {
                name: "01",
                title: "00:30-01:00"
            },
            {
                name: "02",
                title: "01:00-01:30"
            }, {
                name: "03",
                title: "01:30-02:00"
            },
            {
                name: "04",
                title: "02:00-02:30"
            }, {
                name: "05",
                title: "02:30-03:00"
            },
            {
                name: "06",
                title: "03:00-03:30"
            }, {
                name: "07",
                title: "03:30-04:00"
            },
            {
                name: "08",
                title: "04:00-04:30"
            }, {
                name: "09",
                title: "04:30-05:00"
            },
            {
                name: "10",
                title: "05:00-05:30"
            }, {
                name: "11",
                title: "05:30-06:00"
            },
            {
                name: "12",
                title: "06:00-06:30"
            }, {
                name: "13",
                title: "06:30-07:00"
            },
            {
                name: "14",
                title: "07:00-07:30"
            }, {
                name: "15",
                title: "07:30-08:00"
            },
            {
                name: "16",
                title: "08:00-08:30"
            }, {
                name: "17",
                title: "08:30-09:00"
            },
            {
                name: "18",
                title: "09:00-09:30"
            }, {
                name: "19",
                title: "09:30-10:00"
            },
            {
                name: "20",
                title: "10:00-10:30"
            }, {
                name: "21",
                title: "10:30-11:00"
            },
            {
                name: "22",
                title: "11:00-11:30"
            }, {
                name: "23",
                title: "11:30-12:00"
            },
            {
                name: "24",
                title: "12:00-12:30"
            }, {
                name: "25",
                title: "12:30-13:00"
            },
            {
                name: "26",
                title: "13:00-13:30"
            }, {
                name: "27",
                title: "13:30-14:00"
            },
            {
                name: "28",
                title: "14:00-14:30"
            }, {
                name: "29",
                title: "14:30-15:00"
            },
            {
                name: "30",
                title: "15:00-15:30"
            }, {

                name: "31",
                title: "15:30-16:00"
            },
            {
                name: "32",
                title: "16:00-16:30"
            }, {
                name: "33",
                title: "16:30-17:00"
            },
            {
                name: "34",
                title: "17:00-17:30"
            }, {
                name: "35",
                title: "17:30-18:00"
            }, {
                name: "36",
                title: "18:00-18:30"
            },
            {
                name: "37",
                title: "18:30-19:30"
            }, {
                name: "38",
                title: "19:00-19:30"
            },
            {
                name: "39",
                title: "19:30-20:00"
            }, {
                name: "40",
                title: "20:00-20:30"
            },
            {
                name: "41",
                title: "20:30-21:00"
            }, {
                name: "42",
                title: "21:00-21:30"
            },
            {
                name: "43",
                title: "21:30-22:00"
            }, {
                name: "44",
                title: "22:00-22:30"
            },
            {
                name: "45",
                title: "22:30-23:00"
            }, {
                name: "46",
                title: "23:00-23:30"
            },
            {
                name: "47",
                title: "23:30-00:00"
            },

        ];

        var sheetData = [
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0,
                0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0
            ]
        ];

        var updateRemark = function (sheet) {

            var sheetStates = sheet.getSheetStates();
            var rowsCount = dimensions[0];
            var colsCount = dimensions[1];


        };

        $(document).ready(function () {

            var sheet = $("#J_timedSheet").TimeSheet({
                data: {
                    dimensions: dimensions,
                    colHead: hourList,
                    rowHead: dayList,
                    sheetHead: {
                        name: "Date\\Time"
                    },
                    sheetData: sheetData
                },
                end: function (ev, selectedArea) {
                    updateRemark(sheet);
                }
            });

            updateRemark(sheet);

            $("#J_timingDisable").click(function (ev) {
                sheet.disable();
            });

            $("#J_timingEnable").click(function (ev) {
                sheet.enable();
            });

            $("#J_timingClean").click(function (ev) {
                sheet.clean();
            });

            $("#J_timingSubmit").click(function (ev) {

                var sheetStates = sheet.getSheetStates();
                var rowsCount = dimensions[0];
                var $submitDataDisplay = $("#J_dataDisplay");

                $submitDataDisplay.html("<b>Raw Data Submitted:</b><br/>[<br/>");

                for (var row = 0, rowStates = []; row < rowsCount; ++row) {
                    rowStates = sheetStates[row];
                    $submitDataDisplay.append('&nbsp;&nbsp;[ ' + rowStates + ' ]' + (row == rowsCount -
                        1 ? '' : ',') + '<br/>');
                }

                $submitDataDisplay.append(']');
            });



            $("#J_timingGetCell").click(function (ev) {

                var cellIndex = $("#J_cellIndex").val().split(',');
                var cellData = sheet.getCellState(cellIndex);
                var $dataDisplay = $("#J_dataDisplay");

                $dataDisplay.html("<b>Cell Data At [" + cellIndex + "] : </b>" + cellData);
            });

            $("#J_timingGetRow").click(function (ev) {
                var rowIndex = $("#J_rowIndex").val();
                var rowData = sheet.getRowStates(rowIndex);
                var $dataDisplay = $("#J_dataDisplay");

                $dataDisplay.html("<b>Row Data At " + rowIndex + " : </b>[ " + rowData + " ]");
            });
        });
    </script>
      <!-- js placed at the end of the document so the pages load faster -->

    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>
    <script src="../assets/js/jquery.ui.touch-punch.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>


    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>

    <!--script for this page-->
    
  <script>
      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

  </script>
</body>

</html>