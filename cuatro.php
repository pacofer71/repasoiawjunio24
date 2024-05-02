<?php
session_start();

function pintarErrores(string $nombreError)
{
    if (isset($_SESSION[$nombreError])) {
        echo "<p style='color:red; font-size:0.80em; font-style:italic;'>{$_SESSION[$nombreError]}</p>";
        unset($_SESSION[$nombreError]);
    }
}

require_once 'datos.php';

if (isset($_POST['btn_enviar'])) {
    //procesamos el formulario
    //1.- Recogemos y limpiamos los datos
    $nombre = htmlspecialchars(trim($_POST['nombre']));
    $email = htmlspecialchars(trim($_POST['email']));
    $pass = htmlspecialchars(trim($_POST['password']));
    $prov = htmlspecialchars(trim($_POST['provincia']));
    $edad = (isset($_POST['edad'])) ? htmlspecialchars(trim($_POST['edad'])) : "-1";
    $aficiones = (isset($_POST['aficiones'])) ? $_POST['aficiones'] : [];
    //2.- Hacemos las validaciones
    $errores = false;
    if (strlen($nombre) < 3 || strlen($nombre) > 50) {
        $errores = true;
        $_SESSION['errNombre'] = "*** Error el nombre NO puede tener menos de 3 caracteres ni mas de 50";
    }
    if (strlen($pass) < 5 || strlen($pass) > 50) {
        $errores = true;
        $_SESSION['errPass'] = "*** Error el password NO puede tener menos de 5 caracteres ni mas de 50";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores = true;
        $_SESSION['errEmail'] = "*** Error debes introducir un email válido";
    }
    if (!in_array($prov, $todasProvincias)) {
        $errores = true;
        $_SESSION['errProv'] = "*** Error debes seleccionar una provincia válida";
    }
    if ($edad != 1 && $edad != 2) {
        if ($edad == -1) {
            $_SESSION['errEdad'] = "*** Debes seleccionar un tramo de edad";
        } else {
            $_SESSION['errEdad'] = "*** Error, edad inválida";
        }
        $errores = true;
    }
    if (count($aficiones) != 0) {
        foreach ($aficiones as $item) {
            if (!in_array($item, $todasAficiones)) {
                $errores = true;
                $_SESSION['errAficiones'] = "*** Error, aficiones inválidas";
                break;
            }
        }
    } else {
        $errores = true;
        $_SESSION['errAficiones'] = "*** Error, debes seleccionar alguna afición";
    }
    
    if ($errores) {
        header("Location:cuatro.php");
        die();
    }
    // Si estoy aqí es pq no hay errores, vamos a mostrar los datos
    echo "El nombre es: $nombre";
    echo "<br>";
    echo "El email es: $email";
    echo "<br>";
    echo "El password es: $pass";
    echo "<br>";
    echo "La provincia elegida es: $prov<br>";
    echo ($edad == 1) ? "Eres menor de edad<br>" : "Eres Mayor de edad<br>";
    echo "Tus aficiones son:<br>";
    echo "<ol>";
    foreach ($aficiones as $aficion) {
        echo "<li>$aficion</li>";
    }
    echo "</ol>";
    die();
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

    <form method="POST" action="cuatro.php"> <!-- POSt o GET -->
        NOMBRE<br>
        <input type="text" name="nombre" placeholder="Tu nombre..." />
        <?php
        pintarErrores('errNombre');
        ?>
        <br>
        EMAIL<br>
        <input type="email" name="email" placeholder="Tu correo..." />
        <?php
        pintarErrores('errEmail');
        ?>
        <br>
        PASSWORD<br>
        <input type="password" name="password" placeholder="Tu contraseña..." />
        <?php
        pintarErrores('errPass');
        ?>
        <br>
        Provincia<br>
        <select name="provincia">
            <?php
            echo "<option>__ Elige una provincia __</option> ";
            foreach ($todasProvincias as $item) {
                echo "<option>$item</option>";
            }
            ?>
        </select>
        <?php
        pintarErrores('errProv');
        ?>
        <br>
        Elige tus tramo de edad:<br>

        <input type="radio" name="edad" id="menor" value="1"><label for="menor">Menor de edad.</label><br>
        <input type="radio" name="edad" id="mayor" value="2"><label for="mayor">Mayor de edad.</label>
        <?php
        pintarErrores('errEdad');
        ?>
        <br>

        Elige tus aficiones:<br>
        <?php
        foreach ($todasAficiones as $value) {
            echo "<input type='checkbox' name='aficiones[]' 
                value='{$value}' id='{$value}'><label for='{$value}'>$value</label><br>";
        }
        ?>
        <?php
        pintarErrores('errAficiones');
        ?>
        <br>

        <input type="submit" value="Enviar" name="btn_enviar" />
        <input type="reset" value="Limpiar" />
    </form>
</body>

</html>