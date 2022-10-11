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
            $query=$this->db->prepare('SELECT u.usuario_nombre, u.usuario_apellido FROM usuario u WHERE usuario_id_rol = 1 AND usuario_id_especialidad = ?');
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
    }

?>

