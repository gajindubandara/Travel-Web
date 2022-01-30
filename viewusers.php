<?php
include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User List</title>
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

                            $uname = $_POST["btnView"];
                            $conn = new PDO($db, $un, $password);
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = "SELECT  `Name`, `No`, `Email`, `Username`,`Day`, `Address`,`UID` FROM `users` WHERE `UID`=$uname";

                            $result = $conn->query($query);
                            echo '<h3 style="text-align: center;">User profile</h3>';
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
    <form method="post" style="margin-top: 30px">
        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="col-md-8 ">
                    <h3 style="text-align: center;">Search For A User</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder=" Search by Username" name="ps">
                    </div>
                    <input type="submit" class="btn btn-primary form-btn" value="Search" name="find">
                </div>
            </div>
        </div>
    </form>
</div>

<div class="main-container ">
    <form method="post" style="margin-top: 30px">
        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="col-md-8 ">

                    <?php
                            try {
                                $num = $_POST["ps"];
                                $_SESSION["ps"] =$_POST["ps"];
                                $conn = new PDO($db, $un, $password);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                $query = "SELECT  `UID`, `Name`,`Username` FROM `users`  ";
                                if (isset($_POST['find'])) {
                                    $query = $query . "where Name like'%" . $_POST["ps"] . "%'";
                                }
                                $result = $conn->query($query);
                                echo '<table class="table" style="border:solid #dee2e6 1px;">';
                                echo '<thead class="thead-dark">';
                                echo '<tr>

                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col"></th>
                            <th scope="col"></th>

                          </tr>';
                                foreach($result as $row)
                                {   echo '<tbody>';
                                    echo '<tr class="rw">';
                                    echo '<td style="vertical-align: middle;"> <input type="hidden" name="pID[]" value="' . $row[1] . '">'. $row[1] . '</td>';
                                    echo '<td style="vertical-align: middle;"> <input type="hidden" name="pID[]" value="' . $row[2] . '">'. $row[2] . '</td>';
                                    echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="btnView" type="submit" value="'.$row[0].'"  >View Profile  </button></td>';
                                    echo '<td style="vertical-align: middle;"><button class="btn btn-primary form-btn" style="margin: auto" name="Del" type="submit" value="'.$row[0].'"  >Remove  </button></td>';

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
if (isset($_POST["Del"])) {
    try {

        $conn = new PDO($db, $un, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "DELETE FROM `users` WHERE `UID`=?";
        $st = $conn->prepare($query);
        $st->bindValue(1,$_POST["Del"],PDO::PARAM_INT);
        $st->execute();
        echo "<script> alert('User removed Successfully!');</script>";


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





