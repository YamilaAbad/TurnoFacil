<?php
    include_once 'app/models/pacienteModel.php';
    include_once 'app/views/pacienteView.php';

class PacienteController {

    private $model;
    private $views;

    function __construct() {
        
        $this->view = new PacienteView();
        $this->model = new PacienteModel();
    }
    /* "Como paciente quiero ver la lista de médicos para seleccionar
    uno"
    CRITERIO DE ACEPTACIÓN:
        -Seleccionar un médico
        -Permitir filtrar médicos por especialidad y obra social que trabaja
        -Mostrar días y horarios que atiende un médico
    */

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
        
        $mutuales=$this->model->obtenerMutuales();
        $dni= $_POST['dni'];
        if (!empty($dni) && $d=$this->model->existePaciente($dni) > 0){
            // si existe le muestro la pantalla de opciones de lo que puede hacer el paciente
            $this->view->showOpciones($mensaje = '');
        }else{
            // si no existe registro el paciente
            $this->view->showTemplate($mutuales,$dni);
        }
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

        // muestra la home de usuario
        $this->view->homePaciente($mensaje);

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
        $obraSocial=$this->model->obtenerMutuales();
        
        // tomo los datos filtrados en el formulario
        $rangoElegidoD= $_POST['fechaDesde'];
        $rangoElegidoH= $_POST['fechaHasta'];
        $turno = $_POST['turno'];
        $mutual = $_POST['obra_elegida'];
        $especialidad = $_POST['especialidad'];
        
        // aca debo traer dos tipos de filtro 
        /**
         * 1- que filtre los medicos de determinada mutual u obra social 
         * 2- que filtre para un medico en especial 
         */
        $filtro=$this->model->obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $especialidad);

        if (!empty($filtro)){
            $mensaje="Seleccione el dia que desea y confirme por favor";
        }else{
            // si no encuentra resultados en la semana elegida muestra la semana siguiente
            $rangoElegidoD= date("d-m-Y",strtotime($rangoElegidoD."+ 7 days")); 
            //sumo 7 dias
            $rangoElegidoH= date("d-m-Y",strtotime($rangoElegidoH."+ 7 days")); 
            $filtro=$this->model->obtenerHorariosDeAtencion($rangoElegidoD +7, $rangoElegidoH + 7, $turno, $especialidad);
            if (!empty($filtro)){
                $mensaje="Seleccione el dia que desea y confirme por favor";
            }else{
                $mensaje="El medico elegido no tiene turnos disponibles para el rango elegido ni para la siguiente semana. Por favor elija otro medico o intente otra fecha.";
            }
        }
        $this->view->mostrarResultados($filtro,$mensaje);


    }

    /*
        * pantalla inicial para sacar un turno el paciente
    */
    function obtenerTurno(){

        $especialidades=$this->model->obtenerEspecialidadesDeMedicos();
        $mutuales=$this->model->obtenerMutuales();
        $this->view->nuevoTurno($especialidades,$mutuales, $mensaje = '');
    }

    /*
        * aca registra el turno elegido para el paciente
    */
    function registrarTurno(){

        // post del formulario de la tabla 
        // cambiar el estado en turno a ocupado ... el id_paciente
        // lo de la tarifa ver si tiene adicional
        // y el email mostrando la pantalla de confirmacion confirmacion.turno.tpl

    }

    function showTemplate(){
        $this->view->showTemplate();
    }

    function showDatos(){
        $this->view->showDatos();
    }
}

?>