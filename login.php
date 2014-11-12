<?php
require_once("clases/sesion.class.php");

if ($_SERVER['REQUEST_METHOD']=='POST') { // �Nos mandan datos por el formulario?
    include('libreria/motor.php'); //incluimos configuraci�n
    //include('clases/login.class.php'); //incluimos las funciones
    $Login=new Login();
    //si hace falta cambiamos las propiedades tabla, campo_usuario, campo_contrase�a, metodo_encriptacion

    //verificamos el usuario y contrase�a mandados
    if ($Login->login($_POST['usuario'],$_POST['password'])) {
        //acciones a realizar cuando un usuario se identifica
       //EJ: almacenar en memoria sus datos completos, registrar un acceso en una tabla mysql
         $usua=new usuario();
            $id_usuario=$usua->nom_usuario($_POST['usuario']);
             $usua->id_usuario=$id_usuario;
             $usua->usuario=$_POST['usuario'];
             $usua->fecha_ingreso=date("Y-m-d");
             $usua->hora_ingreso=date("Y-m-d H:i:s");
             $usua->hora_fin=date("Y-m-d H:i:s");
           $usua->login_user();
		   $usuario=$_POST['usuario'];
        //saltamos al inicio del �rea restringida
		  $sesion=new Sesion();
		   $sesion->set("usuario",$usuario);
        header('Location: index.php');
        die();
    } else {
        //acciones a realizar en un intento fallido
        //Ej: mostrar captcha para evitar ataques fuerza bruta, bloquear durante un rato esta ip, ....

        //preparamos un mensaje de error y continuamos para mostrar el formulario
        $mensaje='Usuario o contrasena incorrecto.';
        echo $mensaje;
    }
} //fin if post
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

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

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Por Favor Inicie Sesion</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login.php" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="usuario" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <!--<div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
								<input type="submit" value="Entrar" class="btn btn-lg btn-success btn-block" />
                                <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>-->
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>
