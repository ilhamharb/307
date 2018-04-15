<?php
/**
 * Created by PhpStorm.
 * User: alaaharb
 * Date: 2018-04-14
 * Time: 1:20 PM
 */
include_once "loadData.php";

function loadRoomInfo($roomNumber, $categoryID, $conn, $roomId)
{
    $resultText = "<div class='col-md-4 roomsResult'><div class='card box-shadow'>
    <div class='card-header'>
        <h4 class='my-0 font-weight-normal'>";
    //Find the category Name and Price
    $row = getTableRow("roomcategory", $categoryID, $conn);
    $resultText .= $row['name'] . ": " . $roomNumber;
    $resultText .= "</h4>
    </div>
    <div class='card-body'>
        <h1 class='card-title pricing-card-title'>$" . $row['price'] . " <small class='text-muted'>/ night</small></h1>
        <ul class='list-unstyled mt-3 mb-4'>";

    //Find the services available in that category
    $query = "SELECT * from services where roomCatId ='" . $categoryID . "';";
    $result = $conn->query($query);
    while ($row = mysqli_fetch_assoc($result)) {
        $resultText .= "<li>" . $row['serviceName'] . "</li>";
    }

    $resultText .= "</ul>
        <p><a class='btn btn-secondary' role='button' href='reserve.php?roomId=" . $roomId . "'>Reserve &raquo;</a></p>
    </div></div>
</div>";
    return $resultText;
    //Prepare the output and send back
}

?>