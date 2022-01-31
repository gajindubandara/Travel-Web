<?php
require("login-check/login-check-user.php");
include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Booking</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include 'nav&footer/nav.php' ?>

<div class="main-container ">
    <form method="post" style="margin-top: 30px">
        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="col-md-8 ">
                    <h3 style="text-align: center;">Create a new booking</h3>
                    <div class="form-group">
                        Package:
                        <select class="form-control" name="pack" required>
                            <?php
                            try {
                                $conn = new PDO($db, $un, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = "SELECT `ID`, `Name` FROM `packages`";
                                $result = $conn->query($query);
                                foreach ($result as $r) {
                                    echo '<option value="' . $r[0] . '">' . $r[1] . '</option>';
                                }
                            } catch (PDOException $ex) {
                                echo $ex->getMessage();
                            }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        Scheduled Date:
                        <input type="date" class="form-control" name="sDate" required>
                    </div>
                    <div class="form-group">
                        Number of Passengers:
                        <input type="number" class="form-control" name="No" required>
                    </div>
                    <div class="form-group">
                        Description:
                        <textarea class="form-control" name="des" cols="30" rows="5"
                                  placeholder="If there is any message for us please type here!"></textarea>
                    </div>
                    <div class="form-group">
                        Booking Date:
                        <?php $date = date("Y-m-d");
                        echo $date;
                        ?>
                    </div>
                    <input type="submit" class="btn btn-primary form-btn" value="Create Booking !" name="btnAdd">

                </div>
            </div>
        </div>
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnAdd'])) {
        try {
            try {
                $bid=$_POST["pack"];
                $conn = new PDO($db,$un,$password);
                $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $query ="SELECT `Price` FROM `packages` WHERE `ID`=$bid";
                $result = $conn->query($query);
                foreach($result as $price)
                {
                    $stringPrice=$price[0];
                }
            }
            catch(PDOException $ex)
            {
                echo $ex->getMessage();
            }

            $intPrice=(int)$stringPrice;
            $num =$_POST["No"];
            $totalInt=$intPrice*$num;
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO `bookings`( `Name`, `Package`, `Start`, `BDay`,`No`, `Des`,`Total`) 
                 VALUES (?,?,?,?,?,?,?)";
            $st = $conn->prepare($query);
            $st->bindValue(1, $_SESSION["u_uid"], PDO::PARAM_STR);
            $st->bindValue(2, $_POST["pack"], PDO::PARAM_STR);
            $st->bindValue(3, $_POST["sDate"], PDO::PARAM_STR);
            $st->bindValue(4, $date, PDO::PARAM_STR);
            $st->bindValue(5, $_POST["No"], PDO::PARAM_INT);
            $st->bindValue(6, $_POST["des"], PDO::PARAM_STR);
            $st->bindValue(7, $totalInt, PDO::PARAM_INT);
            $st->execute();

            echo "<script> alert('Booking successful!');</script>";


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