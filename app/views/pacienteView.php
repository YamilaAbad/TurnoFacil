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

    function mostrarResultados($filtro, $mensaje){

    }

    function showTemplate(){
        $smarty = new Smarty();
        $smarty->display('./templates/registro.tpl');
    }

    /**
     * Muestra la vista para sacar un nuevo turno
     */
    function showNewTurn($especialidades,$obraSocial, $mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('especialidades', $especialidades);
        $smarty->assign('obra_social', $obraSocial);
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/turno.tpl');
    }

    function showLogin($mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/login.tpl');
    }

    function showOpciones($mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/home.paciente.tpl');
    }
    
    function showDatos(){
        $smarty = new Smarty();
        $smarty->display('./templates/verificar.tpl');
    }


}

?>