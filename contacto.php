<?php
    require('libreria/motor.php');


    if(isset($_POST['boton'])){
        if($_POST['nombre'] == ''){
            $error1 = '<span class="error">Ingrese su nombre</span>';
        }else if($_POST['apellido'] == ''){
            $error2 = '<span class="error">Ingrese su Apellido</span>';
        }else if($_POST['direccion'] == ''){
            $error3 = '<span class="error">Ingrese su Direccion</span>';
        }else if($_POST['telefono'] == ''){
            $error4 = '<span class="error">Ingrese su Telefono</span>';
        }else if($_POST['email'] == '' or !preg_match("/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/",$_POST['email'])){
            $error5 = '<span class="error">Ingrese un email correcto</span>';
        }else if($_POST['asunto'] == ''){
            $error6 = '<span class="error">Ingrese un asunto</span>';
        }else if($_POST['mensaje'] == ''){
            $error7 = '<span class="error">Ingrese un mensaje</span>';
        }else{
            $dest = "pedro822@hotmail.com"; //Email de destino
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $asunto = $_POST['asunto']; //Asunto
            $cuerpo = $_POST['mensaje']; //Cuerpo del mensaje
            //Cabeceras del correo
            $headers = "From: $nombre <$email>\r\n"; //Quien envia?
            $headers .= "X-Mailer: PHP5\n";
            $headers .= 'MIME-Version: 1.0' . "\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; //

           /**********************************************************************/

           /* Lo utilizare despues
           if(mail($dest,$asunto,$cuerpo,$headers)){
 
                foreach($_POST AS $key => $value) {
                    $_POST[$key] = mysql_real_escape_string($value);
                }*/

             /**********************************************************************/
                 if(1==1){
                           $cit=new cita();
                           $id_cita=$cit->secqnos();
                           $cit->id_cita=$id_cita;
                           $cit->fecha_creacion=date("Y-m-d H:i:s");
                           $cit->fecha_programada="";
                           $cit->hora="";
                           $cit->nombre=$nombre;
                           $cit->apellido=$_POST['apellido'];
                           $cit->telefono=$_POST['telefono'];
                           $cit->direccion=$_POST['direccion'];
                           $cit->email=$email;
                           $cit->id_canal=1;
                           $cit->id_estado=1;
                           $cit->comentario=$cuerpo;

                           $result=$cit->agregar();
                           if($result>0){
                              $result = '<div class="result_ok">Email enviado correctamente <img src="http://web.tursos.com/wp-includes/images/smilies/icon_smile.gif" alt=":)" class="wp-smiley"> </div>';
                               $cit->Upsecqnos();
                           }else{
                              $result = '<div class="result_fail">Hubo un error al enviar el mensaje <img src="http://web.tursos.com/wp-includes/images/smilies/icon_sad.gif" alt=":(" class="wp-smiley"> </div>';
                           }

               // $sql = "INSERT INTO `cf` (`nombre`,`email`,`asunto`,`mensaje`) VALUES ('{$_POST['nombre']}','{$_POST['email']}','{$_POST['asunto']}','{$_POST['mensaje']}')";
               // mysql_query($sql) or die(mysql_error());
 

                // si el envio fue exitoso reseteamos lo que el usuario escribio:
                $_POST['nombre'] = '';
                $_POST['email'] = '';
                $_POST['asunto'] = '';
                $_POST['mensaje'] = '';
 
            }else{
                $result = '<div class="result_fail">Hubo un error al enviar el mensaje <img src="http://web.tursos.com/wp-includes/images/smilies/icon_sad.gif" alt=":(" class="wp-smiley"> </div>';
            }
        }
    }
?>
<html>
    <head>
        <title>Contacto</title>
        <link rel='stylesheet' href='css/estilos.css'>
        <script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js'></script>
        <script src='js/funciones.js'></script>
    </head>
    <body>
        <form class='contacto' method='POST' action=''>
            <div><label>Nombre:</label><input type='text' 	class='nombre' name='nombre' value='<?php if(isset($_POST['nombre'])){ echo $_POST['nombre']; } ?>'><?php if(isset($errors)){ echo $errors[1]; } ?></div>
			<div><label>Apellido:</label><input type='text' class='apellido' name='apellido' value='<?php if(isset($_POST['apellido'])){ echo $_POST['apellido']; } ?>'><?php if(isset($errors)){ echo $errors[2]; } ?></div>
            <div><label>Direccion:</label><input type='text'class='direccion' name='direccion' value='<?php if(isset($_POST['direccion'])){ echo $_POST['direccion']; } ?>'><?php if(isset($errors)){ echo $errors[3]; } ?></div>
            <div><label>Telefono:</label><input type='text' class='telefono' name='telefono' value='<?php if(isset($_POST['telefono'])){ echo $_POST['telefono']; } ?>'><?php if(isset($errors)){ echo $errors[4]; } ?></div>
            <div><label>Email:</label><input type='text' 	class='email' name='email' value='<?php if(isset($_POST['email'])){ $_POST['email']; } ?>'><?php if(isset($errors)){ echo $errors[5]; } ?></div>
            <div><label>Asunto:</label><input type='text' 	class='asunto' name='asunto' value='<?php if(isset($_POST['asunto'])){ $_POST['asunto']; } ?>'><?php if(isset($errors)){ echo $errors[6]; } ?></div>
            <div><label>Comentario:</label><textarea rows='6' class='mensaje' name='mensaje'><?php if(isset($_POST['mensaje'])){ $_POST['mensaje']; } ?></textarea><?php if(isset($errors)){ echo $errors[7]; } ?></div>
            <div><input type='submit' value='Envia Mensaje' class='boton' name='boton'></div>
            <?php if(isset($result)) { echo $result; } ?>
        </form>
        <div class="container">
    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
    </div>
</div>
    </body>
</html>