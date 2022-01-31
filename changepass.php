<?php
require("login-check/login-check-user.php");
include("config.php");
session_start();
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
                <div class="col-md-8">
                    <h3 class="feature-title">Change Password</h3>
                    <form method="post">
                        <div class="form-group">Old Password:
                            <input type="password" class="form-control"  name="pOPW" required>
                        </div>
                        <div class="form-group"> New password:
                            <input type="password" class="form-control"  name="pNPW" required>
                        </div>
                        <div class="form-group"> Reenter the new password:
                            <input type="password" class="form-control"  name="pRNPW" required>
                        </div>
                        <input type="submit" class="btn btn-primary form-btn" value="Change Password" name="btnChange">
                        <input type="button" class="btn btn-primary form-btn" value="Cancel" name="btnCan" onclick="changePage()">
                    </form>
                </div>
            </div>
        </div>
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["btnChange"])) {
        try {
            $id = $_SESSION["u_uid"];
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = $query = "SELECT  `Password` FROM `users` WHERE `UID`=$id";
            $st = $conn->prepare($query);
            $st->execute();
            $result = $st->fetch();
            $pw =md5($_POST["pOPW"]);

            if($pw== $result[0])
            {
                if ($_POST["pNPW"] == $_POST["pRNPW"]){

                    $conn = new PDO($db, $un, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = "UPDATE `users` SET `Password`=? Where `UID`=$id";
                    $st = $conn->prepare($query);
                    $npw =md5($_POST["pNPW"]);
                    $st->bindValue(1, $npw, PDO::PARAM_STR);
                    $st->execute();
                    echo "<script> alert('Password updated Successfully!');</script>";
                }else{
                    echo "<script> alert('The reentered password dose not match to the new password! ');</script>";
                }
            }
            else{
                echo '<script>alert("Enter the correct old password")</script>';
            }

        } catch (PDOException $th) {
            echo $th->getMessage();
        }
    }elseif (isset($_POST['btnCan'])) {
        echo "<script>window.location.href='myprofile.php';</script>";
    }
}
?>



<img src="images/bg.jpg" class="img-bg">
<?php include 'nav&footer/footer.php' ?>
<script>function changePage() {
        window.location.href = 'myprofile.php'
    }</script>
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