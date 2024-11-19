<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplos variables php</title>
</head>
<body>
<!--TIPOS DE VARIABLES -> Booleano: true , false -> Cadena de texto: "..."."..." -> Array-->
<p>
    <!--
        le asigno valor numerico
        $ejemplo = 34;
        muestro el contenido de la variable, el punto es el operador de contatenacion, es la forma clasica
        echo "el valor de la variable ejemplo es " .$ejemplo;
    -->
</p>
<p>
    <?php
        //Forma moderna
        $ejemplo = 30;
        echo "el valor de la variable ejemplo es $ejemplo ";
    ?>
</p>
<p>
    <?php
        //Forma booleana
        $ejemplo1 = true;
        echo "el valor de la variable ejemplo es $ejemplo1 ";
    ?>
</p>
<p>
    <?php
        //Forma cadena de texto
        $ejemplo2 = "hola";
        echo "el valor de la variable ejemplo es '$ejemplo2' ";
    ?>
</p>
<p>
    <?php
        //Forma array
        $ejemplo3 = array(1, 2, 3, 4, 5);
        echo "el valor de la variable ejemplo es ";
        print_r($ejemplo3);
    ?>
</p>
<p>
    <?php
       $car = array("brand"=>"Ford", "model"=>"Mustang", "year"=>1964);
       
       foreach ($car as $valor) {
         echo $valor.", ";
       }
    ?>
</p>

<br>

<!--Otra forma de hacerlo-->
<p>
    <h2>Mostrando contenido del array</h2>
    <?php foreach ($car as $valor): ?>
    <p><?php echo $valor; ?></p>
    <?php endforeach  ?>
</p>









</body>
</html>