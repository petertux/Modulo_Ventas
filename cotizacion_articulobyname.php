<?php
include('libreria/motor.php');
$articulos= new articulo();
$q=$_POST['q'];
$res= $articulos->mostrar_articulo_byname($q);
//$res=mysql_query("select * from pais where cod_cont=".$q."",$con);

?>
<select multiple class="form-control">
	<?php foreach($res as $art){
		echo "<option value='".$art['id_articulo']."'>".$art['descripcion']."</option>";
		};
	?>
</select>