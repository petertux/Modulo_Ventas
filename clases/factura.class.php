<?php
  class factura{

  public $id_factura;
  public $fecha_factura;
  public $fecha_creacion;
  public $direccion_factura;
  public $direccion_instalacion;
  public $nit;
  public $ncr;
  public $giro;
  public $sub_total;
  public $descuento;
  public $monto_descuento;
  public $total;
  public $fa_estado;
  public $id_cliente;
  public $id_tipo_doc;
  public $id_orden;
  public $id_forma_pago;


  public function mostrar_factura($articulo){
     $query="Select id_factura,
                    fecha_factura,
                    from factura
                    ";



     $rs=mysql_query($query);
            $array=array();
            while($fila=mysql_fetch_assoc($rs)){
              $array[]=$fila;
            }
                 return $array;
          }


















































}



?>