<?php

require_once('libs/smarty/libs/Smarty.class.php');

class PacienteViews{
    
    private $smarty; 

    function __construct() {
        $this->smarty = new Smarty();
         
    }

    function filtroMedicos($medico){
        $this->smarty->assign('medico', $medico);
    
        $this->smarty->display('templates/filtro_medico.tpl');
    }

    

}

?>