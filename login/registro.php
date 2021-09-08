<?php

include ("../bd.php");

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

if (isset($_POST['btnregistrar'])) {
    $contrasenaencriptada = password_hash($contrasena,PASSWORD_DEFAULT);
    $query = "INSERT INTO users(usuario,correo,contrasena) values ('$usuario', '$correo', '$contrasenaencriptada')";

    if (mysqli_query($conectarbd, $query)) {
        echo "<script>alert('Usuario Registrado: $usuario');</script>";
        header("Location: ../index.php");
}else {
    echo "Error".mysqli_error($conectarbd);
}

}
?>