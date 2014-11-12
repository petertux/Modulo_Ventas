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
	$cargo=$cit->sabercargo($usuario);
	if ($cargo==1)
	{
		$mensaje1="Nuevos Pedidos";
                $mensaje1_1="Ver citas pendientes";
		$mensaje2="Total Asignadas";
		$mensaje3="Nuevas Ordenes";
		$mensaje4="Instalaciones";
		$url1="modulo_ventas_supervisor.php";
		$url2="citas_asignadas_vendedores.php";
	}
	else if($cargo==2)
	{
		$mensaje1="Citas Pendientes";
                $mensaje1_3="Ver Citas";
		$mensaje2="Citas Confirmadas";
                $mensaje2_3="Ver Citas Confirmadas";
		$mensaje3="Cotizacion Pendientes";
		$mensaje4="Recibos Provicionales";
		$url1="Modulo_Ventas/modulo_ventas.php";
		$url2="Modulo_Ventas/citas_programadas.php";
                $urlasig="index.php";
                $envio="Cita";
                $urlasig2="Modulo_Ventas/crear_cita_local.php";
                $urlasig3="Modulo_Ventas/citas_asignadas.php";
                $urlasig4="Modulo_Ventas/cancelar_cita.php";
                $urlasig5="index.php";
                $urlasig6="Modulo_Ventas/citas_programadas.php";
                $urlasig7="Modulo_Ventas/consultar_cotizacion.php";
                $urlasig8="Modulo_Ventas/consultar_recibo_provisional.php";
                $urlasig9="Modulo_Ventas/consultar_orden_trabajo.php";
                $urlasig10="index.php";
                $urlasig11="Modulo_Ventas/crear_cotizacion.php";
                $urlasig12="Modulo_Ventas/crear_recibo_provisional.php";
                $urlasig13="Modulo_Ventas/crear_factura.php";
                $envio2="Crear Cita";
                $envio3="Confrmar Cita";
                $envio4="Cancelar Cita";
                $envio5="Consultas";
                $envio6="Citas Programadas";
                $envio7="Cotizacion";
                $envio8="Recibo Provisional";
                $envio9="Orden de Trabajo";
                $envio10="Procesos";
                $envio11="Crear Cotizacion";
                $envio12="Crear Recibo Provisional";
                $envio13="Crear Factura";
                
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

    <title>Sistema de Inventario</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

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
                                <strong><?php 
                                
                                
                                ?></strong>
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
                                   <?php
										if ($cargo==1)
											{
											$url_asignada=$urlasig;
                                                                                        $ir_a=$envio;
											}
											else if($cargo==2)
											{
                                                                                            $url_asignada=$urlasig;
                                                                                            $ir_a=$envio;
                                                                                            $url_asignada2=$urlasig2;
                                                                                            $url_asignada3=$urlasig3;
                                                                                            $url_asignada4=$urlasig4;
                                                                                            $url_asignada5=$urlasig5;
                                                                                            $url_asignada6=$urlasig6;
                                                                                            $url_asignada7=$urlasig7;
                                                                                            $url_asignada8=$urlasig8;
                                                                                            $url_asignada9=$urlasig9;
                                                                                            $url_asignada10=$urlasig10;
                                                                                            $url_asignada11=$urlasig11;
                                                                                            $url_asignada12=$urlasig12;
                                                                                            $url_asignada13=$urlasig13;
                                                                                            $ir_a2=$envio2;
                                                                                            $ir_a3=$envio3;
                                                                                            $ir_a4=$envio4;
                                                                                            $ir_a5=$envio5;
                                                                                            $ir_a6=$envio6;
                                                                                            $ir_a7=$envio7;
                                                                                            $ir_a8=$envio8;
                                                                                            $ir_a9=$envio9;
                                                                                            $ir_a10=$envio10;
                                                                                            $ir_a11=$envio11;
                                                                                            $ir_a12=$envio12;
                                                                                            $ir_a13=$envio13;
                                                                                            echo"<a href='".$url_asignada."'>".$ir_a."<span class='fa arrow'></span></a> 
                                                                                            <ul class='nav nav-third-level'>
                                                                                                <li>
                                                                                                    <a href='".$url_asignada2."'>".$ir_a2."</a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href='".$url_asignada3."'>".$ir_a3."</a>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <a href='".$url_asignada4."'>".$ir_a4."</a>
                                                                                                </li>
                                                                                            </ul>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href='".$url_asignada5."'>".$ir_a5."<span class='fa arrow'></span></a> 
                                                                                                <ul class='nav nav-third-level'>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada6."'>".$ir_a6."</a>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada7."'>".$ir_a7."</a>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada8."'>".$ir_a8."</a>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada9."'>".$ir_a9."</a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                            <li>
                                                                                                <a href='".$url_asignada10."'>".$ir_a10."<span class='fa arrow'></span></a> 
                                                                                                <ul class='nav nav-third-level'>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada11."'>".$ir_a11."</a>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada12."'>".$ir_a12."</a>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <a href='".$url_asignada13."'>".$ir_a13."</a>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>";
                                                                                        }
									?>
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
                <div class="col-lg-12">
                    <h1 class="page-header">Panel de Control</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
									<?php
										if ($cargo==1)
											{
											$rcate=$cit->cantidad_citas_user($usuario);
											}
											else if($cargo==2)
											{
												$rcate=$cit->cantidad_citas_user($usuario);
											}else if($cargo==3){
												$rcate=$cit->cantidad_cita_pendiente($usuario);
											};
											foreach($rcate as $ci){
											$numero=$ci['numeroCita'];
											//echo"<div class='huge'>{$ci['numeroCita']}<div>";
											};
									?>
                                    <div class="huge"><?php echo $numero; ?></div>
                                    <div><?php echo $mensaje1;?></div>
                                </div>
                            </div>
                        </div>
                        <a href='<?php echo $url1; ?>'>
                            <div class="panel-footer">
                                <?php
										if ($cargo==1)
											{
											$mensaje_mostar=$mensaje1_1;
											}
											else if($cargo==2)
											{$mensaje_mostar=$mensaje1_3;
                                                                                        };
									?>
                                <span class="pull-left"><?php echo $mensaje_mostar; ?></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
								<?php
										if ($cargo==1)
											{
											$rcate=$cit->cantidad_cita_asignada();
											}
											else if($cargo==2)
											{
												$rcate=$cit->cantidad_cita_asignada();	
											}else if($cargo==3){
												$rcate=$cit->cantidad_cita_confirmada($usuario);
											};
										
											foreach($rcate as $ci){
											$numero=$ci['numeroAsi'];
											//echo"<div class='huge'>{$ci['numeroCita']}<div>";
											};
									?>
                                    <div class="huge"><?php echo $numero; ?></div>
                                    <div><?php echo $mensaje2;?></div>
                                </div>
                            </div>
                        </div>
                        <a href='<?php echo $url2; ?>'>
                            <div class="panel-footer">
                                <?php
										if ($cargo==1)
											{
											$mensaje_mostar2=$mensaje1_1;
											}
											else if($cargo==2)
											{
                                                                                            $mensaje_mostar2=$mensaje2_3;
                                                                                        };
									?>
                                <span class="pull-left"><?php echo $mensaje_mostar2; ?></span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
								<?php	if ($cargo==1)
											{
											$rcate=$cit->cantidad_or();
											}
											else if($cargo==2)
											{
                                                                                            $rcate=$cit->cantidad_cita_confirmada($usuario);
											};
										
										$rcate=$cit->cantidad_or_user($usuario);
											foreach($rcate as $ci){
											$numeroO=$ci['numeroOr'];
											//echo"<div class='huge'>{$ci['numeroCita']}<div>";
											};
									?>
                                    <div class="huge"><?php echo $numeroO; ?></div>
                                    <div><?php echo $mensaje3;?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
								<?php
										$rcate=$cit->cantidad_ins();
											foreach($rcate as $ci){
											$numeroi=$ci['numeroIns'];
											//echo"<div class='huge'>{$ci['numeroCita']}<div>";
											};
									?>
                                    <div class="huge"><?php echo $numeroi; ?></div>
                                    <!--<div class="huge">13</div>-->
                                    <div><?php echo $mensaje4;?></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Detalles</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
             <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Ejemplo de Graficas de Ventas
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Acciones
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Ver Ventas</a>
                                        </li>
                                        <li><a href="#">Ver Citas</a>
                                        </li>
                                        <li><a href="#">Ver Instalaciones</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Ver Asignaciones</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div id="morris-area-chart"></div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Ejemplo de Grafico de Barras Compras
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>3326</td>
                                                    <td>10/21/2014</td>
                                                    <td>$321.33</td>
                                                </tr>
                                                <tr>
                                                    <td>3322</td>
                                                    <td>10/21/2014</td>
                                                    <td>$8345.23</td>
                                                </tr>
                                                <tr>
                                                    <td>3321</td>
                                                    <td>10/21/2014</td>
                                                    <td>$245.12</td>
                                                </tr>
                                                <tr>
                                                    <td>3320</td>
                                                    <td>10/21/2014</td>
                                                    <td>$5663.54</td>
                                                </tr>
                                                <tr>
                                                    <td>3319</td>
                                                    <td>10/21/2014</td>
                                                    <td>$943.45</td>
                                                </tr>
												<tr>
                                                    <td>3319</td>
                                                    <td>10/21/2014</td>
                                                    <td>$943.45</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart"></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Panel de Notificaciones
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-comment fa-fw"></i> Nueva Cita
                                    <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-twitter fa-fw"></i>Nuevas Peticiones
                                    <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-envelope fa-fw"></i> Ultimo Mensaje
                                    <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-tasks fa-fw"></i> Nueva Tarea
                                    <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-upload fa-fw"></i> Estado del Servidor
                                    <span class="pull-right text-muted small"><em>11:32 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-warning fa-fw"></i> Estado del Servidor
                                    <span class="pull-right text-muted small"><em>10:57 AM</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-shopping-cart fa-fw"></i> Nueva Orden
                                    <span class="pull-right text-muted small"><em>9:49 AM</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                            <a href="#" class="btn btn-default btn-block">Ver Las Alertas</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Productos Vendidos
                        </div>
                        <div class="panel-body">
                            <div id="morris-donut-chart"></div>
                            <a href="#" class="btn btn-default btn-block">Ver Detalles</a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
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

    <!-- Morris Charts JavaScript -->
    <script src="js/plugins/morris/raphael.min.js"></script>
    <script src="js/plugins/morris/morris.min.js"></script>
    <script src="js/plugins/morris/morris-data.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
<?php
};
?>