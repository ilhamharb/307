<?php
include_once "helper/header.php";
include_once "helper/connect.php";
include_once "helper/injectioncheck.php";
include_once "helper/checkUserStatus.php";
$error = "";
if ($isLoggedIn) {
    header("Location: " . $base_url . "index.php");
    die();
}
if (isset($_POST['password'])) {
    //Checking the passwords
    if ($_POST['password'] != $_POST['rePassword']) {
        $error .= " The passwords do not match. ";
    }
    //Checking if the username exists
    $query = "SELECT * from user where uname='" . $_POST['userName'] . "'";
    $result = $conn->query($query);


    if ($result->num_rows > 0) {
        $error .= " The username already exist. ";
    }

    //Checking if the email exists
    $query = "SELECT from user where email='" . $_POST['email'] . "'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $error .= " The email already exist. ";
    }

    if ($error == "") {
        $query = "INSERT into `user` VALUES (NULL,'" . $_POST['fullName'] . "','" . $_POST['userName'] . "','" . md5($_POST['password']) . "','3','" . $_POST['email'] . "')";
        if (mysqli_query($conn, $query)) {
            $userId = mysqli_insert_id($conn);
            $_SESSION['user_id'] = $userId;
            if (isset($_SESSION['roomIdSelected']) && isset($_SESSION['isReserving'])) {
                unset($_SESSION['isReserving']);
                header("Location: " . $base_url . "reserve.php?roomId=" . $_SESSION['roomIdSelected']);
                die();
            }
            header("Location: " . $base_url . "index.php");
            die();
        } else {
            $error .= "ERROR: " . mysqli_error($conn);
        }
    }
}

?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1>Create an account</h1>
                <div class="error">
                    <?php
                    echo $error;
                    ?>
                </div>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <br>
                            <p>Full Name:</p>
                            <input name="fullName" type="text">
                            <br>
                            <br>
                            <p>User Name:</p>
                            <input name="userName" type="text">
                            <br>
                            <br>
                            <p>Email:</p>
                            <input name="email" type="email">

                        </div>
                        <div class="col-md-6">
                            <br>
                            <p>Password:</p>
                            <input name="password" type="password">
                            <br>
                            <br>
                            <p>Re-enter Password:</p>
                            <input name="rePassword" type="password">
                            <br>
                            <br>
                            <br>
                            <input type="submit" class="btn btn-primary" value="Create Account">
                        </div>
                    </div>
                    <br>
                    <h5>Already have an account? <a href="login.php"> Sign in here</a></h5>
                </form>
            </div>
        </div>


    </main>
<?php
include("helper/footer.php");
?>