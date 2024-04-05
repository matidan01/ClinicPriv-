<!doctype html>
<?php
session_start();
/*include_once("../includes/connection.php");*/
?>
<html lang="en">
  <head>
    <title>Clinic Privè</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="../css/index.css">-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="row">
      <div class="col-sm-12 text-center">
          <img src="../../images/logo.png" alt="ClinicPrive" class="img-rounded" title="ClinicPrive" width="300" 
          height="200" id="logo">
          <form method="post" action="login.php">
          <input type="hidden" name="type" value="0">
              <button id="login_button_medico" class="btn btn-info btn-lg" name="login_button_medico"> Log in Medico</button>
          </form>
          <form method="post" action="login.php">
          <input type="hidden" name="type" value="1">
              <button id="login_button_operatore" class="btn btn-info btn-lg" name="login_button_operatore"> Log in Operatore</button>
          </form>
          <form method="post" action="login.php">
          <input type="hidden" name="type" value="2">
              <button id="login_button_reception" class="btn btn-info btn-lg" name="login_button_reception"> Log in Reception</button>
          </form>
          <form method="post" action="login.php">
          <input type="hidden" name="type" value="3">
              <button id="login_button_amministratore" class="btn btn-info btn-lg" name="login_button_amministratore"> Log in Amministratore</button>
          </form>
      </div> 
    </div>
  </body>
</html>