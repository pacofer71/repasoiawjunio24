<?php
require_once 'datos.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action="action1.php"> <!-- POSt o GET -->
        NOMBRE<br>
        <input type="text" name="nombre" placeholder="Tu nombre..." />
        <br><br>
        EMAIL<br>
        <input type="email" name="email" placeholder="Tu correo..." />
        <br><br>
        PASSWORD<br>
        <input type="password" name="password" placeholder="Tu contraseña..." />
        <br><br>
        Provincia<br>
        <select name="provincia">
            <?php
                echo "<option>__ Elige una provincia __</option> ";
                foreach($todasProvincias as $item){
                    echo "<option>$item</option>";
                }
            ?>
        </select>
        <br><br>
        Elige tus tramo de edad:<br>
        
        <input type="radio" name="edad" id="menor" value="1"><label for="menor">Menor de edad.</label><br>
        <input type="radio" name="edad" id="mayor" value="2"><label for="mayor">Mayor de edad.</label>
        <br><br>

        Elige tus aficiones:<br>
        <?php
            foreach($todasAficiones as $value){
                echo "<input type='checkbox' name='aficiones[]' 
                value='{$value}' id='{$value}'><label for='{$value}'>$value</label><br>";
            }
        ?>
        

        <br>
        
        <input type="submit" value="Enviar" />
    </form>
</body>
</html>