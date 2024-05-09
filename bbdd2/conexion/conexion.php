<?php
try{
    $llave=mysqli_connect('127.0.0.1', 'usuario', 'secret0', 'crud2');
}catch(Exception $ex){
    die("Error en la conexion:".$ex->getMessage());
}