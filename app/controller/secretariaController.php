<?php
    include_once 'app/models/pacienteModel.php';
    include_once 'app/views/pacienteView.php';
    include_once 'app/views/secretariaView.php';
    include_once 'app/models/secretariaModel.php';

class SecretariaController {

    private $model;
    private $view;
    private $secretariaModel;


    function __construct() {
        
        $this->model = new PacienteModel();
        $this->view = new SecretariaView();
        $this->secretariaModel = new SecretariaModel();
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
        var_dump($dni);
        $existe=$this->model->existePaciente($dni);
        if (!empty($existe)){
            // si el paciente se encuentra registrado notifico
            $mensaje="El paciente ya se encuentra registrado";
        }else{
            // si no estaba registrado lo registro al paciente 
            $paciente=$this->model->registrarPaciente($dni, $nombre, $apellido, $domicilio, $telefono, $email);
            if ($paciente > 0){
                
                // si posee mutual lo registro
                if ($mutual != 14){
                    $reg_mut=$this->model->registraMutualPaciente($paciente, $mutual, $afiliado); 
                    if($reg_mut){
                        // si se registro la mutual correctamente y el paciente muestro la pantalla de turnos
                        $mensaje="Se registro correctamente el paciente.";
                        // muestra la view para sacar turno
                        $this->showTurno();

                    } 
                }
            }else{
                $mensaje="Ups! ocurrio un error intente mas tarde.";
            }
        }

        
    }

    /*
        * muestro la pantalla de turnos con los medicos habilitados para la secretaria
    */
    function showTurno(){

        $medicos=$this->secretariaModel->obtenerMedicos();
        // obtiene solo las diferentes mutuales 
        $mutuales=$this->model->obtenerMutuales();
        // aca solo debe tener las especialidades de los medicos que tiene la secretaria
        $especialidades=$this->secretariaModel->obtenerEspecialidades();

        /*SESION - VER CON BRENDA*/ 
        $this->view->nuevoTurno($mutuales, $medicos, $especialidades,$mensaje = '');

    }

    /**
     * Muestra el formulario de login de secretaria
     */
    function showLogin(){
        $mensaje = '';
        $this->view->showLogin($mensaje);
    }
    
    /**
     * Muestra las opciones de la secretaria
     */
    function showOpciones(){

        $mensaje = '';
        $this->secretariaView->showOpciones($mensaje);
    }

    /**
     * Muestra las opciones de la secretaria
     */
    function verificarUsuario(){

        $user= $_POST['user'];
        $pass= MD5($_POST['pass']);

        // controlo que los datos de la secretaria ingresada existan
        $control=$this->secretariaModel->existeUsuario($user, $pass);
        if (!empty($control)){
            // si existe le muestro la pantalla de turno
            $_SESSION['ID_SECRETARIA'] = 1;
            $this->view->showOpciones($mensaje=null);
        }else{
            // si no existe registro el paciente
            $mensaje="Los datos ingresados son incorrectos.";
            $this->view->showLogin($mensaje);
        }
    }

    /*
        * pantalla inicial para sacar un turno el paciente
    */
    function ingresarTurno(){

      //  $medicos=$this->secretariaModel->obtenerMedicos();
        $this->view->showBuscador($mensaje = '');
    }

    /**
     * este verifica si el paciente se encuentra registrado
     */
    function verificarPaciente(){
        
        // obtengo mutuales del modelo Paciente
        $mutuales=$this->model->obtenerMutuales();
        $dni= $_POST['dni'];
        var_dump($dni);
        // verifico si el paciente existe
        $paciente=$this->secretariaModel->existePaciente($dni);

        if (!empty($paciente)){
            // si existe le muestro la pantalla de turnos para que directamente pueda sacarle turno
            // debo obtener los medicos, especialidades y mutuales
            $medicos=$this->secretariaModel->obtenerMedicos();
            $especialidades=$this->secretariaModel->obtenerEspecialidades();
            $this->view->nuevoTurno($mutuales, $medicos, $especialidades, $dni,$mensaje='');
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

    /**
     * obtiene  los turnos segun el filtro elegido
     */
    function filtrarDiasDeAtencion (){

        $medicos=$this->secretariaModel->obtenerMedicos();
        
        // tomo los datos filtrados en el formulario
        $rangoElegidoD= $_POST['fechaDesde'];
        $rangoElegidoH= $_POST['fechaHasta'];
        $turno = $_POST['turno'];
        $dni = $_POST['dni'];
        $medico = $_POST['medico'];
        
        // filtro por medico los turnos
      $filtro=$this->model->obtenerHorariosDeAtencionPorMedico($rangoElegidoD, $rangoElegidoH, $medico);
            

        if (!empty($filtro)){
            $mensaje="Seleccione el dia que desea y confirme por favor";
        }else{
            // si no encuentra resultados en la semana elegida muestra la semana siguiente
            $rangoElegidoD= date("d-m-Y",strtotime($rangoElegidoD."+ 7 days")); 
            //sumo 7 dias
            $rangoElegidoH= date("d-m-Y",strtotime($rangoElegidoH."+ 7 days")); 

            $filtro=$this->model->obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico);
            if (!empty($filtro)){
                $mensaje="Seleccione el dia que desea y confirme por favor";
            }else{
                $mensaje="El medico elegido no tiene turnos disponibles para el rango elegido ni para la siguiente semana. Por favor elija otro medico o intente otra fecha.";
            }
        }
        $this->secretariaView->mostrarResultados($dni,$filtro, $medicos, $mensaje);


    }
    
    // function showTemplate(){
    //     $this->view->showTemplate();
    // }

    // function showDatos(){
    //     $this->view->showDatos();
    // }

}

?>