<?php
function isRoomAvailable($roomId, $fromDate, $toDate, $conn)
{
    $query = "SELECT * from reservation where roomId='$roomId' and isCancelled='0'  AND not((`startDate` >= '$fromDate' AND `startDate` >= '$toDate') OR (`endDate` <= '$fromDate' AND endDate <= '$toDate'));";
    $result = $conn->query($query);
    //remove unavailable rooms from result
    if ($result->num_rows > 0) {
        return false;
    } else {
        return true;
    }
}