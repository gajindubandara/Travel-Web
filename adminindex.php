<?php
require("login-check/login-check-admin.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Home</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</head>
<body>
<?php include 'nav&footer/adminNav.php' ?>


<div class="main-container " style="margin-top: 60px">
    <h1 style="text-align: center;">Manage Packages</h1>
    <div class="row justify-content-md-center ">
        <div class="col-md-6" >
            <button type="button" style="margin-top: 20px" class="btn btn-primary btn-lg btn-block" onclick="addPackage()">Add New Packages</button>
            <button type="button" style="margin-top: 20px" class="btn btn-primary btn-lg btn-block" onclick="viewPackage()">View Package List</button>
        </div>
    </div>
</div>
<div class="main-container " style="margin-top: 60px">
    <h1 style="text-align: center;">Manage Users</h1>
    <div class="row justify-content-md-center ">
        <div class="col-md-6" >
            <button type="button" style="margin-top: 20px" class="btn btn-primary btn-lg btn-block" onclick="viewUsers()">View Users</button>
        </div>
    </div>
</div>
<div class="main-container " style="margin-top: 60px">
    <h1 style="text-align: center;">Manage Bookings</h1>
    <div class="row justify-content-md-center ">
        <div class="col-md-6" >
            <button type="button" style="margin-top: 20px" class="btn btn-primary btn-lg btn-block" onclick="allBookings()">View All Bookings</button>
        </div>
    </div>
</div>

<?php include 'nav&footer/footer.php' ?>
<script>
    function addPackage() {
        window.location.href='addpack.php'
    }
</script>
<script>
    function viewPackage() {
        window.location.href='packagelist.php'
    }
</script>
<script>
    function viewUsers() {
        window.location.href='viewusers.php'
    }
</script>
<script>
    function allBookings() {
        window.location.href='allbookings.php'
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