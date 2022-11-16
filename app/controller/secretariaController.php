<?php
    include_once 'app/models/pacienteModel.php';
    include_once 'app/views/pacienteView.php';
    include_once 'app/views/secretariaView.php';

class SecretariaController {

    private $model;
    private $views;


    function __construct() {
        
        $this->view = new PacienteView();
        $this->model = new PacienteModel();
        $this->secretariaView = new SecretariaView();
    }

    /**
     * Ingreso un nuevo paciente
     */
    function registrarPaciente(){

        $nombre= $_POST['nombre'];
        $apellido= $_POST['apellido'];
        $dni= $_POST['dni'];
        $email= $_POST['email'];
        $domicilio= $_POST['domicilio'];
        $telefono= $_POST['telefono'];
        $mutual= $_POST['obra_elegida'];
        $afiliado= $_POST['afiliado'];

        if ($this->model->existePaciente($dni) > 0){
            // si el paciente se encuentra registrado notifico
            $mensaje="El paciente ya se encuentra registrado";
        }else{
            // si no lo guardo en la BD
            $paciente=$this->model->registrarPaciente($dni, $nombre, $apellido, $domicilio, $telefono, $email);
            if ($paciente > 0){
                $mensaje="Se registro correctamente.";
                if ($mutual != 11){
                    $reg_mut=$this->model->registraMutualPaciente($paciente, $mutual, $afiliado);  
                }
            }else{
                $mensaje="Ups! ocurrio un error intente mas tarde.";
            }
        }

        // muestra la view para sacar turno
        $this->showTurno();

    }

    //muestro la pantalla de turnos
    function showTurno(){
        $especialidades=$this->model->obtenerEspecialidadesDeMedicos();
        $mutuales=$this->model->obtenerMutuales();
        $medicos=$this->model->obtenerMedicos();
        $this->secretariaView->nuevoTurno($especialidades,$mutuales, $medicos, $mensaje = '');

    }

    function showLogin(){
        $mensaje = '';
        $this->view->showLogin($mensaje);
    }

    function showOpciones(){

        $mensaje = '';
        $this->view->showOpciones($mensaje);
    }

    /*
        * pantalla inicial para sacar un turno el paciente
    */
    function ingresarTurno(){

        $especialidades=$this->model->obtenerEspecialidadesDeMedicos();
        $mutuales=$this->model->obtenerMutuales();
        $medicos=$this->model->obtenerMedicos();
        $this->secretariaView->showBuscador($mensaje = '');
    }

    function verificarPaciente(){
        
        $mutuales=$this->model->obtenerMutuales();
        $dni= $_POST['dni'];
        if (!empty($dni) && $d=$this->model->existePaciente($dni) > 0){
            // si existe le muestro la pantalla de turno
            $this->showTurno();

        }else{
            // si no existe registro el paciente
            $this->view->showTemplate($mutuales,$dni);
        }
    }


    /*
        * aca registra el turno elegido para el paciente
    */
    function registrarTurno(){

        $idPaciente= $_POST['paciente'];// se utiliza de esta forma hasta hacer el iniciar seccion
        //guarda el turno seleccionado
        $idTurno = $_POST['check_list'];
        
       
        // si el paciente tiene obra social le cobro un tarifa sino la otra
        $obraSocial= $this->model->obtenerObraSocial($idPaciente); 
        //var_dump($obraSocial);
        //$idTarifa=null;
        if(!empty($obraSocial)){
            $idTarifa=1;
            $mensaje='Al poseer obra social solo tiene que abonar un adicional de $1000'; 
                      
        }else{
            $idTarifa =2;
            $mensaje='No posee obra social por lo que tiene que abonar el costo del turno que seria de $3000';
             
        }
       // $this->model->cambiarTurnoOcupado($idPaciente,$idTarifa,$idTurno);
         
        if(!empty($idPaciente && !empty($idTurno))){
            
            $turno=$this->model->cambiarTurnoOcupado($idPaciente,$idTarifa,$idTurno);

            // si devuelve un numero mayor es porque actualizo
            if ($turno > 0){
                //Verifico que el paciente tenga email para enviar el correo con la confirmacion
                /*$email=$this->model->existeEmailUsuario($idPaciente);

                if(!empty($email)){
                    $this->enviarEmailConfirmacionTurno($email);
                }else{
                    $mensaje='Este paciente no posee email';
                }*/
                // obtengo los datos del turno para poder mostrar en la pantalla de confirmacion de turno
                $datos=$this->model->obtenerInfoTurno($idTurno);
                $msg='Se ha enviado un mail con la confirmacion del turno';
                $this->view->confirmacionDeTurno($msg, $datos);
            }
        }else{
            // si no se actualizo muestra la pantalla de error
            $this->view->showError('Upp! Ocurrio un error intente nuevamente');
        } 

    
        // lo de la tarifa ver si tiene adicional
        
        

    }

    
    function showTemplate(){
        $this->view->showTemplate();
    }

    function showDatos(){
        $this->view->showDatos();
    }

}

?>