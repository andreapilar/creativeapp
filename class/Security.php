<?php
/**
 * Created by PhpStorm.
 * User: andrea
 * Date: 17/01/2022
 * Time: 2:19 PM
 */
require_once (dirname(__FILE__).'/../configImport.php');
class Security{

//Construye el password con varios mecanismos de seguridad
    static function passwordConstructor($password){
        $before_salt = 'xM$q3!';
        $after_salt = 'y7Z9d$';
        $md5_password = md5($before_salt.$password.$after_salt);
        $sha_password = sha1($md5_password);

        return $sha_password;
    }
//
    static function generatePassword($length = 15){
        $characters = '123456789abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }



    /**
     * @Description: Método que destruye y cierra las sesiones
     */
    static function sessionClose(){

        //Se valida si ya se ha iniciado el manejo de sesiones, en caso de que no se haya iniciado, se realiza la inicializacion
        if(session_status() == PHP_SESSION_NONE){
            session_start();
            $id_sesion=Security::GetSessionUserId();
            $company_id = Company::getCompanyIdByCompanyUserId($id_sesion);
            Apc::deleAllApcOperator(constant('PREFIJO_CONVERSACION_APC'),$id_sesion);
            Apc::deleteApc(constant('PREFIJO_SESSION').'_'.$company_id.'_' .$id_sesion);

        }else{
            $id_sesion=Security::GetSessionUserId();
            $company_id = Company::getCompanyIdByCompanyUserId($id_sesion);
            Apc::deleAllApcOperator(constant('PREFIJO_CONVERSACION_APC').$company_id,$id_sesion);
            Apc::deleteApc(constant('PREFIJO_SESSION').'_'.$company_id.'_' .$id_sesion);

        }

//        Apc::getAllApcOperador()
//        se obtiene el id de la sesion para eliminar el token creado

//        se elimina el token creado con el parametro id de la sesion, osea, el id usuario empresa

        //Destruimos todas las sesiones
        session_destroy();

        //Limpiamos todas las sesiones
        session_unset();


        return true;
    }

    /**
     * Crea la sesion, osea hace el login que le permite al usuario continuar
     */
    static function sessionCreate($user_role = null, $user_id = null,$token=NULL){

        //Se inicializa el manejo de sesiones
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
//
//            //Se carga el token de sesion de seguridad
//            $_SESSION['tokenLoginSecret'] = constant('TOKEN_SESSION_GENERAL');
//            $_SESSION['tokenLoginSecret'] = Security::generateRandomToken();

        //Se carga el estado del login
        $_SESSION['sessionStatus'] = '1';

        //Se carga el rol empresa
        $_SESSION['userRole'] = $user_role;

        //Creamos sesión con tiempo, para controlar cuando destruirla por inactividad
        $_SESSION['time_session_create'] = time();

        //Se carga el id del usuario
        $_SESSION['userId'] = $user_id;
        $_SESSION['sessionToken']=$token;

        return true;

    }


//metodo para obtener el id de la sesion
    static function GetSessionUserId(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }

        if (isset($_SESSION['userId']))
            return $_SESSION['userId'];

    }

    static function GetSessionToken(){
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }


        return $_SESSION['sessionToken'];

    }




    static function generateRandomToken(){

        $token_pre = bin2hex(openssl_random_pseudo_bytes(16));
        $time = time();

        $token = md5($token_pre.$time);

        return $token;
    }


    static function insertToken($tipo = "entrada",$id_usuario = NULL){
        if (ValidateData::validateInt($id_usuario)==false){return false;}
        $sql = "
       INSERT INTO `conexion_operador`
           ( `id_empresa_usuario`, `tipo`) VALUES 
                                           (
                                            '%s',
                                            '%s'
                                           )
            
        ";

        $sql = sprintf($sql,
            $id_usuario,
            $tipo
        );
        $result = Db::query($sql);
        return $result;
    }
    static function timeUserConexion($id_empresa = NULL, $fecha_inicial = NULL, $fecha_final = NULL){

        //Se contruyen las condiciones de la consulta
        $conditions = "";

        //Filtro por 'fecha'
        if ($fecha_inicial != NULL) {
            unset($this_condition);
            $this_condition = 'AND DATE(f1.fecha_creacion) BETWEEN "%s" AND "%s"';
            $this_condition = sprintf($this_condition, $fecha_inicial, $fecha_final);

            $conditions .= $this_condition;
            unset($this_condition);
        }

        //Filtro por 'fecha'
        if ($fecha_final != NULL) {
            unset($this_condition);
            $this_condition = 'AND DATE(f2.fecha_creacion) BETWEEN "%s" AND "%s"';
            $this_condition = sprintf($this_condition, $fecha_inicial, $fecha_final);

            $conditions .= $this_condition;
            unset($this_condition);
        }

        $sql = "
         SELECT
    f1.fecha_creacion as entrada,
    f2.fecha_creacion as salida,
    SEC_TO_TIME(
        UNIX_TIMESTAMP(f2.fecha_creacion) - UNIX_TIMESTAMP(f1.fecha_creacion)
    ) AS tiempo,
    operador.nombre as nombre_operador,
    operador.id_empresa
FROM
    conexion_operador f1
LEFT JOIN
    conexion_operador f2
ON
    f1.id_conexion_operador < f2.id_conexion_operador 
    AND f1.id_empresa_usuario=f2.id_empresa_usuario
    AND f1.tipo='entrada' AND f2.tipo='salida'
    INNER JOIN operador ON f1.id_empresa_usuario=operador.id_operador
         WHERE
           operador.id_empresa ='%s' 
          $conditions
GROUP BY
    f1.fecha_creacion,f2.fecha_creacion
ORDER BY
    f1.fecha_creacion
          
        ";

        $sql = sprintf($sql,
            $id_empresa
        );
        $result = Db::query($sql);
        return $result;
    }



    static function deletetToken($id_usuario = NULL, $token){
        if (ValidateData::validateInt($id_usuario)==false){return false;}
        $sql = "
       DELETE FROM 
            empresa_usuario_token 
       WHERE 
            id_empresa_usuario='%s'
        AND
            token='%s'
             
            
        ";
        $sql = sprintf($sql,
            $id_usuario,
            $token
        );
        $result = Db::query($sql);
        return $result;
    }





}





