<?php


include_once 'app/views/nuevaView.php';

class NuevoController{

    private $view;

    function __construct()
    {
        $this->view = new NuevaView();
    }

   
    function pruebaTemplate()
    {
       
        $this->view->mostrar();
    }

    function showHome()
    {
       
        $this->view->showHome();
    }


    
}