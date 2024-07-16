<!doctype html>
<?php
session_start();
include_once("../includes/connection.php");
?>
<html lang="en">
  <head>
    <title>Clinic Privè</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="container">
      <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-sm-12 text-center">
          <img src="../../images/logo.png" alt="ClinicPrive" class="img-rounded mb-4" title="ClinicPrive" width="300" height="200" id="logo">
          <div class="mt-4">
            <a href="login.php" class="btn btn-info">Login</a>
          </div>
        </div> 
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  </body>
</html>
