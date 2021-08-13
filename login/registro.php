<?php

include ("../bd.php");

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

if (isset($_POST['btnregistrar'])) {
    $contraseñaencriptada = password_hash($contraseña,PASSWORD_DEFAULT);
    $query = "INSERT INTO users(usuario,correo,contraseña) values ('$usuario', '$correo', '$contraseñaencriptada')";

    if (mysqli_query($conectarbd, $query)) {
        echo "<script>alert('Usuario Registrado: $usuario');</script>";
        header("Location: ../index.php");
}else {
    echo "Error";
}

}
?>