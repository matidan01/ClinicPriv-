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
          <div class="main-content">
            <form action="../api/login_logics.php" method="post" class="row g-3">
              <input type="hidden" name="type">
              <div class="col-12">
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-person"></i></span>
                  <label for="badge_number" class="visually-hidden">Numero Badge</label>
                  <input type="text" id="badge_number" class="form-control" placeholder="Numero Badge" name="badge_number" required>
                </div>
              </div>
              <div class="col-12">
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock"></i></span>
                  <label for="password" class="visually-hidden">Password</label>
                  <input type="password" id="password" class="form-control" placeholder="Password" name="password" autocomplete="off" required>
                </div>
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-info w-50" name="login" id="login">Log In</button>
              </div>
            </form>
          </div>
        </div> 
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
  </body>
</html>
