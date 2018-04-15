<?php
include_once("helper/header.php");
include_once("helper/loadData.php");
include_once("helper/loadData.php");
include_once("helper/connect.php");
include_once("helper/checkUserStatus.php");
$roomNumber = $_GET["roomId"];
$_SESSION['roomIdSelected'] = $roomNumber;
include_once("helper/footer.php");
if (!$isLoggedIn) {
    $_SESSION['isReserving'] = true;
    header("Location: $base_url" . "createaccount.php");
    die();
}
?>


    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1>Confirm Reservation</h1><br>
                <div class="row">
                    <div class="col-md-6">
                        <?php
                        $room = getTableRow("rooms", $_SESSION['roomIdSelected'], $conn);
                        $category = getTableRow("roomcategory", $room['categoryId'], $conn);
                        $user = getTableRow('user', $_SESSION['user_id'], $conn);
                        ?>
                        <p><b>Room Category</b>: <?php echo $category["name"] ?></p>
                        <br>
                        <p><b>Room Number</b>: <?php echo $room['roomNo']; ?></p>
                        <br>
                        <p><b>Check In</b>: <?php echo $_SESSION['fromDate'] ?></p>
                        <br>
                        <p><b>Check Out</b>: <?php echo $_SESSION['toDate'] ?> </p>
                    </div>
                    <div class="col-md-6">
                        <?php
                        $d1 = date_create_from_format("Y-m-d", $_SESSION['fromDate']);
                        $d2 = date_create_from_format("Y-m-d", $_SESSION['toDate']);
                        $days = date_diff($d1, $d2);
                        ?>
                        <p><b>Total Nights</b>: <?php echo $days->format("%d") ?></p>
                        <br>
                        <p><b>Total Cost</b>: $<?php echo $days->format("%d") * $category['price']; ?> + applicable
                            taxes</p>
                        <br>
                        <p><b>Customer Name</b>: <?php echo $user['name'] ?></p>
                        <br>

                        <a href="<?php echo $base_url ?>confirmation.php">
                            <button class="btn btn-primary">Confirm
                            </button>
                        </a>


                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
include "helper/footer.php";
?>