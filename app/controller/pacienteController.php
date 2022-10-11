<?php

    include_once 'app/models/pacienteModel.php';
    include_once 'app/views/pacienteView.php';

class PacienteController {

    private $model;
    private $views;

    function __construct() {
        $this->view = new PacienteViews();
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
        //AuthHelper::isLogueado();  //Controla que el usuario (paciente en este caso) este logueado, falta implementar la clase para el logueo
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
        //AuthHelper::isLogueado();  //Controla que el usuario (paciente en este caso) este logueado, falta implementar la clase para el logueo
       //Obtengo un medico por obra social
       $medico = $this->model->getSelectObrasocial($id);
       if($medico){
            //Actualizo la vista
            $this-> view->filtroMedicos($medico); 
       }else{
            $this->view->showError('No se encontró médico por esta obra social');
       }     
    }

  /*   
        FUNCION PARA MOSTRAR MEDICOS POR ESPACIALIDAD Y OBRA SOCIAL

    function filtroPorEspecialidadYObraSocial($id,$id){
        //AuthHelper::isLogueado();  //Controla que el usuario (paciente en este caso) este logueado, falta implementar la clase para el logueo
        $medico = $this->model->getAllEspecialidadYObrasocial($id, $id);
        if($medico){
            //Actualizo la vista
            $this-> view->filtroMedicos($medico); 
       }else{
            $this->view->showError('No se encontró médico');
       } 
    }
 */





}

?>