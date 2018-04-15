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
                <div class="row">
                    <div class="col-md-6">
                        <h3>Room Distribution by type:</h3>
                        <div id="roomsStatus" style="height: 350px"></div>
                    </div>
                    <div class="col-md-6">
                        <h3>Room Reservation status today by type:</h3>
                        <div id="reservationStat" style="height: 350px"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<?php
$query = "SELECT * from roomcategory;";
$result = $conn->query($query);
$roomStat = [];
$d1 = date("Y-m-d", strtotime("today"));
$d2 = date("Y-m-d", strtotime("tomorrow"));
while ($row = $result->fetch_assoc()) {
    $query = ("Select * from rooms where categoryId='" . $row['id'] . "';");
    $rooms = $conn->query($query);
    $available = 0;
    while ($aRoom = $rooms->fetch_assoc()) {
        if (isRoomAvailable($aRoom['id'], $d1, $d2, $conn))
            $available++;
    }
    $roomStat[] = ['name' => $row['name'], 'total' => $rooms->num_rows, 'available' => $available];
}
?>
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                <?php
                foreach ($roomStat as $aStat) {
                    echo "['" . $aStat['name'] . "', " . $aStat['total'] . "],";
                }
                ?>
            ]);
            var options = {};
            var chart = new google.visualization.PieChart(document.getElementById('roomsStatus'));
            chart.draw(data, options);

            var data2 = google.visualization.arrayToDataTable([
                ['Room Type', 'Available', 'Reserved'],
                <?php
                foreach ($roomStat as $aStat) {
                    echo "['" . $aStat['name'] . "', " . $aStat['available'] . "," . ((int)$aStat['total'] - (int)$aStat['available']) . "],";
                }
                ?>
            ]);
            options = {};
            var chart2 = new google.charts.Bar(document.getElementById('reservationStat'));

            chart2.draw(data2, google.charts.Bar.convertOptions(options));
        }

    </script>

<?php
include_once("helper/adminfooter.php");
?>