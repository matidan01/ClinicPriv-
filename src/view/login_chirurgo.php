
<!--<?php
session_start();
include_once("../includes/connection.php");
if(isset($_SESSION['login_error'])){
    echo '<div class="alert alert-danger">' . $_SESSION['login_error'] . '</div>';
    unset($_SESSION['login_error']);
}
?>
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Log In Chirurgo</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="../css/login.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="row">
        <div class="col-12 text-center">
            <img src="../../images/icona.png" alt="FoodBook_icon" class="img-rounded" title="FoodBook_icon" width="100" 
                height="100" id = "icon">
        </div>
    </div>
    <div class="main-content">
        <form action="../api/login_logics.php" method="post" class="row">
            <div class="col-sm-12">
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-pencil"></em></span>
                    <label for="badge_number"></label>
                    <input type="text" id="badge_number" class="form-control" placeholder="Numero Badge" name="badge_number" required>
                </div>
                <div class="input-group">
                    <span class="input-group-addon"><em class="glyphicon glyphicon-pencil"></em></span>
                    <label for="password"></label>
                    <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
                </div>
                <p id="back_to_index"><a href="index.php">Non sei un chirurgo?</a></p>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-info w-50" name="login_to_signup" id="login">Log In</button>
            </div>
        </form>
    </div>
</body>
</html>