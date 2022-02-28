<?php
require("login-check/login-check-admin.php");
include("config.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>All bookings</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include 'nav&footer/adminNav.php' ?>
<div class="main-container ">
    <form method="post" style="margin-top: 30px">
        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="col-md-8 ">



                    <?php
                    if (isset($_POST['btnView'])) {
                        try {

                            $bid = $_POST["btnView"];
                            $conn = new PDO($db, $un, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query =  "SELECT `BID`,packages.Name,bookings.Name,`Start`, `BDay`, bookings.Des, `Status`,bookings.Des,`No`,`Total` FROM bookings JOIN packages ON Package=packages.ID WHERE bookings.BID=$bid;";
                            $result = $conn->query($query);
                            echo '<h3 style="text-align: center;">Tour Information</h3>';
                            echo '<table class="table" style="margin-top: 50px">';

                            foreach ($result as $row) {
                                if ($row[6]==0){
                                    $Status="Pending";
                                    $iconColor ="#FFD500";
                                }
                                elseif ($row[6]==1){
                                    $Status="Declined by Dream Tours";
                                    $iconColor ="red";
                                }
                                elseif($row[6]==2){
                                    $Status="Confirmed";
                                    $iconColor ="green";
                                }
                                elseif($row[6]==3){
                                    $Status="Canceled by user";
                                    $iconColor ="#FF7000";
                                }

                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = "SELECT `Username` FROM `users` WHERE `UID`=$row[2]";
                                $result = $conn->query($query);
                                foreach($result as $row1){
                                    $name=$row1[0];

                                }


                                echo '<tbody>';
                                echo '<tr>';
                                echo '<td><b>Package:</b></td>';
                                echo '<td>' . $row[1] . '</td>';
                                echo '</tr>';
                                echo '<td><b>Username:</b></td>';
                                echo '<td>' . $name . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Scheduled Date:</b></td>';
                                echo '<td>' . $row[3] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Booked Date: </b></td>';
                                echo '<td>' . $row[4] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Total Ammount:</b></td>';
                                echo '<td>Rs.' . $row[9]. '.00/=</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>No of Passengers:</b></td>';
                                echo '<td>' . $row[8]. '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Status:</b></td>';
                                echo '<td><i class="fas fa-circle" style="color:'.$iconColor.'"></i> ' . $Status . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Description:</b></td>';
                                echo '<td>' . $row[7] . '</td>';
                                echo '</tr>';
                                echo ' </tbody>';
                                echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnCon" type="submit" value="'.$row[0].'"  >Confirm Booking</button></td>';
                                echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnCan" type="submit" value="'.$row[0].'"  >Cancel Booking</button></td>';
                                echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="Del" type="submit" value="'.$row[0].'"  >Delete Booking</button></td>';
                            }
                            echo '</table>';
                        } catch (PDOException $th) {
                            echo $th->getMessage();

                        }
                    }

                    ?>


                </div>
            </div>
        </div>
    </form>
</div>


<div class="main-container ">
    <form method="post" >
        <div class="container" style="margin-top: 30px">
            <div class="row justify-content-md-center ">
                <div class="col-md-8">

                    <?php
                    try {


                        $conn = new PDO($db, $un, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "SELECT `BID`,packages.Name,`Status`,bookings.Name FROM bookings  JOIN packages ON Package=packages.ID ORDER BY `Status` ASC";
                        $result = $conn->query($query);
                        echo '<h3 style="text-align: center;">All Bookings</h3>';
                        echo '<table class="table" style="border:solid #dee2e6 1px;">';
                        echo '<thead class="thead-dark">';
                        echo '<tr>

                            <th scope="col">Package</th>
                            <th scope="col">User</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            

                          </tr>';
                        foreach($result as $row)
                        {

                            if ($row[2]==0){
                                $Status="Pending";
                                $iconColor ="#FFD500";
                            }
                            elseif ($row[2]==1){
                                $Status="Declined by Dream Tours";
                                $iconColor ="red";
                            }
                            elseif($row[2]==2){
                                $Status="Confirmed";
                                $iconColor ="green";
                            }
                            elseif($row[2]==3){
                                $Status="Canceled by user";
                                $iconColor ="#FF7000";
                            }
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = "SELECT `Username` FROM `users` WHERE `UID`=$row[3]";
                            $result = $conn->query($query);
                            foreach($result as $row1){
                                $name=$row1[0];

                            }

                            echo '<tbody>';
                            echo '<tr class="rw">';
                            echo '<td style="vertical-align: middle;"> <input type="hidden" name="pID[]">'. $row[1] . '</td>';
                            echo '<td style="vertical-align: middle;"> <input type="hidden" name="pID[]" >'. $name . '</td>';
                            echo '<td style="vertical-align: middle;"> <input type="hidden" name="pID[]" ><i class="fas fa-circle" style="color:'.$iconColor.'"></i></td>';
                            echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnView" type="submit" value="'.$row[0].'"  >Info</button></td>';


                            echo '</tr>';
                            echo ' </tbody>';
                        }
                        echo '</table>';


                    } catch (PDOException $th) {
                        echo $th->getMessage();
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
<?php

if (isset($_POST['btnCon'])) {
    try {
        $upStat=2;
        $rmv =$_POST['btnCon'];
        $conn = new PDO($db, $un, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE `bookings` SET `Status`=? WHERE `BID`=$rmv";
        $st = $conn->prepare($query);
        $st->bindValue(1,$upStat,PDO::PARAM_STR);
        $st->execute();
        echo "<script> alert('Booking Confirmed!');</script>";


    } catch (PDOException $th) {
        echo $th->getMessage();

    }
}
elseif (isset($_POST["Del"])) {
    try {

        $conn = new PDO($db, $un, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM `bookings` WHERE `BID`=?";
        $st = $conn->prepare($query);
        $st->bindValue(1, $_POST["Del"], PDO::PARAM_INT);
        $st->execute();
        echo "<script> alert('Booking Deleted Successfully!');</script>";


    } catch (PDOException $th) {
        echo $th->getMessage();

    }
}
elseif (isset($_POST['btnCan'])) {


        try {
            $upStat=1;
            $rmv =$_POST['btnCan'];
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE `bookings` SET `Status`=? WHERE `BID`=$rmv";
            $st = $conn->prepare($query);
            $st->bindValue(1,$upStat,PDO::PARAM_STR);
            $st->execute();
            echo "<script> alert('Removed Booking Successfully!');</script>";


        } catch (PDOException $th) {
            echo $th->getMessage();

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

