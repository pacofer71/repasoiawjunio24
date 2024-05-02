<?php
try{
    //intentará hacer esto
    $llave=mysqli_connect("localhost", "usuario", "secret0", "repaso1");

}catch(Exception $ex){
    //si hemos tenido error arriba se viene aquí
    die("Error al conectar:".$ex->getMessage());
}