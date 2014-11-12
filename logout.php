<?php
/* 
 * Cierra la sesión como usuario validado
 */

/*include('clases/login.class.php'); //incluimos las funciones
Login::logout(); //vacia la session del usuario actual
header('Location: login.php'); //saltamos a login.php
*/
   require_once("clases/sesion.class.php");
   $sesion = new sesion();
   $usuario = $sesion->get("usuario");
   if( $usuario == false )  {
      header("Location: login.php");
   }  else  {
      $usuario = $sesion->get("usuario");
      $sesion->termina_sesion();
      header("location: login.php");
   }
?>
