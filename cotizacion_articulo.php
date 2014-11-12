<?php
include('libreria/motor.php');
$articulos= new articulo();

if(isset($_POST['q'])){
	$q=$_POST['q'];
} else {
	$q=@$_GET['q'];
}

$json= @$_GET['json'];

if(isset($json) && $json != "" && $json == "1"){

	$res= $articulos->mostrar3($q);
	
	$resjson = json_encode($res[0]);
	
	echo $resjson;
	die();

} else {

	$res= $articulos->mostrar_articulo($q);
	//$res=mysql_query("select * from pais where cod_cont=".$q."",$con);

	?>
	<select multiple class="form-control">
		<?php foreach($res as $art){
			echo "<option value='".$art['id_articulo']."'>".$art['descripcion']."</option>";
			};
		?>
	</select>

<?php } ?>