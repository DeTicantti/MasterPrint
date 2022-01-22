<?php 
require('../../funciones/conexion.php');
$errors = array();
$contador = array();
$total = array();

if (isset($_POST['sendF'])) {
    # code...

$idmaquina = $_POST['id'];
//$fechacam = $_POST['fechacam'];
$falla = $_POST['falla'];


if (isset($idmaquina) && isset($falla)) {
    //$id = $con->real_escape_string($_POST['maquinaid']);
    //$contFin = $con->real_escape_string($_POST['fechacam']);
    
    if (empty($idmaquina)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE reparaciones SET rep_falla = ? WHERE rep_id =?";
        $request = $con->prepare($sql);
        $request->bind_param("si",$falla,$idmaquina);
        if ($request->execute()) {
            $res = "¡falla actualizada¡";
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
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../index.php"> 
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
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Falla actualizada!</div>";
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
                    //$con->close();
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


<!--DIAGNOSTICO CHANGE-->
<?php if (isset($_POST['sendD'])) {
    # code...

$idmaquina = $_POST['id'];
//$fechacam = $_POST['fechacam'];
$diagnostico = $_POST['diagnostico'];


if (isset($idmaquina) && isset($diagnostico)) {
    //$id = $con->real_escape_string($_POST['maquinaid']);
    //$contFin = $con->real_escape_string($_POST['fechacam']);
    
    if (empty($idmaquina)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE reparaciones SET rep_diagnostico = ? WHERE rep_id =?";
        $request = $con->prepare($sql);
        $request->bind_param("si",$diagnostico,$idmaquina);
        if ($request->execute()) {
            $res = "¡Diagnostico actualizado¡";
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
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../index.php"> 
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
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Diagnostico actualizado!</div>";
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
                    //$con->close();
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


<!-- Send AViSO-->
<?php if (isset($_POST['sendD'])) {
    # code...

$idmaquina = $_POST['id'];
//$fechacam = $_POST['fechacam'];
$diagnostico = $_POST['diagnostico'];
var_dump($idmaquina);
var_dump($diagnostico);

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
            $res = "¡Diagnostico actualizado¡";
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
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../index.php"> 
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
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Diagnostico actualizado!</div>";
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
                   // $con->close();
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





<!--MONEY CHANGE-->
<?php if (isset($_POST['sendM'])) {
    # code...

$idmaquina = $_POST['id'];
//$fechacam = $_POST['fechacam'];
$money = $_POST['precio'];


if (isset($idmaquina) && isset($money)) {
    //$id = $con->real_escape_string($_POST['maquinaid']);
    //$contFin = $con->real_escape_string($_POST['fechacam']);
    
    if (empty($idmaquina)) {
        $errors[] = "el id esta vacio";
    }else{
        $sql = "UPDATE reparaciones SET rep_costo = ? WHERE rep_id =?";
        $request = $con->prepare($sql);
        $request->bind_param("ii",$money,$idmaquina);
        if ($request->execute()) {
            $res = "¡Cuenta actualizada¡";
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
        <META HTTP-EQUIV="REFRESH" CONTENT="2;URL=../../index.php"> 
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
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡Cuenta actualizada!</div>";
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
                    //$con->close();
                ?>    
                
                
            </div>
        
            
        </div>
    
    </div>
    
        
        
        <script src="" async defer></script>
    </body>
</html>
<?php } ?>


