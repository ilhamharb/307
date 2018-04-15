<?php

session_start();
$base_url = "http://localhost/codes/";

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Rose City Hotel</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/app.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker.standalone.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#"><img src="pictures/logo1.png" alt=""> Rose City Hotel </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
            aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admindash.php">Dash Board<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="roomcalender.php">Reservation Calender</a>
            </li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION['user_id']))
                    echo "<a class=\"nav-link\" href=\"$base_url" . "logout.php\">Logout</a>";
                else
                    echo "<a class=\"nav-link\" href=\"$base_url" . "login.php\">Login</a>";
                ?>

            </li>
        </ul>
    </div>
</nav>
