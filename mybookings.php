<?php
require("login-check/login-check-user.php");
include("config.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My bookings</title>
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



                    <?php
                    if (isset($_POST['btnView'])) {
                        try {

                            $bid = $_POST["btnView"];
                            $conn = new PDO($db, $un, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query =  "SELECT `BID`,packages.Name,`Start`, `End`, `BDay`, bookings.Des, `Status`,`No`,`Total` FROM bookings  JOIN packages ON Package=packages.ID WHERE bookings.BID=$bid;";
                            $result = $conn->query($query);
                            echo '<h3 style="text-align: center;">Tour Information</h3>';
                            echo '<table class="table" style="margin-top: 50px">';

                            foreach ($result as $row) {
                                if ($row[6]==0){
                                    $Status="Pending";
                                    $iconColor ="#B49900";
                                }
                                elseif ($row[6]==1){
                                    $Status="Removed";
                                    $iconColor ="red";
                                }
                                elseif($row[6]==2){
                                    $Status="Confirmed";
                                    $iconColor ="green";
                                }
                                echo '<tbody>';
                                echo '<tr>';
                                echo '<td><b>Package:</b></td>';
                                echo '<td>' . $row[1] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Starting Date:</b></td>';
                                echo '<td>' . $row[2] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Ending Date:</b></td>';
                                echo '<td>' . $row[3] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Booked Date: </b></td>';
                                echo '<td>' . $row[4] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>No of Passengers:</b></td>';
                                echo '<td>' . $row[7] . '</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Total Amount:</b></td>';
                                echo '<td>Rs.' . $row[8] . '.00/=</td>';
                                echo '</tr>';
                                echo '<tr>';
                                echo '<td><b>Status:</b></td>';
                                echo '<td><i class="fas fa-circle" style="color:'.$iconColor.'"></i> ' . $Status . '</td>';
                                echo '</tr>';
                                echo ' </tbody>';
                                echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnEdit" type="submit" value="'.$row[0].'"  >Change Info</button></td>';
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

                        $booking=$_SESSION["u_uid"];
                        $conn = new PDO($db, $un, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "SELECT `BID`,packages.Name,`Status` FROM bookings  JOIN packages ON Package=packages.ID WHERE bookings.Name=$booking ORDER BY `Status` DESC";
                        $result = $conn->query($query);
                        echo '<h3 style="text-align: center;">My Bookings</h3>';
                        echo '<table class="table" style="border:solid #dee2e6 1px;">';
                        echo '<thead class="thead-dark">';
                        echo '<tr>

                            <th scope="col">Package</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            

                          </tr>';
                        foreach($result as $row)
                        {
                           if ($row[2]==0){
                               $Status="Pending";
                               $iconColor ="#B49900";
                           }
                           elseif ($row[2]==1){
                               $Status="Removed";
                               $iconColor ="red";
                           }
                           elseif($row[2]==2){
                               $Status="Confirmed";
                               $iconColor ="green";
                           }

                            echo '<tbody>';
                            echo '<tr class="rw">';
                            echo '<td style="vertical-align: middle;"> <input type="hidden" >'. $row[1] . '</td>';
                            echo '<td style="vertical-align: middle;"> <input type="hidden" > <i class="fas fa-circle" style="color:'.$iconColor.'"></i></td>';
                            echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnView" type="submit" value="'.$row[0].'"  >View</button></td>';
                            echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnCan" type="submit" value="'.$row[0].'"  >Cancel Booking</button></td>';
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

    if (isset($_POST['btnCan'])) {
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
elseif (isset($_POST["btnEdit"])){
    $_SESSION["editbc"] = $_POST["btnEdit"];
    echo "<script>window.location.href='editbooking.php';</script>";
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



<div class="container">

    </div>