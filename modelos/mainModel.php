<?php

if ($peticionAjax) {
    require_once "../config/SERVER.php";
} else {
    require_once "./config/SERVER.php";
}

class mainModel
{

    /*----------------- Funcion conectar a BD ----------------*/
    protected static function conectar()
    {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    /*----------------- Funcion ejecuytar consultas simples ----------------*/
    protected static function ejecutar_consulta_simple($consulta)
    {
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }


    /*----------------- Encriptar cadenas ----------------*/

    public function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }


    /*----------------- Desencriptar cadenas ----------------*/

    protected static function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    /*----------------- Funcion generar codigos aleatorios ----------------*/

    protected static function generar_codigo_aleatorio($letra, $logitud, $numero)
    {
        for($i=1;$i<=$logitud; $i++){
            $aleatorio=rand(0,9);
            $letra.=$aleatorio;
        }
        return $letra."-".$numero;
    }

    /*----------------- Funcion limpiar cadenas ----------------*/
    protected static function limpiar_cadena($cadena){
        $cadena=trim($cadena);
        $cadena=stripslashes($cadena);
        $cadena = str_replace("<script>","",$cadena);
        $cadena = str_replace("</script>","",$cadena);
        $cadena = str_replace("<script src>","",$cadena);
        $cadena = str_replace("<script type=>","",$cadena);
        $cadena = str_replace("SELECT * FROM","",$cadena);
        $cadena = str_replace("DELETE* FROM","",$cadena);
        $cadena = str_replace("INSERT INTO","",$cadena);
        $cadena = str_replace("DROP TABLE","",$cadena);
        $cadena = str_replace("DROP DATABASE","",$cadena);
        $cadena = str_replace("TRUNCATE TABLE","",$cadena);
        $cadena = str_replace("SHOW TABLES","",$cadena);
        $cadena = str_replace("SHOW DATABASES","",$cadena);
        $cadena = str_replace("<?p","",$cadena);
        $cadena = str_replace("?>","",$cadena);
        $cadena = str_replace("--","",$cadena);
        $cadena = str_replace(">","",$cadena);
        $cadena = str_replace("<","",$cadena);
        $cadena = str_replace("[","",$cadena);
        $cadena = str_replace("]","",$cadena);
        $cadena = str_replace("^","",$cadena);
        $cadena = str_replace("==","",$cadena);
        $cadena = str_replace(";","",$cadena);
        $cadena = str_replace("::","",$cadena);
        $cadena=stripslashes($cadena);
        $cadena=trim($cadena);
        return $cadena;
    }
}
