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
     * Obtiene los dias de atencion de un medico en particular
     */
    function obtenerHorariosDeAtencionPorMedico($rangoElegidoD, $rangoElegidoH, $medico){

        // busco los turnos disponibles
        $query = $this->db->prepare("SELECT * FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE t.turno_fecha between ? and ? and t.turno_id_medico = ? and t.turno_ocupado = 0 ORDER BY t.turno_fecha, t.turno_hora;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;
    }

    /**
     * Obtiene los dias de atencion por una obra social en particular
     */
    function obtenerHorariosDeAtencionPorMutual($rangoElegidoD, $rangoElegidoH, $mutual){

        $query = $this->db->prepare("SELECT * FROM turno t 
            inner join medico m on t.turno_id_medico = m.medico_id 
            inner join medico_os mo on m.medico_id = mo.mos_id_medico
        WHERE turno_fecha between ? and ? and mo.mos_id_obrasocial = ? and turno_ocupado = 0 ORDER BY turno_fecha, turno_hora;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $mutual]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;
    }

    /**
     * Obtiene los dias de atencion por especialidad
     */
    function obtenerHorariosDeAtencionPorEspecialidad($rangoElegidoD, $rangoElegidoH, $especialidad){

        $query = $this->db->prepare("SELECT * FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE t.turno_fecha between ? and ? and m.medico_id_especialidad = ? and t.turno_ocupado = 0 ORDER BY t.turno_fecha, t.turno_hora;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $especialidad]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;
    }

    /**
     * Obtiene los dias de atencion con turnos disponibles para el rango elegido de un medico en particular
     */
    function obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico){

        // dependiendo si elige de mañana o tarde el rango elegido para filtrar turnos son esos horarios
        if ($turno == 'tarde'){
            $hora_desde='15:00:00';
            $hora_hasta='20:00:00';
        }else{
            $hora_desde='08:00:00';
            $hora_hasta='12:00:00';
        }

        // busco los turnos disponibles
        $query = $this->db->prepare("SELECT * FROM turno t
        WHERE t.turno_fecha between ? and ? and t.turno_hora between ? and ? and t.turno_ocupado = 0 and t.turno_id_medico = ? ORDER BY turno_fecha, turno_hora ;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $hora_desde, $hora_hasta, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;

    }

    /**
     * Obtiene los mutuales que atienden los medicos del sistema
     */
    function obtenerMutuales(){

        $query = $this->db->prepare("SELECT * FROM obra_social ORDER BY os_nombre;");
        $query->execute();
        $mutuales = $query->fetchAll(PDO::FETCH_OBJ);
        return $mutuales;
    }

    /**
     * Obtiene los medicos que atienden los medicos del sistema
     */
    function obtenerMedicos(){

        $query = $this->db->prepare("SELECT * FROM medico m inner join especialidad e on m.medico_id_especialidad = e.esp_id ORDER BY medico_apellido, medico_nombre;");
        $query->execute();
        $medicos = $query->fetchAll(PDO::FETCH_OBJ);
        return $medicos;
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

    /**
     * Registra un nuevo paciente 
     */
    function registrarPaciente($dni, $nombre, $apellido, $domicilio, $telefono, $email){

        $query = $this->db->prepare('INSERT INTO paciente (paciente_dni, paciente_nombre, paciente_apellido, paciente_domicilio, paciente_telefono, paciente_email ) VALUES (?,?,?,?,?,?)');
        $query->execute([$dni, $nombre, $apellido, $domicilio, $telefono, $email]);
        return $this->db->lastInsertId();
    }

    /**
     * Registra un nuevo paciente 
     */
    function registraMutualPaciente($paciente, $mutual, $afiliado){

        $query = $this->db->prepare('INSERT INTO paciente_os (pos_id_obrasocial, pos_id_paciente, pos_n_afiliado ) VALUES (?,?,?)');
        $query->execute([$mutual,$paciente, $afiliado]);
        return $this->db->lastInsertId();
    }

    /**
     * Verifica si exite el paciente en cuestion 
     */
    function existePaciente($dni){

        $query = $this->db->prepare("SELECT * FROM paciente where paciente_dni = ?;");
        $query->execute([$dni]);
        //return $query->rowCount();
        return $query->fetch(PDO::FETCH_OBJ);
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

    // Verifica si tiene email el paciente para enviar confirmacion
    function existeEmailUsuario($idPaciente){

        $query = $this->db->prepare("SELECT paciente_email FROM paciente WHERE paciente_id=?");
        $query->execute([$idPaciente]);
        $email = $query->fetch(PDO::FETCH_OBJ);
        return $email;
    }

    function obtenerObraSocial($idPaciente){

        $query = $this->db->prepare("SELECT pos_id_obrasocial FROM paciente_os WHERE pos_id_paciente =?");
        $query->execute([$idPaciente]);
        // devuelve cantidad de filas
        $idObraSocial = $query->rowCount();
        return $idObraSocial;
    

    }

    /*
     * Registra el turno elegido para el paciente elegido con la tarifa correspondiente
     */
    function cambiarTurnoOcupado($idPaciente,$idTarifa,$idTurno){
           
        $query = $this->db->prepare('UPDATE turno SET turno_id_paciente=?, turno_id_tarifa=?, turno_ocupado=1 WHERE turno_id = ?');
        $query->execute([$idPaciente,$idTarifa,$idTurno]);
        return $query->rowCount();

          
    }

    /*
     * Registra el turno elegido para el paciente elegido con la tarifa correspondiente
     */
    function obtenerInfoTurno($idTurno){

        $query = $this->db->prepare('SELECT * FROM medico 
            INNER JOIN turno ON medico.medico_id = turno.turno_id_medico
            INNER JOIN tarifa ON tarifa.tarifa_id = turno.turno_id_tarifa
            WHERE turno.turno_id=?');
        $query->execute([$idTurno]);
        return $turno =$query->fetchAll(PDO::FETCH_OBJ);

    }

    /*****************************FILTRO DE TURNOS PACIENTE**********************************/
    /*
    *Filtra los turnos de un paciente dado, mostrará el nombre del medico, especialidad, dia y horario de atención
    *del turno correspondiente
    */

   function obtenerTurnosPaciente($idPaciente){
        $query = $this->db->prepare('SELECT m.medico_nombre,e.esp_nombre,t.turno_fecha,t.turno_hora
                                    FROM paciente p 
                                    INNER JOIN turno t ON (t.turno_id_paciente = p.paciente_id)
                                    INNER JOIN medico m ON (t.turno_id_medico = m.medico_id)
                                    INNER JOIN especialidad e ON (m.medico_id_especialidad=e.esp_id)
                                    WHERE p.paciente_id = ?
                                    ORDER BY t.turno_fecha ASC');
        $query->execute([$idPaciente]);
        return $turnos = $query -> fetchAll(PDO::FETCH_OBJ);
   }

}   

?>

