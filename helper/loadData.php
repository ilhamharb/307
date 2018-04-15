<?php
//File to load required data by id

function getTableRow($table, $id, $conn)
{
    $query = "SELECT * from $table where id='" . $id . "';";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);
    return $row;
}