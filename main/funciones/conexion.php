<?php
$con = new mysqli("localhost","root","","masterprint");
if ($con->connect_errno) {
    echo "Algo salio mal ".$con->errno; 
}
