<?php

include_once 'app/helpers/DB.helper.php';
class PacienteModel {

    private $db;
    private $dbHelper;

    function __construct() {
        
        $this->dbHelper = new DBHelper();
        // me conecto a la BD
        $this->db = $this->dbHelper->connect();
    }

    /**
     * Obtiene los dias de atencion con turnos disponibles para el rango elegido de un medico en particular
     */
    function obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico){

        $query = $this->db->prepare("SELECT * FROM turno
        WHERE fecha_disponible between ? and ? and turno = ? and turno_id_medico= ? ORDER BY  AS;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $turno, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;

    }

}

?>