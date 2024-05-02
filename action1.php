<?php
require_once 'datos.php';

$nombre = htmlspecialchars(trim($_POST['nombre']));
$email = htmlspecialchars(trim($_POST['email']));
$pass = htmlspecialchars(trim($_POST['password']));
$prov=htmlspecialchars(trim($_POST['provincia']));
$edad=(isset($_POST['edad'])) ? htmlspecialchars(trim($_POST['edad'])) : "-1";
$aficiones=(isset($_POST['aficiones'])) ? $_POST['aficiones'] : [];

$chivato = false;

if (strlen($nombre) < 4 || strlen($nombre) > 10) {
    echo "Error el nombre no debe tener mas de 10 caracteres y menos de cuatro<br>";
    $chivato = true;
}
if (strlen($pass) < 4 || strlen($pass) > 15) {
    echo "Error la contraseña no debe tener mas de 15 caracteres y menos de cuatro<br>";
    $chivato = true;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "El email NO es válido<br>";
    $chivato = true;
}
if(!in_array($prov, $todasProvincias)){
    echo "La provincia NO es válida o no elegiste ninguna<br>";
    $chivato=true;
}
if($edad!=1 && $edad!=2){
    if($edad==-1){
        echo "No seleccionaste la edad<br>";
    }else{
        echo "La edad NO es válida<br>";
    }
    $chivato=true;
}
if(count($aficiones)==0){
    echo "Error no has elegido ninguna afición!!!<br>";
    $chivato=true;
}else{
    foreach($aficiones as $afi){
        if(!in_array($afi, $todasAficiones)){
            echo "Las aficiones NO son válidas";
            $chivato=true;
            break;
        }
    }
}
if (!$chivato) {
    echo "El nombre es: $nombre";
    echo "<br>";
    echo "El email es: $email";
    echo "<br>";
    echo "El password es: $pass";
    echo "<br>";
    echo "La provincia elegida es: $prov<br>";
    echo ($edad==1) ? "Eres menor de edad<br>" : "Eres Mayor de edad<br>";
    echo "Tus aficiones son:<br>";
    echo "<ol>";
    foreach($aficiones as $aficion){
        echo "<li>$aficion</li>";
    }
    echo "</ol>";
}else{
    echo "<br>Corrige primero los errores";
}
