    <?php
    class cita{

    public $id_cita;
    public $fecha_creacion;
    public $fecha_programada;
    public $hora;
    public $nombre;
    public $apellido;
    public $email;
    public $direccion;
    public $telefono;
    public $id_canal;
    public $id_estado;
    public $comentario;
	public $id_empleado;


     public function agregar(){
    $query="INSERT INTO cita VALUES ('{$this->id_cita}',
                                        '{$this->fecha_creacion}',
                                        '{$this->fecha_programada}',
                                        '{$this->hora}',
                                        '{$this->nombre}',
                                        '{$this->apellido}',
                                        '{$this->telefono}',
                                        '{$this->direccion}',
                                        '{$this->email}',
                                        '{$this->id_canal}',
                                        '{$this->id_estado}',
                                        '{$this->comentario}',
										'{$this->id_empleado}')";
	$result=mysql_query($query) or die ("Problema con query de Insertar");
     return $result;
    }
	
	
	public function actualizar_cita($cod_emp,$id_cita){
    $query="UPDATE  cita  SET id_empleado=".$cod_emp.",id_estado='1' where id_cita=".$id_cita."";
    $result=mysql_query($query) or die ("Problema con query de Insertar");
     return $result;
    }

        public function secqnos(){
        $query="SELECT siguiente from seqnos where tabla='cita'";
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
        $query2="SELECT siguiente from seqnos where tabla='cita'";
        $rs=mysql_query($query2);
        if ($row = mysql_fetch_row($rs)) {
        $num = trim($row[0]);}
         $num = (int)$num+1;
      $query= "UPDATE seqnos set siguiente='".$num."'where tabla='cita'";
        $resultado = mysql_query($query) or die ("Problema con query");
           return $resultado;
		}
		 
		public function mostrar_supervisor(){
        $query="SELECT cita.`id_cita`,
						`fecha_creacion`,
						`nombre`,
						`telefono`,
						`direccion`,
						`email`,
						canal.`descripcion`,
						cita_estado.`valor`,
						`comentario`
						FROM `cita`
						INNER JOIN  `canal` ON `cita`.id_canal = `canal`.id_canal
						INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest 
						where id_empleado=4 and id_estado=1
						";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		
		public function mostrar_citas_pedientes_byuser($user){
        $query="SELECT cita.`id_cita`,
						`fecha_creacion`,
						`nombre`,
						`telefono`,
						`direccion`,
						`email`,
						canal.`descripcion`,
						cita_estado.`valor`,
						`comentario`
						FROM `cita`
						INNER JOIN  `canal` ON `cita`.id_canal = `canal`.id_canal
						INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest
						INNER JOIN	 `usuario` on `cita`.id_empleado = `usuario`.id_empleado
						where `usuario`='".$user."'
						";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		
		public function mostrar_byid($id){
		
        $query="SELECT `id_cita`,
						`nombre`,
						`apellido`,
						`telefono`,
						`direccion`,
						`email`,
						`comentario`
						FROM `cita`
						where `id_cita`='".$id."'";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
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
		
		public function cantidad_citas(){
		$query="SELECT count(id_cita) as numeroCita 
				from cita where id_estado=1";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		//Cantidad de registros asignados por usuario(supervisor)		
		public function cantidad_citas_user($user){
		$query="SELECT count(id_cita) as numeroCita from cita,usuario
				where cita.id_empleado=usuario.id_empleado
				and usuario.usuario='".$user."'";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		//Cantidad de registros asignados por usuario(vendedor)
		public function cantidad_asi_user($user){
		$query="SELECT count(id_cita) as numeroAsi from cita,usuario
				where cita.id_empleado=usuario.id_empleado
				and usuario.usuario='".$user."'";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		
				//Cantidad de registros cita pendiente por usuario(vendedor)
		public function cantidad_cita_pendiente($user){
		$query="SELECT count(id_cita) as numeroCita from cita,usuario where cita.id_empleado=usuario.id_empleado and usuario.usuario='".$user."' and cita.id_estado=1 ";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		
				//Cantidad de registros cita confirmada por usuario(vendedor)
		public function cantidad_cita_confirmada($user){
		$query="SELECT count(id_cita) as numeroAsi from cita,usuario
				where cita.id_empleado=usuario.id_empleado
				and usuario.usuario='".$user."'
				and cita.id_estado=2";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		
		public function cantidad_asi(){
		$query="SELECT count(id_cita) as numeroAsi from cita where id_estado=2";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		//Cantidad de registros asignados por usuario(taller)
		public function cantidad_or_user($user){
		$query="SELECT count(id_orden) as numeroOr from ORDEN_TRABAJO,usuario
				where orden_trabajo.id_empleado= usuario.id_empleado
				and usuario.usuario='".$user."'";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		public function cantidad_or(){
		$query="SELECT count(id_orden) as numeroOr from ORDEN_TRABAJO where id_trabajo_estado= 1";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		//Se necesitaba saber las cantidades de ordenes de trabajo hay
		public function cantidad_ins(){
		$query="SELECT count(id_orden) as numeroIns from ORDEN_TRABAJO where id_trabajo_estado= 3";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
		
		//Se necesita saber cuales fueron las nuevas entradas de las citas
		public function mostrar_mensaje($user){
        $query="SELECT cita.`id_cita`,
						`fecha_creacion`,
						concat(nombre,' ',apellido) as nombre
						FROM `cita`
						INNER JOIN  `canal` ON `cita`.id_canal = `canal`.id_canal
						INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest
						INNER JOIN	`usuario` ON  `cita`.id_empleado=`usuario`.id_empleado
						and `usuario`.usuario='".$user."'
						ORDER BY fecha_creacion DESC";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		//Se necesitaba saber el cargo del usuario
        public function sabercargo($user){
        $query="SELECT id_cargo FROM `empleado`,`usuario` where `empleado`.id_empleado = `usuario`.id_empleado and usuario.usuario='".$user."'";
        $rs=mysql_query($query);
        if (!$rs) {
                   echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                    exit;}
        $fila = mysql_fetch_row($rs);
        $num=$fila[0];
         $num = (int)$num;
             return $num;
        }    
		
						//Cantidad de citas Asignadas a usuario(vendedor)
		public function cantidad_cita_asignada(){
		$query="SELECT count(id_cita) as numeroAsi from cita, empleado
				where cita.id_estado=1 and cita.id_empleado=empleado.id_empleado and empleado.id_cargo=3";
		$rs=mysql_query($query);
		$array=array();
		while($fila=mysql_fetch_assoc($rs)){
			$array[]=$fila;
		}
			return $array;
		}
                public function mostrar_cita_asgi_vend($user){
        $query="SELECT cita.`id_cita`, `fecha_creacion`, concat(`nombre`,' ',`apellido`) as nombre, `telefono`, `direccion`, `email`, canal.`descripcion`, cita_estado.`valor`, `comentario` FROM `cita` INNER JOIN `canal` ON `cita`.id_canal = `canal`.id_canal INNER JOIN `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest INNER JOIN usuario ON cita.`id_empleado`=usuario.`id_empleado` where (SELECT cargo.`id_cargo` FROM `cargo` WHERE cargo.`id_cargo`=3) AND usuario.`usuario`='".$user."'";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
		
		        public function mostrar_numero_cita_penditente(){
        $query="SELECT id_cita FROM cita WHERE id_estado=1";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
public function mostrar_numero_cita_penditente2(){
        $query="SELECT id_cita, CONCAT(`id_cita`,' ',`nombre`,' ',`apellido`) as citNombre FROM cita WHERE id_estado=1 and id_empleado=4 ";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
        
             return $array;
        }
        public function mostrar_citas_asignadas_total($user){
        $query="SELECT cita.`id_cita`, cita_estado.`valor`,CONCAT(`nombre`,' ',`apellido`) as nombre, `comentario` FROM `cita` INNER JOIN `canal` ON `cita`.id_canal = `canal`.id_canal INNER JOIN `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest INNER JOIN	 `usuario` on `cita`.id_empleado = `usuario`.id_empleado where `usuario`='".$user."'";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
        public function mostrar_citas_programadas($user){
        $query="SELECT cita.`id_cita`,CONCAT(`nombre`,' ',`apellido`) as nombre,cita.`fecha_programada`, `comentario` FROM cita  INNER JOIN	 `usuario` on `cita`.id_empleado = `usuario`.id_empleado where `usuario`='".$user."' and id_estado=2";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
        public function confirmar_cita($fecha_programada,$hora,$id_cita){
    $query="UPDATE  cita  SET fecha_programada='".$fecha_programada."',hora='".$hora."',id_estado='2' where id_cita='".$id_cita."'";
    $result=mysql_query($query) or die ("Problema con query de Insertar");
     return $result;
    }
	public function mostrar_citas_vendedor($user){
        $query="SELECT cita.`id_cita`,
						`fecha_creacion`,
						`nombre`,
						`telefono`,
						`direccion`,
						`email`,
						canal.`descripcion`,
						cita_estado.`valor`,
						`comentario`
						FROM `cita`
						INNER JOIN  `canal` ON `cita`.id_canal = `canal`.id_canal
						INNER JOIN  `cita_estado` ON `cita`.id_estado = `cita_estado`.id_citaest 
                                                INNER JOIN  `usuario` on `cita`.id_empleado = `usuario`.id_empleado
						where `usuario`='".$user."' and id_estado=1
						";
        $rs=mysql_query($query);
        $array=array();
        while($fila=mysql_fetch_assoc($rs)){
          $array[]=$fila;
        }
             return $array;
        }
				/*************************************************************************/
		public function agregar_cliente(){
		$query="INSERT INTO cliente VALUES ('{$this->id_cliente}',
                                        '{$this->nombre}',
                                        '{$this->apellido}',
                                        '{$this->direccion}',
                                        '{$this->telefono}',
										'{$this->nit}')";
		$result=mysql_query($query) or die ("Problema con query de Insertar");
		//echo $query;
     return $result;
	 }
	     
		 public function secqnos_cliente(){
        $query="SELECT siguiente from seqnos where tabla='cliente'";
        $rs=mysql_query($query);
        if (!$rs) {
                           echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                    exit;}
        $fila = mysql_fetch_row($rs);
        $num=$fila[0];
         $num = (int)$num;
             return $num;
        }

        public function Upsecqnos_cliente(){
        $query2="SELECT siguiente from seqnos where tabla='cliente'";
        $rs=mysql_query($query2);
        if ($row = mysql_fetch_row($rs)) {
        $num = trim($row[0]);}
         $num = (int)$num+1;
      $query= "UPDATE seqnos set siguiente='".$num."'where tabla='cliente'";
        $resultado = mysql_query($query) or die ("Problema con query");
           return $resultado;
		}
		
		
		public function actualizar_cita_cotizacion($id_cita,$estado){
			$query="UPDATE  cita  SET id_estado=".$estado." where id_cita=".$id_cita."";
				$result=mysql_query($query) or die ("Problema con query de Insertar");
			return $result;
		}
	/*************************************************************************/
}
?>