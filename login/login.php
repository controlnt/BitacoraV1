<?php
include ("../bd.php");


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

echo "$usuario";

if ($_POST['btnlogin']) {
    $query = mysqli_query($conectarbd,"SELECT * FROM users WHERE usuario = '$usuario'");
    $fila = mysqli_num_rows($query);
    $buscarcontra = mysqli_fetch_array($query);

    if (($fila == 1)&&(password_verify($contraseña,$buscarcontra['contraseña']))) {
        $_SESSION['ver_login'] = $usuario;
        header("Location: ../index.php");
    }
}else {
    echo "<script>
                alert('Mensaje');
    </script>";
}

/*header("Location: index.php");*/


?>