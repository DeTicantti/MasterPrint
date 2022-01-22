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
if (isset($_POST['sendA'])) {
    # code...

$idmaquina = $_POST['id'];
//$fechacam = $_POST['fechacam'];
$diagnostico = $_POST['aviso'];


if (isset($idmaquina) && isset($diagnostico)) {
    //$id = $con->real_escape_string($_POST['maquinaid']);
    //$contFin = $con->real_escape_string($_POST['fechacam']);
    
    if (empty($idmaquina)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE reparaciones SET rep_aviso = ? WHERE rep_id =?";
        $request = $con->prepare($sql);
        $request->bind_param("si",$diagnostico,$idmaquina);
        if ($request->execute()) {
            $res = "¡Aviso agregado¡";
        }else $errors[] = "Ocurrio un error";
        
        //$request->bind_param()
        
    }
    
}else $errors[] = "Ups! te falto algún campo";


?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../reparaciones.php"> 
        <link rel="stylesheet" href="../../style.css" type="text/css">
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="comments">
        <h1></h1>
            <div class="comment">
                <?php  
                
                if (isset($request)) {
                    if ($request) {
                        if ($con->affected_rows>0) {
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Aviso actualizado!</div>";
                        }else{
                            $errors[] = "Este id no existe";
                        }
                    }else{$errors[] = "Error en la actualización";}
                }
                if (count($errors)>0) {
                    echo "<div class='error'>";
                    foreach($errors as $error){
                        echo "<i class='fas fa-exclamation-circle'></i>".$error."<br>";
                    }
                    echo "</div>";
                    }
                    $con->close();
                ?>    
                
                
            </div>
        
            
        </div>
    
    </div>
    <div class="btn-add">
        <a href="$"><i class="fas fa-plus-circle"></i></a>
    </div>
    
        
        
        <script src="" async defer></script>
    </body>
</html>
<?php } ?>