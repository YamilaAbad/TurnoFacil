<?php
    include_once 'app/models/usuarioModel.php';
    include_once 'app/views/usuarioView.php';
    
    

class PacienteController {

    private $model;
    private $views;



    function __construct() {
        
        $this->view = new UsuarioView();
        $this->model = new UsuarioModel();
        session_start();
       // $this->chequearLogin();
     
        
    }


    /** cierra session recientemente creada */
    function logout(){

        session_start();
        session_destroy();
        header("Location: " . BASE_URL . 'home');
    }

    function showLogin(){
        $mensaje = '';
        $this->view->showLogin($mensaje);
    }

    function showOpciones(){

        $mensaje = '';
        $this->view->showOpciones($mensaje);
    }

}

?>