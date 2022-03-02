<?php
require("login-check/login-check-user.php");
include("config.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Booking</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include 'nav&footer/nav.php' ?>
<div class="main-container" style="margin-top: 30px">
    <div class="container">
        <div class="row justify-content-md-center ">
            <div class="col-md-8 ">
                <h3 style="text-align: center;">Update Booking</h3>
                <form method="post" enctype="multipart/form-data">
                    <?php
                    try {
                        $edit = $_SESSION["editbc"];
                        $conn = new PDO($db, $un, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query ="SELECT   `Start`, `No`  FROM `bookings` WHERE `BID`=$edit";
                        $result = $conn->query($query);
                        foreach ($result as $row) {
                            echo '<div class="form-group">';
                            echo 'Scheduled Date:';
                            echo '<input type="date" class="form-control" name="sDate" value="' . $row[0] . '" required>';
                            echo ' </div>';
                            echo '<div class="form-group">';
                            echo 'No of Passengers:';
                            echo '<input type="number" class="form-control" name="No" value="' . $row[1] . '" required>';
                            echo '</div>';
                            echo '<input type="submit" class="btn btn-primary form-btn" value="Update" name="btnUpdate">';
                            echo '<input type="submit" class="btn btn-primary form-btn" value="Cancel" name="btnCan">';
                        }
                    } catch (PDOException $th) {
                        echo $th->getMessage();
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnCan'])) {
        echo "<script>window.location.href='mybookings.php';</script>";
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnUpdate'])) {
        $status = 0;
        try {
            try {
                $conn = new PDO($db, $un, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT  `Package`FROM `bookings` WHERE `BID`=$edit";
                $result = $conn->query($query);
                foreach ($result as $row1) {
                    $pack = $row1[0];
                }
                try {
                    $conn = new PDO($db, $un, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = "SELECT `Price` FROM `packages` WHERE `ID`=$pack";
                    $result = $conn->query($query);
                    foreach ($result as $price) {
                        $stringPrice = $price[0];
                    }
                } catch (PDOException $ex) {
                    echo $ex->getMessage();
                }
            } catch (PDOException $ex) {
                echo $ex->getMessage();
            }
            $intPrice = (int)$stringPrice;
            $num = $_POST["No"];
            $totalInt = $intPrice * $num;
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE `bookings` SET `Start`=?,`Status`=?,`No`=?,`Total`=? WHERE `BID`=$edit";
            $st = $conn->prepare($query);
            $st->bindValue(1, $_POST["sDate"], PDO::PARAM_STR);
            $st->bindValue(2, $status, PDO::PARAM_STR);
            $st->bindValue(3, $_POST["No"], PDO::PARAM_INT);
            $st->bindValue(4, $totalInt, PDO::PARAM_INT);
            $st->execute();
            echo "<script> alert('Booking updated Successfully!');</script>";
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }
}
?>
<img src="images/bg.jpg" class="img-bg">
<?php include 'nav&footer/footer.php' ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
