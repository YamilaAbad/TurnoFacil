<?php
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

    /********************************* OBTENEMOS LOS MEDICOS QUE TRABAJAN POR UNA OBRA SOCIAL ************************************/
        function getSelectObrasocial($id){
            $query=$this->db->prepare('SELECT u.usuario_nombre, u.usuario_apellido FROM usuario u 
                                        INNER JOIN medico_os m ON u.usuario_id = m.mos_id_medico 
                                        WHERE mos_id_obrasocial =( SELECT os_id FROM obra_social WHERE os_id =?)');
            $query->execute([$id]);
            $medico=$query->fetch(PDO :: FETCH_OBJ);
            return $medico;
        }

    /********************************* NUEVA FUNCIÓN PARA OBTENER LOS MEDICOS QUE TRABAJAR POR OBRA SOCIAL - REVISAR -************/
    //si pasa el test reemplazar la sentencia sql en getSelectObrasocial
        function getSelectObrasocial2($id){
            $query=$this->db->prepare('SELECT u.usuario_nombre, u.usuario_apellido, r.rango_horario_inicial, r.rango_horario_final, r.rango_dia
                                        FROM usuario u 
                                        INNER JOIN medico m ON (u.usuario_id = m.medico_usuario_id)
                                        INNER JOIN rango_horario r ON (m.medico_id_rango_horario = r.rango_id)
                                        INNER JOIN medico_os med ON (u.usuario_id = med.mos_id_medico)
                                        WHERE med.mos_id_obrasocial = ( SELECT o.os_id FROM obra_social o WHERE os_id = ?)');
            $query->execute([$id]);
            $medico=$query->fetch(PDO :: FETCH_OBJ);
            return $medico;
    }
}

?>

