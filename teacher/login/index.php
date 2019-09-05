<?php
require "../../error-report.php";
require "../../database/db-config.php";
session_start();
include_once '../Teacher.php';
$teacher = new Teacher(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (isset($_REQUEST['submit'])) {
	extract($_REQUEST);
	$login = $teacher->login($email, $password);
	if ($login) {
		// Registration Success
		header("location:../home");
	} else  {
		// Registration Failed
		$error = 'Wrong username or password';
	}
}

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Teacher Login | E-Learning </title>

    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Font Awesome Icons -->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->

    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP&display=swap" rel="stylesheet">
    <!-- Plugin CSS -->
    <link href="../../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="../../assets/css/creative1.min.css" rel="stylesheet">
    <link href="../../assets/css/form.css" rel="stylesheet"/>

</head>

<body id="page-top">


    <!-- Navigation -->
     <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="../../"><img src="../../assets/img/logo.png"
                    class="img-fluid banner-logo"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto btn-nav">





                    <li class="nav-item">
                        <a class="nav-link" href="../register" style="color: #1E3045">Register</a>
                    </li>



                </ul>
            </div>
        </div>
    </nav>

    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">

                <form method="post" action="" class="form-group">

                    <div id="msform">

                        <fieldset>

                        <h2 class="fs-title">Login as Teacher</h2>

                        <div class=" form-group">
                       <?php
if (isset($error)) {
	echo "<p class=\"col-sm form-control alert-danger\" style=\"margin-bottom: 10px; width: 100%;font-family: montserrat; color: #2C3E50; font-size: 13px; \">" . $error;
}
?>
            </p>
                        <input type="email" name="email" value="" class="col-sm form-control  mr-2"
                        placeholder="Email" />
                        <input type="password" name="password" value="" class="col-sm form-control  mr-2" placeholder="Password" />
                        <input type="submit" name="submit" class="submit action-button" value="Submit" />

                        </div>
                        <a href="../register" title="register">New User?</a>
                        </fieldset>

                    </div>
                </form>
            </div>
        </div>
    </header>


    <!-- Services Section -->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright © 2004-2019 Agent Inc. All Rights Reserved</div>
        </div>
    </footer>
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="../../assets/js/creative.js"></script>
    <script>
            </script>
</body>

</html>

