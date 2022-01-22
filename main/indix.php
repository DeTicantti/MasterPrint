<?php 
include('funciones/menu.php');
session_start();

if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
        //asignamos menu
        $menu = getMenuAdmin();
        
    }
    else{   
        //asignamos menu
        $menu = getMenuUser();
    }
}

require('funciones/conexion.php');
require('funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location: ../index.php');
}
$sql = "SELECT c.cli_nom, c.cli_ape, c.cli_tel, r.rep_imp, r.rep_mod, r.rep_falla, r.rep_date FROM reparaciones r INNER JOIN clientes c ON r.cli_id = c.cli_id";
$errors = array();
$a = 5;
$res = $con->prepare($sql);
//$res->bind_param('i',$a);
$res->execute(); //? echo "actualizado": echo "ocurrio un error";
$res->store_result();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="styly.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="reciboimpresora">
<form action="">
    <label for=""><span>Nombre</span></label>
    <label for="">Carlos</label>
    <label for=""><span>impresora</span></label>
    <label for="">J710</label>
    <label for=""><span>falla</span></label>
    <label for="">limpieza de cabezal</label>
    <label for=""><span>fecha</span></label>
    <label for=""></label>
</form>
</div>
    

    
</body>
</html>