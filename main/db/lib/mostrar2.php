<?php
// Utilizaremos conexion PDO PHP
function conexion() {
	//Declaramos el servidor, la BD, el usuario Mysql y Contraseña BD.
    return new PDO('mysql:host=localhost;dbname=masterprint', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}

$pdo = conexion();
$keyword = '%'.$_POST['palabra'].'%';
$sql = "SELECT * FROM impresoras WHERE imp_mod LIKE (:keyword) ORDER BY imp_id  ASC LIMIT 0, 7";
$query = $pdo->prepare($sql);
$query->bindParam(':keyword', $keyword, PDO::PARAM_STR);
$query->execute();
$lista = $query->fetchAll();
foreach ($lista as $milista) {
    //los colocamos en un selected
	// Colocaremos negrita a los textos
	$pais_nombre = '<select>
    <option selected>'. str_replace($_POST['palabra'], '<b>'.$_POST['palabra'].'</b>', $milista['imp_mod']).'</option>
    <select>';
	// Aquì, agregaremos opciones
    echo '<li onclick="set_items(\''.str_replace("'", "\'", $milista['imp_mod']).'\')">'.$pais_nombre.'</li>
    ';
}


?>