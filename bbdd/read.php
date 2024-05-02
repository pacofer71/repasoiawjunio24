<?php
require_once __DIR__ . "/conexion/miconexion.php";
$q = "select * from articulos";
$articulos = mysqli_query($llave, $q);
//var_dump($articulos);
//die();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="background-color:cornflowerblue">
    <h3>
        <center>LISTADO DE ARTÍCULOS</center>
    </h3>
    <br>
    <center>
        <a href="create.php"><button>+ Nuevo</button></a>
    </center>
    <br>
    <table align='center' border='2' cellpadding='8'>
        <thead>
            <tr style="background-color:lightgray">
                <th>
                    ID
                </th>
                <th>
                    NOMBRE
                </th>
                <th>
                    DESCRIPCION
                </th>
                <th>
                    STOCK
                </th>
                <th>
                    ACCIONES
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($fila = mysqli_fetch_assoc($articulos)) {
                echo <<<TXT
                <tr>
                    <td>
                        {$fila['id']}
                    </td>
                    <td>
                        {$fila['nombre']}
                    </td>
                    <td>
                        {$fila['descripcion']}
                    </td>
                    <td>
                        {$fila['stock']}
                    </td>
                    <td>
                        <form action='borrar.php' method='POST'>
                            <input type='hidden' name='articulo_id' value='{$fila['id']}' />
                            <button type="button">
                                <a href="update.php?articulo_id={$fila['id']}" style="text-decoration:none">Edit</a>
                            </button>
                            <button type="submit" onclick="return confirm('¿Desea borrar el articulo?');">Borrar</button>
                        </form>
                    </td>
                </tr>
                TXT;
            }
            ?>
        </tbody>
    </table>

</body>

</html>