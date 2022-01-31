<?php
session_start();
if ($_SESSION['nivel']== "1" || $_SESSION['nivel']=="2") {


    if ($_SESSION['nivel'] == "1") {
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../index.php'>Volver</a>";
            return $resultado;
        }
        
    }
    else{   
        //asignamos menu
        function menulib(){
            $resultado = "<a href='../../index.php'>Volver</a>";
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = "E"; 
    $dateF = date('j-m-y');

    
    $timeobj = new DateTimeZone('America/Mexico_City');
    $timeobjeto = new DateTime('now', $timeobj);
    $timetrab = $timeobjeto->format('m-j-y'). ' ' . $timeobjeto->format('H:i');
    
    $sql = "SELECT * from trabajadores";
        $request = $con->prepare($sql);
        $request->execute();
        $request->store_result();
        
    
            $sql2 = "UPDATE reparaciones SET rep_sta = ?, rep_dateF = ? WHERE rep_id =?";
<<<<<<< HEAD
            $request = $con->prepare($sql2);
            $request->bind_param("ssi",$status,$timetrab,$id);
            if ($request->execute()) {
=======
            $requests = $con->prepare($sql2);
            $requests->bind_param("ssi",$status,$timetrab,$id);
            if ($requests->execute()) {
>>>>>>> 5c161aacefbbe92ffe51c6987cc63e292e002ee7
                $res = "¡actualizado¡";
            }else $errors[] = "Ocurrio un error";
            
            //$request->bind_param()
    } ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<<<<<<< HEAD
        <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=../../index.php"> 
=======
        <META HTTP-EQUIV="REFRESH" CONTENT=".5;URL=../../index.php"> 
>>>>>>> 5c161aacefbbe92ffe51c6987cc63e292e002ee7
        <link rel="stylesheet" href="../../style.css" type="text/css">
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    </head>
    <body>
    <div class="container">
        <div class="comments">
        <h1></h1>
            <div class="comment">
                <?php  
<<<<<<< HEAD
                
                if (isset($request)) {
                    if ($request) {
=======
            
                if (isset($request)) {
                    if ($requests) {
>>>>>>> 5c161aacefbbe92ffe51c6987cc63e292e002ee7
                        if ($con->affected_rows>0) {
                            echo "<div class='sucess'><i class='fas fa-check-circle'></i> ¡A partir de este punto inicia garantia!</div>";
                        }else{
                            $errors[] = "Para actualizar el estatus debe entrar a garantia timetrab";
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

