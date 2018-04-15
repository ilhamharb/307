<?php
include("helper/header.php");
include("helper/connect.php");
include_once("helper/loadRoomInformation.php");
include_once("helper/loadData.php");
include_once("helper/getRoomStatus.php");
$query = "SELECT * from rooms";
$result = $conn->query($query);
$rooms = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rooms[] = $row;
}
print_r($_GET);
$dates = explode(" - ", $_GET['fromDate']);
$fromDate = $dates[0];
$toDate = $dates[1];
$d1 = strtotime($fromDate);
$d2 = strtotime($toDate);
$_SESSION["fromDate"] = $fromDate;
$_SESSION["toDate"] = $toDate;
foreach ($rooms as $index => $aRoom) {
    if (isset($_GET['roomType']) && $_GET['roomType'] != "any" && $_GET['roomType'] != $aRoom['categoryId']) {
        unset($rooms[$index]);
        continue;
    }
    if (isset($_GET['priceRange'])) {
        $prices = explode(",", $_GET['priceRange']);
        $category = getTableRow("roomcategory", $aRoom['categoryId'], $conn);
        if (!($category['price'] >= $prices[0] && $category['price'] <= $prices[1])) {
            unset($rooms[$index]);
            continue;
        }
    }
    if (!isRoomAvailable($aRoom['id'], $fromDate, $toDate, $conn)) {
        unset($rooms[$index]);
    }
}


?>
    <main role="main">
        <div class="container">

            <?php
            $count = 0;
            ?>
            <div class="search_notice">
                <?php
                if (count($rooms)) {
                    echo "<h4>Following are the rooms available:</h4>";
                } else {
                    echo "<h4>Sorry, no rooms are available. <a href='advancedsearch.php'> Search again here. </a></h4>";
                }
                ?>
            </div>

            <div class="row card-deck text-center">
                <?php
                foreach ($rooms as $aRoom) {
                    $count++;
                    echo loadRoomInfo($aRoom['roomNo'], $aRoom['categoryId'], $conn, $aRoom['id']);
                }
                ?>
            </div>
            <!-- --------------------------------- -->
        </div>
    </main>
<?php
include("helper/footer.php");
?>