<?php
include_once "helper/header.php";
include_once "helper/connect.php";
$test = ['fromDate', 'toDate', 'roomIdSelected', 'user_id'];
//make sure we have everything we need
foreach ($test as $testItem) {
    if (!isset($_SESSION[$testItem])) {
        header("Location: $base_url");
        die();
    }
}
//create a new reservation record
$query = "INSERT INTO reservation VALUES(NULL, '" . $_SESSION['user_id'] . "','" . $_SESSION['roomIdSelected'] . "','" . $_SESSION['fromDate'] . "','" . $_SESSION['toDate'] . "','0')";
if (!(mysqli_query($conn, $query))) {
    print($query);
    print_r(mysqli_error($conn));
    die();
}
//remove information from session
unset($_SESSION['fromDate']);
unset($_SESSION['toDate']);
unset($_SESSION['roomIdSelected']);

?>

    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1 class="success">Reservation Confirmed</h1><br>
                <h2>Congratulations!! Your reservation have been confirmed and the room
                    is in hold for you. Someone from
                    the hotel will call you shortly to sort the payment.</h2>
            </div>
        </div>
    </main>
<?php
include_once "helper/footer.php";
?>