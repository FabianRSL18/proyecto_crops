<?php
require_once ('config.class.php');
    class Sistema{
        var $con;
        function conexion(){
            $this -> con = new PDO(SGBD.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT, DBUSER, DBPASS);
        }

        function alert($tipo,$mensaje){
            include('views/alert.php');
        }

        function get_rol($correo) {
            $this->conexion();
            $data = [];
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT u.correo, p.permiso
                        FROM usuario u
                        JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                        JOIN rol r ON ur.id_rol = r.id_rol
                        JOIN rol_permiso rp ON r.id_rol = rp.id_rol
                        JOIN permiso p ON rp.id_permiso = p.id_permiso
                        WHERE u.correo = :correo
                        LIMIT 0, 25;";
                $roles = $this->con->prepare($sql);
                $roles->bindParam(':correo', $correo, PDO::PARAM_STR);
                $roles->execute();
                $data = $roles->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }
        
        function get_privilegio($correo) {
            $this->conexion();
            $data = [];
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $sql = "SELECT r.rol
                        FROM usuario u
                        INNER JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                        INNER JOIN rol r ON r.id_rol = ur.id_rol
                        WHERE u.correo = :correo;";
                $privilegio = $this->con->prepare($sql);
                $privilegio->bindParam(':correo', $correo, PDO::PARAM_STR);
                $privilegio->execute();
                $data = $privilegio->fetchAll(PDO::FETCH_ASSOC);
            }
            return $data;
        }
        
    }
?>