<?php
/**
 * Created by PhpStorm.
 * User: alaaharb
 * Date: 2018-04-13
 * Time: 4:33 PM
 */

//error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "mobile75";
$database = "finalhotel";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}