<?php
include_once ("connection.php");

function check_login($badgeNumber, $password, $type, $mysqli){
    $colonna = "nBadge";
    switch($type){
        case 0:
            $table = "medico";
            break;
        case 1:
            $table = "operatore";
            break;
        case 2:
            $table = "receptionist";
            break;
        case 3:
            $table = "amministratore";
            $colonna = "idAmministratore";
            break;
        default:
            return false; // Invalid type
    }
    $stmt = $mysqli->prepare("SELECT password FROM $table WHERE $colonna=?");
    print("$table");
    $stmt->bind_param("i", $badgeNumber);
    $stmt->execute();
    $row = $stmt->get_result()->fetch_assoc();
    /*if(password_verify($password, $row['password']) == true){*/
    if($row["password"] == $password){
        $_SESSION['type'] = $type;
        return true;
    }else{
        return false;
    }
} 

function print_home(){
    switch($_SESSION["type"]){
        case 0:
            print_home_medico();
            break;
        case 1:
            print_home_operatore();
            break;
        case 2:
            print_home_receptionist();
            break;
        case 3:
            print_home_amministratore();
            break;
        default:
            print("Problemi di autenticazione rilevati");
    }
}

function print_home_amministratore(){
    echo("
    <nav class='navbar navbar-expand-lg navbar-dark bg-secondary'>
    <div class='container'>
        <div class='collapse navbar-collapse' id='navbarNav'>
            <ul class='navbar-nav mr-auto'>
                <li class='nav-item'>
                    <a class='nav-link' href='#assunzione-personale'>Assunzione personale</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#termine-contratto-con-personale'>Termine contratto con personale</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-dati-fatturato'>Visualizzazione dati fatturato</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-dati-interventi'>Visualizzazione dati interventi</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-grafico-fatture'>Visualizzazione grafico fatture</a>
                </li>
                <li class='nav-item'>
                    <a class='nav-link' href='#visualizzazione-dati-personale'>Visualizzazione dati personale</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section class='py-4'>
    <div class='container'>
        <div class='row'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Assunzione personale</h2>
                        <p class='card-text'>Gestisci l'assunzione del personale.</p>
                        <a href='home/visualizzazione-dati-personale.php' class='btn btn-primary'>Vai alla gestione</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Termine contratto con personale</h2>
                        <p class='card-text'>Gestisci il termine di un contratto col personale.</p>
                        <a href='home/termina-contratto.php' class='btn btn-primary'>Vai alla gestione</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row mt-4'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione dati fatturato</h2>
                        <p class='card-text'>Visualizza i dati di fatturato.</p>
                        <a href='home/visualizzazione-fatturato.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione dati interventi</h2>
                        <p class='card-text'>Visualizza i dati degli interventi</p>
                        <a href='home/visualizza-interventi.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
        </div>
        <div class='row mt-4'>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione grafico fatture</h2>
                        <p class='card-text'>Visualizza il grafico delle fatture</p>
                        <a href='home/visualizzazione-grafico-fatture.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
            <div class='col-md-6'>
                <div class='card'>
                    <div class='card-body'>
                        <h2 class='card-title'>Visualizzazione dati personale</h2>
                        <p class='card-text'>Visualizza i dati del personale.</p>
                        <a href='home/visualizzazione-dati-personale.php' class='btn btn-primary'>Vai alla visualizzazione</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    ");
}



