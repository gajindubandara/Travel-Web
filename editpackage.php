<?php
require("login-check/login-check-admin.php");
include("config.php");?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Package</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include 'nav&footer/adminNav.php' ?>

<div class="main-container" style="margin-top: 30px">

        <div class="container">
            <div class="row justify-content-md-center ">
                <div class="col-md-8 ">
                    <h3 style="text-align: center;">Update Package</h3>
                    <form method="post" enctype="multipart/form-data" >
                    <?php
                    try {
                        $edit = $_SESSION["editpc"];
                        $conn = new PDO($db, $un, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $query = $query ="SELECT  `Name`, `Img`, `Des`, `Acc`, `Food`, `Transport`, `Price`,`Time` FROM `packages` WHERE `ID`=$edit";
                        $result = $conn->query($query);
                        foreach ($result as $row) {
                            echo '<div class="form-group">';
                            echo 'Package Name:';
                            echo '<input type="text" class="form-control" name="txtTitle" value="' . $row[0] . '" required>';
                            echo ' </div>';
                            echo '<div class="form-group">';
                            echo 'Cover Image:';
                            echo ' <br>';
                            echo '<input type="file" name="txtCover" >';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo ' Description:';
                            echo ' <textarea class="form-control" name="txtDes" cols="30" rows="5" required>' . $row[2] . '</textarea>';
                            echo ' </div>';
                            echo '<div class="form-group">';
                            echo '  Accommodation:';
                            echo ' <textarea class="form-control" name="txtAcc" cols="30" rows="5" required>' . $row[3] . '</textarea>';
                            echo '</div>';
                            echo '<div class="form-group">';
                            echo ' Food:';
                            echo '   <textarea class="form-control" name="txtFood" cols="30" rows="5" required>' . $row[4] . '</textarea>';
                            echo '</div>';
                            echo ' <div class="form-group">';
                            echo ' Transport Method:';
                            echo '   <textarea class="form-control" name="txtTrans" cols="30" rows="5" required>' . $row[5] . '</textarea>';
                            echo ' </div>';
                            echo ' <div class="form-group">';
                            echo ' Price:';
                            echo '    <input type="number" class="form-control" name="txtPrice" value="' . $row[6] . '" required>';
                            echo ' </div>';
                            echo ' <div class="form-group">';
                            echo ' Time Duration:';
                            echo '    <input type="text" class="form-control" name="txtTime" value="' . $row[7] . '" required>';
                            echo ' </div>';

                            echo '<input type="submit" class="btn btn-primary form-btn" value="Update" name="btnUpdate">';
                            echo '<input type="submit" class="btn btn-primary form-btn" value="Cancel" name="btnCan">';
                        }
                    } catch (PDOException $th) {
                        echo $th->getMessage();
                    }


                    ?>
                    </form>
                </div>
            </div>
        </div>
</div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnCan'])) {
        echo "<script>window.location.href='packagelist.php';</script>";
    }
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['btnUpdate'])) {
        try {
            $fname = $_FILES["txtCover"]['name'];
            $info  = new SplFileInfo($fname);
            $newName= 'packageImages/'.$edit.'.'.$info->getExtension();
            move_uploaded_file($_FILES["txtCover"]['tmp_name'],$newName) ;
            $conn = new PDO($db, $un, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE `packages` SET `Name`=?,`Des`=?,`Acc`=?,`Img`=?,`Food`=?,`Transport`=?,`Price`=?,`Time`=? WHERE `ID`=$edit";
            $st = $conn->prepare($query);
            $st->bindValue(1,$_POST["txtTitle"],PDO::PARAM_STR);
            $st->bindValue(2,$_POST["txtDes"],PDO::PARAM_STR);
            $st->bindValue(3,$_POST["txtAcc"],PDO::PARAM_STR);
            $st->bindValue(4,$newName,PDO::PARAM_STR);
            $st->bindValue(5,$_POST["txtFood"],PDO::PARAM_STR);
            $st->bindValue(6,$_POST["txtTrans"],PDO::PARAM_STR);
            $st->bindValue(7,$_POST["txtPrice"],PDO::PARAM_STR);
            $st->bindValue(8,$_POST["txtTime"],PDO::PARAM_STR);
            $st->execute();
            echo "<script> alert('Package updated Successfully!');</script>";


        } catch (PDOException $th) {
            echo $th->getMessage();

        }
    }
}
?>
<?php
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (isset($_POST['btnUpdate'])) {
//        try {
//            $test=abc;//remove this
//            $conn = new PDO($db, $un, $password);
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            $query = "UPDATE `packages` SET `Name`=?,`Img`=?,`Des`=?,`Acc`=?,`Food`=?,`Transport`=?,`Price`=? WHERE `ID`=$edit";
//
//            $st = $conn->prepare($query);
//            $st->bindValue(1, $_POST["Name"], PDO::PARAM_STR);
//            $st->bindValue(2, $test, PDO::PARAM_STR);
//            $st->bindValue(3, $_POST["Des"], PDO::PARAM_STR);
//            $st->bindValue(4, $_POST["Acc"], PDO::PARAM_STR);
//            $st->bindValue(5, $_POST["Food"], PDO::PARAM_STR);
//            $st->bindValue(6, $_POST["Trans"], PDO::PARAM_STR);
//            $st->bindValue(7, $_POST["Price"], PDO::PARAM_STR);
//            $st->execute();
//
//
//            echo "<script> alert('Package updated Successfully!');</script>";
//
//
//
//        } catch (PDOException $th) {
//            echo $th->getMessage();
//
//        }
//    }
//}
//?>

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