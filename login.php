<?php
include("config.php");
session_start();?>
<!DOCTYPE html>
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
                <div class="col-md-8 ">
                    <h3 style="text-align: center;">Login to your account</h3>
                    <div class="form-group">
                        Username:
                        <input type="text" class="form-control" placeholder="Username" name="U_UN">
                    </div>
                    <div class="form-group">
                        Password:
                        <input type="password" class="form-control" placeholder="Password" name="U_PW">
                    </div>
                    <input type="submit" class="btn btn-primary form-btn" value="Login" name="logUser">
                    <br>
                    <br>
                   <h5>If you don't have a account please create a new one....</h5>
                </div>
            </div>
        </div>
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["logUser"])) {
            try {
                $conn = new PDO($db, $un, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = $query = "SELECT `UID`,`Username` FROM `users` WHERE `password`=? and `Username`=? ";
                $st = $conn->prepare($query);
                $enteredPW =md5($_POST["U_PW"]);

                $st->bindValue(1, $enteredPW, PDO::PARAM_STR);
                $st->bindValue(2, $_POST["U_UN"], PDO::PARAM_STR);
                $st->execute();
                $result = $st->fetch();
                if($result[1] == $_POST["U_UN"])
                {
//                    header("location:packages.php");
                    echo "<script>window.location.href='index.php';</script>";
                    $_SESSION["u_uid"] =$result[0];
                    $_SESSION["u_un"] =$result[1];

                }
                else{
                    echo '<script>alert("Incorrect user name or password")</script>';
                }

            } catch (PDOException $th) {
                echo $th->getMessage();
            }
        }
    }
    ?>

</div>




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