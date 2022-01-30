<?php
require("login-check/login-check-admin.php");
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
<?php include 'nav&footer/adminNav.php' ?>

<div class="main-container " style="margin-top: 30px">
    <div class="container">
        <div class="row justify-content-md-center ">
            <div class="col-md-8 ">
                <h3 style="text-align: center;">Add A New Package</h3>
                <form method="post" enctype="multipart/form-data" >
                    <div class="form-group">
                        Package Name:
                        <input type="text" class="form-control" name="txtTitle" required>
                    </div>
                    <div class="form-group">
                        Cover Image:
                        <br>
                        <input type="file" name="txtCover" required>
                    </div>
                    <div class="form-group">
                        Description:
                        <textarea class="form-control" name="txtDes" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        Accommodation:
                        <textarea class="form-control" name="txtAcc" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        Food:
                        <textarea class="form-control" name="txtFood" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        Transport Method:
                        <input type="text" class="form-control" name="txtTrans" required>
                    </div>
                    <div class="form-group">
                        Price:
                        <input type="text" class="form-control" name="txtPrice" required>
                    </div>
                    <input type="submit" class="btn btn-primary form-btn" name="btnSave" value="Add Package">
                </form>
            </div>
        </div>
    </div>
</div>


<?php
if(isset($_POST["btnSave"]))
{
    try {
        $conn = new PDO($db,$un,$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $query = "INSERT INTO `packages`( `Name`, `Des`, `Acc`,`Img`, `Food`, `Transport`, `Price`) VALUES (?,?,?,?,?,?,?)";
        $st = $conn->prepare($query);
        $st->bindValue(1,$_POST["txtTitle"],PDO::PARAM_STR);
        $st->bindValue(2,$_POST["txtDes"],PDO::PARAM_STR);
        $st->bindValue(3,$_POST["txtAcc"],PDO::PARAM_STR);
        $st->bindValue(4,"",PDO::PARAM_STR);
        $st->bindValue(5,$_POST["txtFood"],PDO::PARAM_STR);
        $st->bindValue(6,$_POST["txtTrans"],PDO::PARAM_STR);
        $st->bindValue(7,$_POST["txtPrice"],PDO::PARAM_STR);
        $st->execute();
        $id=$conn->lastInsertId(); // this will give the id of the last entry
        $fname = $_FILES["txtCover"]['name'];
        $info  = new SplFileInfo($fname);
        $newName= 'packageImages/'.$id.'.'.$info->getExtension();
        move_uploaded_file($_FILES["txtCover"]['name'],$newName) ;
        $query="UPDATE `packages` SET `Img`=? WHERE `ID`=?";
        $st = $conn->prepare($query);
        $st->bindValue(1,$newName,PDO::PARAM_STR);
        $st->bindValue(2,$id,PDO::PARAM_INT);
        $st->execute();
        echo "<script> alert('Package Added successfully!');</script>";


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