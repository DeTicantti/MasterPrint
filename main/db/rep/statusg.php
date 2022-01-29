<?php 
session_start();
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../clientes.php'>Volver</a>";
            return $resultado;
        }
        
    }
    else{   
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../librosUs.php'>Volver</a>";
            return $resultado;
        }
    }
}

//session_start();
require('../../funciones/conexion.php');
require('../../funciones/funcs.php');
if (!isset($_SESSION['nivel'])) {
    header('Location:../../../index.php');
}
$errors = array();

if (isset($_POST['id'])) {
    $id = null;

    //$nombre = strtoupper($_POST['nombre']);
    //$apellido = strtoupper($_POST['apellido']);
    $telefono = $_POST['id'];
    echo $telefono;
    echo "hola";
}
echo "holaz";