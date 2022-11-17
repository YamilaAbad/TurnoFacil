<?php
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// include("file_with_errors.php");

include_once 'app/controller/pacienteController.php';
include_once 'app/controller/secretariaController.php';
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
$secretariaController = new SecretariaController();
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

        //++++++++++++++VER CON BRENDA ++++++++++++++
        /*if(sesion = secretaria){
            $secretariaController->showLogin();
        }

        */
        //$pacienteController->showLogin();

        $secretariaController->showLogin();
        break;

    case 'opciones':
        $dni = $params[1];
        $pacienteController->showOpciones($dni);
        break;
        
    case 'prueba':
        $controller->pruebaTemplate();
        break;

    case 'nuevo-turno':
        // muestra la pantalla para obtener turnos
        $pacienteController->obtenerTurno();
        break;   

        //secretaria
    case 'ingresar-turnos':
        $secretariaController->ingresarTurno();
        break;   

        case 'filtrar_turnos':
            // realiza el filtro con los turnos 
            $secretariaController->filtrarDiasDeAtencion();
            break;
    case 'verificar_datos':
        $pacienteController->showDatos();
        break;
    case 'obtener_turnos':
        // realiza el filtro con los turnos 

        
        //++++++++++++++VER CON BRENDA ++++++++++++++
        /*if(sesion = secretaria){
            $secretariaController->filtrarDiasDeAtencion();
        }

        */
        $pacienteController->filtrarDiasDeAtencion();
        break;
    case'chequear_paciente':
        // chequea el paciente ingresado
                /* +++++++++ VER TEMA SESION CON BRENDA ++++++++
        if(el usuario es secretaria){
            $secretariaController->verificarPaciente();
        }
        else{
            $pacienteController->verificarPaciente();
        }
        */
        $secretariaController->verificarPaciente();
        break;
    case 'registrar_turno':
        // registrar el turno elegido
        $pacienteController->registrarTurno();
        break;
    case 'registrar_datos':
        // registrar el nuevo paciente
        /* +++++++++ VER TEMA SESION CON BRENDA ++++++++
        if(el usuario es secretaria){
            $secretariaController->registrarPaciente();
        }
        else{
            $pacienteController->registrarPaciente();
        }
        */
        $secretariaController->registrarPaciente();
        break;
    /***************** ANTE ERROR MUESTRA PANTALLA POR DEFECTO ***********************/  
    default:
       // $controller = new ErrorHelper();
        // $controller->errorNotFound();
         break;
}

?>