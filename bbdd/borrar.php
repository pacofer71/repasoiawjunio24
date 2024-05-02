<?php
if(!isset($_POST['articulo_id'])){
    header("Location:read.php");
    die();
}
$id=(int)$_POST['articulo_id'];

if($id==0){
    header("Location:read.php");
    die();
}

require_once __DIR__."/conexion/miconexion.php";
$q="delete from articulos where id= ?";
$stmt=mysqli_stmt_init($llave);
mysqli_stmt_prepare($stmt, $q);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);
mysqli_close($llave);
header("Location:read.php");