<?php
include_once("helper/connect.php");
include_once("helper/loadData.php");
include_once("helper/admin_header.php");
include_once("helper/checkUserStatus.php");
include_once("helper/getRoomStatus.php");
if (!($isAdmin)) {
    header("Location: $base_url");
    die();
}
?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1>Admin Dashboard:</h1><br>
                <form action="#" method="get">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="roomId">Room Number:</label>
                            <select name="roomId" id="roomId" class="form-control" id="sel1">
                                <?php
                                if (isset($_GET['roomId'])) {
                                    $current = $_GET['roomId'];
                                }
                                $query = "SELECT * FROM rooms";
                                $result = $conn->query($query);
                                while ($row = $result->fetch_assoc()) {
                                    if (!isset($current))
                                        $current = $row['id'];
                                    $selected = "";
                                    if ($current == $row['id']) {
                                        $selected = "selected";
                                    }
                                    echo "<option value=\"" . $row['id'] . "\" $selected>" . $row['roomNo'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
                <div class="row" style="margin-top: 25px">
                    <div class="col-md-12">
                        <h3>Room Reservation Calender:</h3>
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
//Get the reservation list for room selected currently
$query = "SELECT * from reservation where roomId='" . $current . "';";
$result = $conn->query($query);
$reservaton = "";
$active = "color: 'blue',textColor: 'black'},";
$canceled = "color: 'red',textColor: 'yellow'},";
while ($row = $result->fetch_assoc()) {
    //get customer detail
    $customer = getTableRow("user", $row['userId'], $conn);
    $reservaton .= "{
                  url : '$base_url/reservationdetails.php?id=" . $row['id'] . "',
                  title  : '" . $customer['name'] . "',
                  start  : '" . $row['startDate'] . "',
                  end : '" . $row['endDate'] . "',";
    if ($row["isCancelled"])
        $reservaton .= $canceled;
    else
        $reservaton .= $active;
}

$script = "
    $( document ).ready(function() {
        var cal=$('#calendar').fullCalendar({
            eventSources: [
        
            // your event source
            {
              events: [ // put the array in the `events` property
                $reservaton
              ],
            }
        
            // any other event sources...
        
          ]
        })
    });
";
include_once("helper/adminfooter.php");
?>