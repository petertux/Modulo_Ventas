<?php
    class materia{

    public $id_materia;
    public $descripcion;
    public $min_stock;
    public $max_stock;
    public $estado;
    public $cant_per_unit;
    public $id_artunidad;
	public $fecha_creacion;


     public function agregar(){
    $query="INSERT INTO materia_prima VALUES ('{$this->id_materia}',
                                        '{$this->descripcion}',
                                        '{$this->min_stock}',
                                        '{$this->max_stock}',
                                        '{$this->estado}',
                                        '{$this->cant_per_unit}',
                                        '{$this->id_artunidad}',
										'{$this->fecha_creacion}')";
    $result=mysql_query($query) or die ("Problema con query de Insertar");
     return $result;
    }

        public function secqnos(){
        $query="SELECT siguiente from seqnos where tabla='materia_prima'";
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
        $query2="SELECT siguiente from seqnos where tabla='materia_prima'";
        $rs=mysql_query($query2);
        if ($row = mysql_fetch_row($rs)) {
        $num = trim($row[0]);}
         $num = (int)$num+1;
      $query= "UPDATE seqnos set siguiente='".$num."'where tabla='materia_prima'";
        $resultado = mysql_query($query) or die ("Problema con query");
           return $resultado;
		}
		 
		public function mostrar(){
        $query="SELECT `id_materia`,
						`materia_prima`.`descripcion`,
						`min_stock`,
						`max_stock`,
						`materia_prima`.`estado`,
						`cant_per_unit`,
						`articulo_uni`.`descripcion`categoria
						FROM `materia_prima`,`articulo_uni`
						where  `materia_prima`.`id_artunidad` =`articulo_uni`.`id_uniart` limit 9";
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		public function mostrar_byid($id){
		$query="SELECT `descripcion`,
						`min_stock`,
						`max_stock`,
						`estado`,
						`cant_per_unit`
						FROM `materia_prima`
						where `id_nateria`='".$id."'";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		//Corregir!! el Where
		public function asignar_cita(){
		$query="UPDATE `cita`
		     SET `nombre`='{$this->nombre}',
			`apellido`= '{$this->apellido}',
			`telefono`='{$this->telefono}',
			`direccion`='{$this->direccion}',
			`email`='{$this->email}',
			`id_estado`='{$this->id_estado}',
			WHERE `id_cita`";

        $result=mysql_query($query) or die ("Problema con query de Actualizar");
     return $result;
		}
		
		public function mostrar_categoria(){
        $query="SELECT `descripcion`,
						`url`,
                        `id_categoria`
						FROM `articulo_cat`
						WHERE `estado` = 'A'
						ORDER BY `descripcion` ASC
						LIMIT 0 , 30";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
}
?>