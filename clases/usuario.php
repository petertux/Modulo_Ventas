<?php
class usuario{
//Se crea la clase usuario con todos sus atributos
    public $id_usuario;
    public $servicio;
    public $usuario;
    public $clave_temp;
    public $clave_def;
    public $fecha_registro;
    public $fecha_modificacion;
    public $fecha_ult_pwd;
    public $descripcion;
    public $estado;
    public $fecha_ult_ing;
    public $fecha_ingreso;
    public $hora_ingreso;
    public $hora_fin;

//Es el metodo para poder intersar en la tabla.
    public function agregar(){
      //$query="INSERT INTO cliente(id_cliente, primer_nombre, 'segundo_nombre', 'primer_apellido', 'direccion', 'telefono', 'dir_ins', 'nit') VALUES ('[this->$id_cliente]','[this->$primer_nombre]','[this->$segundo_nombre]','[this->$primer_apellido]','[this->$segundo_apellido]','[this->$direccion]','[this->$telefono]','[this->$dir_ins]','[this->$nit]')";
    $query="INSERT INTO usuario VALUES ('{$this->id_usuario}',
                                        '{$this->servicio}',
                                        '{$this->usuario}',
                                        '{$this->clave_temp}',
                                        '{$this->clave_def}',
                                        '{$this->fecha_registro}',
                                        '{$this->fecha_modificacion}',
                                        '{$this->fecha_ult_pwd}',
                                        '{$this->descripcion}',
                                        '{$this->estado}',
                                        '{$this->fecha_ult_ing}')";
    mysql_query($query) or die ("Problema con query Para insertar nuevo usuario");

    }

      public function mostrar(){
        $query="SELECT * from usuario";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }

        public function secqnos(){
        $query="SELECT siguiente from seqnos where tabla='usuario'";
        $rs=mysql_query($query);
        if (!$rs) {
                           echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                    exit;}
        $fila = mysql_fetch_row($rs);
        $num=$fila[0];
         $num = (int)$num;
             return $num;
        }

         public function Upsecqnos(){
        $query2="SELECT siguiente from seqnos where tabla='usuario' and bdatos='bdatos'";
        $rs=mysql_query($query2);
        if ($row = mysql_fetch_row($rs)) {
        $num = trim($row[0]);}
         $num = (int)$num+1;
      $query= "UPDATE seqnos set siguiente='".$num."'where tabla='usuario'";
        $resultado = mysql_query($query) or die ("Problema para actualizar tabla de secuenciales ");
           return $resultado;
}
    public function login_user(){
      //$query="INSERT INTO cliente(id_cliente, primer_nombre, 'segundo_nombre', 'primer_apellido', 'direccion', 'telefono', 'dir_ins', 'nit') VALUES ('[this->$id_cliente]','[this->$primer_nombre]','[this->$segundo_nombre]','[this->$primer_apellido]','[this->$segundo_apellido]','[this->$direccion]','[this->$telefono]','[this->$dir_ins]','[this->$nit]')";
    $query="INSERT INTO log_usuario VALUES (null,'{$this->id_usuario}',
                                        '{$this->usuario}',
                                        '{$this->fecha_ingreso}',
                                        '{$this->hora_ingreso}',
                                        '{$this->hora_fin}')";
    mysql_query($query) or die ("Problema con query");
    }

        public function nom_usuario($usuario){
        $query="SELECT id_usuario from usuario where usuario='".$usuario."'";
        $rs=mysql_query($query);
        if ($row = mysql_fetch_row($rs)) {
        $num = trim($row[0]);}
         $num = (int)$num;

             return $num;
        }
}
?>