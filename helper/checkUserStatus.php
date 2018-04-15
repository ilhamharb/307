<?php
$isLoggedIn = false;
$isAdmin = false;
$isSuperAdmin = false;

if (isset($_SESSION['user_id'])) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);

    $isLoggedIn = true;
    $user = getTableRow("user", $_SESSION['user_id'], $conn);
    if ($user['userType'] == 1) {
        $isAdmin = true;
        $isSuperAdmin = true;
    } else {
        $isAdmin = true;
    }
}