<?php
include("config.php");?>
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
                    <h3 style="text-align: center;">Register as a new user</h3>
                    <div class="form-group">
                        Name:
                        <input type="text" class="form-control" name="addName" required>
                    </div>
                    <div class="form-group">
                        Contact Number:
                        <input type="number" class="form-control" name="addNum" required>
                    </div>
                    <div class="form-group">
                        Email:
                        <input type="email" class="form-control" name="addEmail" required>
                    </div>
                    <div class="form-group">
                        Address:
                        <input type="text" class="form-control" name="addAddress"required>
                    </div>
                    <div class="form-group">
                        Create a username:
                        <input type="text" class="form-control" name="addUN" required>
                    </div>
                    <div class="form-group">
                        Create a new password:
                        <input type="text" class="form-control" name="addPW" required>
                        <?php
                        $md5pw =md5($_POST["addPW"]);

                        ?>
                    </div>
                    <div class="form-group">
                        Date:
                        <input type="date" class="form-control" name="addDate" required>
                    </div>
                    <input type="submit" class="btn btn-primary form-btn" value="Create account" name="btnAdd">
                </div>
            </div>
        </div>
    </form>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnAdd'])) {
        try {
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO `users`( `Name`, `No`, `Email`,`Address`, `Username`, `Password`, `Day`) 
                VALUES (?,?,?,?,?,?,?)";
            $st = $conn->prepare($query);
            $st->bindValue(1, $_POST["addName"], PDO::PARAM_STR);
            $st->bindValue(2, $_POST["addNum"], PDO::PARAM_STR);
            $st->bindValue(3, $_POST["addEmail"], PDO::PARAM_STR);
            $st->bindValue(4, $_POST["addAddress"], PDO::PARAM_STR);
            $st->bindValue(5, $_POST["addUN"], PDO::PARAM_STR);
            $st->bindValue(6, $md5pw, PDO::PARAM_STR);
            $st->bindValue(7, $_POST["addDate"], PDO::PARAM_STR);
            $st->execute();

            echo "<script> alert('Registration successful!');</script>";


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