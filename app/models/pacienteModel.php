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
    function obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $especialidad){

        // dependiendo si elige de mañana o tarde el rango elegido para filtrar turnos son esos horarios
        if ($turno == 'maniana'){
            $hora_desde=8;
            $hora_hasta=12;
        }else{
            $hora_desde=15;
            $hora_hasta=20;
        }

        // busco los turnos disponibles
        $query = $this->db->prepare("SELECT * FROM turno as t inner join usuario as u on t.turno_id_medico = u.usuario_id
        WHERE fecha_disponible between ? and ? and turno between ? and ? and usuario_id_especialidad = ? and usuario_id_rol = 1 and turno_ocupado = 0 ORDER BY  AS;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $hora_desde, $hora_hasta, $especialidad]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;

    }

    /**
     * Obtiene los mutuales que atienden los medicos del sistema
     */
    function obtenerMutuales(){

        $query = $this->db->prepare("SELECT * FROM obra_social ORDER BY os_nombre;");
        $query->execute([]);
        $mutuales = $query->fetchAll(PDO::FETCH_OBJ);
        return $mutuales;
    }

    /**
     * Obtiene las diferentes especialidades registradas en el sistema
     */
    function obtenerEspecialidadesDeMedicos(){

        $query = $this->db->prepare("SELECT * FROM especialidad ORDER BY esp_nombre;");
        $query->execute([]);
        $especialidades = $query->fetchAll(PDO::FETCH_OBJ);
        return $especialidades;
    }

}

?>