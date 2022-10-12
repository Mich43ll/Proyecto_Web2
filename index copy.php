<?php
include('funciones.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>

<body>
    <h1>Ejemplo de PHP</h1>
    <p>
        <?php
        //declaracion de variables en php
        $d = 0.50;
        $i = 1;
        $s = 'Hola';
        $b = true;
        //var_dump($d);
        //var_dump($i);
        //var_dump($s);
        //var_dump($b); imprimir el tipo y valor de una variable
        //echo gettype($s); imprimir el tipo de dato que tiene la variable
        //echo isset($s); //funcion que sirve para ver el valor de una varible 
        //echo $x; //echo es para imprimir en pantalla
        //print $x; tambien sirve para imprimir en pantalla

        $n1 = 10;
        $n2 = 20;
        $n3 = 50;
        $r = $n1 + $n2;
        $a = array(
            0 => 'valor1',
            1 => 'valor2',
            2 => 'valor3'
        );
        print_r($a);

        ?>

        <br><br>

        <?php
        foreach ($a as $elemento) {
            echo "$elemento";
        ?>
        <br>
        <?php
        }
        

        echo "<br>";
        for ($c = 0; $c < count($a); $c++) {
            echo "$a[$c]";
        }
        ?>
        <br>
        <?php
        $a2 = array(
            'valor1',
            'valor2',
            'valor3'
        );
        print_r($a2); //Imprimir todos los valroes del arreglo
        //echo "El resultado de la suma de $n1 + $n2 = $r"

        /*if($n1 > $n2 && $n1>$n3){
                echo "El mayor es $n1";
            }else if($n2 > $n1 && $n2>$n3){
                echo "El mayor es $n2";
            }else{
                echo "El mayor es $n3";
            }

            for($c = 1; $c <= 10; $c++){
                echo "$c ";
            }*/
        ?>
    </p>
    <h2>
        <?php
        echo $z;
        ?>
    </h2>
</body>

</html>