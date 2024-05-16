<?php
if(!isset($_POST['idArticulo'])){
    header("Location:index.php");
    die();
}
$id=(int) $_POST['idArticulo'];
if($id==0){
    header("Location:index.php");
    die();
}

require_once __DIR__."/../conexion/conexion.php";
$q="delete from articulos where id=?";
$stmt=mysqli_stmt_init($llave);
mysqli_stmt_prepare($stmt, $q);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($llave);
header("Location:index.php");

