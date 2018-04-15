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
if (!isset($_GET['id'])) {
    header("Location: $base_url" . "admindash.php");
    die();
} else {
    $reservationId = $_GET['id'];
}
$reservation = getTableRow("reservation", $reservationId, $conn);
$room = getTableRow("rooms", $reservation['roomId'], $conn);
$category = getTableRow("roomcategory", $room['categoryId'], $conn);
$user = getTableRow("user", $reservation["userId"], $conn);
?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1>Confirm Reservation Details</h1><br>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        if ($reservation["isCancelled"]) {
                            ?>
                            <p><b>Reservation Status</b>: <span class="error">Cancelled</span></p>
                            <?php
                        } else {
                            ?>
                            <p><b>Reservation Status</b>: <span class="success">Active</span></p>
                            <?php
                        }
                        ?>
                        <br>
                        <p><b>Room Category</b>: <?php echo $category["name"] ?></p>
                        <br>
                        <p><b>Room Number</b>: <?php echo $room['roomNo']; ?></p>
                        <br>
                        <p><b>Check In</b>: <?php echo $reservation['startDate']; ?></p>
                        <br>
                        <p><b>Check Out</b>: <?php echo $reservation['endDate']; ?> </p>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $d1 = date_create_from_format("Y-m-d", $reservation['startDate']);
                        $d2 = date_create_from_format("Y-m-d", $reservation['endDate']);
                        $days = date_diff($d1, $d2);
                        ?>
                        <p><b>Total Nights</b>: <?php echo $days->format("%d") ?></p>
                        <br>
                        <p><b>Total Cost</b>: $<?php echo $days->format("%d") * $category['price']; ?> + applicable
                            taxes</p>
                        <br>
                        <p><b>Customer Name</b>: <?php echo $user['name'] ?></p>
                        <br>
                        <br>
                        <p><b>Customer Email</b>: <?php echo $user['email'] ?></p>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php
include_once("helper/adminfooter.php");
?>