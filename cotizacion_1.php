<?php
include('libreria/motor.php');

require_once("clases/sesion.class.php");
//$login=new Login();
   $sesion = new Sesion();
   $usuario = $sesion->get("usuario");
   if( $usuario == false )  {
      header("Location: login.php");
   }  else  {

   
   $cit=new cita();
	$art=new articulo();
	$materiales=new materia();
	$emp=new empleado();
	$cargo=$cit->sabercargo($usuario);
	if ($cargo==1)
	{
		$mensaje1="Nuevos Pedidos";
		$mensaje2="Total Asignadas";
		$mensaje3="Nuevas Ordenes";
		$mensaje4="Instalaciones";
	}
	else if($cargo==2)
	{
		$mensaje1="Nuevos Pedidos";
		$mensaje2="Asignadas";
		$mensaje3="Nuevas Ordenes";
		$mensaje4="Instalaciones";
	}else if($cargo==3){
		$mensaje1="Citas Pendientes";
		$mensaje2="Citas Confirmadas";
		$mensaje3="Cotizacion Pendientes";
		$mensaje4="Recibos Provicionales";
	
	}
	
function fechainteligente($timestamp) 
{
	if (!is_int($timestamp)) 
	{
		$timestamp=strtotime($timestamp, 0);
	}
	$diff = time() - $timestamp;
	if ($diff <= 0) return 'Ahora';
	else if ($diff < 60) return "hace ".ConSoSinS(floor($diff), ' segundo(s)');
	else if ($diff < 60*60) return "hace ".ConSoSinS(floor($diff/60), ' minuto(s)');
	else if ($diff < 60*60*24) return "hace ".ConSoSinS(floor($diff/(60*60)), ' hora(s)');
	else if ($diff < 60*60*24*30) return "hace ".ConSoSinS(floor($diff/(60*60*24)), ' día(s)');
	else if ($diff < 60*60*24*30*12) return "hace ".ConSoSinS(floor($diff/(60*60*24*30)), ' mes(es)');
	else return "hace ".ConSoSinS(floor($diff/(60*60*24*30*12)), ' año(s)');
}


function ConSoSinS($val, $sentence) 
{
	if ($val > 1) return $val.str_replace(array('(s)','(es)'),array('s','es'), $sentence); 
	else return $val.str_replace('(s)', '', $sentence);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema de Administracion</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="css/plugins/dataTables.bootstrap.css" rel="stylesheet">
	
	<!-- Edit Table CCSS -->
	<link href="js/edit_table/editablegrid.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

         <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Alfinte S.A de CV</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>

					
					
					
                    <ul class="dropdown-menu dropdown-messages">
						<?php
					$com=$cit->mostrar_mensaje($usuario);
						foreach($com as $co){
							$hace=fechainteligente($co['fecha_creacion']);
							echo"<li>
									<a href='ver_citas.php?id_cita=".$co['id_cita']."'>
										<div>
											<strong>{$co['nombre']}</strong>
											<span class='pull-right text-muted'>
											<em>.$hace.</em>
											</span>
										</div>
										<div> Ha recibido un nuevo mensaje de cita</div>
									</a>
								</li>
								 <li class='divider'></li>";
						
						};
					?>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Leer Todos</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-tasks">
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tareas 1</strong>
                                        <span class="pull-right text-muted">40% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 2</strong>
                                        <span class="pull-right text-muted">20% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 3</strong>
                                        <span class="pull-right text-muted">60% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            <span class="sr-only">60% Complete (warning)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <p>
                                        <strong>Tarea 4</strong>
                                        <span class="pull-right text-muted">80% Complete</span>
                                    </p>
                                    <div class="progress progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            <span class="sr-only">80% Complete (danger)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>Ver Todas las Tareas</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-tasks -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
					<ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <?php echo $sesion->get("usuario"); ?> Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a class="active" href="index.php"><i class="fa fa-dashboard fa-fw"></i> Panel de Control</a>
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                               <li>
                                    <a href="index.php">Cita <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="ver_categoria.php">Crear Cita</a>
                                        </li>
                                        <li>
                                            <a href="ver_categoria.php">Confirmar Cita</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
								<li>
                                    <a href="ver_cita.php">Asignaciones</a>
                                </li>
								<li>
                                    <a href="cotizacion.php">Cotizaciones</a>
                                </li>
                                <li>
                                    <a href="facturas.php">Facturas</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<li>
                            <a href="index.php"><i class="fa fa-bar-chart-o fa-fw"></i>Taller<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="orden_trabajo.php">Orden de Trabajo</a>
                                </li>
								<li>
                                    <a href="orden_trabajo.php">Consultar Orden de Trabajo</a>
                                </li>
								<li>
                                    <a href="solicitar_materiales.php">Materiales</a>
                                </li>
								<li>
                                    <a href="instalaciones.php">Instalaciones</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-sitemap fa-fw"></i>Inventario<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="ver_categoria.php">Consultar Articulos</a>
                                </li>
								<li>
                            <a href="ver_categoria.php">Categoria de Articulos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
							<?php
									$rcate=$materiales->mostrar_categoria();
									foreach($rcate as $ci){
									echo "
										<li>
											<a href='".$ci['url']."?id_categoria=".$ci['id_categoria']."'>".$ci['descripcion']."</a>

										</li>";
									}
							?>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                                <li>
                                    <a href="ver_materia.php">Consultar Materiales</a>
                                </li>
								<li>
                                    <a href="index.php">Ajustes <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="ver_categoria.php">Ajustes de Materiales</a>
                                        </li>
                                        <li>
                                            <a href="ver_categoria.php">Ajustes de Articulos</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
								<li>
                                    <a href="index.php">Traslados <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="ver_categoria.php">Traslados Materiales</a>
                                        </li>
                                        <li>
                                            <a href="ver_categoria.php">Traslados Articulos</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="index.php">Solicitar Materiales <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="ver_categoria.php">Verificar Existencia</a>
                                        </li>
                                        <li>
                                            <a href="ver_categoria.php">Ubicaciones</a>
                                        </li>
                                        <li>
                                            <a href="ver_categoria.php">Sucursales</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-files-o fa-fw"></i> Administrar<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php">Mantenimiento Sucursales</a>
                                </li>
                                <li>
                                    <a href="index.php">Mantenimiento Bodegas </a>
                                </li>
								<li>
                                    <a href="index.php">Mantemiento Paises <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="ver_categoria.php">Mantenimiento Ciudades</a>
                                        </li>
                                        <li>
                                            <a href="ver_categoria.php">Mantenimiento Provincias</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						 <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-10">
                    <h1 class="page-header">Cotizacion</h1>
                </div>
                <!-- /.col-lg-10 -->
            </div>
            <!-- /.row -->
			<div class="row">
				<form role="form">
					<div class="col-lg-8">
						<div class="panel panel-primary">
							<div class="panel-heading">
								Informacion del Cliente
							</div>

							<div class="panel-body">
								<div class="col-xs-6">
										<div class="form-group">
												<input class="form-control" placeholder="Enter text">
										</div>
										<div class="form-group">
											<label>Nombre</label>
												<input class="form-control">
										</div>
										<div class="form-group">
											<label>Telefono</label>
												<input class="form-control">
										</div>
										
								</div>

								
								<div class="col-xs-6">
										<div class="form-group">
										<button type="submit" class="btn btn-primary">Buscar </button>
										
										<p></p>
										</div>
										
										<div class="form-group">
											<label>Apellido</label>
											<input class="form-control">
										</div>
										<div class="form-group">
											<label>Direccion</label>
											<input class="form-control">
											
										</div>
								</div>
								<div class="col-lg-8">
										<div class="form-group">
                                            <label>Comentarios</label>
                                            <textarea class="form-control" rows="2"></textarea>
                                        </div>
								</div>
							</div>
							<div class="panel-footer">
								Panel Footer
							</div>
						</div>
					</div>
					
					<div class="col-lg-10">
						<div class="panel panel-yellow">
								<div class="panel-heading">
									Cotizacion
								</div>
								<div class="panel-body">
									<div class="col-xs-4">
										<div class="form-group">
                                            <label>Categoria</label>
											<select class="form-control" onchange="load(this.value)">
												<option value="">Seleccione</option>
											<?php  $categoria=$art->mostrar_categoria();
													foreach($categoria as $cat){
													echo "
															<option value='".$cat['id_categoria']."'>".$cat['descripcion']."</option>";
															};
											?>
                                            </select>
                                        </div>
									</div>

									<div class="col-xs-4">
										<div class="form-group">
											 <input class="form-control" placeholder="Enter text" type="text" id="articulo_nombre" onkeyup="loadXMLDoc()" required>
										</div>
										<!-- Aqui esta el DIV en el cual se va a cargar la pagina de cotizacion_articulo-->
										<div id="myDiv"></div>
											<p></p>
											<button  id="btnagregar" type="submit" class="btn btn-primary">Agregar </button>
                                     </div>
									
									<div class="col-lg-12">
										<div class="panel-body">
											<!-- aqui va la tabla creada con js -->
											<div id="tablecontent"></div>
										</div>
									</div>
								</div>
								
								<div class="panel-footer">
									Panel Footer
								</div>
						</div>
						<!-- /.col-lg-4 -->
						
					</div>
					
					
				</form>
			</div>
			<div class="row">
			
			</div>

		</div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
	
	<!-- Ajax Customizado"-->
	<script src="js/ajax.js"></script>
	
	<script src="js/edit_table/editablegrid.js"></script>
	<script src="js/edit_table/editablegrid_charts.js"></script>
	<script src="js/edit_table/editablegrid_renderers.js"></script>
	<script src="js/edit_table/editablegrid_editors.js"></script>
	<script src="js/edit_table/editablegrid_utils.js"></script>
	<script src="js/edit_table/editablegrid_validators.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
	var $myDiv, $btnAgregar;
	var editableGrid; //variable con el editableGrid
	
	function agregarCotizacion(valorselec){
		
		$.ajax({
			type: "GET",
			url: "cotizacion_articulo.php",
			data: { 'q' : valorselec, 'json': "1" },
			success: function(data){
				//console.log(data);
				agregarTabla(data);
			},
			dataType: "json"
		});

	}

	function agregarTabla(datonuevo){
		var data = [];
		
		datagrid = editableGrid.data;
		for(i = 0; i < datagrid.length; i++){ //obtener antes los valores del editable grid.
			fila =  datagrid[i];
			jfila = { "id": fila.columns[0], "values": {
				"id_articulo": fila.columns[0],
				"descripcion": fila.columns[1],
				"min_stock": fila.columns[2],
				"precio": fila.columns[3],
				"ancho": fila.columns[4],
				"largo": fila.columns[5],
				"volumen": fila.columns[6],
				"total": fila.columns[7]
				}
			};
			data.push(jfila);
		}
		
		//console.log(fila);
		//console.log(data.length);
		
		nuevafila = { "id": datonuevo.id_articulo, "values": {
				"id_articulo": datonuevo.id_articulo,
				"descripcion": datonuevo.descripcion,
				"min_stock": datonuevo.min_stock,
				"precio": 0,
				"ancho": 0,
				"largo": 0,
				"volumen": 0,
				"total": 0
			}
		};
		
		data.push(nuevafila);
		
		//console.log(data);
		//editableGrid.data = data;
		editableGrid.load({"metadata": getMetaTable(), "data": data});
		editableGrid.renderGrid("tablecontent", "table table-hover table-bordered table-condensed");
	}
	
	function getMetaTable(){
		var metadata = [];
        metadata.push({name: "id_articulo", label: "Cod. Articulo", datatype: "integer", editable: false});
        metadata.push({name: "descripcion", label: "Articulos", datatype: "string", editable: true});
        metadata.push({name: "min_stock", label: "Cantidad", datatype: "double", editable: true});
		metadata.push({name: "precio", label: "Precio", datatype: "double", editable: true});
		metadata.push({name: "ancho", label: "Ancho", datatype: "double", editable: true});
		metadata.push({name: "largo", label: "Largo", datatype: "double", editable: true});
		metadata.push({name: "volumen", label: "Volumen", datatype: "double", editable: true});
		metadata.push({name: "total", label: "Total", datatype: "double", editable: true});
		return metadata;
	}
	
	function crearTabla() {
        editableGrid = new EditableGrid("Tabla");
        editableGrid.load({"metadata": getMetaTable(), "data": []});
        editableGrid.renderGrid("tablecontent", "table table-hover table-bordered table-condensed");
    }
	
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
		
		$btnAgregar = $("button#btnagregar");
		$myDiv = $("div#myDiv");
		
		crearTabla();
		
		$btnAgregar.click(function(){
			//alert("esta es una alerta de prueba");
			valorselec = $myDiv.find("select option:selected").val();
			if(valorselec == undefined) return false;
			
			agregarCotizacion(valorselec);
			
			//alert(valorselec);
			return false;
		});
		
    });
    </script>

</body>

</html>
<?php
};
?>