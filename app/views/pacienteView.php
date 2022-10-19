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
    function nuevoTurno($especialidades,$mutuales, $mensaje = ''){

        $smarty = new Smarty();
        $smarty->assign('especialidades', $especialidades);
        $smarty->assign('mutuales', $mutuales);
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/turno.tpl');
    }

    function mostrarFiltro(){

    }

    /** 
     * muestra la pantalla de home de paciente 
     * */
    function homePaciente($mensaje){

        $smarty = new Smarty();
        $smarty->assign('mensaje', $mensaje);
        $smarty->display('./templates/portada.tpl');
    }

    function showNewTurn() {}
    
    function showDatos(){
        $smarty = new Smarty();
        $smarty->display('./templates/verificar.tpl');
    }


}

?>