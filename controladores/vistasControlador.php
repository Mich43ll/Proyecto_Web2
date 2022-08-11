<?php
    require_once "./modelos/vistasModelo.php";

    class vistasControlador extends vistasModelo{

        /* --------------- Controlador obtener plantilla -----------*/
        public function obtener_plantilla_controlador(){
            return require_once "./vistas/plantilla.php";
        }

        /* --------------- controlador obtener vistas -----------*/
        public function obtener_vistas_controlador(){
            if(isset($_GET['views'])){
                $ruta=explode("/",$_GET['views']);
                $repuesta=vistasModelo::obtener_vistas_controlador($ruta[0]);
            }else{
                $respuesta="login";
            }
            return $repuesta;
        }
    }

    