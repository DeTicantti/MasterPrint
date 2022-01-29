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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $status = "T";
    $sql = "SELECT * from trabajadores";
        $request = $con->prepare($sql);
        $request->execute();
        $request->store_result();
        
}
if (isset($_POST['enviarr'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $trab_id = $_POST['tecnico'];
        $diagnostico = strtolower($_POST['diagnos']);
        $status = "T";
        $costo = $_POST['costo'];
        $timeobj = new DateTimeZone('America/Mexico_City');
        $timeobjeto = new DateTime('now', $timeobj);
        $timetrab = $timeobjeto->format('m-j-y').' '.$timeobjeto->format('H:i');
        //$time = date('');
               
    
    
            $sql2 = "UPDATE reparaciones SET rep_sta = ?, trab_id = ?, rep_diagnostico = ?, rep_costo = ?, rep_daterev = ? WHERE rep_id =?";
            $request = $con->prepare($sql2);
            $request->bind_param("sisisi",$status,$trab_id,$diagnostico, $costo,$timetrab,$id);
            if ($request->execute()) {
                $res = "¡actualizado se ¡";
            }else $errors[] = "Ocurrio un error";
            
            //$request->bind_param()
    }
    ?>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=../../index.php"> 
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
            
        
    <?php    
    }
    if (isset($_POST['entregar'])) {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $trab_id = $_POST['tecnico'];
                $diagnostico = $_POST['diagnos'];
                $status = "E";
                $costo = $_POST['costo'];
                $timeobj = new DateTimeZone('America/Mexico_City');
                $timeobjeto = new DateTime('now', $timeobj);
                $timetrab = $timeobjeto->format('m-j-y').' '.$timeobjeto->format('H:i');
                $sql2 = "UPDATE reparaciones SET rep_sta = ?, trab_id = ?, rep_diagnostico = ?, rep_costo = ?, rep_daterev = ?, rep_dateF = ? WHERE rep_id =?";
                $request = $con->prepare($sql2);
                $request->bind_param("sisissi",$status,$trab_id,$diagnostico, $costo,$timetrab,$timetrab,$id);
                if ($request->execute()) {
                        $res = "¡actualizado¡";
                    }else $errors[] = "Ocurrio un error";
                    
                    //$request->bind_param()
            }
            ?>
            <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <META HTTP-EQUIV="REFRESH" CONTENT="1;URL=../../index.php"> 
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
                            echo `<div class='sucess'><i class='fas fa-check-circle'></i> ¡Se asigno la reparacion <br/> a partir de este punto inicia garantia!</div>`;
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
        <script src="" async defer></script>
    </body>
</html>


        <?php }else $errors[] = "Ups! te falto algún campo";
    

?> 

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="FormularioUsuarios" content="Usuarios">
    
        <title>Intranet</title>
        <link href="../../style.css" rel="stylesheet" type="text/css">
        <link href="../style.css" rel="stylesheet" type="text/css">
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="../../css/all.min.css" rel="stylesheet" type="text/css">
        
            <link rel="stylesheet" href="../../fontawesomeweb/css/all.min.css" type="text/css">
        <script type="text/javascript" src="intranet.js"> </script>
        <script type="text/javascript" src="jquery-3.4.1.min.js"></script>
        <script type="text/javascript" src="sistema.js"></script>
        <script type="text/javascript" src="sistema2.js"></script>
    
    
    </head>
    <body>
    <div class="container">
    <header>
        <div class="closeSession">
        <?php echo menulib()?>
        </div>
    </header>
    
    </br>
    <div>
    <h1>Agregar técnico</h1>
    
    
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="contact" id="general" enctype="multipart/form-data">
        <label for="status"><span>Status</span></label>
        
        <input type="text" name="status" id="status" value="<?php echo $status;?>" readonly= "readonly" required hidden></input>
        <input type="number" name="id" value="<?php echo $id ?>" hidden>

        <label for="tecnico"><span>Técnico asignado</span> </label>
        
        
            <?php if ($request->num_rows>0) {
                            $request->bind_result($id,$nombre,$reparaciones);
            } ?>
            <select name="tecnico" id="">
                       <?php while ($request->fetch()) { ?>
             <option value="<?php echo $id ?>"> <?php echo $nombre ?> </option>
           
            <?php } ?>
            </select>
        
        </br>
        <label for="diagnos"><span>Diagnóstico</span></label>
        <textarea name="diagnos" id="" cols="30" rows="10" required></textarea>
        <label for="costo">Costo</label>
        <input type="number" min="0" name="costo" id="" required>
        <br/>
        <input type="reset" class="send" value="Borrar"></input>
        <input type="submit" class="send" value="Añadir al taller" name="enviarr"></input>
        <input type="submit" class="send" value="Entregar" name="entregar"></input>
    </form>
    
    
    
    
    </div>
    
    
    
    
    
    </div>  
    
    <footer class="last">Insertar</footer>
    
    </body>
    </html>
