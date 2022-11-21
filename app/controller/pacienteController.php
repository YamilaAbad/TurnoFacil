<?php
    include_once 'app/models/pacienteModel.php';
    include_once 'app/views/pacienteView.php';
    
    

class PacienteController {

    private $model;
    private $views;



    function __construct() {
        
        $this->view = new PacienteView();
        $this->model = new PacienteModel();
        session_start();
       // $this->chequearLogin();
     
        
    }
    /* "Como paciente quiero ver la lista de médicos para seleccionar
    uno"
    CRITERIO DE ACEPTACIÓN:
        -Seleccionar un médico
        -Permitir filtrar médicos por especialidad y obra social que trabaja
        -Mostrar días y horarios que atiende un médico
    */
    function chequearLogin(){
        session_start();
        if (!isset($_SESSION['ID_PACIENTE'])){

            header("Location: " . BASE_URL . "login");
            //$this->view->showOpciones($mensaje = '');
            
            die();
        }
    }

    function filtroDeEspecialidad($id){
       
        //Obtengo un medico por especialidad
       $medico = $this->model->getSelectEspecialidad($id); 
        if($medico){
            //Actualizo la vista
            $this-> view->filtroMedicos($medico);
        }else{
            $this->view->showError('No se encontró médico con esa especialidad');
        }
    }

    function filtroPorObraSocial($id){
        
       //Obtengo un medico por obra social
       $medico = $this->model->getSelectObrasocial($id);
       if($medico){
            //Actualizo la vista
            $this-> view->filtroMedicos($medico); 
       }else{
            $this->view->showError('No se encontró médico por esta obra social');
       }     
    }

   
        //FUNCION PARA MOSTRAR MEDICOS POR ESPACIALIDAD Y OBRA SOCIAL

    function filtroPorEspecialidadYObraSocial($id1,$id2){

        //Obtengo un medico por obra social y especialidad del mismo
        $medico = $this->model->getAll($id1, $id2);
        if($medico){
            // Actualizo la vista
            $this-> view->filtroMedicos($medico); 
       }else{
            $this->view->showError('No se encontró médico');
       } 
    }

    /**
     * Muestro la pantalla de ingreso de paciente
     */
    function verificarPaciente(){
        
        //$mutuales=$this->model->obtenerMutuales();
        $dni= $_POST['dni'];
        $paciente=$this->model->existePaciente($dni);
        //var_dump($paciente);
        
        if (!empty($dni) && !empty($paciente)){
            // si existe le muestro la pantalla de opciones de lo que puede hacer el paciente
            $_SESSION['ID_PACIENTE'] = $paciente->paciente_id;
            $_SESSION['DNI_PACIENTE'] = $paciente->paciente_dni;
            $this->view->showOpciones($mensaje = '');
        }else{
            // si no existe registro el paciente
             $this->view->showError("Datos incorrectos"); 
            //$this->view->showTemplate($dni);
        }
    }

    function verRegistro(){
        $mutuales=$this->model->obtenerMutuales();
        $this->view->showTemplate($mutuales);
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
            $this->view->showLogin($mensaje);
        }else{
            // si no lo guardo en la BD
            
            $paciente=$this->model->registrarPaciente($dni, $nombre, $apellido, $domicilio, $telefono, $email);
            if ($paciente > 0){
                $mensaje="Se registro correctamente. Inicie session por favor";
                if ($mutual != 11){
                    $reg_mut=$this->model->registraMutualPaciente($paciente, $mutual, $afiliado);  
                }else{
                    // si no posee mutual
                    $reg_mut=$this->model->registraMutualPaciente($paciente, 11, 0);
                }
                // si se registro mutual y paciente correctamente lo mando al login
                $this->view->showOpciones();
            }else{
                $mensaje="Ups! no pudimos registrarlo como paciente. Intente mas tarde.";
                $this->view->showLogin($mensaje);
            }
        }

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

