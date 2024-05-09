<?php
session_start();

function pintarErrores($nombre)
{
    if (isset($_SESSION[$nombre])) {
        echo "<p style='color:red; italic; font-size:smaller'>{$_SESSION[$nombre]}</p>";
        unset($_SESSION[$nombre]);
    }
}

if (isset($_POST['btn'])) {
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));
    $precio = (float)htmlspecialchars(trim($_POST['precio']));
    $tipo = (isset($_POST['tipo'])) ? htmlspecialchars(trim($_POST['tipo'])) : "";

    $errores = false;
    if (strlen($nombre) < 3 || strlen($nombre) > 40) {
        $_SESSION['err_nombre'] = "*** Error el nombre debe tener entre 3 y 40 caracteres";
        $errores = true;
    }else{
        //comprobaremos que el nombre de articulo no existe
        require __DIR__."/../conexion/conexion.php";
        $q="select id from articulos where nombre=?";
        $stmt=mysqli_stmt_init($llave);
        mysqli_stmt_prepare($stmt, $q);
        mysqli_stmt_bind_param($stmt, 's', $nombre);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)>0){
            $_SESSION['err_nombre']='*** Error el nombre de articulo ya está registrado.';
            $errores=true;
            //como he tenido un error cierro todo pues ya no necesitaré la conexion
            mysqli_stmt_close($stmt);
            mysqli_close($llave);
        }else{
            //NO cierro la llave pue la puedo seguir necesitando para guardar el articulo
            mysqli_stmt_close($stmt);
        }
        
        


    }
    if (strlen($descripcion) < 5 || strlen($descripcion) > 50) {
        $_SESSION['err_descripcion'] = "*** Error la descripcion debe tener entre 5 y 50 caracteres";
        $errores = true;
    }
    if ($precio <= 0 || $precio > 9999.99) {
        $_SESSION['err_precio'] = "*** Error el precion debe estar entre 0 y 9999.99";
        $errores = true;
    }
    if ($tipo != 'bazar' && $tipo != 'digital') {
        $_SESSION['err_tipo'] = "*** Error tipo incorrecto o no selecciono ninguno";
        $errores = true;
    }
    if ($errores) {
        header("Location:nuevo.php");
        die();
    }
    echo "TODO OK";
}

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
        <center>CREAR ARTICULOS</center>
    </h3>
    <div style="width:40%; margin-left:auto; margin-right:auto; padding:12px; border-style:solid; border-color:gray">
        <form method="POST" action="nuevo.php">
            <label for="nombre">Nombre</label><br>
            <input type="text" name="nombre" id="nombre" style="width:100%;">
            <?php
            pintarErrores('err_nombre');
            ?>
            <br><br>

            <label for="precio">Precio (€)</label><br>
            <input type="number" name="precio" id="precio" step="0.01" style="width:100%;">
            <?php
            pintarErrores('err_precio');
            ?>
            <br><br>

            <label for="descripcion">Descripcion</label><br>
            <textarea name="descripcion" id="descipcion" rows='5' style="width:100%;"></textarea>
            <?php
            pintarErrores('err_descripcion');
            ?>
            <br><br>

            <label>Tipo</label><br>
            <input type="radio" name="tipo" value="digital" id="d"> <label for="d">Digital</label><br>
            <input type="radio" name="tipo" value="bazar" id="bz"> <label for="bz">Bazar</label><br>
            <?php
            pintarErrores('err_tipo');
            ?>

            <br>
            <input type="submit" value="GUARDAR" name="btn" style="background-color:blue; color:white; padding:4px" />
            <input type="reset" value="LIMPIAR" style="background-color:orange; color:white; padding:4px" />


        </form>
    </div>
</body>

</html>