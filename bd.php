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

$bd = new mysqli("host17.latinoamericahosting.com", "sangelco", "S@ngelCP2020", "sangelco_bitacora");
if ($bd->connect_errno) {
    echo "Error al conectar la base de datos. Codigo de error(" . $bd->connect_errno . ") " . $bd->connect_error;
}
