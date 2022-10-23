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
        WHERE t.turno_fecha between ? and ? and m.especialidad_id = ? and t.turno_ocupado = 0 ORDER BY t.turno_fecha, t.turno_hora;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $especialidad]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;
    }

    /**
     * Obtiene los dias de atencion con turnos disponibles para el rango elegido de un medico en particular
     */
    function obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno){

        // dependiendo si elige de mañana o tarde el rango elegido para filtrar turnos son esos horarios
        if ($turno == 'maniana'){
            $hora_desde='08:00:00';
            $hora_hasta='12:00:00';
        }else{
            $hora_desde='15:00:00';
            $hora_hasta='20:00:00';
        }

        // busco los turnos disponibles
        $query = $this->db->prepare("SELECT * FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE t.turno_fecha between ? and ? and t.turno_hora between ? and ? and turno_ocupado = 0 ORDER BY turno_fecha, turno_hora ;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $hora_desde, $hora_hasta]);
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
     * Obtiene los medicos que atienden los medicos del sistema
     */
    function obtenerMedicos(){

        $query = $this->db->prepare("SELECT * FROM medico m inner join especialidad e on m.especialidad_id = e.esp_id ORDER BY medico_apellido, medico_nombre;");
        $query->execute([]);
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
        return $query->rowCount();
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
    function existeEmailUsuario($correo){
        $query = $this->db->prepare("SELECT * FROM paciente where paciente_email = ?;");
        $query->execute([$correo]);
        $email = $query->fetch(PDO::FETCH_OBJ);
        return $email;
    }

    function existeUsuario($idPaciente){
        $query = $this->db->prepare("SELECT * FROM paciente where paciente_id = ?;");
        $query->execute([$idPaciente]);
        $idPaciente = $query->fetch(PDO::FETCH_OBJ);
        return $idPaciente;
    }

    //Cambia el turno Disponible a ocupado
    function cambiarTurnoOcupado($IDPaciente,$turnoOcupado,$IDTarifa){
       //DUDA SI HACERLO ASI
            $query = $this->db->prepare('UPDATE turno SET turno_id_paciente=?, turno_ocupado=1, turno_id_tarifa=? WHERE turno_id = ?');
            $query->execute([$IDPaciente,$turnoOcupado,$IDTarifa]);
          
    }

    

}   

?>

