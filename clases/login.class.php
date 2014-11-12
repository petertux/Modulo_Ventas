<?php
/**
 * Clase Login para validar un usuario comprobando su usuario (o email) y contraseña
 * 
 * 
 */
class Login {
    
    public $tabla='usuario'; //nombre de la tabla usarios
    public $campo_usuario='usuario'; //campo que contiene los datos de los usuarios (se puede usar el email)
    public $campo_clave='clave_def'; //campo que contiene la contraseña
    public $metodo_encriptacion='texto'; //método utilizado para almacenar la contrasela. Opciones: sha1, md5, o texto

  
    /**
     * valida un usuario y contraseña
     * @param string $usuario
     * @param string $password
     * @return bool
     */
    public function login($usuario, $password) {

        //usuario y password tienen datos?
        if (empty($usuario)) return false;
        if (empty ($password)) return false;
	 
        //2 - preparamos la consulta SQL a ejecutar utilizando sólo el usuario y evitando ataques de inyección SQL.
        $query='SELECT '.$this->campo_usuario.', '.$this->campo_clave.' FROM '.$this->tabla.' WHERE '.$this->campo_usuario.'="'.  mysql_real_escape_string($usuario).'" LIMIT 1 '; //la tabla y el campo se definen en los parametros globales
        $result = mysql_query($query);
        if (!$result) {
            //trigger_error('Error al ejecutar la consulta SQL: ' . mysql_error($this->link),E_USER_ERROR);
        }


        //3 - extraemos el registro de este usuario
        $row = mysql_fetch_assoc($result);

        if ($row) {
            //4 - Generamos el hash de la contraseña encriptada para comparar o lo dejamos como texto plano
            switch ($this->metodo_encriptacion) {
                case 'sha1'|'SHA1':
                    $hash=sha1($password);
                    break;
                case 'md5'|'MD5':
                    $hash=md5($password);
                    break;
                case 'texto'|'TEXTO':
                    $hash=$password;
                    break;
                default:
                    trigger_error('El valor de la propiedad metodo_encriptacion no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
            }

            //5 - comprobamos la contraseña
            if ($hash==$row[$this->campo_clave]) {
                @session_start();
               // $_SESSION['USUARIO']=array('user'=>$row[$this->campo_usuario]); //almacenamos en memoria el usuario
                // en este punto puede ser interesante guardar más datos en memoria para su posterior uso, como por ejemplo un array asociativo con el id, nombre, email, preferencias, ....
                return true; //usuario y contraseña validadas
            } else {
                @session_start();
                unset($_SESSION['USUARIO']); //destruimos la session activa al fallar el login por si existia
                return false; //no coincide la contraseña
            }
        } else {
            //El usuario no existe
            return false;
        }

    }

    


    /**
     * Veridica si el usuario está logeado
     * @return bool
     */
    public function estoy_logeado () {
        @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)

        if (!isset($_SESSION['USUARIO'])) return false; //no existe la variable $_SESSION['USUARIO']. No logeado.
        if (!is_array($_SESSION['USUARIO'])) return false; //la variable no es un array $_SESSION['USUARIO']. No logeado.
        if (empty($_SESSION['USUARIO']['user'])) return false; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.

        //cumple las condiciones anteriores, entonces es un usuario validado
        return true;

    }

    /**
     * Vacia la sesion con los datos del usuario validado
     */
    public function logout() {
        @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)
        unset($_SESSION['USUARIO']); //eliminamos la variable con los datos de usuario;
        session_write_close(); //nos asegurmos que se guarda y cierra la sesion
        return true;
    }
	
    
    
}




    
?>