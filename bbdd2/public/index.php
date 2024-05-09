<?php
$q = "select * from articulos order by id desc";
require_once __DIR__ . "/../conexion/conexion.php";
$articulos = mysqli_query($llave, $q);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:beige">
    <h3>
        <center>ARTICULOS</center>
    </h3>
    <center>
        <a href="nuevo.php"><button>+ NUEVO</button></a>
    </center>
    <br>
    <table align='center' cellpadding='4' cellspacing='2' border='1'>
        <thead>
            <tr style="background-color:black; color:white">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCION</th>
                <th>PRECIO (€)</th>
                <th>TIPO</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($articulos as $item) {
                $color = ($item['tipo'] == 'bazar') ? "blue" : "green";
                echo <<<TXT
                <tr>
                <td>{$item['id']}</td>
                <td>{$item['nombre']}</td>
                <td>{$item['descripcion']}</td>
                <td>{$item['precio']}</td>
                <td style="color:$color;">{$item['tipo']}</td>
                <td>Botones</td>
                </tr>
                TXT;
            }
            ?>
        </tbody>
    </table>

</body>

</html>