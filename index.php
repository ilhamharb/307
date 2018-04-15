<?php
include("helper/header.php");
?>

    <main role="main">

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <form action="<?php echo $base_url; ?>results.php" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <p>Searching For:</p>
                            <input required name="fromDate" class="fromDate form-control" type="text">
                        </div>

                        <div class="col-md-4">
                            <br>
                            <input type="submit" class="btn btn-primary" href="#" role="button" value="Search">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <center><h2>About Us</h2></center>
                    <p> Our beautiful hotel is in the heart of downtown Windsor, Ontario, Canada. We offer views of the
                        Detroit River and skyline, as well as sights of the beautiful gardens and large parks on the
                        waterfront of Windsor. </p>
                    <img src="pictures/hotel.jpg" alt="Hotel Image">
                    <br>
                    <br>
                    <p>
                    <center><a class="btn btn-secondary" href="aboutus.php" role="button">View details &raquo;</a>
                    </center>
                    </p>
                </div>
                <div class="col-md-4">
                    <center><h2>Services</h2></center>
                    <img src="pictures/waterfront.jpg" alt="Waterfront view">
                    <br>
                    <br>
                    <img src="pictures/lobby.jpg" alt="Hotel Lobby">
                    <br>
                    <br>
                    <img src="pictures/pool.JPG" alt="Hotel pool">
                    <br>
                    <br>
                    <p>
                    <center><a class="btn btn-secondary" href="services.php" role="button">View Services &raquo;</a>
                    </center>
                    </p>
                </div>
                <div class="col-md-4">
                    <center><h2>Reservations</h2></center>
                    <p>Explore everything from our luxury rooms with everything you need; a comfortable bed, a nice hot
                        shower, and free Wi-Fi. Our rooms accommodate the appropriate number of guests which leaves you
                        and your family with an unforgettable experience!</p>
                    <img src="pictures/room.jpg" alt="Hotel Room">
                    <br>
                    <br>
                    <center><p><a class="btn btn-secondary" href="advancedsearch.php" role="button">Reserve a Room
                                &raquo;</a>
                        </p></center>
                </div>
            </div>

            <hr>

        </div> <!-- /container -->

    </main>
<?php
$d = strtotime("today");
$d2 = strtotime("tomorrow");
$script = "
    $('.fromDate').daterangepicker({
    locale: {
      format: 'YYYY-MM-DD'
    },
    minDate: '" . date("Y-m-d", $d) . "',
    startDate: '" . date("Y-m-d", $d) . "',
    endDate: '" . date("Y-m-d", $d2) . "'
});";
include("helper/footer.php");
?>