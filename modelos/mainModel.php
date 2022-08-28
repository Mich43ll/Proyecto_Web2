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

    /*----------------- Funcion verificar datos ----------------*/

    protected static function verificar_datos($filtro,$cadena){
        if(preg_match("/^".$filtro."$/",$cadena)){
            return false;
        }else{
            return true;
        }
    }

    /*----------------- Funcion verificar fechas ----------------*/
    protected static function verificar_fecha($fecha){
        $valores=explode('-',$fecha);
        if(count($valores) ==3 && checkdate($valores[1],$valores[2],$valores[0])){
            return false;
        }else{
            return true;
        }
    }

    /*----------------- Funcion paginador de tablas ----------------*/
    protected static function paginador_tablas($pagina,$Npaginas,$url,$botones){
        $tabla='<nav aria-label="Page navigation example">
		<ul class="pagination justify-content-center">';
        if($pagina==1){
            $tabla.='<li class="page-item disabled"><a class="page-link"><i class="fa-thin fa-angles-left"></i></a></li>';
        }else{
            $tabla.='<li class="page-item"><a class="page-link" href="'.$url.'1/"><i class="fa-thin fa-angles-left"></i></a></li>
            <li class="page-item"><a class="page-link" href="'.$url.($pagina-1).'">Anterior</a></li>';
        }

        $ci = 0;
        for($i=$pagina;$i<=$Npaginas; $i++){
            if($ci>=$botones){
                break;
            }
            if($pagina==$i){
                $tabla.='<li class="page-item"><a class="page-link active" href="'.$url.$i.'/">'.$i.'</a></li>';
            }else{
                $tabla.='<li class="page-item"><a class="page-link " href="'.$url.$i.'/">'.$i.'</a></li>';
            }
            $ci++;
        }

        if($pagina==$Npaginas){
            $tabla.='<li class="page-item disabled"><a class="page-link"><i class="fa-thin fa-angles-right"></i></a></li>';
        }else{
            $tabla.='<li class="page-item"><a class="page-link" href="'.$url.($pagina+1).'">Siguiente</a></li>
            <li class="page-item"><a class="page-link" href="'.$url.$Npaginas.'/"><i class="fa-thin fa-angles-right"></i></a></li>';
            
        }
        $tabla.='</ul></nav>';
        return $tabla;
    }
}   
