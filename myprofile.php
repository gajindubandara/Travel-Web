<?php
require("login-check/login-check-user.php");
include("config.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Profile</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body class="bg">
<?php include 'nav&footer/nav.php' ?>
<div class="main-container ">
    <form method="post" style="margin-top: 30px">
        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="CardBgCol col-md-8 ">
                    <h3 style="text-align: center; margin-top: 20px">My profile</h3>
                    <?php
                    try {
                        $uname = $_SESSION["u_uid"];
                        $conn = new PDO($db, $un, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = "SELECT  `Name`, `No`, `Email`, `Username`,`Day`, `Address`,`UID` FROM `users` WHERE `UID`=$uname";
                        $result = $conn->query($query);
                        echo '<table class="table" style="margin-top: 50px">';
                        foreach ($result as $row) {
                            echo '<tbody>';
                            echo '<tr>';
                            echo '<td><b>Name:</b></td>';
                            echo '<td>' . $row[0] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><b>Phone Number:</b></td>';
                            echo '<td>' . $row[1] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><b>Email:</b></td>';
                            echo '<td>' . $row[2] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><b>Address: </b></td>';
                            echo '<td>' . $row[5] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><b>Username:</b></td>';
                            echo '<td>' . $row[3] . '</td>';
                            echo '</tr>';
                            echo '<tr>';
                            echo '<td><b>Registered date:</b></td>';
                            echo '<td>' . $row[4] . '</td>';
                            echo '</tr>';
                            echo ' </tbody>';
                        }
                        echo '</table>';
                        echo '<form method="post">';
                        echo '<button class="btn btn-primary form-btn"  name="btnEdit" type="submit"  value="' . $row[6] . '">Update Profile  </button>';
                        echo '<button class="btn btn-primary form-btn"  name="btnChng" type="submit"  value="' . $row[6] . '">Change Password  </button>';
                        echo '</form>';
                    } catch (PDOException $th) {
                        echo $th->getMessage();
                    }
                    ?>
                    <?php
                    if (isset($_POST["btnEdit"])) {
                        $_SESSION["editNo"] = $_POST["btnEdit"];
                        header("location:updateprofile.php");
                    }
                    if (isset($_POST["btnChng"])) {
                        $_SESSION["editNo"] = $_POST["btnChng"];
                        header("location:changepass.php");
                    }
                    ?>
                </div>
            </div>
        </div>
    </form>
</div>
<img src="images/bg.jpg" class="img-bg" alt="Adventure image">
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
