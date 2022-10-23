<?php

require_once('libs/Smarty/libs/Smarty.class.php');
  
 
class NuevaView {

    /*  
      * Muestra la info importante a tener en cuenta con el manejo de los diferentes archivos de pago. 
    */
    function mostrar(){

        $smarty = new Smarty;
        $smarty->display('templates/home.unlogged.tpl');
    }
    
    
    function showHome(){

        $smarty = new Smarty;
        $smarty->display('templates/home.unlogged.tpl');
    }
  }