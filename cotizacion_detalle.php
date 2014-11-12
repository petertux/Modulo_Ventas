<?php
include('libreria/motor.php');
$articulos= new articulo();
$q=$_POST['q'];
$res= $articulos->mostrar_articulo($q);
//$res=mysql_query("select * from pais where cod_cont=".$q."",$con);

?>
<select multiple class="form-control">
	<?php foreach($res as $art){
		echo "<option value='".$art['id_articulo']."'>".$art['descripcion']."</option>";
		};
	?>
</select>

<div class="col-lg-12">
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<th>No</th>
						<th>Cod. Articulo</th>
						<th>Articulos</th>
						<th>Cantidad</th>
						<th>Precio</th>
						<th>Ancho</th>
						<th>Largo</th>
						<th>Volumen</th>
						<th>Total</th>
						<th>	 </th>
						
					</thead>
					<tbody>
					<?php
						foreach($res as $art){
						echo"
						<tr>
							<td>".$art['id_articulo']."</td>
							<td>".$art['id_articulo']."</td>
							<td><input type='text'</td>
							<td><input type='text'</td>
							<td><input type='text'</td>
							<td><input type='text'</td>
							<td><input type='text'</td>
							<td><input type='text'</td>
							<td><input type='text'</td>
						</tr>	
						";
					};
					?>
					</tbody>
				</table>
			</div>
		</div>
</div>
