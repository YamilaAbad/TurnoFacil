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





}

?>