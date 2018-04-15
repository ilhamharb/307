<?php
include_once "helper/header.php";
include_once "helper/connect.php";
include_once "helper/injectioncheck.php";
include_once "helper/checkUserStatus.php";
$error = "";
if ($isLoggedIn) {
    header("Location: " . $base_url);
    die();
}
if (isset($_POST['userName']) && isset($_POST['password'])) {
    //Check for username and password
    $query = "SELECT * from user WHERE `uname`='" . $_POST['userName'] . "' AND `password`='" . md5($_POST['password']) . "';";
    $result = $conn->query($query);
    if ($result->num_rows == 0) {
        $error = "User name and/or password is incorrect. Please try again.";
    } else {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $user['id'];
        if (isset($_SESSION['roomIdSelected']) && isset($_SESSION['isReserving'])) {
            unset($_SESSION['isReserving']);
            header("Location: " . $base_url . "reserve.php?roomId=" . $_SESSION['roomIdSelected']);
            die();
        } elseif ($user['userType'] < 3) {
            header("Location: " . $base_url . "admindash.php");
            die();
        }
        header("Location: " . $base_url . "index.php");
        die();
    }
}
?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1>Log In</h1>
                <div class="error">
                    <?php
                    echo $error;
                    ?>
                </div>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <p>User Name:</p>
                            <input name="userName" type="text">
                        </div>
                        <div class="col-md-6">
                            <br>
                            <p>Password:</p>
                            <input name="password" type="password">
                            <br>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Log In">
                        </div>
                    </div>
                    <h5>Don't have an account? <a href="createaccount.php"> Sign Up Here</a></h5>
                </form>
            </div>
        </div>


    </main>

<?php
include_once("helper/footer.php");
?>