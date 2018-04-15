<?php
/**
 * Created by PhpStorm.
 * User: alaaharb
 * Date: 2018-04-13
 * Time: 5:00 PM
 */

foreach ($_POST as $index=>$data){
    $_POST[$index]=mysqli_real_escape_string($conn,$data);
    $_POST[$index]=htmlspecialchars($data);
}

foreach ($_GET as $index=>$data){
    $_GET[$index]=mysqli_escape_string($conn,$data);
    $_GET[$index]=htmlspecialchars($data);
}