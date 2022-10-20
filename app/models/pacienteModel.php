<?php

include_once 'app/helpers/DB.helper.php';

class PacienteModel {

    private $db;
    private $dbHelper;

    function __construct(){
        $this->dbHelper = new DBHelper();
        //Abrimos la conexion a la bd
        $this->db = $this->dbHelper->connect();
    }

    /******************************* OBTENEMOS LOS MEDICOS POR ESPECIALIDAD****************************************************/
    function getSelectEspecialidad($id){
        $query=$this->db->prepare('SELECT u.usuario_nombre, u.usuario_apellido, r.rango_horario_inicial, r.rango_horario_final, r.rango_dia 
                                    FROM usuario u 
                                    INNER JOIN medico m ON (u.usuario_id = m.medico_usuario_id)
                                    INNER JOIN rango_horario r ON (m.medico_id_rango_horario = r.rango_id)
                                    WHERE m.medico_id_especialidad = ?)');
        $query->execute([$id]);
        $medico=$query->fetch(PDO :: FETCH_OBJ);
        return $medico;
    }


    /**
     * Obtiene los dias de atencion con turnos disponibles para el rango elegido de un medico en particular
     */
    function obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico){

        $query = $this->db->prepare("SELECT * FROM turno
        WHERE fecha_disponible between ? and ? and turno = ? ORDER BY fecha_disponible, turno_hora;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $turno, $medico]);
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

    /********************************* NUEVA FUNCIÓN PARA OBTENER LOS MEDICOS QUE TRABAJAR POR OBRA SOCIAL ************/
    //si pasa el test reemplazar la sentencia sql en getSelectObrasocial
        function getSelectObrasocial($id){
            $query=$this->db->prepare('SELECT u.usuario_nombre, u.usuario_apellido, r.rango_horario_inicial, r.rango_horario_final, r.rango_dia
                                        FROM usuario u 
                                        INNER JOIN medico m ON (u.usuario_id = m.medico_usuario_id)
                                        INNER JOIN rango_horario r ON (m.medico_id_rango_horario = r.rango_id)
                                        INNER JOIN medico_os med ON (u.usuario_id = med.mos_id_medico)
                                        WHERE med.mos_id_obrasocial = ( SELECT o.os_id FROM obra_social o WHERE o.os_id = ?)');
            $query->execute([$id]);
            $medico=$query->fetch(PDO :: FETCH_OBJ);
            return $medico;
    }

    /******************************OBTENEMOS DIAS, HORARIOS Y MEDICOS FILTADROS POR OBRA SOCIAL Y ESPECIALIDAD*********************/
    //revisar pasajes de id - sujeto a mejoras -
    function getAll($id1, $id2){

        $query=$this->db->prepare('SELECT u.usuario_nombre, u.usuario_apellido, r.rango_horario_inicial, r.rango_horario_final, r.rango_dia
                                    FROM usuario u 
                                    INNER JOIN medico m ON (u.usuario_id = m.medico_usuario_id)
                                    INNER JOIN rango_horario r ON (m.medico_id_rango_horario = r.rango_id)
                                    INNER JOIN medico_os med ON (u.usuario_id = med.mos_id_medico)
                                    WHERE med.mos_id_obrasocial = ( SELECT o.os_id FROM obra_social o WHERE o.os_id = ? AND m.medico_id_especialidad = ?)');
        $query->execute([$id1,$id2]);
        $medico=$query->fetch(PDO :: FETCH_OBJ);
        return $medico;

    }

}
?>

