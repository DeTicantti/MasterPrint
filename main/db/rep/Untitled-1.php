<?php 

$timeobj = new DateTimeZone('America/Mexico_City');
        $timeobjeto = new DateTime('now', $timeobj);
        $tim = $timeobjeto->format('m-j-y') . ' ' . $timeobjeto->format('H:i');
        var_dump($tim);
        echo $tim;

$week = $timeobjeto->format('W');
echo "chin", $week;