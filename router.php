<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
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
$controller = new NuevoController(); 
// phpinfo();

// parsea la acción y los parámetros 
$params = explode('/', $action);

//$pacienteController = new PacienteController();
// determina que camino seguir según la acción
switch ($params[0]) {

    case 'home':    
        $controller->showHome();
        break;

    case 'login':
        $pacienteController->showLogin();
        break;

    case 'opciones':
        $pacienteController->showOpciones();
        break;
        
    case 'prueba':
        $controller->pruebaTemplate();
        break;

    case 'nuevo-turno':
        // muestra la pantalla para obtener turnos
        $pacienteController->obtenerTurno();
        break;   

    case 'verificar_datos':
        $pacienteController->showDatos();
        break;
    case 'obtener_turnos':
        // realiza el filtro con los turnos
        $pacienteController->filtrarDiasDeAtencion();
        break;
    case'chequear_paciente':
        // chequea el paciente ingresado
        $pacienteController->verificarPaciente();
        break;
    case 'registrar_turno':
        // registrar el turno elegido
        $pacienteController->registrarTurno();
        break;
    case 'registrar_datos':
        // registrar el nuevo paciente
        $pacienteController->registrarPaciente();
        break;
    case 'listar_turnos':
        // registrar el nuevo paciente
        $pacienteController->listadoPaciente();
        break;
    /***************** ANTE ERROR MUESTRA PANTALLA POR DEFECTO ***********************/  
    default:
       // $controller = new ErrorHelper();
        // $controller->errorNotFound();
         break;
}

?>