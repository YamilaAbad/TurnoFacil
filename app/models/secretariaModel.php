<?php

include_once 'app/helpers/DB.helper.php';

class SecretariaModel {

    private $db;
    private $dbHelper;

    function __construct(){
        $this->dbHelper = new DBHelper();
        //Abrimos la conexion a la bd
        $this->db = $this->dbHelper->connect();
    }

    /**
     * Verifica que la secretaria ingrese sus datos correctos
     */
    function existeUsuario($user, $pass){

        $query = $this->db->prepare("SELECT * FROM usuario 
        WHERE usuario_user = ? and usuario_contrasenia = ? and usuario_id_rol = 2");
        $query->execute([$user, $pass]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Obtiene los dias de atencion de un medico en particular
     */
    function obtenerHorariosDeAtencionPorMedico($rangoElegidoD, $rangoElegidoH, $medico){


        /* SELECT DISTINCT(t.turno_id), m.*, t.* FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE  t.turno_id_medico = 4 and t.turno_ocupado = 0 ORDER BY t.turno_fecha, t.turno_hora;*/

        $query = $this->db->prepare("SELECT * FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE t.turno_fecha between ? and ? and t.turno_id_medico = ? and t.turno_ocupado = 0 ORDER BY t.turno_fecha, t.turno_hora;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;
    }

    /**
     * Obtiene los dias de atencion con turnos disponibles para el rango elegido de un medico en particular
     */
    function obtenerHorariosDeAtencion($rangoElegidoD, $rangoElegidoH, $turno, $medico){

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
        WHERE t.turno_fecha between ? and ? and t.turno_hora between ? and ? and turno_ocupado = 0 and t.turno_id_medico = ? ORDER BY turno_fecha, turno_hora ;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $hora_desde, $hora_hasta, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;

    }

    function obtenerHorariosDeAtencionManiana($rangoElegidoD, $rangoElegidoH, $medico){

        // busco los turnos disponibles
        $query = $this->db->prepare("SELECT * FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE t.turno_fecha between ? and ? and t.turno_id_medico = ? and t.turno_hora > '08:00:00' and t.turno_hora < '12:00:00' and turno_ocupado = 0 ORDER BY turno_fecha, turno_hora ;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;

    }

    function obtenerHorariosDeAtencionTarde($rangoElegidoD, $rangoElegidoH, $medico){

        // busco los turnos disponibles
        $query = $this->db->prepare("SELECT * FROM turno t inner join medico m on t.turno_id_medico = m.medico_id
        WHERE t.turno_fecha between ? and ? and t.turno_id_medico = ? and t.turno_hora > '15:00:00' and t.turno_hora < '20:00:00' and turno_ocupado = 0 ORDER BY turno_fecha, turno_hora ;");
        $query->execute([$rangoElegidoD, $rangoElegidoH, $medico]);
        $turnos = $query->fetchAll(PDO::FETCH_OBJ);
        return $turnos;

    }



    /**
     * Obtiene los medicos con los que trabaja la secretaria
     * VER EL WHERE CUANDO BRENDA HAGA LO DE LA SESION DE LA SECRETARIA
     */
    function obtenerMedicos(){

        $query = $this->db->prepare("SELECT * FROM `secretaria_de_medicos` s inner join medico m on s.id_medico = m.medico_id WHERE s.id_secretaria=1;");
        $query->execute();
        $medicos = $query->fetchAll(PDO::FETCH_OBJ);
        return $medicos;
        
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
     * Obtiene las diferentes especialidades registradas en el sistema
     */
    function obtenerEspecialidades(){

        $query = $this->db->prepare("SELECT * FROM especialidad ORDER BY esp_nombre;");
        $query->execute([]);
        $especialidades = $query->fetchAll(PDO::FETCH_OBJ);
        return $especialidades;
    }

    /**
     * Verifica si exite el paciente en cuestion 
     */
    function existePaciente($dni){

        $query = $this->db->prepare("SELECT paciente_dni FROM paciente where paciente_dni = ?;");
        $query->execute([$dni]);
        return $query->fetch(PDO::FETCH_OBJ);;
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
    * obtengo el id_paciente 
     */
    function obtenerIdPaciente($paciente){

        $query = $this->db->prepare("SELECT paciente_id FROM paciente WHERE paciente_dni =?");
        $query->execute([$paciente]);
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

    

}   

?>

