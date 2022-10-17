<?php
    include_once 'app/models/pacienteModel.php';
    include_once 'app/views/pacienteView.php';

class PacienteController {

    private $model;
    private $view;

    function __construct() {
        
        $this->view = new PacienteView();
        $this->model = new PacienteModel();
 
    }


    /*
        Como paciente quiero poder filtrar días y horarios de atención del médico elegido para poder elegir un día
        
        Criterios: 
            Ingresar un rango de fecha para mostrar los días que el paciente prefiere asistir.
            Permitir buscar si es turno mañana o tarde.
            Mostrar la siguiente semana,  en caso de no encontrar en el rango ingresado.
    */
    function filtrarDiasDeAtencion ($medico){

        $rangoElegidoD= $_POST['fecha_desde'];
        $rangoElegidoH= $_POST['fecha_hasta'];
        $turno = $_POST['turno'];

        $filtro=$this->modelPaciente->obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico);

        if (!empty($filtro)){
            $mensaje="Seleccione el dia que desea y confirme por favor";
        }else{
            // si no encuentra resultados en la semana elegida muestra la semana siguiente
            $rangoElegidoD= date("d-m-Y",strtotime($rangoElegidoD."+ 7 days")); 
            //sumo 7 dias
            $rangoElegidoH= date("d-m-Y",strtotime($rangoElegidoH."+ 7 days")); 
            $filtro=$this->modelGestion->obtenerHorariosDeAtencion($rangoElegidoD +7, $rangoElegidoH + 7, $turno, $medico);
            if (!empty($filtro)){
                $mensaje="Seleccione el dia que desea y confirme por favor";
            }else{
                $mensaje="El medico elegido no tiene turnos disponibles para el rango elegido ni para la siguiente semana. Por favor elija otro medico o intente otra fecha.";
            }
        }
        $this->view->mostrarResultados($filtro,$mensaje);


    }

    function showTemplate(){
        $this->view->showTemplate();
    }

    function showNewTurn(){
        $this->view->showNewTurn();
    }

    function showDatos(){
        $this->view->showDatos();
    }
}

?>