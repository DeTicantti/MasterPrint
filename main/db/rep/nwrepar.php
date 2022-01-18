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

if (isset($_POST['enviar'])) {
    $id = null;
    $idUser = $_SESSION['nivel'];
    $nombre = strtoupper($_POST['nombre']);
    $apellido = strtoupper($_POST['apellido']);
    $telefono = $_POST['telefono'];
    /*$marca = strtoupper($_POST['marca']);
    $modelo = strtoupper($_POST['modelo']);
    $serie = $_POST['serie'];
    $falla = $_POST['falla'];*/
    if (!empty($nombre) && !empty($apellido) && !empty($telefono)) {

        $timeobj = new DateTimeZone('America/Mexico_City');
        $timeobjeto = new DateTime('now', $timeobj);
        $tim = $timeobjeto->format('m-j-y');
        
        $sql = "INSERT INTO clientes (cli_id,cli_nom,cli_ape,cli_tel,cli_reg) VALUES (?,?,?,?,?)";
        $request = $con->prepare($sql);
        $request->bind_param("issis",$id,$nombre,$apellido,$telefono,$tim);                 
        if ($request->execute()) {
            $res = "¡Cliente guardado!";
            $a = mysqli_insert_id($con);
            $b = $a;
        }else $errors[] = " Ocurrio un error";
                   /* }else $errors[] = " No se pudo guardar el archivo";
                }else $errors[] = " El archivo ya existe";
            }else $errors[] = " El archivo excede el tamaño permitido";
        }else $errors[] = " Tipo de archivo no permitido";*/
    }else $errors[] = " faltan campos por llenar";
    


    ?>


<?php }elseif (isset($_POST['enviarr'])){
    
    
        $id = null;
        $idUser = $_SESSION['nivel'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $a = $_POST['iden'];
        $marca = strtoupper($_POST['marca']);
        $modelo = strtoupper($_POST['modelo']);
        $serie = strtoupper($_POST['serie']);
        $falla = strtolower($_POST['falla']);
        $status = 'P';
        
        $timeobj = new DateTimeZone('America/Mexico_City');
        $timeobjeto = new DateTime('now', $timeobj);
        $timetrab = $timeobjeto->format('m-j-y') . ' ' . $timeobjeto->format('H:i');
        //$time = date('m-j-y h:i');
   
    if (!empty($nombre) && !empty($apellido) && !empty($telefono)) {
        $sql = "INSERT INTO reparaciones (rep_id,cli_id,rep_imp,rep_mod,rep_serial,rep_falla,rep_sta,rep_date) VALUES (?,?,?,?,?,?,?,?)";
        $request = $con->prepare($sql);
        $request->bind_param("iissssss",$id,$a,$marca,$modelo,$serie,$falla,$status,$timetrab);
                                
        if ($request->execute()) {
            $res = "¡Reparación archivada!";
        }else $errors[] = " Ocurrio un error";
                       /* }else $errors[] = " No se pudo guardar el archivo";
                    }else $errors[] = " El archivo ya existe";
                }else $errors[] = " El archivo excede el tamaño permitido";
            }else $errors[] = " Tipo de archivo no permitido";*/
    }else $errors[] = " faltan campos por llenar";
        
}
else{
        $id = null;
        $idUser = $_SESSION['nivel'];
        $nombre = $_GET['nom'];
        $apellido = $_GET['ape'];
        $a = $_GET['i'];
        $tel = $_GET['te'];
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
    
    
    <div>


    <div class="logo sm">
    <a href="../../index.php"><img src="../../../img/logomasterp.png" alt=""></a>
</div>
    <h1>Agregar reparación</h1>
    <?php
    
    ?>    
    <?php 
    if (isset($res)) {
        if ($res) {
            
        
    ?>
        <div class="bg- sucess text-white p-2 mx-5 text-center">
        <?php echo $res ?> 
        </div>
    <?php
        }else $errors[] = "algo salio mal";
    }
    include('../../funciones/errors.php');
    ?>
    
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="contact" id="general" enctype="multipart/form-data">
        <label for="name"><span>Cliente</span></label>
        
        <input type="text"  name="nombre" id="name" value="<?php echo $nombre; ?>" readonly= "readonly" required></input>
        <input type="text"  name="apellido" id="apellido" value="<?php echo $apellido; ?>" readonly= "readonly" required></input>
        </br>
        <input type="number" name="iden" id="iden" value="<?php echo $a ?>" readonly="readonly" hidden >
        <input type="number" name="telefono" id="telefono" value="<?php echo $tel ?>" readonly="readonly" hidden >
        
         
        <div class="etiqueta"><label for="marca"><span>Impresora Marca</span></label></div>
        <div class="input_container">
                    <input autocomplete="off" type="text" maxlength="25" id="pais_id" onkeyup="autocompletar()" name="marca" required>
                    <ul id="lista_id"></ul>
                </div>

        
        <div class="etiqueta"><label for="modelo"><span>Impresora Modelo</span></label></div>
        <div class="input_container">
                    <input autocomplete="off" type="text" maxlength="25" id="imp_mod" onkeyup="autocompletarmod()" name="modelo" required>
                    <ul id="lista_id_mod"></ul>
                </div>
                <a href="">agregar impresora</a>
        
    </br>
        <label for="serie"><span>No. Serie</span></label>
        <input type="text" maxlength="4" name="serie" id="serie" required>
        <label for="falla"><span>Falla</span></label>
        <textarea name="falla" maxlength="350" id="" cols="30" rows="10" required></textarea>

        <input type="reset" class="send" value="Borrar"></input>
        <input type="submit" class="send" value="Añadir servicio" name="enviarr"></input>
    </form>
    
    
    
    
    
    </div>
    
    
    
    
    
    </div>  
    
    <footer class="last">Insertar</footer>
    
    </body>
    </html>


<?php
exit;
}

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
        
    <div class="logo sm">
    <a href="../../index.php"><img src="../../../img/logomasterp.png" alt=""></a>
</div>
    <h1>Nueva reparación</h1>
    
    <?php 
    if (isset($res)) {
        if ($res) {
            
        
    ?>
        <div class="bg- sucess text-white p-2 mx-5 text-center">
        <?php echo $res ?>
        <form action="ticket.php" method="POST" target="_blank">
        <input type="submit" class="sendRed" value="Ticket" name="ticket">
    </form> 
        </div>
    <?php
        }else $errors[] = "algo salio mal";
    }
    include('../../funciones/errors.php');
    ?>
    
    
    <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" class="contact" id="general" enctype="multipart/form-data">
        <label for="name"><span>Cliente</span></label>
        
        <input type="text" name="nombre" id="name" value="<?php echo $nombre; ?>" readonly= "readonly" maxlength="25" required></input>
        <input type="text" maxlength="25" name="apellido" id="apellido" value="<?php echo $apellido; ?>" readonly= "readonly" required></input>
        </br>
        <input type="number" name="iden" id="iden" value="<?php echo $a ?>" readonly="readonly" required hidden>
        <input type="number" max="9999999999" name="telefono" id="telefono" value="<?php echo $telefono; ?>" readonly= "readonly" required hidden></input></br>
        
        <div class="etiqueta"><label for="marca"><span>Impresora Marca</span></label></div>
        <div class="input_container">
                    <input autocomplete="off" type="text" maxlength="35" id="pais_id" onkeyup="autocompletar()" name="marca" required>
                    <ul id="lista_id"></ul>
                </div>

        
        <div class="etiqueta"><label for="modelo"><span>Impresora Modelo</span></label></div>
        <div class="input_container">
                    <input autocomplete="off" type="text" maxlength="35" id="imp_mod" onkeyup="autocompletarmod()" name="modelo" required>
                    <ul id="lista_id_mod"></ul>
                </div>
                <a href="">agregar impresora</a>
        
    </br>
        <label for="serie"><span>No. Serie</span></label>
        <input type="text" maxlength="4" name="serie" id="serie" required>
        <label for="falla"><span>Falla</span></label>
        <textarea name="falla" maxlength="350" id="" cols="30" rows="10" required></textarea>

        <!--<input type="reset" class="send" value="Borrar"></input>-->
        <input type="submit" class="send" value="Añadir servicio" name="enviarr"></input>
    </form>
    
    <form action="ticket.php" method="POST" target="_blank">
        <input type="submit" class="send" value="Imprimir Ticket" name="ticket">
    </form>
    
    
    </div>
    
    
    
    
    
    </div>  
    
    <footer class="last">Insertar</footer>
    
    </body>
    </html>

 
     

