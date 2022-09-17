<?php

if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo
{    
    
    /*----------------- Controlador para iniciar sesion ----------------*/
    public function iniciar_sesion_controlador(){
        $usuario=mainModel::limpiar_cadena($_POST['usuario_log']);
        $clave=mainModel::limpiar_cadena($_POST['clave_log']);

    /*----------------- Comprobar campos vacios ----------------*/
        if($usuario=="" || $clave == ""){
            echo '
            <script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "No has llenado todos los campos que son requeridos",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';
        }

    /*----------------- Verificando integridad de los datos ----------------*/
        if(mainModel::verificar_datos("[0-9-]{10,20}",$usuario)){
            echo '
            <script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "El NOMBRE de usuario no coincide con el formato solicitado",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';
        }

        if(mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}",$clave)){
            echo '
            <script>
                Swal.fire({
                    title: "Ocurrio un error inesperado",
                    text: "La CLAVE no coincide con el formato solicitado",
                    type: "error",
                    confirmButtonText: "Aceptar"
                });
            </script>
            ';
            }
            
            $clave = mainModel::encryption($clave);
            $dato_login = [
                "Usuario"=>$usuario,
                "Clave"=>$clave
            ];
}
}