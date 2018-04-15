<?php
include_once("helper/header.php");
if (isset($_SESSION['user_id']))
    unset($_SESSION['user_id']);
header("Location: $base_url");
die();