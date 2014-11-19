<?php
    class inventario{

    public $id_movimiento;
    public $cantidad;
    public $fecha_creacion;
    public $id_tipo_movimiento;
    public $factura_referencia;
    public $id_detalle;
	public $id_articulo;
	public $ubicacion_origen;
	public $ubicacion_destino;
	public $precio;
	public $total;
	public $fecha_crea;
	
	
	/*********************Insertar Encabezado de traslado*******************************/
	public function agregar_encabezado(){
    $query="INSERT INTO traslado_inv_articulo VALUES ('{$this->id_movimiento}',
                                        '{$this->cantidad}',
                                        '{$this->fecha_crea}',
                                        '{$this->id_tipo_movimiento}',
                                        '{$this->factura_referencia}')";
    $result=mysql_query($query) or die ("Problema con query de Insertar en Traslado Inv Articulo");
     return $result;
    }
	/*********************Insertar Encabezado de traslado*******************************/
	
		/*********************Insertar detalle de traslado*******************************/
	public function agregar_detalle(){
    $query="INSERT INTO detalle_traslado VALUES ('{$this->id_detalle}',
                                        '{$this->id_articulo}',
                                        '{$this->ubicacion_origen}',
										'{$this->ubicacion_destino}',
                                        '{$this->precio}',
										'{$this->total}',
                                        '{$this->id_movimiento}')";
    $result=mysql_query($query) or die ("Problema con query de Insertar en Traslado Inv Articulo");
     return $result;
    }
	/*********************Insertar Encabezado de traslado*******************************/
	
	/*************************************************************************/
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
	 // echo $query;
        $resultado = mysql_query($query) or die ("Problema con query");
           return $resultado;
		}
	/*************************************************************************/
	
	
	//Traer la cantidad de articulos trasladados por movimiento
	public function cantidad_detalle($id_movimiento){
	$query="SELECT count(id_movimiento)
			FROM detalle_traslado
			WHERE id_movimiento=".$id_movimiento;
	$rs=mysql_query($query);
        if (!$rs) {
                    echo 'No se pudo ejecutar la consulta: ' . mysql_error();
                    exit;}
        $fila = mysql_fetch_row($rs);
        $num=$fila[0];
         $num = (int)$num;
             return $num;
        }
	}
	?>
	
