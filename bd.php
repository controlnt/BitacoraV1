<?php

#iniciar sesion
session_start();

#datos para conectar bd
$conectarbd = mysqli_connect(
    'host17.latinoamericahosting.com',
    'sangelco',
    'S@ngelCP2020',
    'sangelco_bitacora'
);

/*if (isset($conectarbd)) {
    echo "DB esta conectada";
}*/

$xd = "lapakwnoer";

$_SESSION['datos'] = $xd;
?>