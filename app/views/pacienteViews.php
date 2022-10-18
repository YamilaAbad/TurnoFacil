<?php

require_once('libs/smarty/libs/Smarty.class.php');

class PacienteViews{
    
    private $smarty; 

    function __construct() {
        $this->smarty = new Smarty();
         
    }

    /************************************VISTA DE FILTRO DE MEDICOS POR BUSQUEDA DEL PACIENTE**************************/
    function filtroMedicos($medico){
        $this->smarty->assign('medico', $medico);
        $this->smarty->display('templates/filtro_medico.tpl');
    }

    /*****************************************MENSAJE DE ERROR***********************************************/
    function showError($msg) {
        $smarty = new Smarty();
        $smarty->assign('msg', $msg);
        $smarty->display('templates/error.tpl');
    }
    

}

?>