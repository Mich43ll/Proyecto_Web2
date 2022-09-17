<?php

if ($peticionAjax) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo

{    /*----------------- Controlador para iniciar sesion ----------------*/
    public function iniciar_sesion_controlador(){
        
    }
}
