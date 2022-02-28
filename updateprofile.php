<?php
require("login-check/login-check-user.php");
include("config.php");
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Profile</title>
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
                    <h3 style="text-align: center;">Update Profile Information</h3>

                    <?php

                    try {
                        $edit = $_SESSION["editNo"];
                        $conn = new PDO($db, $un, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = $query = "SELECT  `Name`, `No`, `Email`, `Address` FROM `users` WHERE `UID`=$edit";
                        $result = $conn->query($query);

                        foreach ($result as $row) {


                            echo '  <div class="form-group"> Name:';
                            echo '<input type="text" class="form-control" name="Name" value="' . $row[0] . '" required >';
                            echo '</div>';


                            echo '  <div class="form-group"> Contact Number:';
                            echo '<input type="number" class="form-control" name="No" value="' . $row[1] . '" required >';
                            echo '</div>';

                            echo '  <div class="form-group"> Email:';
                            echo '<input type="email" class="form-control" name="Email" value="' . $row[2] . '" required >';
                            echo '</div>';

                            echo '  <div class="form-group"> Address:';
                            echo '<input type="text" class="form-control" name="Address" value="' . $row[3] . '" required >';
                            echo '</div>';


                            echo '<input type="submit" class="btn btn-primary form-btn" value="Update" name="btnUpdate">';
                            echo '<input type="submit" class="btn btn-primary form-btn" value="Cancel" name="btnCan">';


                        }


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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnUpdate'])) {
        try {
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE `users` SET `Name`=?,`No`=?,`Email`=?,`Address`=? WHERE `UID`=$edit";
            $st = $conn->prepare($query);
            $st->bindValue(1, $_POST["Name"], PDO::PARAM_STR);
            $st->bindValue(2, $_POST["No"], PDO::PARAM_STR);
            $st->bindValue(3, $_POST["Email"], PDO::PARAM_STR);
            $st->bindValue(4, $_POST["Address"], PDO::PARAM_STR);
            $st->execute();

            echo "<script>window.location.href='myprofile.php';</script>";


        } catch (PDOException $th) {
            echo $th->getMessage();

        }
    } elseif (isset($_POST['btnCan'])) {
        echo "<script>window.location.href='myprofile.php';</script>";
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