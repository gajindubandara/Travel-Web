<?php
include("config.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Packages</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include 'nav&footer/nav.php' ?>
<div class="main-container" style="padding-top: 30px">
    <div class="col-md-12">
        <form method="post" style=" margin-top: 20px; margin-bottom: 35px">
            <div class="container">
                <div class="row justify-content-md-center ">
                    <div class="col-md-8 ">
                        <h1 style="text-align: center;">Our Packages...</h1>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder=" Search by tour" name="pack">
                        </div>
                        <input type="submit" class="btn btn-primary form-btn" value="Search" name="find">
                    </div>
                </div>
            </div>
        </form>
        <button class="btn btn-primary btn-lg form-btn book-btn" style="margin-bottom: 20px" name="btnBook"
                type="submit" onclick="loadPage()">Book Now!
        </button>
        <div class="row justify-content-md-center ">
            <?php
            try {
                $conn = new PDO($db, $un, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT  `ID`,`Name`, `Img`, `Des`, `Acc`, `Food`, `Transport`,`Time`, `Price` FROM `packages`";
                if (isset($_POST['find'])) {
                    $query = $query . "where Name like'%" . $_POST["pack"] . "%'";
                }
                $result = $conn->query($query);
                foreach ($result as $row) {
                    echo '<div class="card card-style" style="width: 500px">';
                    echo '<h3 class="card-title">' . $row[1] . '</h3>';
                    echo ' <img class="card-img-top card-img" src="' . $row[2] . '" alt="Card image cap">';
                    echo '<div class="card-body">';
                    echo '<h5 style="text-align: center">' . $row[3] . '</h5>';
                    echo '<br>';
                    echo '  <ul style="list-style-type: none;">';
                    echo '<li><b>Accommodation:</b> ' . $row[4] . '</li>';
                    echo '<br>';
                    echo '<li><b>Food:</b> ' . $row[5] . '</li>';
                    echo '<br>';
                    echo ' <li><b>Transport Method:</b> ' . $row[6] . '</li>';
                    echo '<br>';
                    echo ' <li><b> ' . $row[7] . '</b></li>';
                    echo '<br>';
                    echo '<h4 > Rs.' . $row[8] . '.00/=</h4><p> Per Person</p>';
                    echo '</ul></p>';
                    echo '</div>';
                    echo ' </div>';
                }
            } catch (PDOException $th) {
                echo $th->getMessage();
            }
            ?>
        </div>
    </div>
</div>
<div class="main-container ">
    <div class="col-md-12">
        <div class="row justify-content-md-center ">
            <h1 style="text-align: center; padding-top: 30px">More packages are coming soon! Stay tuned......</h1>
        </div>
    </div>
</div>
<?php include 'nav&footer/footer.php' ?>
<script>
    function loadPage() {
        window.location.href = 'addBooking.php'
    }
</script>
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
