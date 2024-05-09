<?php
session_start();
function mostrarError(string $nom)
{
    if (isset($_SESSION[$nom])) {
        echo "<p style='font-size 0.8em; color:red; font-size:0.80em; font-style:italic;'>{$_SESSION[$nom]}</p>";
        unset($_SESSION[$nom]);
    }
}

if (!isset($_GET['articulo_id'])) {
    header("Location:read.php");
    die();
}
$id = (int)$_GET['articulo_id'];

if ($id == 0) {
    header("Location:read.php");
    die();
}



//comprobaremos que el id del articulo existe
require_once __DIR__ . "/conexion/miconexion.php";
$q = "select * from articulos where id=?";
$stmt = mysqli_stmt_init($llave);
mysqli_stmt_prepare($stmt, $q);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $i, $nom, $sto, $des);
if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
    header("Location:read.php");
    die();
}
if (isset($_POST['btn_env'])) {
    //recojo y limpio los datos
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $descripcion = htmlspecialchars(trim($_POST['descripcion']));
    $stock = (int) htmlspecialchars(trim($_POST['stock']));
    //Hacemos las validaciones
    $errores = false;

    if (strlen($nombre) < 5 || strlen($nombre) > 50) {
        $errores = true;
        $_SESSION['errNombre'] = "*** Error el nombre debe tener entre 5 y 50 caracteres.";
    } else {
        //comprobaremos que $nombre NO existe en la BB de Datos
        require_once __DIR__ . "/conexion/miconexion.php";
        $q = "select * from articulos where nombre=? AND id <> ?";
        $stmt = mysqli_stmt_init($llave);
        mysqli_stmt_prepare($stmt, $q);
        mysqli_stmt_bind_param($stmt, 'si', $nombre, $id);
        mysqli_stmt_execute($stmt);
        //Almacenamos el resultado
        mysqli_stmt_store_result($stmt);
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errores = true;
            $_SESSION['errNombre'] = "*** Error el nombre artículo $nombre YA existe";
            mysqli_stmt_close($stmt);
            mysqli_close($llave);
        } else {
            mysqli_stmt_close($stmt);
        }
    }

    if (strlen($descripcion) < 10 || strlen($descripcion) > 150) {
        $errores = true;
        $_SESSION['errDescripcion'] = "*** Error la descripcion debe tener entre 10 y 150 caracteres.";
    }
    if ($stock <= 0) {
        $errores = true;
        $_SESSION['errStock'] = "*** Error el stock NO puede ser negativo.";
    }
    if ($errores) {
        header("Location:update.php?articulo_id=$id");
        die();
    }
    // Todo ha ido bien actualizamos el registro
    $q = "update articulos set nombre=?, descripcion=?, stock=? where id = ?";
    $stmt = mysqli_stmt_init($llave);
    mysqli_stmt_prepare($stmt, $q);
    mysqli_stmt_bind_param($stmt, 'ssii', $nombre, $descripcion, $stock, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($llave);
    header("Location:read.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo</title>
</head>

<body style="background-color:cornflowerblue">
    <form method="POST" action="update.php?articulo_id=<?php echo $id ?>">
        <label for="nombre">Nombre:</label>
        <br>
        <input type="text" value="<?php echo $nom; ?>" name="nombre" placeholder="Nombre artículo..." id="nombre" style="width:60%" />
        <?php
        mostrarError('errNombre');
        ?>
        <br>
        <label for="stock">Stock:</label>
        <br>
        <input type="number" value="<?php echo $sto; ?>" name="stock" placeholder="Stock artículo..." id="stock" style="width:60%" />
        <?php
        mostrarError('errStock');
        ?>
        <br>
        <label for="descripcion">Descripción:</label>
        <br>
        <textarea name="descripcion" placeholder="Descripcion artículo..." id="descipcion" style="width:60%" rows='5'><?php echo $des; ?></textarea>
        <?php
        mostrarError('errDescripcion');
        ?>
        <br>
        <input type="reset" value="Limpiar" />
        <input type="submit" name="btn_env" value="Editar" />

    </form>

</body>

</html>