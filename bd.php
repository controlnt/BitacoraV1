<?php

#iniciar sesion
if (isset($_SESSION)) {
session_start();
}

#datos para conectar bd
$conectarbd = mysqli_connect(
    'localhost',
    'root',
    '',
    'bitacora'
);

/*if (isset($conectarbd)) {
    echo "DB esta conectada";
}*/
?>