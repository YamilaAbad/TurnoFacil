<?php
include_once 'app/controllers/pacienteController.php';
include_once 'app/helpers/DB.helper.php';


// defino la base url para la construccion de links con urls semánticas
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

// lee la acción
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'login'; // acción por defecto si no envían
}
// phpinfo();

// parsea la acción y los parámetros 
$params = explode('/', $action);

// determina que camino seguir según la acción
switch ($params[0]) {

    case 'home':
        /* muestra la pantalla principal del visitante */
        // $controller = new HomeController();
        $controller->mostrarHome();
        break;
    case 'filtrar-dias':
        $medico = $params[1];
        $controller = new PacienteController();
        $controller->filtrarDiasDeAtencion($medico);
        break;
    /***************** ANTE ERROR MUESTRA PANTALLA POR DEFECTO ***********************/  
    default:
       // $controller = new ErrorHelper();
        $controller->errorNotFound();
        break;
}

?>