    /*
        Como paciente quiero poder filtrar días y horarios de atención del médico elegido para poder elegir un día
        
        Criterios: 
            Ingresar un rango de fecha para mostrar los días que el paciente prefiere asistir.
            Permitir buscar si es turno mañana o tarde.
            Mostrar la siguiente semana,  en caso de no encontrar en el rango ingresado.
    */
    function filtrarDiasDeAtencion (){

        // obtengo las especialidades y mutuales por si tengo que volver a registrar turno
        $especialidades=$this->model->obtenerEspecialidadesDeMedicos();
        $mutuales=$this->model->obtenerMutuales();
        $medicos=$this->model->obtenerMedicos();
        
        // tomo los datos filtrados en el formulario
        $rangoElegidoD= $_POST['fechaDesde'];
        $rangoElegidoH= $_POST['fechaHasta'];
        $turno = $_POST['turno'];
        $mutual = $_POST['obra_elegida'];
        $especialidad = $_POST['especialidad'];
        $medico = $_POST['medico'];
        
        // aca debo traer dos tipos de filtro 
        /**
         * 1- que filtre los medicos de determinada mutual u obra social 
         * 2- que filtre para un medico en especial 
         */

        if (empty($especialidad) && empty($medico) && empty($mutual) && !empty($turno) ) {
            // si no filtro especialidad ni medico filtro solo por la fecha elegida y turno
            $filtro=$this->model->obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico);
        }else{
            // filtro por medico los turnos
            if (!empty($medico) && empty($especialidad) && empty($mutual) ) {
                $filtro=$this->model->obtenerHorariosDeAtencionPorMedico($rangoElegidoD, $rangoElegidoH, $medico);
            }else{
                // filtro por mutual
                if (empty($medico) && empty($especialidad) && !empty($mutual) ) {
                    $filtro=$this->model->obtenerHorariosDeAtencionPorMutual($rangoElegidoD, $rangoElegidoH,$mutual);
                }else{
                    // filtro por especialidad 
                    if (!empty($especialidad) && empty($medico) && empty($mutual) ) {
                        $filtro=$this->model->obtenerHorariosDeAtencionPorEspecialidad($rangoElegidoD, $rangoElegidoH, $especialidad);
                    }
                }
            }
        }

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
        $this->view->mostrarResultados($filtro,$especialidades,$mutuales, $medicos, $mensaje);


    }

    /*
        * pantalla inicial para sacar un turno el paciente
    */
    function obtenerTurno(){
        
        $especialidades=$this->model->obtenerEspecialidadesDeMedicos();
        $mutuales=$this->model->obtenerMutuales();
        $medicos=$this->model->obtenerMedicos();
        $this->view->nuevoTurno($especialidades,$mutuales, $medicos,$mensaje = '');
    }

    /*
        * aca registra el turno elegido para el paciente
    */
    function registrarTurno(){
        //session_start();
        //guardo el id del paciente
        $idPaciente= $_SESSION['ID_PACIENTE'];
        //var_dump($idPaciente);
       
        //guarda el turno seleccionado
        $idTurno = $_POST['check_list'];
        
       
        // si el paciente tiene obra social le cobro un tarifa sino la otra
        $obraSocial= $this->model->obtenerObraSocial($idPaciente); 

        if(!empty($obraSocial)){
            $idTarifa=1;
            $mensaje='Al poseer obra social solo tiene que abonar un adicional de $1000'; 
                      
        }else{
            $idTarifa =2;
            $mensaje='No posee obra social por lo que tiene que abonar el costo del turno que seria de $3000';
             
        }
    
         
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
                $msg='Se ha enviado un e-mail con la confirmacion del turno';
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

    //Con la confirmacion del turno se envia email al paciente
    function enviarEmailConfirmacionTurno($email){//PASAR CORREO POR PARAMETRO

           /* //destinatarios de los mensajes de confirmacion
            $to = $email;//"centenomanuela40@gmail.com";//ACA TENDRIA QUE IR EL CORREO
            $subject = "Confirmacion de turno";//asunto
            $message = "Hola! Envio confirmacion de turno para la fecha:en el horario: Muchas gracias por utilizar TurnoFacil. Cualquier consulta comunicarse a tales numero";
        
 
            mail($to, $subject, $message);*/
    }
    //Muestra los turnos que tiene el paciente
    
    function listadoPaciente(){
        
        if (!isset($_SESSION['ID_PACIENTE'])){
            session_start();
        }

        $idPaciente= $_SESSION['ID_PACIENTE'];
        //var_dump($idPaciente);
        $turnos = $this->model->obtenerTurnosPaciente($idPaciente);
        if(!empty($turnos)){
            $this->view->showList($turnos);
        }else{
            $this->view->showError("No hay turnos seleccionados");
        }
       
    }
}

?>