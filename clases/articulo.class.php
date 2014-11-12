<?php
    class articulo{

    public $id_articulo;
    public $descripcion;
    public $min_stock;
    public $estado;
    public $cant_per_unit;
    public $id_categoria;
	public $fecha_creacion;
	public $disponible_web;
    public $precio;
    public $id_art_precio;
    public $fecha_desde;
    public $fecha_hasta;
	public $id_coti_detalle;
	public $cantidad;
	public $total;
	public $alto;
    public $largo;
    public $area;
	public $volumen;
    public $id_cotizacion;


     public function agregar(){
    $query="INSERT INTO articulo_ter VALUES ('{$this->id_articulo}',
                                        '{$this->descripcion}',
                                        '{$this->min_stock}',
                                        '{$this->estado}',
										'{$this->fecha_creacion}',
                                        '{$this->cant_per_unit}',
										'{$this->disponible_web}',
										'{$this->id_categoria}')";
     $result=mysql_query($query) or die ("Problema con query de Insertar");
     return $result;
    }

        public function secqnos($tabla){
        $query="SELECT siguiente from seqnos where tabla='".$tabla."'";
        $rs=mysql_query($query);
        if (!$rs) {
                    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                    exit;}
        $fila = mysql_fetch_row($rs);
        $num=$fila[0];
         $num = (int)$num;
             return $num;
        }

        public function Upsecqnos($tabla){
        $query2="SELECT siguiente from seqnos where tabla='".$tabla."'";
        $rs=mysql_query($query2);
        if ($row = mysql_fetch_row($rs)) {
        $num = trim($row[0]);}
         $num = (int)$num+1;
      $query= "UPDATE seqnos set siguiente='".$num."'where tabla='".$tabla."'";
        echo $query;
        $resultado = mysql_query($query) or die ("Problema con query");
           return $resultado;
		}
		 
		public function mostrar(){
        $query="SELECT `id_articulo`,
						`articulo_ter`.`descripcion`,
						`min_stock`,
						`articulo_ter`.`estado`,
						`cant_per_unit`,
                        `imagen`
						FROM `articulo_ter`,`articulo_cat`
						where  `articulo_ter`.`id_categoria` =`articulo_cat`.`id_categoria`
						AND limit 10";
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		public function mostrar2($id){
        $query="SELECT `id_articulo`,
						`articulo_ter`.`descripcion`,
						`min_stock`,
						`articulo_ter`.`estado`,
						`cant_per_unit`,
                        `imagen`
						FROM `articulo_ter`,`articulo_cat`
						WHERE  `articulo_ter`.`id_categoria` =`articulo_cat`.`id_categoria`
						AND `id_articulo` =" . $id;
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";

		//echo $query;
		//die();
						
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		public function mostrar_articulo($id){
        $query="SELECT `id_articulo`,
						`articulo_ter`.`descripcion`
						FROM `articulo_ter`,`articulo_cat`
						WHERE  `articulo_ter`.`id_categoria` =`articulo_cat`.`id_categoria`
						AND `articulo_ter`.`id_categoria`=".$id." limit 10";
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		public function mostrar_articulo_media($id){
        $query="SELECT `id_articulo`,
						`articulo_ter`.`descripcion`,
						`min_stock`,
						`articulo_ter`.`estado`,
						`cant_per_unit`,
                        `imagen`
						FROM `articulo_ter`,`articulo_cat`
						where  `articulo_ter`.`id_categoria` =`articulo_cat`.`id_categoria`
						AND `articulo_ter`.`id_categoria`=".$id." limit 10";
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		public function mostrar_articulo_byname($id){
        $query="SELECT `id_articulo`,
						`articulo_ter`.`descripcion`
						FROM `articulo_ter`,`articulo_cat`
						where  `articulo_ter`.`id_categoria` =`articulo_cat`.`id_categoria`
						AND `articulo_ter`.`descripcion` like '%".$id."%' limit 10";
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
        public function mostrar_imagen(){
        $query="SELECT `imagen`,
                `disponible_web`,
                `articulo_ter`.`descripcion`,
                `articulo_pre`.`precio`,
                 `articulo_ter`.`id_articulo`
                FROM `articulo_ter` ,`articulo_pre`,`articulo_cat`
                where `articulo_ter`.`id_articulo` =`articulo_pre`.`id_articulo`
                and `articulo_ter`.`id_categoria`=`articulo_cat`.`id_categoria`
				limit 10;";
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
        $query="SELECT `id_categoria`,
						`descripcion`,
						`url`						
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


        public function agregar_precio(){
    $query="INSERT INTO articulo_pre VALUES ('{$this->id_art_precio}',
                                        '{$this->precio}',
                                        '{$this->fecha_desde}',
                                        '{$this->fecha_hasta}',
										'{$this->id_articulo}')";
     $result=mysql_query($query) or die ("Problema con query de Insertar");
     return $result;
    }


	public function imagen_dato($articulo){
        $query="SELECT `imagen`,
                `disponible_web`,
                `articulo_ter`.`descripcion`,
                `articulo_pre`.`precio`,
                `articulo_cat`.`descripcion` `categoria`,
                sum(`articulo_exi`.`cant_disponible`) `cant_disponible`
                FROM `articulo_ter` ,`articulo_pre`,`articulo_cat`,`articulo_exi`
                where `articulo_ter`.`id_articulo` =`articulo_pre`.`id_articulo`
                and `articulo_ter`.`id_categoria`=`articulo_cat`.`id_categoria`
                and `articulo_ter`.`id_articulo`=`articulo_exi`.`id_articulo`
				and `articulo_ter`.`id_articulo`='".$articulo."'";
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }

        public function ubicacion_articulo($articulo){
        /*  $query="SELECT `cant_disponible`,
                         `sucursal`.`descripcion`
                  FROM `articulo_exi`,`ubicacion`,`articulo_ter`,`bodega`,`sucursal`
                  WHERE  `articulo_exi`.`id_ubicacion`=`ubicacion`.`id_ubicacion`
                   and `articulo_ter`.`id_articulo`=`articulo_exi`.`id_articulo`
                   and `bodega`.`id_bodega`=`ubicacion`.`id_ubicacion`
                   and `sucursal`.`id_sucursal`=`bodega`.`id_sucursal`
                   and `articulo_ter`.`id_articulo`='".$articulo."'";
             */

            $query="select articulo_exi.cant_disponible,sucursal.descripcion
                    from articulo_exi, ubicacion,bodega,sucursal,articulo_ter
                    where articulo_exi.id_ubicacion=ubicacion.id_ubicacion
                    and ubicacion.id_bodega=bodega.id_bodega
                    and bodega.id_sucursal=sucursal.id_sucursal
                    and articulo_ter.id_articulo=articulo_exi.id_articulo
                    and articulo_ter.id_articulo='".$articulo."'";
          $rs=mysql_query($query);
          $array=array();
          while($fila=mysql_fetch_assoc($rs)){
            $array[]=$fila;
          }
            return $array;
        }
     public function mostrar3($id){
        $query="SELECT `id_articulo`,
						`articulo_ter`.`descripcion`,
						`articulo_pre`.`precio` `precio`
						FROM `articulo_ter`,`articulo_cat`,`articulo_pre`
						WHERE  `articulo_ter`.`id_categoria` =`articulo_cat`.`id_categoria`
						AND `articulo_ter`.`id_precio` = `articulo_pre`.`id_art_pre`
						AND `id_articulo` =" . $id;
						//INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest limit 9";

		//echo $query;
		//die();
						
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		
		public function cotizacion_detalle(){
    $query="INSERT INTO cotizacion_detalle VALUES ('{$this->id_coti_detalle}',
                                        '{$this->cantidad}',
                                        '{$this->precio}',
                                        '{$this->total}',
										'{$this->alto}',
                                        '{$this->ancho}',
										'{$this->largo}',
										'{$this->area}',
										'{$this->volumen}',
										'{$this->id_articulo}',
										'{$this->id_cotizacion}')";
     $result=mysql_query($query) or die ("Problema con query de Insertar");
	 echo $query;
     return $result;
    }

}
?>