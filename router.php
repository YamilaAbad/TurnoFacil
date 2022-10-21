<?php
<<<<<<< HEAD
//error_reporting(E_ALL);
//ini_set("display_errors", 1);
=======
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
>>>>>>> origin/develop
// include("file_with_errors.php");

include_once 'app/controller/pacienteController.php';
include_once 'app/controller/nuevo.php';
//  include_once 'app/helpers/DB.Helper.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'login'; // acción por defecto si no envían
}
$pacienteController = new PacienteController(); 
// phpinfo();

// parsea la acción y los parámetros 
$params = explode('/', $action);

//$pacienteController = new PacienteController();
// determina que camino seguir según la acción
switch ($params[0]) {

    case 'home':
        $controller = new NuevoController();
        $controller->showHome();
        break;

    case 'login':
        $pacienteController->showLogin();
        break;

    case 'opciones':
        $pacienteController->showOpciones();
        break;
        
    case 'prueba':
<<<<<<< HEAD
        $controller->pruebaTemplate();
=======
    $controller = new NuevoController();
    $controller->pruebaTemplate();
>>>>>>> origin/develop
    break;

    
    case 'nuevo-turno':
<<<<<<< HEAD
        $pacienteController->showNewTurn();
    break;     
=======
    $pacienteController->newTurn();
    break;
      
    $controller->pruebaTemplate();
    break;
  
>>>>>>> origin/develop
    case 'verificar-datos':
        $pacienteController->showDatos();
        break;

    // case 'home':
        /* muestra la pantalla principal del visitante */
        // $controller = new HomeController();
        // $controller->mostrarHome();
        // break;
        /*
    case 'filtrar-dias':
        $medico = $params[1];
        $controller = new PacienteController();
        $controller->filtrarDiasDeAtencion($medico);
        break;
<<<<<<< HEAD
    case 'sacar-turno':
        $controller = new PacienteController();
        $controller->obtenerTurno();
=======
        */
    case 'sacar-turno':
        $pacienteController->filtrarDiasDeAtencion();
>>>>>>> origin/develop
        break;

    /***************** ANTE ERROR MUESTRA PANTALLA POR DEFECTO ***********************/  
    default:
       // $controller = new ErrorHelper();
        // $controller->errorNotFound();
        // break;
}

?>