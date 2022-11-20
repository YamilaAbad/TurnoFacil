<?php

require_once('libs/Smarty/libs/Smarty.class.php');


class PacienteView{

   
    /*  
    * Muestra los dias y horarios de atencion de turnos disponibles del medico elegido 
    */
    function mostrarDias($mensaje =null) {

        $smarty = new Smarty();
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('templates/filtro-dias-atencion.tpl');

    }

    /**
     * Muestra los resultados que obtiene de aplicar los diferentes filtros
     */
    function mostrarResultados($filtro, $especialidades,$mutuales, $medicos, $mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('especialidades', $especialidades);
        $smarty->assign('mutuales', $mutuales);
        $smarty->assign('medicos', $medicos);
        $smarty->assign('mensaje', $mensaje);
        $smarty->assign('filtro', $filtro);
        $smarty->display('./templates/turno.tpl');
    }

    /**
     * muestra el registro de paciente
     */
    function showTemplate($mutuales){

        $smarty = new Smarty();
        $smarty->assign('mutuales', $mutuales);
        $smarty->display('./templates/registro.tpl');
    }

    /**
     * Muestra la vista para sacar un nuevo turno
     */
    function nuevoTurno($especialidades,$mutuales, $medicos, $mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('especialidades', $especialidades);
        $smarty->assign('mutuales', $mutuales);
        $smarty->assign('medicos', $medicos);
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/turno.tpl');
    }

    function showLogin($mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/login.tpl');
    }

    /**
     * muestro las pantallas de opciones que puede hacer el paciente
     */
    function showOpciones($mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/home.paciente.tpl');
    }


    /**
     * si es un paciente verifico los datos
     */
    function showDatos($dni, $mutuales,$mensaje){

        $smarty = new Smarty();
        $smarty->assign('dni', $dni);
        $smarty->assign('mensaje', $mensaje);
        $smarty->assign('mutuales', $mutuales);
        $smarty->display('./templates/verificar.tpl');
    }

    /**
     * muestra la pantalla de confirmacion de turno
     */
    function confirmacionDeTurno($msg, $datos) {

        $smarty = new Smarty();
        $smarty->assign('datos', $datos);
        $smarty->assign('mensaje', $msg);
        $smarty->display('templates/confirmacion.turno.tpl');
    }

    /** muestra los turnos del paciente */
    function showList($turnos){

        $smarty = new Smarty();
        $smarty->assign('turnos', $turnos);
        $smarty->display('templates/turnos.paciente.tpl');
    }

    /*****************************************MENSAJE DE ERROR***********************************************/
    function showError($msg) {
        $smarty = new Smarty();
        $smarty->assign('msg', $msg);
        $smarty->display('templates/error.tpl');
    }
}

?>