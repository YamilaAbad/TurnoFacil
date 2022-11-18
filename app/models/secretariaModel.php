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



    /**
     * Obtiene los medicos con los que trabaja la secretaria
     * VER EL WHERE CUANDO BRENDA HAGA LO DE LA SESION DE LA SECRETARIA
     */
    function obtenerMedicos(){

        $query = $this->db->prepare("SELECT * FROM `secretaria` s inner join medico m on s.medico_asociado = m.medico_id WHERE s.id_usuario=7;");
        $query->execute([]);
        $query->execute();
        $medicos = $query->fetchAll(PDO::FETCH_OBJ);
        return $medicos;
    }

        /**
     * Obtiene las mutuales por las que trabaja el medico seleccionado
     */
    function obtenerMutuales($idMedico){

        $query = $this->db->prepare("SELECT * FROM medico_os WHERE mos_id_medico = ? ORDER BY os_nombre;");
        $query->execute([$idMedico]);
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
     * Verifica si exite el paciente en cuestion 
     */
    function existePaciente($dni){

        $query = $this->db->prepare("SELECT * FROM paciente where paciente_dni = ?;");
        $query->execute([$dni]);
        return $query->rowCount();
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

    

}   

?>

