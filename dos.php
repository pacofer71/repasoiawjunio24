<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        $dato=["uno", "dos", "tres", 34, true, 56.78, "Pedro"];
        echo "<ul>";
        foreach($dato as $item){
            echo "<li>El valor es: $item y el tipo:".gettype($item)."</li>";
        }
        echo "</ul>";
        echo "<br>";
        echo "el array \$dato tiene: ".count($dato)." elementos";
        echo "<br>";
        $dato[0]="Otro valor";
        echo "<br>";
        foreach($dato as $item){
            echo "El valor es: $item y el tipo:".gettype($item)."<br>";
        }
        $usuario=[
            'nombre'=>"Manolo",
            'apellidos'=>'Gil Perez',
            'edad'=>34,
            'ciudad'=>'Almería'
        ];
        echo "<ul>";
        foreach($usuario as $clave=>$valor){
            echo "<li>La claves es:$clave y el valor: $valor </li>";
        }
        echo "</ul>";

        echo "El nombre es: ".$usuario['ciudad'];
        echo "<hr>";

        $usuario1=[
            'nombre'=>"Manolo",
            'apellidos'=>'Gil Perez',
            'edad'=>34,
            'ciudad'=>'Almería'
        ];
        $usuario2=[
            'nombre'=>"Ana",
            'apellidos'=>'Gil Perez',
            'edad'=>14,
            'ciudad'=>'Sevilla'
        ];
        $hermanos=[$usuario1, $usuario2, $usuario1, $usuario2];
        $cont=1;
        echo "<ul>";
        foreach($hermanos as $hermano=>$valor){
            echo "<li>Hermano: ".$cont++. "</li>";
            echo "<ol>";
            foreach($valor as $k=>$v){
                echo "<li>$k=$v</li>";
            }
            echo "</ol>";
        }
        echo "</ul>";




    ?>
</body>
</html>