<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-md">
    <a class="navbar-brand" href="#"><h4>Dream Tour Sri Lanka</h4></a>
    <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main-navigation">
        <ul class="navbar-nav" id="nav">
            <?php
            if (isset($_SESSION["admin"])) {
                echo '  
                         <li class="nav-item">
                              <a class="nav-link" href="adminindex.php">Home</a>
                            </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addpack.php">Add Package
                        </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="packagelist.php">Package List</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="viewusers.php">View Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="allbookings.php">All Bookings
                        </a>
                        </li>
                        
                         <li class="nav-item">
                            <form method="post">
                                <button class="logout" type="submit" name="logout">Logout <i class="fas fa-sign-out-alt" style="color:white"></i></button>
                            </form>
                        </li> ';
            } else {
                echo ' <li class="nav-item">
              <a class="nav-link" href="adminlogin.php">Login</a>
                        </li>';
            }
            if (isset($_POST["logout"])) {
                unset($_SESSION["admin"]);
                header("location:adminlogin.php");
            }

            ?>
        </ul>
    </div>
</nav>
</body>
</html>
