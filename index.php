<?php

$error = "";
if (isset($_GET["msj"])&& ($_GET["msj"] == "msjError")) {
    $error = "<span> ¡ </span>usuario o contraseña incorrectos <span> ! </span>";
}
if (isset($_GET["msj"])&& ($_GET["msj"] == "gracias")) {
    $error = "enhorabuena vuelve pronto";
}
if (isset($_GET["msj"])&& ($_GET["msj"] == "id-denegado")) {
    $error = "favor de iniciar sesión";
}
$timeobj = new DateTimeZone('America/Mexico_City');
$timeobjeto = new DateTime('now', $timeobj);
$timetrab = $timeobjeto->format('j-m-y') . 'T' . $timeobjeto->format('h:i:s A');
$time = date('j-m-y h:i:s A');
$time2 = date('Y-m-j');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="FormularioUsuarios" content="Usuarios">
    <title>InicioIntranet</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="intranet.js"> </script>
    <script type="text/javascript">

function startTime(){

today=new Date();

h=today.getHours();

m=today.getMinutes();

s=today.getSeconds();

m=checkTime(m);

s=checkTime(s);

document.getElementById('reloj').innerHTML=h+":"+m+":"+s;

t=setTimeout('startTime()',500);}

function checkTime(i)

{if (i<10) {i=0 + i;}return i;}

window.onload=function(){startTime();}

</script>
</head>
<body>

<div class="done"></div>

<!--<div class="imagen"> 
    <img src="img/logocopycentrosm.png" alt="logo">
</div>-->

<div id="toHome">
    <form action="login/autenticar2.php" method="POST" onsubmit="return validacion()"
    id="inicio" name="inicio">
        <label for="name" class="mail">Usuario</label>
        <?php //echo password_hash("carlos", PASSWORD_DEFAULT)."\n";?>
        <?php echo '<br/>'. $time2 . '<br/>'. $timetrab;?>
        <input type="text" name="name" id="name"/>

        <label for="pass" class="pass">Contraseña</label>
        <input type="password" name="pass" id="pass"/>
        <br class="clearfloat"/>
       
        <input type="submit" name="enviar" value="entrar" class="bInicio" id="bInicio"/>
        <p class="red"><?php echo $error ?></p>
    </form>
    

    
</div>
<div id="reloj" style=" width: 450px; background-color: black;font-size:100px;color: green ; text-align: center "></div>    
</body>
</html>