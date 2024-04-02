<!doctype html>
<html lang="en">
  <head>
    <title>Clinic Privè</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <div class="row">
      <div class="col-sm-12 text-center">
          <img src="../../images/logo.png" alt="ClinicPrive" class="img-rounded" title="ClinicPrive" width="300" 
          height="200" id="logo">
          <form method="post" action="login_chirurgo.php">
              <button id="login_button_chirurgo" class="btn btn-info btn-lg" name="login_button_chirurgo"> Log in Chirurgo</button>
          </form>
          <form method="post" action="login_operatore.php">
              <button id="login_button_operatore" class="btn btn-info btn-lg" name="login_button_operatore"> Log in Operatore</button>
          </form>
          <form method="post" action="login_reception.php">
              <button id="login_button_reception" class="btn btn-info btn-lg" name="login_button_reception"> Log in Reception</button>
          </form>
          <form method="post" action="login_amministratore.php">
              <button id="login_button_amministratore" class="btn btn-info btn-lg" name="login_button_chirurgo"> Log in Amministratore</button>
          </form>
      </div> 
    </div>
  </body>
</html>