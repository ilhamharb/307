<?php
include_once "helper/header.php";
include_once "helper/connect.php";

?>
    <main role="main">

        <div class="jumbotron">
            <div class="container">
                <h1>Search Room</h1>
                <form action="results.php" method="GET">
                    <div class="col-md-6">
                        <br>
                        <p>Date range:</p>
                        <input required name="fromDate" class="fromDate form-control" type="text">
                        <br>
                        <div class="form-group">
                            <label for="roomType">room type:</label>
                            <select name="roomType" class="form-control" id="sel1">
                                <option value="any" selected>Any</option>
                                <?php
                                $query = "SELECT * from roomcategory;";
                                $result = $conn->query($query);
                                $min = 99999;
                                $max = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if ($row['price'] < $min) {
                                        $min = $row['price'];
                                    } elseif ($row['price'] > $max) {
                                        $max = $row['price'];
                                    }
                                    echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <p>Price Range:</p>
                        <br>
                        <?php
                        echo "<input name='priceRange' id=\"ex2\" type=\"text\" class=\"span2\" value=\"\" data-slider-min=\"$min\"
                                          data-slider-max=\"$max\" data-slider-step=\"1\"
                                          data-slider-value=\"[$min,$max]\"/>";
                        ?>
                        <br>
                        <br>
                        <input type="submit" class="btn btn-primary" href="#" role="button" value="Search">


                    </div>
                    <br>
                    <h5>Already have an account? <a href="login.php"> Sign in here</a></h5>
                </form>
            </div>
        </div>


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
});
$(\"#ex2\").slider({});
";
include("helper/footer.php");
?>