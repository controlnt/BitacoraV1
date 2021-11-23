<?php

//VERIFICAR QUE LA SESSION ESTE INICIADA
if (!isset($_SESSION)) {
    session_start();
}

//VERIFICAR QUE EL USUARIO ESTE LOGEADO
if (!isset($_SESSION['ver_login'])) {
    header('Location: login/login.php');
}

?>