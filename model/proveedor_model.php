<?php
    
    class proveedor_model{
        private $DB;
        private $proveedor;

        function __construct(){
            $this->DB=Database::connect();
        }

        function get(){
            $sql= 'SELECT * FROM estudiante ORDER BY id DESC';
            $fila=$this->DB->query($sql);
            $this->probedor=$fila;
            return  $this->proveedor;
        }


        function create($data){

            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="INSERT INTO proveedor(id,nombre,apellidos,rfc,direccion,estado,ciudad,telefono)VALUES (?,?,?,?,?,?,?,?)";

            $query = $this->DB->prepare($sql);
            $query->execute(array($data['id'],$data['nombre'],$data['apellidos'],$data['rfc'],$data['direccion'],$data['estado'],$data['ciudad'],$data['telefono']));
            Database::disconnect();       

        }






        function get_id($id){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM proveedor where id = ?";
            $q = $this->DB->prepare($sql);
            $q->execute(array($id));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            return $data;
        }



        
        function update($data,$date){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE proveedor  set nombre =?, apellidos=?,rfc=?, direccion=?, estado=?,ciudad=?, telefono=? WHERE id = ? ";
            $q = $this->DB->prepare($sql);
            $q->execute(array($data['nombre'],$data['apellidos'],$data['rfc'],$data['direccion'],$data['estado'],$data['ciudad'],$data['telefono'], $date));
            Database::disconnect();

        }

        function delete($date){
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql="DELETE FROM proveedor where id=?";
            $q=$this->DB->prepare($sql);
            $q->execute(array($date));
            Database::disconnect();
        }
    }
?>

