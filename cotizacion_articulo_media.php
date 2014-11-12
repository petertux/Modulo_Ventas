<?php
include('libreria/motor.php');
$articulos= new articulo();
$q=$_POST['q'];
$res= $articulos->mostrar_articulo_media($q);


?>
	<div class="media">
		<?php foreach($res as $art){
		echo $art['imagen'];
		echo 	"<a class='pull-left' href='#'>
					<img class='media-object' src='{$art['imagen']}'>
					
				</a>
				<div class='media-body'>
					<h4 class='media-heading'>Media Heading </h4>
					".$art['descripcion']."
					<div class='media'>
					....
					</div>
				</div>";
		};?>
		
    </div>