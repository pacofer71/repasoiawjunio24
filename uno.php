<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    echo "Hola";
    echo "<br>";
    echo "Adios";
    echo '<hr>';
    //variables
    $nombre="Manolo"; //string
    $num=12; //int
    $num2=23.45; //float 
    $estado = true; //bool
    echo "<br>";
    echo "El nombre es $nombre";
    echo "<br>";
    echo 'El nombre es $nombre';
    echo "<br>";
    echo "Tu nombre es \$nombre";
    echo "<br>";
    $nombre="kjhkhk4asdad5";
    $miNumero=(int) $nombre;
    echo "<br>";
    if(is_int($miNumero)){
        echo "La variable \$miNumero es de tipo int y su valor es:$miNumero";
    }else{
        echo "La variable \$miNumero NO es de tipo int";
    }
    echo "<br>";
    echo $miNumero;
    echo "<br>";
    if(is_string($nombre)){
        echo 'La variable $nombre es de tipo string';
    }else{
        echo 'La variable $nombre NO es de tipo string';
    }
    //------------------------------------------------------------------
    $var=67;
    $var2=(string) $var;
    echo "<hr>";
    echo "El valor de \$var2=$var2 y su tipo es: ".gettype($var2);
    echo "<br>";
    if($var===$var2){
        echo "El valor de las variables es igual";
    }else{
        echo "El valor o el tipo de las variables NO es igual";
    }
    
    
    ?>
</body>
</html>