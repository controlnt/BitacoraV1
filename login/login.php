<?php
include ("../bd.php");


$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];


if ($_POST['btnlogin']) {
    $query = mysqli_query($conectarbd,"SELECT * FROM users WHERE usuario = '$usuario'");
    $fila = mysqli_num_rows($query);
    $buscarcontra = mysqli_fetch_array($query);

    if (($fila == 1)&&(password_verify($contrasena,$buscarcontra['contrasena']))) {
        $_SESSION['ver_login'] = $usuario;
        header("Location: ../index.php");
    }
}else {
    header("Location: form_registro.php");
}

/*header("Location: index.php");*/
$_SESSION['usuario'] = $usuario;
?>