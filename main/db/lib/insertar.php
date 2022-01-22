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
    if (!empty($nombre) && !empty($apellido) && !empty($telefono)) {
        
$timeobj = new DateTimeZone('America/Mexico_City');
$timeobjeto = new DateTime('now', $timeobj);
$fecha = $timeobjeto->format('m-j-y');

        //$time = date('ism');
        //var_dump($time);
       /* $tipos = array('image/png','image/jpeg','application/pdf');
        if (in_array($_FILES['archivo']['type'],$tipos)) {
            $tamano = 1024*1024*60; 
            if ($_FILES['archivo']['size'] < $tamano) {
                $carpeta = "libros/";
                if (!file_exists($carpeta)) {
                mkdir($carpeta);
                }
                $carpeta .= "$nombre$time";
            //$carpeta .= "$idUser/$fecha";
            //if (!file_exists($carpeta)) {
              //  mkdir($carpeta);
            //}
                $tipo = $_FILES['archivo']['type'];
                $date = date('Ymd-His');

                if (strcmp($tipo,"application/pdf" == 0)) {
                $archivo = $carpeta.".pdf";   #nombramos a los archivos
                }elseif (strcmp($tipo,"image/png" == 0)) {
                $archivo = $carpeta.".png";
                }else {
                $archivo = $carpeta.".jpg";
                }
                $tmpName = $_FILES['archivo']['tmp_name'];  #guardamos el nombre temporal donde se alojo el archivo
                if (!file_exists($archivo)) {   //si no existe el archivo procedemos a guardarlo
                    if (move_uploaded_file($tmpName,$archivo)) {    #esta funcion mueve el archivo guardado temporalmente a la variable que contiene otro lugar de alojamiento, si es tru, si podra guardarlo*/
                        $sql = "INSERT INTO clientes (cli_id,cli_nom,cli_ape,cli_tel,cli_reg) VALUES (?,?,?,?,?)";
                            $request = $con->prepare($sql);
                            $request->bind_param("issis",$id,$nombre,$apellido,$telefono,$fecha);
                        if ($request->execute()) {
                            $res = "¡Cliente guardado!";
                        }else $errors[] = " Ocurrio un error";
                   /* }else $errors[] = " No se pudo guardar el archivo";
                }else $errors[] = " El archivo ya existe";
            }else $errors[] = " El archivo excede el tamaño permitido";
        }else $errors[] = " Tipo de archivo no permitido";*/
    }else $errors[] = " faltan campos por llenar";
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
    
        <link rel="stylesheet" href="../../../fontawesomeweb/css/all.min.css" type="text/css">
    <script type="text/javascript" src="intranet.js"> </script>
    <script type="text/javascript" src="sistema.js"></script>
        <script type="text/javascript" src="sistema2.js"></script>
        <script type="text/javascript" src="../rep/jquery-3.4.1.min.js"></script>


</head>
<body>
<div class="container">
<header>
    <div class="closeSession">
    <?php echo menulib()
    ?>
    </div>
</header>

</br>
<div>
<h1>Nuevo cliente</h1>

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


<form action="../rep/nwrepar.php" method="POST" class="contact" id="general" enctype="multipart/form-data">
	<label for="nombre"><span>Nombre:</span></label>
	<input type="text" maxlength="25" name="nombre" id="name" required></input></br>
	<label for="apellido"><span>Apellido:</span></label>
	<input type="text" maxlength="25" name="apellido" id="apellido" required>
    <label for="telefono"><span>Telefono:</span></label>
	<input type="number" max="9999999999" name="telefono" id="telefono" required></input></br>
</br>

	<input type="reset" class="send" value="Borrar"></input>
	<input type="submit" class="send" value="Servicio" name="enviar"></input>
</form>





</div>





</div>  

<footer class="last">Insertar</footer>

</body>
</html>
<?php ?>